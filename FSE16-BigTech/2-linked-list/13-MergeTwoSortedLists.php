<?php 

class MergeTwoSortedLists {

    /**
     * @param ListNode $list1
     * @param ListNode $list2
     * @return ListNode
     */
    function mergeTwoLists($list1, $list2) {
        
        $dummy = $head = new ListNode();

        while($list1 && $list2) {

            if($list1->val < $list2->val) {
                $head->next = $list1;
                $list1      = $list1->next;
            } else {
                $head->next = $list2;
                $list2      = $list2->next;
            }

            $head = $head->next;
        }

        # handle left of either list
        if($list1) {
            $head->next = $list1;
        } else {
            $head->next = $list2;
        }

        return $dummy->next;
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


displayList($node1);

$mode1 = new ListNode();
$mode1->val = 1;

$mode2 = new ListNode();
$mode2->val = 3;

$mode3 = new ListNode();
$mode3->val = 4;

$mode1->next = $mode2;
$mode2->next = $mode3;

displayList($mode1);

echo "Merge Sort Two Lists \n";

$solution = new MergeTwoSortedLists();
$merged = $solution->mergeTwoLists($node1, $mode1);


displayList($merged);