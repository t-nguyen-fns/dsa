<?php

class PalindromeLinkedList {

    /**
     * @param ListNode $head
     * @return Boolean
     */
    function isPalindrome($head) {


        $slow = $fast = $head;

        while($fast && $fast->next) {

            $slow = $slow->next;
            $fast = $fast->next->next;
        }

        $middle = $slow;

        

        $middle_dummy      = null;
        $head_next  = null;


        while($middle) {

            $head_next    = $middle->next;

            $middle->next = $middle_dummy;     

            $middle_dummy = $middle;      

            $middle       = $head_next;

        }

        

        while($head && $middle_dummy) {

            if($head->val !== $middle_dummy->val) {
                return false;
            }

            $head   = $head->next;
            $middle_dummy = $middle_dummy->next;
        }

        return true;
    }

}