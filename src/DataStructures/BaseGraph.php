<?php

namespace App\DataStructures;

class BaseGraph
{
    public const DIRECTED_TYPE = "Directed";
    public const UNDIRECTED_TYPE = "Undirected";

    /**
     * @var string
     */
    protected $type;

    /**
     * @var array
     */
    protected $adjacencyList;

    /**
     *
     * @var array
     */
    protected $vertices;

    /**
     * Graph constructor.
     * @param string $type
     */
    public function __construct(string $type)
    {
        $this->type = $type;
        $this->adjacencyList = [];
        $this->vertices = [];
    }

    /**
     * @return array
     */
    public function getAdjacencyList()
    {
        return $this->adjacencyList;
    }

    /**
     * @return array
     */
    public function getVertices()
    {
        return $this->vertices;
    }

    /**
     * @param $vertex
     * @return bool
     */
    public function vertexExists($vertex)
    {
        return in_array($vertex, $this->vertices);
    }

    /**
     * @param $vertex
     * @return array|null
     */
    public function getConnectedVerticesList($vertex)
    {
        if (array_key_exists($vertex, $this->adjacencyList)) {
            return $this->adjacencyList[$vertex];
        }

        return null;
    }
}