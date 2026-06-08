<?php

class Atoi {

    /**
     * TC: O(n)
     * SC: O(1)
     * @param String $s
     * @return Integer
     */
    function myAtoi($s)
    {
        
        $strLength  = strlen($s);
        $sign       = null;
        $num        = 0;
        $MINIMUM    = -2147483648; 
        $MAXIMUM    =  2147483647; 
        
        $i = 0;

        # handle white space
        while($s[$i] === ' ') {
            $i++;
        }

        # handle sign
        if($s[$i] === '-' || $s[$i] === '+') {
            $sign = $s[$i];
            $i++;
        }

        # handle numeric- base-10 shift !
        while($i < $strLength && is_numeric($s[$i])) {
            $digit  = (int) $s[$i];
            $num    = $num * 10 + $digit; 
            $i++;
        }

        # handle sign
        if($sign === '+') {
            $num = +$num;
        } else if ($sign === '-') {
            $num = -$num;
        }

        # handle 32-bit
        if($num < $MINIMUM) {
            $num = $MINIMUM;
        }

        if($MAXIMUM < $num) {
            $num = $MAXIMUM;
        }

        return $num;
    }
}

$solution = new Atoi();
#echo $solution->myAtoi("42") . "\n";                       # 42
#echo $solution->myAtoi(" -042") . "\n";                    # -42

#echo $solution->myAtoi("1337c0d3") . "\n";                 # 1337

#echo $solution->myAtoi("0-1") . "\n";                      # 0

#echo $solution->myAtoi("4193 with words") . "\n";          # 4193

#echo $solution->myAtoi("-+12") . "\n";                     # 0
#echo $solution->myAtoi("-5-") . "\n";                      # 0

#echo $solution->myAtoi("   +   413") . "\n";               # 0

