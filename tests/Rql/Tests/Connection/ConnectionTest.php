<?php
/**
 * Created by PhpStorm.
 * User: njohns
 * Date: 1/27/15
 * Time: 7:44 AM
 */

namespace Rql\Tests\Connection;

use Rql\Connection\GuzzleConnection;
use \PHPUnit_Framework_TestCase;
use \Mockery as m;

class ConnectionTest extends \PHPUnit_Framework_TestCase
{
    public function tearDown()
    {
        m::close();
    }

    public function testConnectReturnsSuccess()
    {
        $handle = fopen('php://temp', 'rw+');
        fwrite($handle, 'SUCCESS' . chr(0));
        fseek($handle, 0);

        $stream = new NullWriteStream($handle);
        $connection = new GuzzleConnection($stream);

        $result = $connection->connect();

        $connection->close();
        $this->assertTrue($result);
    }

    public function testConnectReturnsTrueIfAlreadyConnected()
    {
        $stream = m::mock('GuzzleHttp\Stream\StreamInterface')->makePartial();
        $stream->shouldReceive('close')->once()->andReturn(true);

        $connection = new GuzzleConnection($stream);
        $connection->setConnected(true);

        $result = $connection->connect();

        $this->assertTrue($result);
    }

    /**
     * @expectedException \Exception
     * @expectedExceptionMessage Handshake failed.
     */
    public function testConnectThrowsExceptionOnWrite()
    {
        $stream = m::mock('GuzzleHttp\Stream\StreamInterface')->makePartial();
        $stream->shouldReceive('write')->once()->andReturn(0);
        $stream->shouldReceive('close')->twice()->andReturn(true);

        $connection = new GuzzleConnection($stream);

        $connection->connect();
        $connection->close();
    }

    /**
     * @expectedException \Exception
     * @expectedExceptionMessage Handshake failed.
     */
    public function testConnectThrowsExceptionOnRead()
    {
        $stream = m::mock('GuzzleHttp\Stream\StreamInterface')->makePartial();
        $stream->shouldReceive('write')->andReturn(1);
        $stream->shouldReceive('read')->once()->andReturn(false);
        $stream->shouldReceive('close')->once()->andReturn(true);

        $connection = new GuzzleConnection($stream);

        $connection->connect();
        $connection->close();
    }

    /**
     * @expectedException \Exception
     * @expectedExceptionMessage Handshake failed.
     */
    public function testConnectThrowsExceptionOnReadNotSuccess()
    {
        $handle = fopen('php://temp', 'rw+');
        fwrite($handle, 'NOT_SUCCESS' . chr(0));
        fseek($handle, 0);

        $stream = new NullWriteStream($handle);
        $connection = new GuzzleConnection($stream);

        $connection->connect();
        $connection->close();
    }

    public function testGetConnectionReturnsInstanceOfStreamInterface()
    {
        $stream = m::mock('GuzzleHttp\Stream\StreamInterface')->makePartial();
        $stream->shouldReceive('close')->once()->andReturn(true);

        $connection = new GuzzleConnection($stream);

        $expected = 'GuzzleHttp\Stream\StreamInterface';
        $actual = $connection->getConnection();

        $this->assertInstanceOf($expected, $actual);
    }

    public function testGetConnectedReturnsTrue()
    {
        $handle = fopen('php://temp', 'rw+');
        fwrite($handle, 'SUCCESS' . chr(0));
        fseek($handle, 0);

        $stream = new NullWriteStream($handle);
        $connection = new GuzzleConnection($stream);

        $connection->connect();
        $connected = $connection->getConnected();

        $connection->close();

        $this->assertTrue($connected);
    }

    public function testSendQueryReturnsJsonDecodedStructure()
    {
        $handle = fopen('php://temp', 'rw+');
        $queryBytes = [
            0x05, 0x00, 0x00, 0x00, 0x00, 0x00, 0x00, 0x00, // Token
            0x0F, 0x00, 0x00, 0x00,                         // Size
            0x7b, 0x22, 0x74, 0x22, 0x3a, 0x31, 0x2c, 0x22, // Response
            0x72, 0x22, 0x3a, 0x5b, 0x37, 0x5d, 0x7d,       // Response (cont)
        ];

        foreach($queryBytes as $bytes) {
            fwrite($handle, chr($bytes));
        }

        fseek($handle, 0);

        $stream = new NullWriteStream($handle);
        $connection = new GuzzleConnection($stream);

        $response = $connection->sendQuery([], 5);

        $connection->close();

        $expected = 7;
        $actual = array_shift($response['data']);

        $this->assertEquals($expected, $actual);
    }

    /**
     * @expectedException \Exception
     * @expectedExceptionMessage Response type missing
     */
    public function testSendQueryThrowsMissingResponseError()
    {
        $handle = fopen('php://temp', 'rw+');
        $queryBytes = [
            0x05, 0x00, 0x00, 0x00, 0x00, 0x00, 0x00, 0x00, // Token
            0x09, 0x00, 0x00, 0x00,                         // Size
            0x7b, 0x22, 0x72, 0x22, 0x3a, 0x5b, 0x37, 0x5d,
            0x7d,       // Response (cont)
        ];

        foreach($queryBytes as $bytes) {
            fwrite($handle, chr($bytes));
        }

        fseek($handle, 0);

        $stream = new NullWriteStream($handle);
        $connection = new GuzzleConnection($stream);

        $response = $connection->sendQuery([], 5);

        $connection->close();
    }

