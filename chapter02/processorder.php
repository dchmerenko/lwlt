<?php
// create short variable names
$tireqty = (int) htmlspecialchars($_POST['tireqty']);
$oilqty = (int) htmlspecialchars($_POST['oilqty']);
$sparkqty = (int) htmlspecialchars($_POST['sparkqty']);
$address = htmlspecialchars(preg_replace('/\t|\R/', ' ', $_POST['address']));
$document_root = $_SERVER['DOCUMENT_ROOT'];
$date = date('H:i, jS F Y');
?>

<!DOCTYPE html>
<html>
<head>
  <title>Bob's Auto Parts - Order Results</title>
</head>
<body>
  <h1>Bob's Auto Parts</h1>
  <h2>Order Results</h2>
  <?php
    echo "<p>Order processed at ".date('H:i, jS F Y')."</p>";
    echo '<p>Your order is as follows: </p>';

    $totalqty = 0;
    $totalamount = 0.00;

    define('TIREPRICE', 100);
    define('OILPRICE', 10);
    define('SPARKPRICE', 4);
    
    $totalqty = $tireqty + $oilqty + $sparkqty;
    echo "<p>Items ordered: ".$totalqty."<br />";

    if (0 == $totalqty) {
      echo "You did not order anything on previous page!<br>";
    } else {
      if ($tireqty > 0) {
        echo $tireqty . ' tires<br>';
      }
      if ($oilqty > 0) {
        echo $oilqty . ' bottles of oil<br>';
      }
      if ($sparkqty > 0) {
        echo $sparkqty . ' spark plugs<br>';
      }
    }

    $totalamount = $tireqty * TIREPRICE
                 + $oilqty * OILPRICE
                 + $sparkqty * SPARKPRICE;
 
    echo "Subtotal: $".number_format($totalamount, 2)."<br />";
 
    $taxrate = 0.10; // local sales tax is 10%
    $totalamount = $totalamount * (1 + $taxrate);
    echo "Total including tax: $".number_format($totalamount, 2)."</p>";

    echo "<p>Address to ship to is ".$address."</p>";

    $outputstring = $date."\t".$tireqty." tires \t".$oilqty." oil\t"
                    .$sparkqty." spark plugs\t\$".$totalamount
                    ."\t".$address."\n";

    // open file for appending
    $fp = fopen("$document_root/../orders/orders.txt", "ab");

    if (!$fp) {
      echo "<p><strong> Your order could not be processed at this time.
            Please try again later.</strong></p>";
      exit;
    }

    flock($fp, LOCK_EX);
    fwrite($fp, $outputstring, strlen($outputstring));
    flock($fp, LOCK_UN);
    fclose($fp);

    echo "<p>Order written.</p>";
?>
</body>
</html>
