<?php
    /***** 
    二叉搜索树
    *****/
    class node{
        public $key;
        public $parent;
        public $left;
        public $right;
        public $bf;


        public function __construct($key){
            $this->key = $key;
            $this->left = null; 
            $this->right = null; 
            $this->parent = null; 
        }
    }



    class BST{
        public $root;

        /***** 
            叉树搜索树的初始化
        *****/
        public function __construct($arr){
            $this->root = new node($arr[0]);
            for($i = 1; $i<count($arr); $i++){
                $this->insert($arr[$i]);
            }
        }



        /***** 
             将一个节点插入
        *****/
        public function insert($key){
            if(!is_null($this->search($key))){
                throw new Exception("已经存在", 1);
            }
            $inode = new node($key);
            $root = $this->root;
            $current = $root;
            $prenode = null;

            while($current !== null){
                $prenode = $current;
                if($inode->key < $current->key){
                    $current = $current->left;
                }else{
                    $current = $current->right;
                }
            }

            $inode->parent = $prenode;

            if($prenode === null){
                $this->root = $inode;
            }else{
                if($inode->key < $prenode->key){
                    $prenode->left = $inode;
                }else {
                    $prenode->right = $inode;
                }
            }

        }


        /***** 
             查找并返回$key对应的节点
        #param $key 要查找的值
        #return 返回节点
        *****/
        public function search($key){
           $current = $this->root;
           while($current!==null){
                if($current->key == $key){
                    return $current;
                }else if($current->key >$key){
                    $current = $current->left;
                }else{
                    $current = $current->right;
                }
           } 
           return $current;
        }




        /***** 
             找最大值最小值
        #param  $case   -1 为找最小值  1为找最大值
        #return 找到则为节点 失败为false
        *****/
        public function extremum($case){
            $current = $this->root;
            switch ($case) {
                case 1:
                    while($current->right !== null){
                        $current = $current->right;
                    }
                    return $current;
                    break;
                
                case -1:
                     while($current->left!== null){
                        $current = $current->left;
                    }
                    return $current;
                    break;
            }
        }

        /***** 
             遍历
        #param $func
        #return false or true
        *****/
        public function travel($root,$func){
            $current = $root;
            if($current !== null){
                $this->travel($current->left,$func);
                $func($current->key);
                $this->travel($current->right,$func);
            }
        }


    }
?>