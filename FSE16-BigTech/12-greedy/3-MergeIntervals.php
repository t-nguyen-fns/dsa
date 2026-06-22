<?php 

class MergeIntervals {

    /**
     * @param Integer[][] $intervals
     * @return Integer[][]
     */
    function merge($intervals)
    {

        # Sort
        sort($intervals);
        $A_start = null;
        $A_end = null;
        
        $ans = [];

        foreach($intervals as [$B_start, $B_end]) {
            
            $idx = count($ans) - 1;
        
            if(isset($ans[$idx])) {
                [$A_start, $A_end] = $ans[$idx];
            }    
            
            if(!is_null($A_end) && $B_start <= $A_end) {

                $A_end = max($A_end, $B_end);
                $ans[$idx] = [$A_start, $A_end];

            } else {
                $ans[] = [$B_start, $B_end];
            }

        }
        
        return $ans;
    }
}

$solution = new MergeIntervals();

// $result1 = $solution->merge([[1,3],[2,6],[8,10],[15,18]]);     
// var_dump($result1);     # [[1,6],[8,10],[15,18]]

// $result2 = $solution->merge([[1,4],[4,5]]);     
// var_dump($result2);     # [[1,5]]


// $result3 = $solution->merge([[4,7],[1,4]]);     
// var_dump($result3);     # [[1,7]]

// $result4 = $solution->merge([[1,4],[5,6]]);     
// var_dump($result4);     # [[1,4],[5,6]]




#$result5 = $solution->merge([[1,4],[0,4]]);     
#var_dump($result5);                     # [[0,4]]


#$result6 = $solution->merge([[1,4],[0,2],[3,5]]);     
#var_dump($result6);                     # [[0,5]]




