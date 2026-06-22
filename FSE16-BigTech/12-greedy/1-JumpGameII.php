<?php

/**
 * 
 * https://leetcode.com/problems/jump-game-ii/description/
 * 
 * minimum count of jumps, not the min indices taken
 * 
 */

class JumpGameII {


    function jump($nums)
    {
        
        $i = 0;
        $iFarthest = 0;
        $iDestination = count($nums) - 1;
        $minJump = 0;
        $iJumpEnd   = 0;

        # iterate $i to $iDestination of each step
        while($i < $iDestination) {

            # reached iDestination
            #if($iJumpEnd === $iDestination) {
            #    break;
            #}
            
            # find farthest jump for each step
            $iFarthest = max($iFarthest, $i + $nums[$i]);

            if($i === $iJumpEnd) {
                $iJumpEnd = $iFarthest;
                $minJump++;
            }

            $i++;

        }

        return $minJump;
    }

}


$solution = new JumpGameII();




echo $solution->jump([2,3,1,1,4]) . "\n";      # 2 

echo $solution->jump([2,3,0,1,4]) . "\n";      # 2

echo $solution->jump([2,3,1])     . "\n";      # 1

echo $solution->jump([7,0,9,6,9,6,1,7,9,0,1,2,9,0,3]) . "\n";  # 2









