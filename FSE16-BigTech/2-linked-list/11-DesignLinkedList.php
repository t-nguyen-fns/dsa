<?php

class DesignLinkedList {

    
    /**
     * 
     * Dummy Node
     * Sentinel Node
     * @var 
     */
    public $head;

    public $size;


    /**
     */
    function __construct() {
        
        $this->head = new ListNode();
        $this->size = 0;
    }
  
    /**
     * @param Integer $index
     * @return Integer
     */
    function get($index) {

        # invalid index
        if($index >= $this->size)
            return -1;

        # +1(dummy)
        $currentNode = $this->head;

        # get node at index =  1(dummy) + $index
        for($i = 0; $i < 1 + $index; $i++) {
            $currentNode = $currentNode->next;
        }

        return $currentNode->val;
    }
  
    function add($val)
    {
        $this->addAtTail($val);
    }

    /**
     * @param Integer $val
     * @return NULL
     */
    function addAtHead($val) {
        $this->addAtIndex(0, $val);
    }
  
    /**
     * @param Integer $val
     * @return NULL
     */
    function addAtTail($val) {
        $this->addAtIndex($this->size, $val);
    }
    
  
    /**
     * @param Integer $index
     * @param Integer $val
     * @return NULL
     */
    function addAtIndex($index, $val) {
        
        # can add at index === size; otherwise index > size -> false
        if($index > $this->size)
            return;

        
        $prevNode = $this->head;

        # get prev_node at index =  1(dummy) + $index - 1 = $index
        for($i = 0; $i < $index; $i++) {
            $prevNode = $prevNode->next;
        }

        $newNode = new ListNode($val, $prevNode->next);
        $prevNode->next = $newNode;
        $this->size++;
    }
  
    /**
     * @param Integer $index
     * @return NULL
     */
    function deleteAtIndex($index) {
        
        #
        if($index >= $this->size) {
            return;
        }

        $prevNode = $this->head;

        # get prev_node at index =  1(dummy) + $index - 1 = $index
        for($i = 0; $i < $index; $i++) {
            $prevNode = $prevNode->next;
        }

        $prevNode->next = $prevNode->next->next;
        $this->size--;

    }
    

    public function displayList() {

        $currentNode = $this->head->next;
    
        while($currentNode) {

            echo $currentNode->val . " ";

            $currentNode = $currentNode->next;
        }

        echo "\n";
    }

    public function toArrayList() {

        $array = [];
        $currentNode = $this->head->next;
    
        while($currentNode) {

            $array[] = $currentNode->val;
            $currentNode = $currentNode->next;
        }

        return $array;
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


$linkedList = new DesignLinkedList();
$linkedList->addAtHead(1);
$linkedList->displayList();             # 1
$linkedList->addAtTail(3);              # 1 3
$linkedList->displayList();
$linkedList->addAtIndex(1, 2);          # 1 2 3
$linkedList->displayList();             # 1 2 3
echo $linkedList->get(1) . "\n";            # 2


$linkedList1 = new DesignLinkedList();
$linkedList1->addAtHead(6);
$linkedList1->displayList();             # 6
$linkedList1->addAtHead(2);              # 2 6
$linkedList1->displayList();             # 2 6   
$linkedList1->get(0);                    # 2
$linkedList1->get(1);                    # 6
$linkedList1->addAtHead(1);              # 1 2 6
$linkedList1->displayList();             # 1 2 6
$linkedList1->addAtTail(9);              # 1 2 6 9
$linkedList1->displayList();             # 1 2 6 9
$linkedList1->addAtTail(4);              # 1 2 6 9 4
$linkedList1->displayList();             # 1 2 6 9 4
echo $linkedList1->get(3) . "\n";        # 9
$linkedList1->addAtTail(4);              # 1 2 6 9 4 4
$linkedList1->displayList();             # 1 2 6 9 4 4
echo $linkedList1->get(6) . "\n";        # -1

$linkedList1->add(5);                    # 1 2 6 9 4 4 5
$linkedList1->displayList();             # 1 2 6 9 4 4 5
$array = $linkedList1->toArrayList();
var_dump($array);
