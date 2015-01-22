<?php
/**
 * Created by PhpStorm.
 * User: njohns
 * Date: 1/1/15
 * Time: 10:52 PM
 */

namespace Rql;

use Rql\Query\QueryBuilder;

class Rql
{
    public function builder()
    {
        $rand = mt_rand(3, 10);
        $pool = [];

        for($i = 0; $i < $rand; $i++) {
            $pool[] = $this->makeConnection();
        }

        $rounds = mt_rand(4, 10);

        for($i = 0; $i < $rounds; $i++) {
            echo "==> Beginning round {$i} \n";

            $connum = mt_rand(0, $rand-1);

            echo "==> Fetching connection {$connum} from pool \n";

            $r = $pool[$connum];

            echo "==> Fetching count\n";

            $count = $r->db('test')->table('testInserts')->count()->run();

            echo "==> Count: " . var_export($count['data'], true) . "\n";
        }
    }

    public function makeConnection()
    {
        $s = stream_socket_client("tcp://127.0.0.1:28015", $errno, $errstr);
        $connection = Connection\GuzzleConnection::makeConnection($s);
        $connection->connect();
        $client = new Transport($connection);

        $b = new QueryBuilder($client);

        return $b;
    }
}
