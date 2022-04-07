<?php

include "../_config/connect.php";
include "../_functions/index.php";


extract($_POST, EXTR_OVERWRITE);
extract($_GET, EXTR_OVERWRITE);

if(isset($_GET["req"])){
$req = $_GET["req"];
}else{
$req = $_POST["req"];
}
if(isset($_GET["session"])){
$session = $_GET["session"];
}else{
$session = $_POST["session"];
}

//echo $req;
if($req == "savesession"){
$data = explode("-",$date);
$date = explode("/", $data[0]);
$date = date("Y-m-d", mktime("0","0","0", $date[1], $date[0], date("Y")));
$time = $data[1];


$SQL = mysqli_query($connect, "SELECT date FROM tb_session WHERE `date` = '$date' and `time` = '$time' and `session` = '$session'");
if(!mysqli_num_rows($SQL)){
$SQL = "REPLACE INTO tb_session(`date`, `time`, `session`) VALUES('$date', '$time', '$session')";
$SQL = mysqli_query($connect, $SQL);
}
}else if($req == "deletesession"){
$data = explode("-",$date);
$date = explode("/", $data[0]);
$date = date("Y-m-d", mktime("0","0","0", $date[1], $date[0], date("Y")));
$time = $data[1];


$SQL = mysqli_query($connect, "SELECT date FROM tb_session WHERE `date` = '$date' and `time` = '$time' and `session` = '$session'");
if(mysqli_num_rows($SQL)){
$SQL = "DELETE FROM tb_session WHERE `date` = '$date' AND `time` = '$time' AND `session` = '$session'";
//echo $SQL;
$SQL = mysqli_query($connect, $SQL);
}
	
}else if($req == "collect_hours"){
$hours = $hours;
echo sprintf("%02d", $hours);
}else if($req == "collect_total"){
//$total_hours = $_GET["hours"];
$SQL = mysqli_query($connect, "SELECT date, time FROM tb_session WHERE session = '$session'");
$SQL_N = mysqli_num_rows($SQL);
//echo "SELECT date, time FROM tb_session WHERE session = '$session'";die;
if($SQL_N > 0){
	while($SQL_Q = mysqli_fetch_assoc($SQL)){
	$date["date"][] = $SQL_Q['date'];
	$date["time"][] = $SQL_Q['time'];	
	}
	sort($date["date"]);
	$date_un = array_unique($date["date"]);
	$date_to = array_count_values($date["date"]);
/*echo "<pre>";
print_r($date_to);
echo "</pre>";*/


foreach($date_to as $k => $v){
if($v == 1){
	$x[] = 7;
}elseif($v == 2){
	$x[] = $v*6;
}else{
	$x[] = $v*5;
}
/*echo "<pre>";
print_r($x);
echo "</pre>";*/
$valor_total = 0;
foreach($x as $k => $v){
$valor_total += intval($v);
}
}

echo $valor_total;
}

}else if($req == "showInfoDiv"){
//auto_encode();

	
$data = explode("-",$date);
$date = explode("/", $data[0]);
$date = date("Y-m-d", mktime("0","0","0", $date[1], $date[0], date("Y")));
$time = $data[1].":00";


$SQL1 = mysqli_query($connect, "SELECT b.* FROM tb_schedule a LEFT JOIN tb_user b ON a.id_user = b.id WHERE a.date = '$date' and a.time = '$time'") or die(mysqli_error($connect));
//echo "SELECT b.* FROM tb_schedule a LEFT JOIN tb_user b ON a.id_user = b.id WHERE a.date = '$date' and a.time = '$time'";
if(mysqli_num_rows($SQL1)){
while($SQL_Q = mysqli_fetch_assoc($SQL1)){
$cName = $SQL_Q['cName'];
$cEmail = $SQL_Q['cEmail'];
$cTel = $SQL_Q['cTel'];
}

?>
	<ul class="show_ul_content">
    	<li class="one">Name1:</li>
        <li class="two"><?php echo $cName?></li>
        <li class="one">E-mail:</li>
        <li class="two"><a href="mailto:<?php echo $cEmail?>;"><?php echo $cEmail?></a></li>
        <li class="one">Telephone:</li>
        <li class="two"><?php echo $cTel?></li>
    </ul>
    <div class="both"><br clear="all" /></div>
<?php
}
}else if($req == "addToCart"){
//echo  "SELECT * FROM tb_shop_cart WHERE id_product = $id AND session = '$session' AND size = '$size'";
$size = "";
$amount_before = "";
extract($_GET, EXTR_OVERWRITE);
extract($_POST, EXTR_OVERWRITE);
print_r($_POST);
if(!isset($amount)) $amount = 1;


if(!isset($size)) $size = "";

$SQL = mysqli_query($connect, "SELECT * FROM tb_shop_cart WHERE id_product = $id AND session = '$session' AND size = '$size'") or die(mysqli_error($connect));

if(mysqli_num_rows($SQL)){

$SQL_Q = mysqli_fetch_assoc($SQL);

//if(!isset($amount)) $amount  = 1;
//elseif($amount > 0) $amount++;
if($amount != $amount_before and $add != "yes"){

//if($add == "yes" and $amount > 0) $amount++;
$SQL = "UPDATE tb_shop_cart SET `amount` = $amount WHERE id_product = $id AND session = '$session'";
$SQL = mysqli_query($connect, $SQL) or die(mysqli_error($connect)) or die(mysqli_error($connect));	
}else{
mysqli_query($connect, "UPDATE `tb_shop_cart` SET `amount` = `amount`+1 WHERE `id_product` = $id AND `session` = '$session'");
}
	
}else{
$SQL = "INSERT INTO tb_shop_cart(`id_product`, `amount`, `type`, `size`, `session`) VALUES($id, $amount, '$type', '$size', '$session')";
//echo $SQL;
$SQL = mysqli_query($connect, $SQL) or die(mysqli_error($connect));	
}

$SQL = mysqli_query($connect, "SELECT a.*, b.price FROM tb_shop_cart a LEFT JOIN tb_shop_products b ON a.id_product = b.id WHERE a.session = '$session'");
$SQL_N = mysqli_num_rows($SQL);
$total_amount = 0;
$total_price = 0;
if($SQL_N > 0){
while($SQL_Q = mysqli_fetch_assoc($SQL)){
$total_amount += $SQL_Q["amount"];
$total_price += $SQL_Q["price"]*$SQL_Q["amount"];
}
}
?>
    <table align="right" class="table_shopping_bar_cart" border="0">
            	<tr>
                	<td width="110px" align="center">SHOPPING CART:</td>
                	<td width="80px" align="center"><?php echo sprintf("%02d", $total_amount); ?> ITEMS</td>
                    <td width="120px" align="center">(<?php echo sprintf("%02d", $total_price); ?>,00 EUR)</td>
                   	<td width="25px" align="left"><img src="<?php echo PATH ?>images/shopping_cart.png" /></td>
                </tr>
            </table>
    <?php
}else if($req == "removeItem"){
extract($_GET, EXTR_OVERWRITE);
mysqli_query($connect, "DELETE FROM `tb_shop_cart` WHERE id_product = $id AND session = '$session'")

?>
<?php /*?>    <table align="right" class="table_shopping_bar_cart" border="0">
            	<tr>
                	<td width="110px" align="center">SHOPPING CART:</td>
                	<td width="80px" align="center"><?php echo sprintf("%02d", $total_amount); ?> ITEMS</td>
                    <td width="120px" align="center">(<?php echo sprintf("%02d", $total_price); ?>,00 EUR)</td>
                   	<td width="25px" align="left"><img src="<?php echo PATH ?>images/shopping_cart.png" /></td>
                </tr>
            </table><?php */?>
    <?php
}elseif($req == "saveFormShop"){
	extract($_POST, EXTR_OVERWRITE);


$SQL = mysqli_query($connect, "SELECT id FROM tb_customers WHERE session = '$session'");

if(mysqli_num_rows($SQL)){
	mysqli_query($connect, "UPDATE tb_customers SET $name = '$value' WHERE session = '$session'");
}else{
	$SQL = mysqli_query($connect, "INSERT INTO tb_customers(`$name`, `session`, `dtcad`) VALUES('$value', '$session', NOW())");	
	
}
$SQL = mysqli_query($connect, "SELECT id FROM tb_customers WHERE session = '$session'");
if(mysqli_num_rows($SQL)){
$SQL_Q = mysqli_fetch_assoc($SQL);
$last_id = $SQL_Q['id'];
	mysqli_query($connect, "UPDATE tb_shop_cart SET id_user = $last_id WHERE session = '$session'");
	echo $last_id;
}
}elseif($req == "delete-order"){
extract($_POST, EXTR_OVERWRITE);
mysqli_query($connect, "DELETE FROM tb_order WHERE id = $id LIMIT 1");	
}elseif($req == "shipped-order"){
extract($_POST, EXTR_OVERWRITE);
mysqli_query($connect, "UPDATE tb_order SET `delivered` = 'Y' WHERE id = $id LIMIT 1");	
}

?>