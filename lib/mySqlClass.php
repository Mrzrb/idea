<?php
    class mySqlClass{
        private $_hostname = 'localhost';
        private $_username = 'root';
        private $_password = '';
        private $_charset = 'utf8';
        private $_dbname = '';
        private $_tbname = '';
        private $_link = null;
        private $_dataStack;
        private $_dataArr = array();
        private $_keys = array();

        private $_isEmpty = true;

        public function __construct(){
            if(!empty(func_get_args())){
                $args = func_get_args();
                $this->_hostnae = $args[0];
                $this->_username = $args[1];
                $this->_password = $args[2];
                $this->_charset = $args[3];
            }
           
        }

        function fetchTable_($dbname,$table){
            $this->_dbname = $dbname;
            $this->_tbname = $table;
            $this->_link = mysqli_connect($this->_hostname,$this->_username,$this->_password,$this->_dbname);
            //var_dump($this->_link);
            mysqli_query($this->_link,'set names '.$this->_charset);
            $sql = 'select * from '.$table;
            $this->_dataStack = mysqli_query($this->_link,$sql);
           // var_dump($this->_dataStack);

            $this->_keys = $this->getKeys();
            //var_dump($this->_keys);
        }



  //*************************explore the record****************************************


        function getData(){    //获取数据栈的顶头元素
            return mysqli_fetch_assoc($this->_dataStack);
        }


        function showKeys(){

            $sql = "SHOW FULL COLUMNS FROM $this->_tbname";
            $r = mysqli_query($this->_link,$sql);
            $keys = array();
            while($a = mysqli_fetch_assoc($r)){
                $keys[] = $a['Field'];
            }

           // $temp = mysqli_fetch_assoc($this->_dataStack);
           // $keys = array_keys($temp);
            if(!empty($keys)){
                foreach($keys as $key){
                    echo $key,'&nbsp&nbsp&nbsp';
                }
            }
        }


        function getKeys(){
            $sql = "SHOW FULL COLUMNS FROM $this->_tbname";
            $r = mysqli_query($this->_link,$sql);
            $res = array();
            while($a = mysqli_fetch_assoc($r)){
                $res[] = $a['Field'];
            }
            return $res;
        }


        // function getKeysi(){
        //     $temp = mysqli_fetch_assoc($this->_dataStack);
        //     $keys = array_keys($temp);
        //     return $keys;
        // }

        function getDataArr(){
            $arr = array();
            while($a = mysqli_fetch_assoc($this->_dataStack)){
                $arr[] = $a;
            }
            return $arr;
        }


        function drawTable(){    //绘制数据栈表格
            $temp = mysqli_fetch_assoc($this->_dataStack);
            $keys = array_keys($temp);
            $row = count($temp);
            $marr = $this->getDataArr();
            $col = count($marr);

            echo '<table border=1 style="border-collapse:collapse;border-color:#aaaaaa;">';
            echo '<tr>';
            for($l=0;$l<$row;$l++){
                echo '<td>';
                echo $keys[$l];
                echo '</td>';
            }
            echo '</tr>';


            for($i=0;$i<$col;$i++){
                echo '<tr>';
                for($j=0;$j<$row;$j++){
                echo '<td>';
                    echo $marr[$i][$keys[$j]];
                echo '</td>';
                }
                echo '</tr>';
            }
            echo '</table>';
                    
        }
        

 //***********************************Insert data ************************************
    function insertData(){
            $keys = array();
            $keys = $this->getKeys();
            $args = func_get_args();
    
        //获取table括号中的文字
            $tbn ="";
            for($i=1;$i<count($keys);$i++){
                if($i==count($keys)-1){
                    $tbn .= (''.$keys[$i]);
                }else{
                    $tbn.=(''.$keys[$i].',');
                }
            }
        //构造输入数据字符
            $text = "";
            for($i=0;$i<count($args);$i++){
                $test = gettype($args[$i]);
                if($i!=count($args)-1){
                    if($test === 'string'){
                        $text .=("'".$args[$i]."',");
                    }else if($test === 'integer'||$test === 'double'){
                        $text .=("".$args[$i].",");
                    } 
                }
                   else{
                        if($test === 'string'){
                            $text .=("'".$args[$i]."'");
                        }else if($test === 'integer'||$test === 'double'){
                            $text .=("".$args[$i]);
                    } 
                }
           } 
        //    echo $text;


            $sql = "insert into $this->_tbname ($tbn) values($text)";

            // echo $sql;
                //echo $sql;

            $res =  mysqli_query($this->_link,$sql);
            if(!$res){
                echo mysqli_error($this->_link);
                exit;
            }
    }
 
 




 
 }





    $t = new mySqlClass();
    $t->fetchTable_('mchat','category');
    //$t->showKeys();
    // $t->getKeysi();
    //var_dump($t->getData());
   // $t->drawTable();
   // $t->drawTable();
   // $t->insertData('周宗明',5);
?>