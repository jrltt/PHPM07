<?php
// $count = 0;
// $x = 0;
// $y = 1;

// echo $x."<br />";
// echo $y."<br />";

// while($count < 10) {
//     $z = $x + $y;
//     echo $z."<br />";
//     $x = $y;
//     $y = $z;
//     $count ++;
// }
function fibonacci($n,$first = 0,$second = 1)
{
    $fib = [$first,$second];
    for($i=1;$i<$n;$i++)
    {
        $fib[] = $fib[$i]+$fib[$i-1];
    }
    return $fib;
}
echo "<pre>";
print_r(fibonacci(8));

//Serie de fibonacci
//martin@mygnet.com
//Consiste en una serie de números que se construye una serie desde el numero 1, después el numero 2. y luego se obtiene el siguiente numero por la suma del anterior y su precedente:
//1, 1, 2, 1+2=3, 2+3=5, 3+5=8, 5+8=13, 8+13=21, 13+21=34, 21+34=55, 34+55=89, 55+89=144, 89+144=233, 144+233=377, 233+377=610, 377+610=987, 610+987=1597, 987+1597=2584, 1597+2584=4181, 2584+4181=6765, etc...

// function fun_fibonacci($max,$ant=1,$sum=0)
// {	echo $sum?", $ant+$sum=".($ant+$sum):($max>=1?'1':'').($max>=2?', 1':'').($max>=3?', 2':'').($max>=4?', 1+2=3':'');
// 	if($max<=4 && !$sum)return;
// 	echo $max>0?fun_fibonacci($max-($sum?1:5),$sum?$sum:2,$ant+($sum?$sum:2)):', etc...';
// }
 
// //Mandar llamar...
// fun_fibonacci(8);
 $num = 8;
 imprime($num);

//se recibe el numero y se realiza un for para hacer el recorrido y se hace un llamado ala funcion
//fibo con un parametro y luego se imprime un lo que retorna fibo()
function imprime ($n)
{
 for($i=0;$i<=$n;$i++)
 {
  $r = fibo($i);
  echo"fibonacci de $i = $r ";
  echo "<br/>";
 }
}

//se realizan las condiciones del valor de fibonacci para cuando equivale "0" y "1" y luego
//se realiza la operacion fibonacci para calcular cualquier numero y se retorna un resultado
function fibo ($fi)
{
 if(($fi == 0 ) || ($fi == 1 ))
  return $fi;
 else
  $res = fibo($fi - 1) + fibo($fi - 2);
  return $res;
}
?>