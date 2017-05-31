<?php
//*********************************单向链表*****************************************//
        class Node{

            public $data = '';
            public $next = null;

            public function __construct(){
                if(func_num_args()>0){
                    $this->data = func_get_args()[0];
                }
            }
        }


        class mList{
            public $_length = 0;
            public $_head = null;
            public $_last = null;



            public function __construct(){
                $this->_head = new Node();
                $this->_last = $this->_head;
                $this->_last->next = $this->_head;
                $this->_head->next = null;
            }



    //******************************增删类***************************************//
            function addNodeHead($node){    //insert node after head
                $temp = new Node();
                $temp = $node;
                $this->_head->next = $temp;
                $this->_head = $temp;
                $this->_head->next = null;
                $this->_length ++;
            }


            function addNodeafter($node,$flag){ //insert node after flag
                $node->next = $flag->next;
                $flag->next = $node;
                $this->_length++;
            }


            
            function deNodeFromHead(){
                
                $swim = $this->_last;
                if($swim->next == null){
                    echo __FUNCTION__, ':&nbsp;Delete failed, error: there is no Node to delete, length of list equal to 0!<br>';
                    return null;
                }
                $temp = null;
                while($swim->next->next){
                    $swim= $swim->next;
                }
                $temp = $swim->next;
                $temp->next = null;
                $swim->next = null;
                $this->_head = $swim;
                $this->_length--;
                return $temp;
            }

            function deNodeFromLast(){
                $temp = null;            
                if($this->_length == 0){
                    echo __FUNCTION__,'&nbsp:Delete failed, error: there is no Node to delete, length of list equal to 0!<br>';
                    return null;
                }else if($this->_length != 0){
                $temp = $this->_last->next;
                $this->_last->next = $temp->next;
                $temp->next = null;
                $this->_length --;
                return $temp;
                }
            }





    //********************************遍历类*********************************************//
            function moveSteps($num,$flag){   //move and retuern $num steps from $flag
                $r = $flag;
                for($i = 0; $i<$num; $i++){
                    $flag = $flag->next;
                    if($flag==null){
                        echo __CLASS__,'->',__FUNCTION__,':overflow!<br>';
                        return;
                    }
                    $r = $flag;
                }
                return $r;
            }


            function travelL(){ //travel all node of link
                $swim = $this->_last;
                if($swim->next == null){
                    echo __CLASS__,'->',__FUNCTION__ ,':No Object exist!<br>';
                    return;
                }
                while($swim){
                    echo $swim->data.'&nbsp;';
                    $swim = $swim->next;
                }
            }





        //**********************************寻找类型**************************************//
        function findFirstData($data){
            $swim = $this->_last;
            while($swim->data != $data){
                $swim = $swim->next;
            }
            return $swim;

        }


        function findAllData($data){
            $dataArr = [];
            $swim = $this->_last;
                while($swim){
                    if($swim->data == $data){
                        array_push($dataArr,$swim);
                    }
                    $swim = $swim->next;
                }
                if(!empty($dataArr)){
                    return $dataArr;
                }else return null;
        }





        }

        $mli = new mList();
        $a = new Node(1);
        $b = new Node(2);
        $c = new Node(3);
        $d = new Node(4);
        $e = new Node(5);
        $f = new Node(6);
        $g = new Node(7);
        $h = new Node(1);
        var_dump($mli);
    //  $mli->travelL();
        $mli->addNodeHead($a);
        $mli->addNodeHead($b);
        $mli->addNodeHead($c);
        $mli->addNodeHead($d);
        $mli->addNodeHead($e);
        $mli->addNodeHead($f);
        $mli->addNodeHead($g);
        $mli->addNodeHead($h);
        $mli->moveSteps(5,$mli->_last);
        echo $mli->_length;
    // $mli->travelL();
        // $mli->addNodeafter($y,$sl);
        
        // echo $mli->_last->next->next->next->next->next->next->data;
        // echo $mli->_head->data;
        // echo $mli->_last->next->next->data;
        

?>