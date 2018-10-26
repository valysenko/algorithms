<?php

namespace App\DataStructures;

use App\DataStructures\Nodes\TreeNode;

/**
 * Not balanced Binary search tree
 * Search/Insert/Delete operations: O(log(n))
 *
 * Class SimpleBinaryTree
 * @package App\DataStructures
 */
class SimpleBinaryTree
{
    /**
     * @var TreeNode
     */
    private $root;

    /**
     * @var int
     */
    private $size;

    /**
     * SimpleBinaryTree constructor.
     */
    public function __construct()
    {
        $this->root = null;
        $this->size = 0;
    }

    /**
     * @return bool
     */
    public function isEmpty()
    {
        return $this->root === null;
    }

    /**
     * @return int
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * @return TreeNode
     */
    public function getRoot()
    {
        return $this->root;
    }

    /**
     * O(log(n))
     *
     * @param $value
     * @param TreeNode|null $node
     * @return mixed
     */
    public function search($value, TreeNode $node = null)
    {
        if (!$node || $node->getValue() === $value) {
            return $node;
        }
        if ($value >  $node->getValue()) {
            return $this->search($value, $node->getRight());
        } else {
            return $this->search($value, $node->getLeft());
        }
    }

    /**
     * O(log(n))
     *
     * @param $value
     * @param TreeNode|null $node
     * @return TreeNode|null
     */
    public function iterativeSearch($value, TreeNode $node = null)
    {
        if (!$node) {
            $node = $this->root;
        }

        while ($node && $node->getValue() != $value) {
            if ($value >  $node->getValue()) {
                $node =  $node->getRight();
            } else {
                $node =  $node->getLeft();
            }
        }

        return $node;
    }

    /**
     * O(log(n))
     *
     * @param TreeNode|null $node
     * @return TreeNode|null
     */
    public function min(TreeNode $node = null)
    {
        if (!$node) {
            $node = $this->root;
        }

        while ($node->getLeft()) {
            $node = $node->getLeft();
        }

        return $node;
    }

    /**
     * O(log(n))
     *
     * @param TreeNode|null $node
     * @return TreeNode|null
     */
    public function max(TreeNode $node = null)
    {
        if (!$node) {
            $node = $this->root;
        }

        while ($node->getRight()) {
            $node = $node->getRight();
        }

        return $node;
    }

    /**
     * O(n)
     *
     * @param $value
     * @return bool
     */
    public function insert($value)
    {
        $parent = null;
        $node = $this->root;

        // 1. Find parent for the new node
        while ($node) {
            $parent = $node;
            if ($value >= $node->getValue()) {
                $node = $node->getRight();
            } else {
                $node = $node->getLeft();
            }
        }
        // 2. Out of tree: node = null; parent = last tree node (parent of the new node)

        // 3. Create new node
        $newNode = new TreeNode($value);
        $newNode->setParent($parent);

        // 4. Connect parent node with new node
        if (!$parent) {
            $this->root = $newNode;
        } elseif ($newNode->getValue() <= $parent->getValue()) {
            $parent->setLeft($newNode);
        } else {
            $parent->setRight($newNode);
        }
        $this->size++;

        return true;
    }

    /**
     * O(log(n))
     *
     * @param TreeNode|null $node
     * @return TreeNode|null
     */
    public function next(TreeNode $node)
    {
        if ($node->getRight()) {
            return $this->min($node->getRight());
        }

        // Example: next to 13 is 15
        // -> while there is turn left ($node === $parent->getRight())
        //       15
        //    6
        //       7
        //          13

        $parent = $node->getParent();
        while ($parent && $node === $parent->getRight()) {
            $node = $parent;
            $parent = $parent->getParent();
        }

        return $parent;
    }

    /**
     * O(log(n))
     *
     * There are 3 different cases:
     * - node has no children
     * - node has one child
     * - node has 2 children
     *
     * @param $value
     * @throws \Exception
     */
    public function delete($value)
    {
        $node = $this->iterativeSearch($value);

        if (!$node) {
            throw new \Exception('Element not found');
        }

        $this->size--;

        // 0 children: O(1)
        if (!$node->getLeft() && !$node->getRight()) {
            if ($node->getParent()->getLeft() === $node) {
                $node->getParent()->setLeft(null);
            } else {
                $node->getParent()->setRight(null);
            }
        }
        // 2 children: O(log(n))
        elseif ($node->getLeft() && $node->getRight()) {
            // get next: $next will replace $node
            $next = $this->next($node);
            $node->setValue($next->getValue());

            // get right element for the $next
            $rightNext = $next->getRight();
            if ($rightNext) {
                $rightNext->setParent($next->getParent());
                if ($rightNext->getParent() === $node) {
                    $rightNext->getParent()->setRight($rightNext);
                } else {
                    $rightNext->getParent()->setLeft($rightNext);
                }
            }
            else {
                $node->setRight(null);
                $next->setParent(null);
            }
        }
        // 1 child: O(1)
        elseif ($node->getLeft() || $node->getRight()) {
            // 1. get child
            if ($node->getLeft()) {
                $child = $node->getLeft();
            } else {
                $child = $node->getRight();
            }
            // 2. update links
            if ($node->getParent()) {
                if($node->getParent()->getLeft() === $node) {
                    $node->getParent()->setLeft($child);
                } else {
                    $node->getParent()->setRight($child);
                }
                $child->setParent($node->getParent());
            } else{
              // if we delete root
              $this->root = $child;
            }
        }

    }

    /**
     * O(n)
     *
     * in-order example:
     *    x
     *  y   z
     * => y->x->z
     *
     * @param TreeNode|null $node
     */
    public function inOrderTreeWalk(TreeNode $node = null)
    {
        if ($node) {
            $this->inOrderTreeWalk($node->getLeft());
            print $node->getValue() . " ";
            $this->inOrderTreeWalk($node->getRight());
        }
    }

    /**
     * O(n)
     *
     * in-order example:
     *    x
     *  y   z
     * => y->x->z
     *
     * @return \Generator
     */
    public function inOrderWalkGenerator()
    {
        $current = $this->root;
        $s = new Stack($this->getSize());
        while ($current || !$s->isEmpty()) {
            // 1. Go to left while current node is not null; push every node to stack
            while ($current) {
                $s->push($current);
                $current = $current->getLeft();
            }

            // 2. when we are in the left part of the subtree:
            // - pop element from stack
            // - yield it
            // - set current node to poppedItem->right
            // After that go 1.
            $item = $s->pop();
            yield $item;
            $current = $item->getRight();
        }

    }

}