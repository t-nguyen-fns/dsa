<?php

/**
 * 
 * https://leetcode.com/problems/jump-game/description/
 * 
 */

class JumpGame {


     /**
     * @param Integer[] $nums
     * @return Boolean
     */
    function canJump($nums) {
        
        $i = 0;
        $iFarthest = 0;
        $iDestination = count($nums) - 1;

        # iterate $i to $iFarthest of each step
        while($i <= $iFarthest) {

            if($i === $iDestination) {
                return true;
            }
            
            # find farthest jump for each step
            $iFarthest = max($iFarthest, $i + $nums[$i]);
            $i++;

        }

        return false;
    }
}


$solution = new JumpGame();

echo $solution->canJump([2,3,1,1,4])  . "\n"; # true

echo $solution->canJump([3,2,1,0,4])  . "\n"; # false



