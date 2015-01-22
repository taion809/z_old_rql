<?php
/**
 * Created by PhpStorm.
 * User: njohns
 * Date: 1/3/15
 * Time: 10:17 PM
 */

namespace Rql\Query;

use Rql\Generated\Query\QueryType;
use Rql\Query\Queries\Aggregation\Count;
use Rql\Query\Queries\Db;
use Rql\Query\Queries\Query;
use Rql\Query\Queries\Table;
use Rql\Transport;
use Rql\Types\TypeResolver;

class QueryBuilder
{
    /**
     * @var Query
     */
    private $node = null;

    /**
     * @var Transport
     */
    private $client;

    public function __construct(Transport $transport)
    {
        $this->client = $transport;
    }

    public function db($name)
    {
        $name = TypeResolver::resolve($name);
        $this->node = new Db($name);

        return $this;
    }

    public function table($name)
    {
        $name = TypeResolver::resolve($name);
        $this->node = new Table($this->node, $name);

        return $this;
    }

    public function count()
    {
        $this->node = new Count($this->node);
        return $this;
    }

    public function run()
    {
        $ast = $this->node->build();

        return $this->client->run($ast);
    }

}
