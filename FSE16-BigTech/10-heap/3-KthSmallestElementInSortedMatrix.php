<?php

class KthSmallestElementInSortedMatrixOld extends SplMaxHeap
{

    /**
     * TC: N^2*logK
     * SC: O(1)
     * TC: 110ms Beats 33.33%
     * @param Integer[][] $matrix
     * @param Integer $k
     * @return Integer
     */
    function kthSmallest($matrix, $k)
    {

        $this->k = $k;

        foreach ($matrix as $idx => $points) {

            foreach ($points as $idx_pt => $point) {

                $this->insert([$idx, $idx_pt, $point]);

                if ($this->count() > $k) {

                    $this->extract();
                }
            }

        }


        $result = $this->top();

        return $matrix[$result[0]][$result[1]];
    }

    protected function compare($point1, $point2): int
    {

        # SplMaxHeap
        return $point1[2] <=> $point2[2];
    }


    /**
     *   # [[1,2],[1,3]
     *   # #######
     *   # 1 2
     *   # 1 3
     *   # unsorted matrix
     *   # 1 1 2 4
     *   # -> flatten sorted
     * @param Integer[][] $matrix
     * @param Integer $k
     * @return Integer
     */
    function kthSmallestWrong($matrix, $k) {

        $this->k = $k;

        $count = 0;

        foreach($matrix as $idx => $points) {

            foreach($points as $idx_pt => $point) {

                $count++;

                if($count === $k) {
                    return $matrix[$idx][$idx_pt];
                }
            }

        }
    }

}

class KthSmallestElementInSortedMatrix extends SplMinHeap
{


    /**
     *   TC: O(1)
     *   # [[1,2],[1,3]
     *   # #######
     *   # 1 2
     *   # 1 3
     *   # unsorted matrix
     *   # 1 1 2 4
     *   # -> flatten sorted
     * @param Integer[][] $matrix
     * @param Integer $k
     * @return Integer
     */
    function kthSmallestWrong(array $matrix, int $k){

        $n = count($matrix);

        // Calculate row and column
        $modCol = ($k % $n);
        $col    = $modCol > 0 ? $modCol - 1 : $modCol;
        
        $divRow = intdiv($k, $n);
        $row    = $divRow === 1 && $modCol === 0 ? 0 : $divRow ;

        return $matrix[$row][$col];
    }

    /**
     * TC: O(logN^2)
     * @param array $matrix
     * @param int $target
     * @return bool
     */
    public function binarySearchMaxtrix(array $matrix, int $target)
    {
        $r    = count($matrix);
        $c    = count($matrix[0]);

        $left = 0;
        $right = ($r * $c) - 1;

        while($left <= $right) {

            $ptr_idx    = floor($left + ($right - $left) / 2);
            $ptr_row    = intdiv($ptr_idx, $r);
            $ptr_col    = $ptr_idx % $c;

            $ptr_value  = $matrix[$ptr_row][$ptr_col];

            if($ptr_value === $target) {
                return true;
            } else {
                if($target < $ptr_value) {
                    $right = $ptr_idx - 1; 
                } else {
                    $left  = $ptr_idx + 1;
                }
            }
        }

        return false;

    }
    
    /**
     * TC: O(NlogN)
     * SC: O(1)
     * TC: 1ms Beats 83.33%
     * SC: Memory 23.45 MB Beats 83.33%
     * @param array $matrix
     * @param int $k
     */
    public function kthSmallestBinarySearch(array $matrix, int $k)
    {
        #$r      = count($matrix);
        #$c      = count($matrix[0]);

        #$left   = 0;
        #$right  = ($r * $c) - 1;

        $n       = count($matrix);
        $lower   = $matrix[0][0];
        $higher  = $matrix[$n - 1][$n - 1]; 
        

        while($lower < $higher) {


            # $ptr_idx    = floor($left + ($right - $left) / 2);
            # $ptr_row    = intdiv($ptr_idx, $r);
            # $ptr_col    = $ptr_idx % $c;
            # $ptr_value  = $matrix[$ptr_row][$ptr_col];

            $count      = 0;
            $mid_value  = floor($lower + ($higher - $lower) / 2);
            $row        = $n - 1;
            $col        = 0;

            $smaller    = $matrix[0][0];
            $larger     = $matrix[$n - 1][$n - 1];

            while($row >= 0 && $col < $n) {

                if($matrix[$row][$col] > $mid_value) {
                    
                    $larger  = min($larger, $matrix[$row][$col]);
                    $row    -= 1;

                } 
                # $matrix[$row][$col] < $mid_value
                else {
                    $smaller  = max($smaller, $matrix[$row][$col]);
                    $count   += $row + 1;
                    $col     += 1;
                }

            }


            if($count === $k) {
                return $smaller;
            } else {
                if($k < $count) {
                    $higher = $smaller; 
                } else {
                    $lower  = $larger;
                }
            }
            
        }

        return $lower;

    }

    /**
     *
     * TC: O(N(logN))
     * SC: O(1)
     * RT: 28 ms Beats 66.67%
     * SC: 23.06 MB Beats 83.33%
     * @param array $matrix
     * @param int $k
     * @return mixed
     */
    public function kthSmallestHeap(array $matrix, int $k)
    {
        $n = count($matrix);
        
        foreach(range(0, min($k, $n) - 1) as $r) {
            $this->insert([$matrix[$r][0], $r, 0]);
        }

        while($k > 0 ){
            
            [$val, $r, $c] = $this->extract();

            if($c < ($n - 1)) {
                $this->insert([$matrix[$r][$c + 1], $r, $c + 1]);
            }

            $k--;
        }

        return $val;
    }

}


$solution = new KthSmallestElementInSortedMatrix();




//  # 1 5 9 10 11 12 13 13 15
// $result1 =  $solution->kthSmallest([[1,5,9],[10,11,13],[12,13,15]], 8);       # 13
// var_dump($result1);

// # 1 1 2 3
// # 1 2
// # 1 3
// $result =  $solution->kthSmallest([[1,2],[1,3]], 3);       # 2
// var_dump($result);
// // [0, 0, 1]
// // [0, 1, 2]
// // [1, 0, 1]
// // [1, 1, 3]



// $result2 =  $solution->kthSmallest([[-5]], 1);       # -5
// var_dump($result2);

# 1 5 9 10 11 12 13 13 15
#    ########
# 0: 1   5  9
# 1: 10 11 13   
# 2: 12 13 15
# echo $solution->binarySearchMaxtrix([[1,5,9],[10,11,13],[12,13,15]], 1) . "\n";


#$result =  $solution->kthSmallestHeap([[1,5,9],[10,11,13],[12,13,15]], 8);
#var_dump($result);


$result =  $solution->kthSmallest([[1,5,9],[10,11,13],[12,13,15]], 8);
var_dump($result);


# 