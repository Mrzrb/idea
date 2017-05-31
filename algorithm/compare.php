<?php

//************************************比较两个相同位数的数字的组成是否相等***********************************//
    $a = 555234;



    function getNumArr($a){  //获得各个位数数组
        $arr = [];
        $len = strlen($a);
        for ($m=0; $m<$len ; $m++) { 
            if ($m==0) {
                $arr[]=$a%10;
            }else{
                $arr[]=floor($a/pow(10,$m))%10;
            }
            }
            return $arr;
    }


                
        

        function reCArr(){   //获得比较数组
            $arr = [];

                for($i=0;$i<10;$i++){
                    array_push($arr,0);
            }
            return $arr;
        }

                // echo count($arr);
            //var_dump($arr);


            function compare($c1,$c2){
                $g1 = reCArr();
                $g2 = $g1;
                for($i=0;$i<6;$i++){
                    $g1[$c1[$i]]++;
                    $g2[$c2[$i]]++;
                }

                if($g1 === $g2){
                    return true;
                }else return false;

            }



            $num1 = 123456;
            $num2 = 654381;

            $n1 = getNumArr($num1);
            $n2 =getNumArr($num2);


        var_dump (compare($n1,$n2));