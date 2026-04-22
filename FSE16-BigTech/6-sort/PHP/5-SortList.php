<?php


class MergeSortList
{

    function mergeSortList($list)
    {
        return $this->mergeSortListRecv($list);
    }   



    function mergeSortListRecv($list)
    {

        
        $listLength = $this->getListLength($list);
        

        if($listLength == 1) {
            return $list;
        }

        if($listLength == 0) {
            return;
        }

        $low        = 0;
        $high       = $this->getListLength($list) - 1;
        $mid        = ceil($high / 2);

        $leftList       = null;
        $rightList      = null;
        $currentNode    = $list;
        $currentNodeLeft = null;
        $currentNodeRight = null;
        for($i = 0; $i <= $high; $i++) {

            $newNode         = new ListNode();
            $newNode->val    = $currentNode->val;


            // slice left
            if($i < $mid) {
                
                $newNode         = new ListNode();
                $newNode->val    = $currentNode->val;

                if($leftList === null) {
                    $leftList               = $newNode;
                    $currentNodeLeft        = $leftList;
                } else {
                    $currentNodeLeft->next  = $newNode;
                    $currentNodeLeft        = $currentNodeLeft->next;
                }

            } 
            // slice right
            else {       
                
                if($rightList === null) {
                    $rightList = $newNode;
                    $currentNodeRight = $rightList;
                } else {
                    $currentNodeRight->next = $newNode;
                    $currentNodeRight       = $currentNodeRight->next;
                }
            }            
            
            $currentNode = $currentNode->next;
        }


        $lowArr  = $this->mergeSortListRecv($leftList);
        $highArr = $this->mergeSortListRecv($rightList);

        $mergedArraySorted = $this->mergeSortTwoList($lowArr, $highArr);
        
        return $mergedArraySorted;
    }


    public function mergeSortTwoList($leftList, $rightList)
    {
        $mergeSortedList    = null;
        $currentNode        = null;
        $i = 0;
        while($leftList && $rightList) {

            if($leftList->val < $rightList->val) {
                
                if($mergeSortedList === null) {
                    $mergeSortedList        = $leftList;
                    $currentNode            = $mergeSortedList;
                    $leftList               = $leftList->next;
                } else {
                    $currentNode->next      = $leftList;
                    $currentNode            = $currentNode->next;
                    $leftList              = $leftList->next;
                }
            } else {
                
                if($mergeSortedList === null) {
                    $mergeSortedList        = $rightList;
                    $currentNode            = $mergeSortedList;
                    $rightList               = $rightList->next;
                } else {
                    $currentNode->next      = $rightList;
                    $currentNode            = $currentNode->next;
                    $rightList              = $rightList->next;
                }
            }
        }

        while($leftList !== null) {
            $currentNode->next     = $leftList;
            $currentNode           = $currentNode->next;
            $leftList              = $leftList->next;
        }

        while($rightList !== null) {
            $currentNode->next      = $rightList;
            $currentNode            = $currentNode->next;
            $rightList              = $rightList->next;
        }

        return $mergeSortedList;

    }

    public function mergeSortTwoListOld($leftList, $rightList) {
        // Create a dummy node
        $mergeSortedList = new ListNode(0);
        $currentNode = $mergeSortedList;

        // Traverse both lists
        while ($leftList !== null && $rightList !== null) {

            if ($leftList->val < $rightList->val) {
                $currentNode->next = $leftList;
                $leftList = $leftList->next;
            } else {
                $currentNode->next = $rightList;
                $rightList = $rightList->next;
            }
            $currentNode = $currentNode->next;
        }

        // Append remaining nodes from either list
        if ($leftList !== null) {
            $currentNode->next = $leftList;
        } elseif ($rightList !== null) {
            $currentNode->next = $rightList;
        }

        // skipping the dummy node
        return $mergeSortedList->next;
    }

    public function getListLength($list) {

        $length = 0;
        $currentNode = $list;
        while($currentNode) {
            $length++;
            $currentNode = $currentNode->next;
        }
        return $length;
    }
}
