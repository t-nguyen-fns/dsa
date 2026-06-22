<?php


/**
 * Interweaving
 */

class ReorganizeString extends SplMaxHeap {

    /**
     * @param String $s
     * @return String
     */
    function reorganizeString($s) {
        
        
        $strLength = strlen($s);
        $freqMap   = [];

        for($i = 0; $i < $strLength; $i++) {
            echo $s[$i] . "\n";
            if(!isset($freqMap[$s[$i]])) {
                $freqMap[$s[$i]] =  1;
            } else {
                $freqMap[$s[$i]] += 1;
            }  
        }

        arsort($freqMap);
        
        foreach($freqMap as $k => $freq) {
            $this->insert([$k, $freq]);
        }

        $ans = '';

        $max_freq = $this->top();

        if($max_freq[1] <= floor(($strLength + 1)/ 2)) {
            while(!$this->isEmpty()) {
                $first  = !$this->isEmpty() ? $this->extract() : null;
                $second = !$this->isEmpty() ? $this->extract() : null;

                
                if($first) {
                    $ans .= $first[0];
                    $first[1]--;
                }

                if($second) {
                    $ans .= $second[0];
                    $second[1]--;
                }

                if($first && $first[1]) {
                    $this->insert($first);
                }

                if($second && $second[1]) {
                    $this->insert($second);
                }
            }


            return $ans;
        } else {
            return $ans;
        }

        

    }


    protected function compare($point1, $point2): int
    {
        
        # SplMaxHeap
        return $point1[1] <=> $point2[1];
    }

}


$solution = new ReorganizeString();


#echo $solution->reorganizeString("aab")     . "\n";     # "aba"

echo $solution->reorganizeString("aaab")    . "\n";     # ""