<?php

class ReverseList {

    /**
     * @param ListNode $head
     * @return ListNode
     */
    function reverseList($head) {
        
        $dummy      = null;
        $head_next  = null;


        while($head) {

            $head_next   = $head->next;

            $head->next = $dummy;     

            $dummy      = $head;      

            $head       = $head_next;

        }

        return $dummy;
    }


    function reverseListExt($head) {
        
        $dummy = new ListNode();
        


        while($head) {

            # tmp
            $next_tmp   = $head->next;   # temp = a

            $head->next = $dummy;        # a    = b

            $dummy      = $head;         # b    = c

            $head       = $next_tmp;     # c    = temp

            # temp = b
            # b = a
            # a = c
            # c = temp
        }

        return $dummy;
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


function displayList($currentNode) {

    
    while($currentNode) {

        echo $currentNode->val . " ";

        $currentNode = $currentNode->next;
    }

    echo "\n";
}



$node1 = new ListNode();
$node1->val = 1;

$node2 = new ListNode();
$node2->val = 2;

$node3 = new ListNode();
$node3->val = 4;


$node1->next = $node2;
$node2->next = $node3;


$solution = new ReverseList();
$dummy = $solution->reverseList($node1);


displayList($dummy);