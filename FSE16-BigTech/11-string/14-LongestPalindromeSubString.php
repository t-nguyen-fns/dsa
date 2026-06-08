<?php

class LongestPalindromeSubString {

    public $dp = [];

    function isPalindrome($s, $left, $right)
    {
        
        while($left < $right) {
            if($s[$left] !== $s[$right]) {
                return false;
            }

            $left  += 1;
            $right -= 1;
        }

        return true;

    }

    /**
     * TC: O(N^3)
     * SC: O(1)
     * 
     * TC: 1312 ms Beats 28.83%
     * SC: 20.16 MB Beats 93.69%
     * @param String $s
     * @return String
     */
    function longestPalindromeBruteForce($s) {
        
        $strLength = strlen($s) - 1;

        for($right = $strLength; $right > 0; $right--) {
            for($left = 0; $left <= $strLength - $right; $left++) {
                if($this->isPalindrome($s, $left, $left + $right)) {
                    return substr($s, $left, $right + 1);
                }
            }
        }

        return strlen($s) > 0 ? $s[0] : "";
    }

     /**
      * TC: 215 ms Beats 37.84%
      * SC: 20.29 MB Beats 87.39%
      * Summary of longestPalindrome
      * @param mixed $s
      * @return string
      */
     function longestPalindrome($s) {
        
        $strLength = strlen($s);

        $expanding_left     = 0;
        $expanding_right    = 0;


        $expanding = function($l, $r) use(&$expanding_left, &$expanding_right, $s, $strLength) {
            
            while($l >= 0 && $r < $strLength) {

                if($s[$l] !== $s[$r]) {
                    return false;
                }
                
                # new palindrome length: $r - $l
                # old palindrome length: $expanding_right - $expanding_left
                if($r - $l > $expanding_right - $expanding_left) {
                    $expanding_right = $r;
                    $expanding_left  = $l;
                }

                $l -= 1;
                $r += 1;
            }

        };

        for($i = 0; $i < $strLength; $i++) {
            $expanding($i, $i);
            $expanding($i, $i + 1);  
        }

        return substr($s, $expanding_left, $expanding_right - $expanding_left + 1);
     }


}

$solution = new LongestPalindromeSubString();
#echo $solution->longestPalindromeBruteForce("babad") . "\n";    # "bab" or "aba"
#echo $solution->longestPalindromeBruteForce("cbbd") . "\n";     # "bb"

#echo $solution->longestPalindromeDP("babad") . "\n";    # "bab" or "aba"
#echo $solution->longestPalindromeDP("cbbd") . "\n";     # "bb"


#echo $solution->longestPalindrome("babad") . "\n";    # "bab" or "aba"

echo $solution->longestPalindrome("cbbd") . "\n";    # "bb"
