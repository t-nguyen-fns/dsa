<?php

class Combinations {

    public $n;

    public $k;

    public $ans = [];

    /**
     * @param Integer $n
     * @param Integer $k
     * @return Integer[][]
     */
    function combine($n, $k) {
        

        $this->n = $n;
        $this->k = $k;
        $this->ans = [];

        $current_combination = [];

        $this->choose(1, $current_combination);
        //$this->chooseOld($current_using, $used, $current_combination);
        return $this->ans;
    }

    /**
     * 
     * Runtime: 444 ms
     * Beats: 5.00%
     * @param mixed $current_using
     * @param mixed $current_combination
     * @return void
     */
    function choose($current_using, $current_combination)
    {
        if(count($current_combination) === $this->k)
        {
            $this->ans[] = $current_combination;
            return;
        }

        $end = $this->n;

        for ($i = $current_using; $i <= $end; $i++) {


            // complexity:O(K∗C(N,K))
            // Prune the search space by starting the loop from current_using + 1 instead of 1 to avoid redundant checks.
            array_push($current_combination, $i);
            $this->choose($i + 1, $current_combination);
            array_pop($current_combination);
        }
        
    }

    /**
     * 
     * Runtime: 459 ms
     * Beats: 5.00%
     * @param mixed $current_using
     * @param mixed $used
     * @param mixed $current_combination
     * @return void
     */
    function chooseOld($current_using, $used, $current_combination)
    {
        if(count($current_combination) === $this->k)
        {
            $this->ans[] = $current_combination;
            return;
        }

        foreach(range(1, $this->n) as $i)
        {
            
            if(!in_array($i, $used) && $i > $current_using){

                $used[$i] = $i;
                $current_using = $i;
                array_push($current_combination, $i);
                // complexity:O(N^K)
                $this->choose($current_using , $used, $current_combination);
                array_pop($current_combination);
                unset($used[$i]);
            }
            
        }
    }
}


$solution = new Combinations();
$ans = $solution->combine(4, 2);

var_dump($ans);