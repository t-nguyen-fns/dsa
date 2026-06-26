<?php


/**
 * 
 * deque = https://en.wikipedia.org/wiki/Double-ended_queue
 * 
 */
class DesignDoublyLinkedList {

    /**
     * 
     * Dummy Node
     * Sentinel Node
     * @var 
     */
    public $head;

    /**
     * 
     * Dummy Node
     * Sentinel Node
     * @var 
     */
    public $tail;

    public $size;


    /**
     */
    function __construct() {
        
        $this->head = new ListNode();
        $this->tail = new ListNode();
        $this->head->next = $this->tail;
        $this->tail->prev = $this->head;
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


        $mid = floor($this->size / 2);

        #echo "index: $index | mid: $mid | size: $this->size \n";

        if($index <= $mid) {

            #echo "get from head \n";

            # +1(dummy)
            $currentNode = $this->head;

            /**
             * O(n)
             * Can be optimized: closest to head/tail
             */
            # get node at index =  1(dummy) + $index
            for($i = 0; $i < 1 + $index; $i++) {
                $currentNode = $currentNode->next;
            }

            return $currentNode->val;

        } else {
            
            #echo "get from tail \n";
            
            # +1(dummy)
            $currentNode = $this->tail;
            

            /**
             * O(n)
             * Can be optimized: closest to head/tail
             */
            # get node at index =  1(dummy) + $index
            for($i = 0; $i < $this->size - ($index); $i++) {
                $currentNode = $currentNode->prev;
            }

            return $currentNode->val;
        }
    }


    /**
     * 
     * @param mixed $val
     * @return void
     */
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

       

        $mid = floor($this->size / 2);
        echo "index: $index | size: $this->size | mid: $mid \n";

        if($index <= $mid) {

            echo "add from head \n";

            $prevNode = $this->head;

            /**
             * O(n)
             * Can be optimized: closest to head/tail
             */
            # get prev_node at index =  1(dummy) + $index - 1 = $index
            for($i = 0; $i < $index; $i++) {
                $prevNode = $prevNode->next;
            }

            $newNode = new ListNode($val, $prevNode->next, $prevNode);
            
            # link previous
            $prevNode->next->prev   = $newNode;     # link tail
            $prevNode->next         = $newNode;     # link head

            $this->size++;

        } else {
            echo "add from tail \n";
            $prevNode = $this->tail;

            /**
             * O(n)
             * Can be optimized: closest to head/tail
             */
            # get prev_node at index =  1(dummy) + $index - 1 = $index
            for($i = 0; $i < $this->size - $index; $i++) {
                $prevNode = $prevNode->prev;
            }
            
            $newNode = new ListNode($val, $prevNode, $prevNode->prev);
            $prevNode->prev->next   = $newNode;     # link head
            $prevNode->prev         = $newNode;     # link tail

            $this->size++;
        }

       
    }


    function deleteAtTail()
    {
        $this->deleteAtIndex($this->size - 1);
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

        $mid = floor($this->size / 2);
        echo "index: $index | size: $this->size | mid: $mid \n";
        
        if($index <= $mid) {

            echo "delete from head \n";
            $prevNode = $this->head;

            /**
             * O(n)
             * Can be optimized: closest to head/tail
             */
            # get prev_node at index =  1(dummy) + $index - 1 = $index
            for($i = 0; $i < $index; $i++) {
                $prevNode = $prevNode->next;
            }


            $nextNode       = $prevNode->next->next;
            
            $nextNode->prev = $prevNode;    # link tail
            $prevNode->next = $nextNode;    # link head

            $this->size--;

        } else {
            echo "delete from tail \n";

            $prevNode = $this->tail;

            /**
             * O(n)
             * Can be optimized: closest to head/tail
             */
            # get prev_node at index =  1(dummy) + $index - 1 = $index
            
            for($i = 0; $i < $this->size - $index; $i++) {
                $prevNode = $prevNode->prev;
            }

            echo "prevNode: " . $prevNode->val . "\n";

            $nextNode       = $prevNode->prev->prev;
            
            $nextNode->prev = $prevNode;    # link tail
            $prevNode->next = $nextNode;    # link head

            $this->size--;
        }


    }

    public function displayList() {

        $currentNode = $this->head->next;

        for($i = 0; $i < $this->size; $i++) {
            
            echo $currentNode->val . " ";
            $currentNode = $currentNode->next;
        }

        echo "\n";
    }

    public function displayReversedList() {

        $currentNode = $this->tail->prev;

        for($i = 0; $i < $this->size; $i++) {
            
            echo $currentNode->val . " ";
            $currentNode = $currentNode->prev;
        }

        echo "\n";
    }

    public function toArrayList() {

        $array = [];

        $currentNode = $this->head->next;
    
        for($i = 0; $i < $this->size; $i++) {

            $array[] = $currentNode->val;
            $currentNode = $currentNode->next;
        }

        return $array;
    }

}


