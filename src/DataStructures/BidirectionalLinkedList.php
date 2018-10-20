<?php

namespace App\DataStructures;

use App\DataStructures\Nodes\BidirectionalNode;

/**
 * Class BidirectionalLinkedList
 * @package App\DataStructures
 */
class BidirectionalLinkedList
{

    /**
     * @var BidirectionalNode
     */
    private $first;

    /**
     * @var BidirectionalNode
     */
    private $last;

    /**
     * @var int
     */
    private $size;

    /**
     * @param BidirectionalNode $node
     * @return bool
     */
    private function removeFromMiddle(BidirectionalNode $node)
    {
        $prev = $node->getPrev();
        $next = $node->getNext();
        $prev->setNext($next);
        $next->setPrev($prev);
        $node->setNext(null);
        $node->setPrev(null);
        $this->size--;

        return true;
    }

    /**
     * @return bool
     */
    private function removeTheOnly()
    {
        $this->first = null;
        $this->last = null;
        $this->size = 0;

        return true;
    }

    /**
     * @param $element
     * @return bool
     */
    private function pushToEmpty($element)
    {
        $this->first = new BidirectionalNode($element);
        $this->first->setPrev(null);
        $this->first->setNext(null);
        $this->last = $this->first;
        $this->size++;

        return true;
    }

    /**
     * @return bool
     */
    private function isEmpty()
    {
        return $this->size == 0;
    }

    /**
     * O(n)
     * Inserts in front of an element that has a given position before the insertion
     *
     * @param $element
     * @param int $position
     * @return bool
     * @throws \Exception
     */
    public function pushByPosition($element, int $position)
    {
        if ($position > $this->size || $position < 0) {
            throw new \Exception('Wrong position');
        }

        if ($position === 0) {
            return $this->pushToStart($element);
        }

        if ($position === $this->size) {
            return $this->pushToEnd($element);
        }

        $newNode = new BidirectionalNode($element);

        $oldNode = $this->getElementByPosition($position);

        $oldNodePrev = $oldNode->getPrev();

        $oldNode->setPrev($newNode);
        $newNode->setNext($oldNode);

        $newNode->setPrev($oldNodePrev);
        $oldNodePrev->setNext($newNode);
        $this->size++;

        return true;
    }

    /**
     * O(1)
     *
     * @param $element
     * @return bool
     */
    public function pushToStart($element)
    {
        if (!$this->first) {
            return $this->pushToEmpty($element);
        } else {
            $oldFirst = $this->first;
            $this->first = new BidirectionalNode($element);
            $this->first->setPrev(null);
            $this->first->setNext($oldFirst);
            $oldFirst->setPrev($this->first);
            $this->size++;
        }

        return true;
    }

    /**
     * O(1)
     *
     * @param $element
     * @return bool
     */
    public function pushToEnd($element)
    {
        if (!$this->first) {
            return $this->pushToEmpty($element);
        } else {
            $oldLast = $this->last;
            $this->last = new BidirectionalNode($element);
            $this->last->setPrev($oldLast);
            $oldLast->setNext($this->last);
            $this->last->setNext(null);
            $this->size++;
        }

        return true;
    }

    /**
     * O(1)
     *
     * @return bool
     * @throws \Exception
     */
    public function removeFirst()
    {
        if ($this->isEmpty()) {
            throw new \Exception('List is empty');
        }

        if ($this->size === 1) {
            return $this->removeTheOnly();
        }

        $node = $this->first;
        $this->first = $node->getNext();
        $this->first->setPrev(null);
        $this->size--;

        return true;
    }

    /**
     * O(1)
     *
     * @return bool
     * @throws \Exception
     */
    public function removeLast()
    {
        if ($this->isEmpty()) {
            throw new \Exception('List is empty');
        }
        if ($this->size === 1) {
            return $this->removeTheOnly();
        }

        $node = $this->last;
        $this->last = $node->getPrev();
        $this->last->setNext(null);
        $this->size--;

        return true;
    }

    /**
     * O(n)
     *
     * @param int $position
     * @return bool
     * @throws \Exception
     */
    public function removeByPosition(int $position)
    {
        if ($position > $this->size-1 || $position < 0) {
            throw new \Exception('Wrong position');
        }

        if ($this->size === 1) {
            return $this->removeTheOnly();
        }

        $currentNode = $this->getElementByPosition($position);
        return $this->removeFromMiddle($currentNode);
    }

    /**
     * O(n)
     *
     * @param $elem
     * @return bool
     */
    public function removeByValue($elem)
    {
        if ($this->size === 1) {
            return $this->removeTheOnly();
        }

        $currentNode = $this->first;
        while ($currentNode) {
            if ($currentNode->getItem() === $elem) {
                return $this->removeFromMiddle($currentNode);
            }
            $currentNode = $currentNode->getNext();
        }

        return false;
    }

    /**
     * O(n)
     *
     * @param int $position
     * @return BidirectionalNode|mixed
     * @throws \Exception
     */
    public function getElementByPosition(int $position)
    {
        if ($position > $this->size-1 || $position < 0) {
            throw new \Exception('Wrong position');
        }

        if ($position === 0) {
            return $this->removeFirst();
        }
        if ($position === $this->size-1) {
            return $this->removeLast();
        }

        $elem = $this->first;
        for ($i = 0; $i < $position; $i++) {
            $elem = $elem->getNext();
        }

        return $elem;

    }

    /**
     * @return BidirectionalNode
     */
    public function getFirst()
    {
        return $this->first;
    }

    /**
     * @return BidirectionalNode
     */
    public function getLast()
    {
        return $this->last;
    }

    /**
     * @return int
     */
    public function getSize()
    {
        return $this->size;
    }

    public function printElements()
    {
        $currentNode = $this->first;
        while ($currentNode) {
            print $currentNode->getItem() . " ";
            $currentNode = $currentNode->getNext();
        }
    }

    public function reversePrintElements()
    {
        $currentNode = $this->last;
        while ($currentNode) {
            print $currentNode->getItem() . " ";
            $currentNode = $currentNode->getPrev();
        }
    }

}