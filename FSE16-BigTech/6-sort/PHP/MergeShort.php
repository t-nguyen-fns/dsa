<?php


/**
 * chia nhỏ + sort các dãy con và merge chúng lại.
 * Chia đôi dãy cần sort thành 2 nửa
 * Sort mỗi nửa dùng đệ quy
 * Merge 2 nửa đã sort lại với nhau trước khi thoát đệ quy
 */

class MergeShort
{

    function mergeShort($numbs)
    {
    
        
        return $this->mergeShortRecv($numbs);

    }   

     function selectionShort($numbs) {

        $current_index = 0;

        for ($i = 0; $i < count($numbs); $i++) {

            $min_index = $current_index;

            for ($j = $min_index + 1; $j < count($numbs); $j++) {

                if ($numbs[$j] < $numbs[$min_index]) {
                    $min_index = $j;
                }
            }

            // swap
            $current_value = $numbs[$current_index];
            $numbs[$current_index] = $numbs[$min_index];
            $numbs[$min_index] = $current_value;

            $current_index++;
        }

        return $numbs;
    }

    function mergeShortRecv($numbs)
    {

        $low = 0;
        $high = count($numbs) - 1;

        if(count($numbs) == 1) {
            return $numbs;
        }

        if(count($numbs) == 0) {
            exit;
        }

        $mid = ceil($high / 2);

        // slice left
        $lowSliceArray = [];
        for($i = 0; $i < $mid; $i++) {
            $lowSliceArray[$i] = $numbs[$i];
        }

        // slice right
        $highSliceArray = [];
        for($j = $mid, $index = 0; $j <= $high; $j++, $index++) {
            $highSliceArray[$index] = $numbs[$j];
        }

        $lowArr  = $this->mergeShortRecv($lowSliceArray);
        $highArr = $this->mergeShortRecv($highSliceArray);

        $mergedArraySorted = $this->mergeShortTwoArray($lowArr, $highArr);

        return $mergedArraySorted;
    }


    public function mergeShortTwoArray($left, $right)
    {
        $i = 0; $j = 0; $count = 0;
        $leftLength = count($left);
        $rightLength = count($right);
        $numbs = [];
        while($i < $leftLength && $j < $rightLength) {

            $leftI = $left[$i];
            $rightJ = $right[$j];


            if($left[$i] < $right[$j]) {
                $numbs[$count++] = $left[$i++];
            } else {
                $numbs[$count++] = $right[$j++];
            }
        }

        // When we exit the first while loop, one array is exhausted
        // The remaining elements are already sorted AND are all larger than what's already been placed
        //echo "i < leftLength : $i < $leftLength \n";

        // either left or right is exhausted => the Copy remaining elements from left (if any)
        // Case 1 (left exhausted): All elements in right are ≥ the last element taken from right (due to sorting), and that last element was ≥ the last element taken from left (due to merge logic). Therefore, all remaining right elements ≥ everything already placed.
        while($i < $leftLength) {
            $numbs[$count++] = $left[$i++];    
        }

        //echo "j < rightLength : $j < $rightLength \n";
        // either left or right is exhausted => the Copy remaining elements from right (if any)
        // Case 2 (right exhausted): Similarly, all remaining left elements ≥ everything already placed.
        
        while($j < $rightLength) {
            $numbs[$count++] = $right[$j++];    
        }

        return $numbs;
    }

    
    public function sortArrayV2($nums)
    {
        $this->mergeSortV2($nums, count($nums));
        return $nums;
    }
    

    //sort day nums co do dai n
    public function mergeSortV2(&$nums, $n) {
        if ($n == 1) {
            return;
        }
        // Chia day ra lam 2 day
        $mid = (int) $n / 2;
        // Clone day ben trai
        $left = [];
        for($i = 0; $i < $mid; $i++) {
            $left[$i] = $nums[$i];
        }
        // Clone day ben phai
        $right = [$n - $mid];
        for($i = 0; $i < $n - $mid; $i++) {
            $right[$i] = $nums[$i + $mid];
        }

        $this->mergeSortV2($left, $mid);
        $this->mergeSortV2($right, $n - $mid);  

        $this->merge($left, $mid, $right, $n - $mid, $nums);
    }

    /*  
        Merge 2 day left va right (2 day da duoc sort) vao day nums
    */
    public function merge(&$left, $m, &$right, $n, &$nums) {
        $i = 0; $j = 0; $count = 0;


        while($i < $m && $j < $n) {

            $leftI = $left[$i];
            $rightJ = $right[$j];

            if ($left[$i] < $right[$j]) {
                $nums[$count++] = $left[$i++];
            } else {
                $nums[$count++] = $right[$j++];
            }

        }
        // When we exit the first while loop, one array is exhausted
        // The remaining elements are already sorted AND are all larger than what's already been placed
        // echo "i < m : $i < $m \n";

        // either left or right is exhausted => the Copy remaining elements from left (if any)
        // Case 1 (left exhausted): All elements in right are ≥ the last element taken from right (due to sorting), and that last element was ≥ the last element taken from left (due to merge logic). Therefore, all remaining right elements ≥ everything already placed.
        while($i < $m) {
            $nums[$count++] = $left[$i++];
        }

        // either left or right is exhausted => the Copy remaining elements from right (if any)
        // Case 2 (right exhausted): Similarly, all remaining left elements ≥ everything already placed.
        while($j < $n) {
            $nums[$count++] = $right[$j++];
        }
    }

}

$solution = new MergeShort();

/**
 * Input: nums = [-1,0,3,5,9,12], target = 9
 * Output: 4
 * Explanation: 9 exists in nums and its index is 4
 */

echo "Merge Sort \n";
$numbs = [11, 2, 6, 7, 26, 3, 19, 65];
echo "before mergeSort: " . implode(",", $numbs) . "\n";
$shortedArray = $solution->mergeShort($numbs);
echo "after mergeSort: " . implode(",", $shortedArray) . "\n";

$numbs1 = [5,2,3,1];
echo "before mergeSort: " . implode(",", $numbs1) . "\n";
$shortedArray1 = $solution->mergeShort($numbs1);
echo "after mergeSort: " . implode(",", $shortedArray1) . "\n";



echo "before mergeSort: " . implode(",", $numbs) . "\n";
$shortedArray2 = $solution->sortArrayV2($numbs);
echo "after mergeSort: "  . implode(",", $shortedArray2) . "\n";

echo "before mergeSort: " . implode(",", $numbs1) . "\n";
$shortedArray3 = $solution->sortArrayV2($numbs1);
echo "after mergeSort: " . implode(",", $shortedArray3) . "\n";