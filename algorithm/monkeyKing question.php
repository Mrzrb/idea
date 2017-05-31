<?php
//******************猴子选王问题（约瑟夫环问题）***********************************************
    // $a[0] =  1;
    // $a[2] =  3;
    // $a[1] =  2;
    // $a[3] =  0;


    //*************************************数组模拟循环链表法************************************//
        $arr=[0];
        $monkey = 9000;
        $sum = 55;
        //construct
        for($i=0;$i<$monkey;$i++){
            if($i!=$monkey-1){
                $arr[$i] = $i+1;
            }else $arr[$i] = 0;
        }

        $pre = $arr[count($arr)-2];
        $next = 1;
        $now = 0;    
        $count = 1;
        $alive = $monkey;
        while($alive-1){
            if($count==$sum){
                $arr[$pre] = $next;     $arr[$now] = -1;
                $alive--;               $now = $next;
                $next = $arr[$next];    $count =1;
            }else {
                $pre = $now;
                $now = $next;
                $next = $arr[$next];
                $count ++;
            }
        }

    


        //var_dump($arr);
        echo $now+1;
        echo '<br>';




    //****************数组push法********************************************//



        // $cache = 1;
        // $next = $arr[0];
        // $count=1;
        // $live = $monkey;
        // while($live-1){

        //     if($count<$sum ){
        //         $count++;
        //         $cache = $next;
        //         $next = $arr[$next];
        //     }else if($count==$sum){
        //         $count = 1;
        //         $live--;
        //         $arr[$cache] = $arr[$next];
        //         echo 'tao tai '.($cache).'<br>';

        //         $cache = $next;
        //         $next = $arr[$next];
        //         $arr[$cache] =0;
        //     }
        // }
        // print_r($arr);





        //     function King($a=7,$b=5){
        // 	for ($i=1; $i <= $a; $i++) { 
        // 		$arr[]=$i; 
        // 	}

        
        // 	 //1       2      3     4      5      6      7
        // 	// arr[0],arr[1],arr[2],arr[3],arr[4],arr[5],arr[6]
        // 	$j = 1;
        //     print(count($arr));
        // 	while (count($arr)>1) {
        // 		if ($j%$b==0) {
        //             echo $j-1,'&nbsp;',$arr[$j-1],'<br>';
        // 			echo '数到第',$j,'次的时候，第',$arr[$j-1],'只猴子被淘汰<br>';
        // 			unset($arr[$j-1]);
        // 		}else{
        // 			array_push($arr,$arr[$j-1]);
        // 			unset($arr[$j-1]);
        //             //var_dump($arr);
        // 		}
        // 		$j++;
        // 	}
        // 	return $arr;
        // }


    //********************************约瑟夫法*****************************//

    function getLeader($n,$m) {  
        $res=0;  
        for($i=2; $i<=$n; $i++) {
            $res=($res+$m)%$i;  
        }
        return $res+1;  
    }  
    $leader = getLeader(9000,55);
    echo $leader;




?>