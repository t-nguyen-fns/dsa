<?php

/**
 * Identify Independent Partitions/Blocks
 */

class PartitionLabels {


    function partitionLabels($s) {
        
        
        $length     = strlen($s);        
        $ans        = [];
        $mapEnd     = [];

        for($i = 0; $i < $length; $i++) {
            $mapEnd[$s[$i]] = $i;
        }


        $i_start    = 0;
        $i_end      = $mapEnd[$s[$i_start]];

        for($i = 0; $i < $length; $i++) {

            if($mapEnd[$s[$i]] >  $i_end) {
                $i_end = $mapEnd[$s[$i]];
            }


            if($i === $i_end) {

                $ans[]  = $i_end - $i_start + 1;

                if(isset($s[$i + 1])) {                    
                    $i_start        = $i + 1;
                    $i_end          = $mapEnd[$s[$i_start]];
                }
            }
        }

        return $ans;

    }

}

$solution = new PartitionLabels();
$result1 = $solution->partitionLabels("ababcbacadefegdehijhklij");
var_dump($result1);


$result2 = $solution->partitionLabels("eccbbbbdec");
var_dump($result2);

