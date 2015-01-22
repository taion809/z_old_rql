<?php
/**
 * Created by PhpStorm.
 * User: njohns
 * Date: 1/3/15
 * Time: 10:37 PM
 */

namespace Rql\Query\Queries;

use Rql\Datum;

abstract class Query extends Datum
{
    /**
     * @var Datum[]
     */
    protected $terms = [];

    /**
     * @var Datum[]
     */
    protected $options = [];

    // TODO: Not a fan of recursion here, lets figure it out later.
    /*
     * Thoughts:
     * So how a lot of these queries work is that it is a recursive chain of classes
     * that include the previous class (hence the recursive portion)
     *
     * So the query looks like this
     * [Start] -> [insert] -> [[table], [data]]
     * But is constructed r->table()->insert([data])->start()->run()
     *
     * So you can see the last called is the first node.
     *
     * For now, going to keep going this way but that means i need to consider how the query builder will work with this.
     * I'm not positive that it can :|
     *
     * Think about it tomorrow morning.
     */
    public function build()
    {
        $finalTerms = [];
        foreach($this->terms as $term) {
            $finalTerms[] = $term->build();
        }

        $finalOptions = [];
        foreach($this->options as $key => $option) {
            $finalOptions[$key] = $option->build();
        }

        return [$this->getDatumType(), $finalTerms, (object) $finalOptions];
    }
}
