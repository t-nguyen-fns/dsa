<?php 


class RemoveDuplicateElements {

    /**
     * @param ListNode $head
     * @return ListNode
     */
    function deleteDuplicates($head) {
        
        $dummy = $head;

        while($head) {

            if($head->next->val === $head->val) {
                $head->next = $head->next->next;
                continue;
            }

            $head = $head->next;

        }

        return $dummy;
    }

}