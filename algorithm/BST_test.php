<?php
    /***** 
     Commented-Out
    *****/
    include ('BST.php');

    $arr = array();
    for($i=0;$i<15;$i++){
        $arr[$i] = rand(0,9999);
    }
    var_dump($arr);

   // $arr1= [1];
    //print_r($arr1);
    $tr = new BST($arr);
    function mecho($c){
        echo $c,'<br>';
    }

    //$tr->travel($tr->root,'mecho');
    // echo $tr->extremum(1)->key;
    // var_dump($tr);
    //var_dump( $tr->search(1));


?>