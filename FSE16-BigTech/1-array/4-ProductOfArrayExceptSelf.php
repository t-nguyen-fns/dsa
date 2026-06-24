<?php

/**
 * https://leetcode.com/problems/product-of-array-except-self/description/
 */
class ProductOfArrayExceptSelf {



    function productExceptSelf($nums) {

        $arrLength = count($nums) - 1;


        $prefixProducts[0] = 1;

        for($i = 1; $i <= $arrLength; $i++) {

            $prefixProducts[$i] = $prefixProducts[$i - 1] * $nums[$i - 1];
        }


        $suffixProducts = array_fill(0, $arrLength, null);
        $suffixProducts[$arrLength] = 1;

        for($j = $arrLength -1; $j >= 0; $j--) {
            $suffixProducts[$j] = $suffixProducts[$j + 1] * $nums[$j + 1];
        }

        $ans = [];

        for($i = 0; $i <= $arrLength; $i++) {
            $ans[$i] = $prefixProducts[$i] * $suffixProducts[$i];
        }

        return $ans;
    }

    /**
     * @param Integer[] $nums
     * @return Integer[]
     */
    function productExceptSelfUsingDivision($nums) {
        
        $arrLength = count($nums) - 1;
    
        
        $products = 1;
        
        for($i = 0; $i <= $arrLength; $i++) {
            $products *= $nums[$i];
        }

        for($i = 0; $i <= $arrLength; $i++) {
            $nums[$i] = $products / $nums[$i];
        }

        
        return $nums;
    }
}

$solution = new ProductOfArrayExceptSelf();
$result1 = $solution->productExceptSelf([1,2,3,4]);
var_dump($result1);


# [1, 2, 3, 4 ]
# prefix: [ 1,  1,  2, 6]
# suffix: [24, 12,  4, 1]
# product:[24, 12,  8, 6]    