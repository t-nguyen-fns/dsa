<?php

class BrowserHistory {


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

    public $homepage;

    public $currentLocation;

    /**
     */
    function __construct($homepage) {
        
        $this->head = new DoublyListNode();
        $this->tail = new DoublyListNode();
        $this->head->next = $this->tail;
        $this->tail->prev = $this->head;
        $this->size = 0;

        $this->visit($homepage);

        $this->homepage = $homepage;
    }


    /**
     * @param String $url
     * @return NULL
     */
    function visit($url)
    {
           
        $lastLocation    = $this->tail->prev;
        $currentLocation = $this->currentLocation;

        if($lastLocation && $currentLocation && $lastLocation !== $currentLocation) {

            # 1st
            $this->currentLocation->next = $this->tail;
            $this->tail->prev            = $this->currentLocation;

        }

        $this->add($url);
    }
  
    /**
     * @param Integer $steps
     * @return String
     */
    function back($steps)
    {

        while($steps > 0 && $this->currentLocation->prev !== $this->head) {
            $this->currentLocation = $this->currentLocation->prev;
            $steps--;
        }

        return $this->currentLocation->val;
    }
  
    /**
     * @param Integer $steps
     * @return String
     */
    function forward($steps)
    {

        while($steps > 0 && $this->currentLocation->next !== $this->tail) {
            $this->currentLocation = $this->currentLocation->next;
            $steps--;
        }

        return $this->currentLocation->val;
        
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

        if($index <= $mid) {

            # +1(dummy)
            $currentNode = $this->head;

            
            for($i = 0; $i < 1 + $index; $i++) {
                $currentNode = $currentNode->next;
            }

            return $currentNode->val;

        } else {
            
            
            # +1(dummy)
            $currentNode = $this->tail;
            
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
        
        
        if($index > $this->size)
            return;

        $mid = floor($this->size / 2);
        
        if($index <= $mid) {

            $prevNode = $this->head;

            for($i = 0; $i < $index; $i++) {
                $prevNode = $prevNode->next;
            }

            $newNode = new DoublyListNode($val, $prevNode->next, $prevNode);
            
            # link previous
            $prevNode->next->prev   = $newNode;     # link tail
            $prevNode->next         = $newNode;     # link head

            $this->currentLocation  = $newNode;
            $this->size++;

        } else {
            
            $prevNode = $this->tail;

            for($i = 0; $i < $this->size - $index; $i++) {
                $prevNode = $prevNode->prev;
            }
            
            $newNode = new DoublyListNode($val, $prevNode, $prevNode->prev);
            $prevNode->prev->next   = $newNode;     # link head
            $prevNode->prev         = $newNode;     # link tail

            $this->currentLocation  = $newNode;
            $this->size++;
        }

       
    }

    function deleteAtTail()
    {
        $this->deleteAtIndex($this->size);
    }

    /**
     * @param Integer $index
     * @return NULL
     */
    function deleteAtIndex($index) {
        
        #
        if($index > $this->size) {
            return;
        }

        $mid = floor($this->size / 2);

        
        if($index <= $mid) {


            $prevNode = $this->head;

            for($i = 0; $i < $index; $i++) {
                $prevNode = $prevNode->next;
            }


            $nextNode       = $prevNode->next->next;
            
            $nextNode->prev = $prevNode;    # link tail
            $prevNode->next = $nextNode;    # link head

            $this->size--;

        } else {


            $prevNode = $this->tail;

            
            for($i = 0; $i < $this->size - $index; $i++) {
                $prevNode = $prevNode->prev;
            }

            $nextNode       = $prevNode->prev->prev;
            

            $nextNode->next = $prevNode;    # link tail
            $prevNode->prev = $nextNode;    # link head

            $this->size--;
        }


    }

    public function displayList() {

        $currentNode = $this->head->next;
        
        while ($currentNode !== $this->tail) {

            echo $currentNode->val . " ";
            $currentNode = $currentNode->next;

        }

        echo "\n";
    }

    public function displayReversedList() {

        $currentNode = $this->tail->prev;

        while ($currentNode !== $this->head) {

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



class DoublyListNode {

    public $val = 0;
 
    public $next = null;
    
    public $prev = null;

    function __construct($val = 0, $nextNode = null, $prevNode = null) {
        $this->val  = $val;
        $this->next = $nextNode;
        $this->prev = $prevNode;
    }

}


$browserHistory = new BrowserHistory("leetcode.com");
$browserHistory->visit("google.com");       // You are in "leetcode.com". Visit "google.com"
$browserHistory->visit("facebook.com");     // You are in "google.com". Visit "facebook.com"
$browserHistory->visit("youtube.com");      // You are in "facebook.com". Visit "youtube.com"

$browserHistory->displayList();             # google.com facebook.com youtube.com
$browserHistory->displayReversedList();     # youtube.com facebook.com google.com 

echo $browserHistory->back(1) . "\n";                   // You are in "youtube.com", move back to "facebook.com" return "facebook.com"
echo $browserHistory->back(1) . "\n";                   // You are in "facebook.com", move back to "google.com" return "google.com"
echo $browserHistory->forward(1) . "\n";                // You are in "google.com", move forward to "facebook.com" return "facebook.com"

$browserHistory->visit("linkedin.com");     // You are in "facebook.com". Visit "linkedin.com"
$browserHistory->displayList();             # google.com facebook.com youtube.com linkedin.com
$browserHistory->displayReversedList();     # linkedin.com youtube.com facebook.com google.com 


echo $browserHistory->forward(2) . "\n";                // You are in "linkedin.com", you cannot move forward any steps.
echo $browserHistory->back(2) . "\n";                   // You are in "linkedin.com", move back two steps to "facebook.com" then to "google.com". return "google.com"
echo $browserHistory->back(7) . "\n";                   // You are in "google.com", you can move back only one step to "leetcode.com". return "leetcode.com"



$browserHistory1 = new BrowserHistory("jrbilt.com");
$browserHistory1->visit("uiza.com");
#$browserHistory1->displayList();               # "uiza.com"
#$browserHistory1->displayReversedList();       # "uiza.com"

echo $browserHistory1->forward(3) . "\n";       # "uiza.com"
echo $browserHistory1->forward(3) . "\n";       # "uiza.com"

$browserHistory1->visit("fveyl.com");
$browserHistory1->visit("hyhqfqf.com");
$browserHistory1->displayList();               # uiza.com fveyl.com hyhqfqf.com
$browserHistory1->displayReversedList();       # hyhqfqf.com fveyl.com uiza.com

echo $browserHistory1->back(3) . "\n";         # "jrbilt.com"

$browserHistory1->visit("cccs.com");
$browserHistory1->visit("bivz.com");

$browserHistory1->displayList();               # uiza.com fveyl.com hyhqfqf.com cccs.com bivz.com 
$browserHistory1->displayReversedList();       # bivz.com cccs.com hyhqfqf.com fveyl.com uiza.com 


echo $browserHistory1->forward(6) . "\n";                  # "bivz.com"
echo $browserHistory1->back(1) . "\n";                     # "cccs.com" 


$browserHistory1->visit("cmbw.com");
$browserHistory1->visit("iywwwfn.com");
$browserHistory1->visit("sktbhdx.com");

$browserHistory1->displayList();               # uiza.com fveyl.com hyhqfqf.com cccs.com cmbw.com iywwwfn.com sktbhdx.com 
$browserHistory1->displayReversedList();       # sktbhdx.com iywwwfn.com cmbw.com cccs.com hyhqfqf.com fveyl.com uiza.com 


echo $browserHistory1->forward(8) . "\n";                   # sktbhdx.com
echo $browserHistory1->forward(10) . "\n";                  # sktbhdx.com


$browserHistory1->visit("bskj.com");
$browserHistory1->visit("thw.com");

$browserHistory1->displayList();               # uiza.com fveyl.com hyhqfqf.com cccs.com cmbw.com iywwwfn.com sktbhdx.com bskj.com thw.com
$browserHistory1->displayReversedList();       # thw.com bskj.com sktbhdx.com iywwwfn.com cmbw.com cccs.com hyhqfqf.com fveyl.com uiza.com 


echo $browserHistory1->back(6) . "\n";         # "jrbilt.com"




