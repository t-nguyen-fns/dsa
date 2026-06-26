<?php

class MiddleOfLinkedList {

    /**
     * @param ListNode $head
     * @return ListNode
     */
    function middleNode($head) {
        

        $slow = $fast = $head;

        while($fast && $fast->next) {

            $slow = $slow->next;
            $fast = $fast->next->next;
        }

        return $slow;
    }
}


class ListNode {

    public $val = 0;
    public $next = null;

    function __construct($val = 0, $nextNode = null) {
        $this->val = $val;
        $this->next = $nextNode;
    }

}


$node1 = new ListNode();
$node1->val = 1;

$node2 = new ListNode();
$node2->val = 2;

$node3 = new ListNode();
$node3->val = 4;


$node1->next = $node2;
$node2->next = $node3;


$solution = new MiddleOfLinkedList();
$middle = $solution->middleNode($node1);
echo $middle->val . "\n";