<?php

$tireqty = $_POST['tireqty'];
$oilqty = $_POST['oilqty'];
$sparkqty = $_POST['sparkqty'];
$address = $_POST['address'];
$find = $_POST['find'];

$DOCUMENT_ROOT = $_SERVER['DOCUMENT_ROOT'];

?>

<html>
<head>
    <meta charset="UTF-8">
    <title>鲍勃的汽修店</title>
</head>
<body>
<h1>Bob`s Auto Parts</h1>
<h2>Order Results</h2>
<?php
$date = date('H:i, jS F');

echo '<p>Order processed at ';
echo $date;
echo '</p>';
echo '<p>您的订单： </p>';

$totalqty = 0;
$totalqty = $tireqty + $oilqty + $sparkqty;
echo '总数为：'.$totalqty.'个'.'<br/>';

if($totalqty == 0)
{
    echo '<font color=red>';
    echo 'You did not order anything on the previous page!<br/>';
    echo '</font>';
    exit;
}
else
{
    if($tireqty)
        echo $tireqty.'个轮胎<br/>';
    if ($oilqty)
        echo $oilqty.'升汽油<br/>';
    if($sparkqty)
        echo $sparkqty.'个火花塞<br/>';
}

echo '<br/>';

$totalamount = 0.00;

define('TIREPRICE', 100);
define('OILPRICE', 10);
define('SPARKPRICE', 4);

$totalamount = $tireqty * TIREPRICE
                        + $oilqty * OILPRICE
                        + $sparkqty * SPARKPRICE;

echo '总价为： $'.number_format($totalamount,2,'.',' ').'<br/>';

//echo '<p>总价为：' . $totalamount . '</p>';
echo '<p>家庭住址为： ' . $address . '</p>';

$outputstring = $date . "\t" . $tireqty . "tires \t" . $oilqty . "oil\t"
                    .$sparkqty . "spark plugs\t\$" . $totalamount
                    ."\t" . $address . "\t" . $find . "\n";

$fp = fopen("$DOCUMENT_ROOT/www/php and mysql/orders.txt",'ab');
flock($fp,LOCK_EX);
fwrite($fp,$outputstring);
flock($fp,LOCK_UN);
fclose($fp);

if(!$fp)
{
    echo '<p><strong> Your order could could not be processed at this time'
        .'Please try again later.</strong></p></body></html>';
    exit;
}

//fwrite($fp, $outputstring, strlen($outputstring));
//fclose($fp);

echo '<p>Order written.</p>';
?>
</body>
</html>