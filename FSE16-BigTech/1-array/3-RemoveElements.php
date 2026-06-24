<?php

/**
 * https://leetcode.com/problems/remove-element/description/
 */
class RemoveElements {

    /**
     * @param Integer[] $nums
     * @param Integer $val
     * @return Integer
     */
    function removeElement(&$nums, $val) {
     
        
        $ans = [];

        foreach($nums as $num) {
            if($num !== $val) {
                $ans[] = $num;
            }
        }

        $nums = $ans;

        return count($ans);
    }
}

$solution = new RemoveElements();
$data1     = [3,2,2,3];
echo $solution->removeElement($data1, 3) . "\n";             #  k = 2

$data2     = [0,1,2,2,3,0,4,2];
echo $solution->removeElement($data2, 2) . "\n";             #  k = 5


