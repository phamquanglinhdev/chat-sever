@php
    //Vòng lặp xác định trước số lần
//        for

//$total = 0;
//for($i = 1;$i<=99;$i++){
//    if($i%2==1){
//        $total+=$i;
//    }
//}
//echo $total;

//Vòng lặp không xác định số lần => Điều kiện sai => Dừng lặp
//while ()
// in ra 5 số lẻ đầu tiên lớn hơn 0

$count = 0;
$i = 1;
while ($count<5){
    if($i%2==1){
        echo "<div>$i</div>";
        $count++;
    }
    $i++;
}

//BTVN: In ra 30 số chia hết cho 3 nhưng không chia hết cho 5 đầu tiên từ 0

//BTCAOCAPVL :
// + In ra bảng cửu chương
// + Vẽ hình tam giác vuông
//dùng 2 vòng lặp for :>>>>>
//*
//* *
//* * *
//* * * *
//* * * * *

@endphp
