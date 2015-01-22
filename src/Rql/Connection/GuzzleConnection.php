<?php
/**
 * Created by PhpStorm.
 * User: njohns
 * Date: 1/2/15
 * Time: 7:00 AM
 */

namespace Rql\Connection;

use GuzzleHttp\Stream\NoSeekStream;
use GuzzleHttp\Stream\Stream;
use GuzzleHttp\Stream\StreamInterface;

class GuzzleConnection extends Connection
{
    /**
     * @var StreamInterface
     */
    protected $connection;

    /**
     * @param StreamInterface $connection
     */
    public function __construct(StreamInterface $connection)
    {
        $this->connection = $connection;
    }

    /**
     * @param $resource
     * @param array $options
     * @return GuzzleConnection
     */
    public static function makeConnection($resource, $options = [])
    {
        $stream = Stream::factory($resource, $options);
        $nonSeek = new NoSeekStream($stream);

        return new self($nonSeek);
    }

    public function close()
    {
        if($this->connection) {
            $this->connection->close();
        }

        return parent::close();
    }

    /**
     * @param $message
     * @return int
     * @throws \Exception
     */
    public function write($message)
    {
        $totalBytesWritten = 0;
        while($totalBytesWritten < strlen($message)) {
            $bytesWritten = $this->connection->write($message);

            if($bytesWritten === false || $bytesWritten === 0) {
                $this->connection->close();
                throw new \Exception("Unable to write to stream");
            }

            $totalBytesWritten += $bytesWritten;
        }

        return $totalBytesWritten;
    }

    /**
     * @param int $bytes
     * @param int $step
     * @return string
     * @throws \Exception
     */
    public function read($bytes, $step = 0)
    {
        $response = '';
        while (strlen($response) < $bytes) {
            $partialResponse = $this->connection->read($bytes);

            if ($partialResponse === false) {
                $metadata = $this->connection->getMetadata();
                $this->close();

                if (isset($metadata['timed_out']) && $metadata['timed_out']) {
                    throw new \Exception("Reading from stream timed out");
                }

                throw new \Exception("Unable to read from stream");
            }

            $response .= $partialResponse;
        }

        return $response;
    }

    /**
     * @return array|mixed|null
     */
    protected function getMetadata()
    {
        if(! $this->connected) {
            return [];
        }

        return $this->connection->getMetadata();
    }
}
