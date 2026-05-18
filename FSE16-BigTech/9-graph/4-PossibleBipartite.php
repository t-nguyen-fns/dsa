<?php

class PossibleBipartite {


    const WHITE = -1;
    
    const RED   = 0;

    const BLACK = 1;

    public $graph;

    public $n;

    public $numberOfPeople;

    public $ans = true;

    public $path = [];

    public $visited = [];

    public $visitedColors = [];

    /**
     * @param Integer $n
     * @param Integer[][] $dislikes
     * @return Boolean
     */
    function possibleBipartition($n, $dislikes) {
          
        $this->n   = $n;
        $this->ans = true;
        $this->visitedColors = array_fill(0, $n + 1, self::WHITE);
        
        $this->graph = array_fill(0, $n + 1, []);
        # ?!
        foreach ($dislikes as $edge) {
            $i = $edge[0];
            $j = $edge[1];
            $this->graph[$i][] = $j;
            $this->graph[$j][] = $i;
        }

        if(!$this->graph) {
            return false;
        }


        # start from first node
        for($i = 1; $i <= $n; $i++) {
            # dfs unvisited node
            if($this->visitedColors[$i] === self::WHITE) {
                $this->visitedColors[$i] = self::RED;
                $this->dfs($i);
            }
        }


        return $this->ans;
    }

    function dfs($i) {

        foreach($this->graph[$i] as $j) {

            # if visited color
            if($this->visitedColors[$i] === $this->visitedColors[$j]) {
                return $this->ans = false;
            } else if ($this->visitedColors[$j] === self::WHITE) {
                # otherwise: set other color for $i's adjacent nodes
                $this->visitedColors[$j] = 1 - $this->visitedColors[$i];
                # 
                $this->dfs($j);
            }
        }
    }

}


$solution = new PossibleBipartite();


$grid = [[1,2],[1,3],[2,4]];
echo $solution->possibleBipartition(4, $grid) . "\n";   # output: true

$grid1 = [[1,2],[1,3],[2,3]];
#echo $solution->possibleBipartition(3, $grid1) . "\n";   # output: false