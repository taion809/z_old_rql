<?php
/**
 * Created by PhpStorm.
 * User: njohns
 * Date: 1/26/15
 * Time: 6:41 PM
 */

namespace Rql\Tests\Connection;

use GuzzleHttp\Stream\Stream;
use Rql\Connection\GuzzleConnection;
use \PHPUnit_Framework_TestCase;
use \Mockery as m;

class GuzzleConnectionTest extends PHPUnit_Framework_TestCase
{
    public function tearDown()
    {
        m::close();
    }

    public function testInstanceOfConnectionInterface()
    {
        $expected = 'Rql\Connection\ConnectionInterface';

        $stream = Stream::factory("string stream");

        $actual =  new GuzzleConnection($stream);

        $this->assertInstanceOf($expected, $actual);
    }

    public function testStaticMethodInstanceOfConnectionInterface()
    {
        $expected = 'Rql\Connection\ConnectionInterface';

        $actual =  GuzzleConnection::makeConnection("string stream");

        $this->assertInstanceOf($expected, $actual);
    }

    public function testWriteReturnsBytesWritten()
    {
        $handle = fopen('php://temp', 'w+');

        $stream = new NullWriteStream($handle);
        $connection = new GuzzleConnection($stream);

        $result = $connection->write("test");

        $connection->close();
        $this->assertEquals(4, $result);
    }

    /**
     * @expectedException \Exception
     * @expectedExceptionMessage Unable to write to stream
     */
    public function testWriteThrowsException()
    {
        // Mock stream interface so we can forcefully throw an exception
        $stream = m::mock('GuzzleHttp\Stream\StreamInterface')->makePartial();
        $stream->shouldReceive('write')->once()->andReturn(0);
        $stream->shouldReceive('close')->twice()->andReturn(true);

        $connection = new GuzzleConnection($stream);
        $connection->write('invalid');

        $connection->close();
    }

    /**
     * @expectedException \Exception
     * @expectedExceptionMessage Reading from stream timed out
     */
    public function testReadThrowsTimeoutException()
    {
        // Mock stream interface so we can forcefully throw an exception
        $stream = m::mock('GuzzleHttp\Stream\StreamInterface')->makePartial();
        $stream->shouldReceive('read')->once()->andReturn(false);
        $stream->shouldReceive('getMetadata')->once()->andReturn(['timed_out' => true]);
        $stream->shouldReceive('close')->once()->andReturn(true);

        $connection = new GuzzleConnection($stream);
        $connection->read(9000);

        $connection->close();
    }

    /**
     * @expectedException \Exception
     * @expectedExceptionMessage Unable to read from stream
     */
    public function testReadThrowsGeneralException()
    {
        // Mock stream interface so we can forcefully throw an exception
        $stream = m::mock('GuzzleHttp\Stream\StreamInterface')->makePartial();
        $stream->shouldReceive('read')->once()->andReturn(false);
        $stream->shouldReceive('getMetadata')->once()->andReturn(['timed_out' => false]);
        $stream->shouldReceive('close')->once()->andReturn(true);

        $connection = new GuzzleConnection($stream);
        $connection->read(9000);

        $connection->close();
    }

    public function testGetMetadataDisconnectedReturnsEmptyArray()
    {
        $handle = fopen('php://temp', 'rw+');
        fwrite($handle, 'SUCCESS' . chr(0));
        fseek($handle, 0);

        $stream = new NullWriteStream($handle);
        $connection = new GuzzleConnection($stream);
        $connection->setConnected(false);

        $result = $connection->getMetadata();

        $connection->close();

        $this->assertEquals([], $result);
    }

    public function testGetMetadataConnectedReturnsArray()
    {
        $handle = fopen('php://temp', 'rw+');
        fwrite($handle, 'SUCCESS' . chr(0));
        fseek($handle, 0);

        $stream = new NullWriteStream($handle);
        $connection = new GuzzleConnection($stream);
        $connection->setConnected(true);

        $result = $connection->getMetadata();

        $connection->close();

        $this->assertNotEmpty($result);
    }
}
