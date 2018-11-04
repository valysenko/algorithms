<?php

namespace App\Services\Graph;

/**
 * Class GraphVisited
 * @package App\Services\Graph
 */
class GraphVisited
{
    /**
     * @var array
     */
    protected $visited;

    /**
     * @return array
     */
    public function getVisited()
    {
        return $this->visited;
    }

}