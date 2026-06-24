<?php

/**
 * https://leetcode.com/problems/pascals-triangle/description/
 */

class PascalTriangle {
    
    /**
     * @param Integer $numRows
     * @return Integer[][]
     */
    function generate($numRows)
    {
        
        $ans = [];

        if($numRows === 1) {
            return [[1]];
        } else if($numRows === 2) {
            return [[1], [1,1]];
        } else {
            $ans[] = [1];
            $ans[] = [1, 1];
        }

    
        for($i = 2; $i < $numRows; $i++) {
            
            $ansIth = array_fill(0, $i, null);

            $ansIth[0] = 1;
            $ansIth[$i] = 1;

            $prevRow = $ans[$i -1];
            
            
            for($j = 1; $j <= $i - 1; $j++) {

                $ansIth[$j] = $prevRow[$j - 1] + $prevRow[$j];
            
            }
            
            $ans[] = $ansIth;
        }

        return $ans;
    }
}

$solution = new PascalTriangle();
$solution->generate(5);

