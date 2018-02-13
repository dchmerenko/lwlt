<?php

$arr = range(1, 9);

array_walk($arr, 'my_mult', 2);

echo "<pre>";
print_r($arr);
echo "</pre>";

function my_mult(&$value, $key, $factor)
{
  $value *= $factor;
}
?>