class ListNode {

    public $val = 0;
 
    public $next = null;
    
    public $prev = null;

    function __construct($val = 0, $nextNode = null, $prevNode = null) {
        $this->val  = $val;
        $this->next = $nextNode;
        $this->prev = $prevNode;
    }

}


$doublyLinkedList = new DesignDoublyLinkedList();

// $doublyLinkedList->addAtHead(1);
// $doublyLinkedList->displayList();             # 1
// // $doublyLinkedList->addAtHead(0);
// // $doublyLinkedList->displayList();             # 0 1
// // $doublyLinkedList->displayReversedList();     # 1 0
// $doublyLinkedList->addAtTail(3);              # 1 3
// $doublyLinkedList->displayList();             # 1 3  
// $doublyLinkedList->displayReversedList();     # 3 1
// $doublyLinkedList->addAtIndex(1, 2);          # 1 2 3
// $doublyLinkedList->displayList();             # 1 2 3
// echo $doublyLinkedList->get(1) . "\n";        # 2


$doublyLinkedList1 = new DesignDoublyLinkedList();
$doublyLinkedList1->addAtHead(6);
$doublyLinkedList1->displayList();             # 6
$doublyLinkedList1->addAtHead(2);              # 2 6
$doublyLinkedList1->displayList();             # 2 6   
$doublyLinkedList1->get(0);                    # 2
$doublyLinkedList1->get(1);                    # 6
$doublyLinkedList1->addAtHead(1);              # 1 2 6
$doublyLinkedList1->displayList();             # 1 2 6
$doublyLinkedList1->addAtTail(9);              # 1 2 6 9
$doublyLinkedList1->displayList();             # 1 2 6 9
$doublyLinkedList1->addAtTail(4);              # 1 2 6 9 4
$doublyLinkedList1->displayList();             # 1 2 6 9 4
echo $doublyLinkedList1->get(3) . "\n";        # 9

$doublyLinkedList1->addAtTail(4);              # 1 2 6 9 4 4
$doublyLinkedList1->displayList();             # 1 2 6 9 4 4
echo $doublyLinkedList1->get(6) . "\n";        # -1

$doublyLinkedList1->add(5);                    # 1 2 6 9 4 4 5
$doublyLinkedList1->displayList();             # 1 2 6 9 4 4 5
$doublyLinkedList1->displayReversedList();     # 5 4 4 9 6 2 1 

$doublyLinkedList1->deleteAtTail();            # 1 2 6 9 4 4
$doublyLinkedList1->displayList();             # 1 2 6 9 4 4
$doublyLinkedList1->displayReversedList();     # 4 4 9 6 2 1  
$doublyLinkedList1->deleteAtTail();            # 1 2 6 9 4 
$doublyLinkedList1->displayList();             # 1 2 6 9 4 
$doublyLinkedList1->displayReversedList();     # 4 9 6 2 1 