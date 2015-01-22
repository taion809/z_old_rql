<?php
/**
 * Created by PhpStorm.
 * User: njohns
 * Date: 1/2/15
 * Time: 9:23 AM
 */

namespace Rql;

use Rql\Connection\ConnectionInterface;

class Transport
{
    /**
     * @var ConnectionInterface
     */
    private $connection;

    /**
     * @var array
     */
    private $tokens = [];

    public function __construct(ConnectionInterface $connection)
    {
        $this->connection = $connection;
    }

    public function run($query)
    {
        $token = $this->generateToken();
        $this->tokens[$token] = true;

        // This is unfortunate, i need push this into the query builder instead.
        $query = [
            Generated\Query\QueryType::START,
            $query,
            (object) []
        ];

        $response = $this->connection->sendQuery($query, $token);
        return $response;
    }

    private function generateToken()
    {
        $retries = 0;
        $max = 1 << 30;
        do {
            $token = mt_rand(0, $max);
            $collision = isset($this->tokens[$token]);
        } while($collision && ++$retries < $max);

        if($collision) {
            throw new \Exception("Unable to generate unique key... :|");
        }

        return $token;
    }
}
