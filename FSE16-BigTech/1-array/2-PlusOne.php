<?php

/**
 * https://leetcode.com/problems/plus-one/description/
 */
class PlusOne {

    /**
     * @param Integer[] $digits
     * @return Integer[]
     */
    function plusOne($digits) {
        
        $arrLength = count($digits) - 1;
        $rem = 0;
        $digits[$arrLength] = $digits[$arrLength] + 1; 

        
        for($i = $arrLength; $i >= 0; $i--) {
            
            if (($digits[$i] + $rem) > 9) {
                $digits[$i] = ($digits[$i] + $rem) % 10;
                $rem = 1;
            } else {
                $digits[$i] = ($digits[$i] + $rem);
                $rem = 0;
            }
        }

        if($rem === 1) {
            array_unshift($digits, 1);
        }

        return $digits;
    }

}

$solution = new PlusOne();
$result1 = $solution->plusOne([9]);         # [1,0]

#var_dump($result1);


#$result2 = $solution->plusOne([1,2,3]);     # [1,2,4]

#var_dump($result2);

$result3 = $solution->plusOne([4,3,2,1]);   # [4,3,2,2]

var_dump($result3);


$result4 = $solution->plusOne([9,9]);       # [1,0,0]

var_dump($result4);


$result5 = $solution->plusOne([8,9]);       # [1,0,0]

var_dump($result5);


$result6 = $solution->plusOne([8,8,9]);       # [1,0,0,0]

var_dump($result6);