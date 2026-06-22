<?php

/**
 * https://leetcode.com/problems/non-overlapping-intervals/
 */

class NonOverlapingIntervals {

    /**
     * TC: O(NlogN + N)
     * SC: O(1)
     * @param Integer[][] $intervals
     * @return Integer
     */
    function eraseOverlapIntervals($intervals)
    {

        # Sort
        sort($intervals);
        $A_start = null;
        $A_end = null;
        $overlap = 0;
        
        foreach($intervals as $idx => [$B_start, $B_end]) {

            if($B_start < $A_end) {

                $overlap++;
                # minimize the number of intervals to remove
                # maximizing the number of non-overlapping intervals we can keep
                # -> Greedy Choice Property: 
                #        - To minimize the chance of future overlaps, minimize the interval that ends earlier
                #        - By minimizing the interval that ends earlier min(A_end, B_end), we maximize the remaining free timeline for future intervals
                
                $A_end = min($A_end, $B_end);
            } else {
                
                [$A_start, $A_end] = [$B_start, $B_end];
            }
            

        }
        
        return $overlap;
    }

}


$solution = new NonOverlapingIntervals();
#echo $solution->eraseOverlapIntervals([[1,2],[2,3],[3,4],[1,3]]);   # 1
#echo $solution->eraseOverlapIntervals([[1,2],[1,2],[1,2]]);         # 2
#echo $solution->eraseOverlapIntervals([[1,2],[2,3]]);               # 0

echo $solution->eraseOverlapIntervals([[-52,31],[-73,-26],[82,97],[-65,-11],[-62,-49],[95,99],[58,95],[-31,49],[66,98],[-63,2],[30,47],[-40,-26]]);     #7


#idx: 0 | Astart:  | Aend:  | Bstart: -73 | Bend: -26 | overlap: 0 
#idx: 1 | Astart: -73 | Aend: -26 | Bstart: -65 | Bend: -11 | overlap: 0 
#idx: 2 | Astart: -73 | Aend: -26 | Bstart: -63 | Bend: 2 | overlap: 1 
#idx: 3 | Astart: -73 | Aend: -26 | Bstart: -62 | Bend: -49 | overlap: 2 
#idx: 4 | Astart: -73 | Aend: -26 | Bstart: -52 | Bend: 31 | overlap: 3 
#idx: 5 | Astart: -73 | Aend: -26 | Bstart: -40 | Bend: -26 | overlap: 4 
#idx: 6 | Astart: -73 | Aend: -26 | Bstart: -31 | Bend: 49 | overlap: 5 
#idx: 7 | Astart: -73 | Aend: -26 | Bstart: 30 | Bend: 47 | overlap: 6 
#idx: 8 | Astart: 30 | Aend: 47 | Bstart: 58 | Bend: 95 | overlap: 6 
#idx: 9 | Astart: 58 | Aend: 95 | Bstart: 66 | Bend: 98 | overlap: 6 
#idx: 10 | Astart: 58 | Aend: 95 | Bstart: 82 | Bend: 97 | overlap: 7 
#idx: 11 | Astart: 58 | Aend: 95 | Bstart: 95 | Bend: 99 | overlap: 8 
#8

##

#idx: 0 | Astart:  | Aend:  | Bstart: -73 | Bend: -26 | overlap: 0 
#idx: 1 | Astart: -73 | Aend: -26 | Bstart: -65 | Bend: -11 | overlap: 0 
#idx: 2 | Astart: -73 | Aend: -26 | Bstart: -63 | Bend: 2 | overlap: 1 
#idx: 3 | Astart: -73 | Aend: -26 | Bstart: -62 | Bend: -49 | overlap: 2 
#idx: 4 | Astart: -73 | Aend: -49 | Bstart: -52 | Bend: 31 | overlap: 3 
#idx: 5 | Astart: -73 | Aend: -49 | Bstart: -40 | Bend: -26 | overlap: 4 
#idx: 6 | Astart: -40 | Aend: -26 | Bstart: -31 | Bend: 49 | overlap: 4 
#idx: 7 | Astart: -40 | Aend: -26 | Bstart: 30 | Bend: 47 | overlap: 5 
#idx: 8 | Astart: 30 | Aend: 47 | Bstart: 58 | Bend: 95 | overlap: 5 
#idx: 9 | Astart: 58 | Aend: 95 | Bstart: 66 | Bend: 98 | overlap: 5 
#idx: 10 | Astart: 58 | Aend: 95 | Bstart: 82 | Bend: 97 | overlap: 6 
#idx: 11 | Astart: 58 | Aend: 95 | Bstart: 95 | Bend: 99 | overlap: 7 
#7