    /**
     * @expectedException \Exception
     * @expectedExceptionMessage Client error reported by server
     */
    public function testSendQueryThrowsClientError()
    {
        $handle = fopen('php://temp', 'rw+');
        $queryBytes = [
            0x05, 0x00, 0x00, 0x00, 0x00, 0x00, 0x00, 0x00, // Token
            0x10, 0x00, 0x00, 0x00,                         // Size
            0x7b, 0x22, 0x74, 0x22, 0x3a, 0x31, 0x36, 0x2c,
            0x22, 0x72, 0x22, 0x3a, 0x5b, 0x37, 0x5d, 0x7d,       // Response (cont)
        ];

        foreach($queryBytes as $bytes) {
            fwrite($handle, chr($bytes));
        }

        fseek($handle, 0);

        $stream = new NullWriteStream($handle);
        $connection = new GuzzleConnection($stream);

        $response = $connection->sendQuery([], 5);

        $connection->close();
    }

    /**
     * @expectedException \Exception
     * @expectedExceptionMessage Error compiling query... maybe?
     */
    public function testSendQueryThrowsCompileError()
    {
        $handle = fopen('php://temp', 'rw+');
        $queryBytes = [
            0x05, 0x00, 0x00, 0x00, 0x00, 0x00, 0x00, 0x00, // Token
            0x10, 0x00, 0x00, 0x00,                         // Size
            0x7b, 0x22, 0x74, 0x22, 0x3a, 0x31, 0x37, 0x2c,
            0x22, 0x72, 0x22, 0x3a, 0x5b, 0x37, 0x5d, 0x7d,       // Response (cont)
        ];

        foreach($queryBytes as $bytes) {
            fwrite($handle, chr($bytes));
        }

        fseek($handle, 0);

        $stream = new NullWriteStream($handle);
        $connection = new GuzzleConnection($stream);

        $response = $connection->sendQuery([], 5);

        $connection->close();
    }

    /**
     * @expectedException \Exception
     * @expectedExceptionMessage Runtime error
     */
    public function testSendQueryThrowsRuntimeError()
    {
        $handle = fopen('php://temp', 'rw+');
        $queryBytes = [
            0x05, 0x00, 0x00, 0x00, 0x00, 0x00, 0x00, 0x00, // Token
            0x10, 0x00, 0x00, 0x00,                         // Size
            0x7b, 0x22, 0x74, 0x22, 0x3a, 0x31, 0x38, 0x2c,
            0x22, 0x72, 0x22, 0x3a, 0x5b, 0x37, 0x5d, 0x7d,       // Response (cont)
        ];

        foreach($queryBytes as $bytes) {
            fwrite($handle, chr($bytes));
        }

        fseek($handle, 0);

        $stream = new NullWriteStream($handle);
        $connection = new GuzzleConnection($stream);

        $response = $connection->sendQuery([], 5);

        $connection->close();
    }

    /**
     * @expectedException \Exception
     * @expectedExceptionMessage Response token mismatch: received [5]
     */
    public function testSendQueryThrowsMismatchTokenError()
    {
        $handle = fopen('php://temp', 'rw+');
        $queryBytes = [
            0x05, 0x00, 0x00, 0x00, 0x00, 0x00, 0x00, 0x00, // Token
            0x0F, 0x00, 0x00, 0x00,                         // Size
            0x7b, 0x22, 0x74, 0x22, 0x3a, 0x31, 0x2c, 0x22, // Response
            0x72, 0x22, 0x3a, 0x5b, 0x37, 0x5d, 0x7d,       // Response (cont)
        ];

        foreach($queryBytes as $bytes) {
            fwrite($handle, chr($bytes));
        }

        fseek($handle, 0);

        $stream = new NullWriteStream($handle);
        $connection = new GuzzleConnection($stream);

        $response = $connection->sendQuery([], 6);

        $connection->close();
    }

    /**
     * @expectedException \Exception
     * @expectedExceptionMessage Invalid response from server
     */
    public function testSendQueryThrowsInvalidSecondaryTokenError()
    {
        $handle = fopen('php://temp', 'rw+');
        $queryBytes = [
            0x05, 0x00, 0x00, 0x00, 0x05, 0x00, 0x00, 0x00, // Token
            0x0F, 0x00, 0x00, 0x00,                         // Size
            0x7b, 0x22, 0x74, 0x22, 0x3a, 0x31, 0x2c, 0x22, // Response
            0x72, 0x22, 0x3a, 0x5b, 0x37, 0x5d, 0x7d,       // Response (cont)
        ];

        foreach($queryBytes as $bytes) {
            fwrite($handle, chr($bytes));
        }

        fseek($handle, 0);

        $stream = new NullWriteStream($handle);
        $connection = new GuzzleConnection($stream);

        $response = $connection->sendQuery([], 5);

        $connection->close();
    }
}
