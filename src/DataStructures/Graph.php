<?php

namespace App\DataStructures;

/**
 * Class Graph
 * @package App\DataStructures
 */
class Graph
{

    /**
     * @var array
     */
    private $adjacencyList;

    /**
     *
     * @var array
     */
    private $vertices;

    /**
     * Graph constructor.
     */
    public function __construct()
    {
        $this->adjacencyList = [];
        $this->vertices = [];
    }

    /**
     * @param $vertex1
     * @param $vertex2
     */
    public function insertEdge($vertex1, $vertex2)
    {
        $this->adjacencyList[$vertex1][] = $vertex2;

        if (!in_array($vertex1, $this->vertices))
        {
            $this->vertices[] = $vertex1;
        }

        if (!in_array($vertex2, $this->vertices))
        {
            $this->vertices[] = $vertex2;
        }

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