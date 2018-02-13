<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="utf-8">
  <title>Stock Quote From NASDAQ</title>
</head>
<body>

<?php
//choose stock to look at
$symbol = 'TSLA';
$apikey = 'G15RRA18NZU4L2OT';

echo '<h1>Stock Quote for '.$symbol.'</h1>';

$url = 'http://www.alphavantage.co/query?function=BATCH_STOCK_QUOTES&symbols='.$symbol.'&apikey='.$apikey.'&datatype=csv'; 

if (!($contents = file($url))) {
  die('Failed to open '.$url);
}

//extract relevant data
list($symbol, $price, $volume, $timestamp) = explode(',', $contents[1]);
list($date, $time) = explode(' ', $timestamp);

echo '<p>'.$symbol.' was last sold at: $'.$price.'</p>';
echo '<p>Quote current as of '.$date.' at '.$time.'</p>';

//acknowledge source
echo '<p>This information retrieved from <br><a href="'.$url.'">'.$url.'</a></p>';

?>
</body>
</html>
