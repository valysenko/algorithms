<?php

namespace App\DataStructures\Nodes;


class TreeNode
{
    /**
     * @var mixed
     */
    private $value;

    /**
     * @var TreeNode
     */
    private $left;

    /**
     * @var TreeNode
     */
    private $right;

    /**
     * @var TreeNode
     */
    private $parent;

    /**
     * Node constructor.
     * @param mixed $value
     */
    public function __construct($value)
    {
        $this->value = $value;
        $this->left = null;
        $this->right = null;
        $this->parent = null;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param mixed $value
     */
    public function setValue($value)
    {
        $this->value = $value;
    }

    /**
     * @return TreeNode
     */
    public function getLeft()
    {
        return $this->left;
    }

    /**
     * @param TreeNode $left
     */
    public function setLeft($left)
    {
        $this->left = $left;
    }

    /**
     * @return TreeNode
     */
    public function getRight()
    {
        return $this->right;
    }

    /**
     * @param TreeNode $right
     */
    public function setRight($right)
    {
        $this->right = $right;
    }

    /**
     * @return TreeNode
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * @param TreeNode $parent
     */
    public function setParent($parent)
    {
        $this->parent = $parent;
    }

}