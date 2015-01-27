<?php
/**
 * Created by PhpStorm.
 * User: njohns
 * Date: 1/2/15
 * Time: 8:42 AM
 */

namespace Rql\Connection;

use Rql\Generated\Response\ResponseType;

abstract class Connection implements ConnectionInterface
{
    /**
     * @var mixed
     */
    protected $connection = null;

    /**
     * @var bool
     */
    protected $connected = false;

    public function __destruct()
    {
        $this->close();
    }

    /**
     * @return bool
     * @throws \Exception
     */
    public function connect()
    {
        if($this->connected) {
            return true;
        }

        $response = $this->initHandshake();
        if($response) {
            $this->connected = true;
        }

        return true;
    }

    /**
     * @return bool
     */
    public function close()
    {
        if($this->connection) {
            $this->connection = null;
            $this->connected = false;
        }

        return true;
    }

    /**
     * @return mixed
     */
    public function getConnection()
    {
        return $this->connection;
    }

    /**
     * @return bool
     */
    public function getConnected()
    {
        return $this->connected;
    }

    /**
     * @param ConnectionInterface $connection
     */
    public function setConnection(ConnectionInterface $connection)
    {
        $this->connection = $connection;
    }

    /**
     * @param bool $connected
     */
    public function setConnected($connected = true)
    {
        $this->connected = $connected;
    }

    /**
     * @return bool
     * @throws \Exception
     */
    private function initHandshake()
    {
        $binaryVersion = pack("V", \Rql\Generated\VersionDummy\Version::V0_3); // "V" is little endian, 32 bit unsigned integer
        $handshake = $binaryVersion;
        $binaryKeyLength = pack("V", 0);
        $handshake .= $binaryKeyLength . "";
        $binaryProtocol = pack("V", \Rql\Generated\VersionDummy\Protocol::JSON);
        $handshake .= $binaryProtocol;

        try {
            $this->write($handshake);
        } catch(\Exception $e) {
            $this->close();
            throw new \Exception('Handshake failed.', 0, $e);
        }

        // Read SUCCESS\000 from stream.
        $response = '';
        while(true) {
            try {
                $r = $this->read(1);
            } catch(\Exception $e) {
                $this->close();
                throw new \Exception('Handshake failed.', 0, $e);
            }

            if($r == chr(0)) {
                break;
            }

            $response .= $r;
        }

        if($response !== 'SUCCESS') {
            throw new \Exception('Handshake failed.');
        }

        return true;
    }

    protected function buildRequest($query, $token)
    {
        $precision = ini_get('precision');
        if($precision === false || $precision < 17) {
            ini_set('precision', 17);
        }

        $json = json_encode($query);

        ini_set('precision', $precision);

        $size = pack('V', strlen($json));
        $binToken = pack('V', $token) . pack('V', 0);

        return $binToken . $size . $json;
    }

    public function sendQuery($query, $token)
    {
        $request = $this->buildRequest($query, $token);
        $bytes = $this->write($request);

        $headers = $this->fetchHeaders();

        $responseSize = $this->parseHeaders($headers, $token);
        $response = $this->fetchResponse($responseSize);

        return $this->parseResponse($response, $headers);
    }

    protected function fetchHeaders()
    {
        $rawHeaders = $this->read(12);
        $headers = unpack('Vtoken/Vtoken2/Vsize', $rawHeaders);

        return $headers;
    }

    protected function fetchResponse($size)
    {
        $rawResponse = $this->read($size);

        $response = json_decode($rawResponse, true);

        return $response;
    }

    protected function parseResponse($response, $headers)
    {
        $metadata = $this->getMetadata();

        if(! isset($response['t'])) {
            $this->processError($response, $headers, $metadata);
        }

        switch($response['t']) {
            case ResponseType::CLIENT_ERROR:
            case ResponseType::COMPILE_ERROR:
            case ResponseType::RUNTIME_ERROR:
                $this->processError($response, $headers, $metadata);
                break;
        }

        return $this->processSuccess($response, $headers, $metadata);
    }

    /**
     * @param $response
     * @param $headers
     * @param $metadata
     * @throws \Exception
     */
    protected function processError($response, $headers, $metadata)
    {
        // Close stream due to error.
        $this->close();

        if(!isset($response['t'])) {
            throw new \Exception('Response type missing');
        }

        // Do some extra stuff here like parse backtrace

        if($response['t'] == ResponseType::CLIENT_ERROR) {
            throw new \Exception('Client error reported by server');
        } elseif($response['t'] == ResponseType::COMPILE_ERROR) {
            throw new \Exception('Error compiling query... maybe?');
        } elseif($response['t'] == ResponseType::RUNTIME_ERROR) {
            throw new \Exception('Runtime error');
        }
    }

    /**
     * @param $response
     * @param $headers
     * @param $metadata
     * @return array
     */
    protected function processSuccess($response, $headers, $metadata)
    {
        return [
            'status' => $response['t'],
            'data' => $response['r'],
            'debug' => [
                'headers' => $headers,
                'response' => $response,
                'metadata' => $metadata
            ]
        ];
    }

    protected function parseHeaders($headers, $token)
    {
        if($headers['token2'] !== 0) {
            throw new \Exception("Invalid response from server");
        }

        if($headers['token'] !== $token) {
            throw new \Exception("Response token mismatch: received [{$headers['token']}]");
        }

        return (int) $headers['size'];
    }

    public static function makeConnection($resource, $options) {}

    abstract public function write($message);
    abstract public function read($bytes, $step = 0);
    abstract protected function getMetadata();
}
