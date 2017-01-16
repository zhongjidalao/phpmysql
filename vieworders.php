<?php
$DOCUMENT_ROOT = $_SERVER['DOCUMENT_ROOT'];
?>

<html>
<head>
    <meta charset="UTF-8">
    <title>鲍勃的汽修店</title>
</head>
<body>
<h1>Bob`s Auto Parts</h1>
<h2>Customer Orders</h2>
<?php

$orders = file("$DOCUMENT_ROOT/www/php and mysql/orders.txt");
$number_of_orders = count($orders);
if($number_of_orders == 0)
{
    echo '<p><strong>No orders pending.
            Please try again later.</strong></p>';
}
echo "<table border='1'>\n";
echo '<tr><th bgcolor="#CCCCFF">订单数据</th>
          <th bgcolor="#CCCCFF">轮胎</th>
          <th bgcolor="#CCCCFF">汽油</th>
          <th bgcolor="#CCCCFF">火花塞</th>
          <th bgcolor="#CCCCFF">总价</th>
          <th bgcolor="#CCCCFF">家庭住址</th>
        </tr>';
for($i=0; $i<$number_of_orders; $i++)
{
    $line = explode("\t",$orders[$i]);
    $line[1] = intval($line[1]);
    $line[2] = intval($line[2]);
    $line[3] = intval($line[3]);
    echo "<tr><td>$line[0]</td>
                <td align='right'>$line[1]</td>
                <td align='right'>$line[2]</td>
                <td align='right'>$line[3]</td>
                <td align='right'>$line[4]</td>
                <td>$line[5]</td>
            </tr>";
}
echo '</table>';
?>
</body>
</html>
