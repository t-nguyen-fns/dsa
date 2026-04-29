<?php

/**
 * https://leetcode.com/problems/diameter-of-binary-tree/description/
 * Definition for a binary tree node.
 * class TreeNode {
 *     public $val = null;
 *     public $left = null;
 *     public $right = null;
 *     function __construct($val = 0, $left = null, $right = null) {
 *         $this->val = $val;
 *         $this->left = $left;
 *         $this->right = $right;
 *     }
 * }
 */

class DFSTreeDiameter {

    public $maxDiameterOfTreeThroughNodes = 0;


    /**
     * @param $root
     * @return int|mixed
     */
    function diameterOfBinaryTree($root) {

        if(!$root) {
            return 0;
        }

        $this->findDiameter($root);

        return $this->maxDiameterOfTreeThroughNodes;
    }

    function findDiameter($node)
    {

        if(!$node) {
            return 0;
        }
        

        $leftMaxHeigthOfNodeSubtree      = $this->findDiameter($node->left);
        $rightMaxHeightOfNodeSubtree     = $this->findDiameter($node->right);

        $currentDiameterThroughNode  = $leftMaxHeigthOfNodeSubtree + $rightMaxHeightOfNodeSubtree;

        $this->maxDiameterOfTreeThroughNodes  = max($currentDiameterThroughNode, $this->maxDiameterOfTreeThroughNodes);

        return $nodeHeight = 1 + max($leftMaxHeigthOfNodeSubtree, $rightMaxHeightOfNodeSubtree); 
    }
}


/**
 * Binary Tree Node class
 */
class TreeNode {
    public $val;
    public $left;
    public $right;

    public function __construct($val) {
        $this->val = $val;
        $this->left = null;
        $this->right = null;
    }
}


class BinaryTree {

    function buildBinaryTree(array $arr) {
        if (empty($arr) || $arr[0] === null) {
            return null; // Empty tree
        }

        // Create root node
        $root = new TreeNode($arr[0]);
        $queue = [$root];
        $i = 1;

        // BFS construction
        while (!empty($queue) && $i < count($arr)) {
            $current = array_shift($queue);

            // Left child
            if ($i < count($arr) && $arr[$i] !== null) {
                $current->left = new TreeNode($arr[$i]);
                $queue[] = $current->left;
            }
            $i++;

            // Right child
            if ($i < count($arr) && $arr[$i] !== null) {
                $current->right = new TreeNode($arr[$i]);
                $queue[] = $current->right;
            }
            $i++;
        }

        return $root;
    }

    
    function printLevelOrder($root) {
        if (!$root) {
            echo "[]\n";
            return;
        }
        $queue = [$root];
        $result = [];
        while (!empty($queue)) {
            $node = array_shift($queue);
            if ($node) {
                $result[] = $node->val;
                $queue[] = $node->left;
                $queue[] = $node->right;
            } else {
                $result[] = null;
            }
        }
        
        while (end($result) === null) {
            array_pop($result);
        }
        echo implode(",", $result) . "\n";
    }
}





$input          = [1,2,3,4,5,6,7, 8, 9];
$binaryTree     = new BinaryTree();
$tree           = $binaryTree->buildBinaryTree($input);

var_dump($tree);
$solution = new DFSTreeDiameter();
$ans = $solution->diameterOfBinaryTree($tree);
var_dump($ans);

