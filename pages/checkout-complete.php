<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'mail/vendor/autoload.php';
require_once('_functions/stripe/vendor/autoload.php');

function get_content($URL, $post){
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
      curl_setopt($ch, CURLOPT_URL, $URL);
	  curl_setopt($ch, CURLOPT_POSTFIELDS, "post=".$post);
      $data = curl_exec($ch);
      curl_close($ch);
      return $data;
}
if($_GET["b"] == ""){
$id_trans = $_SESSION["id_trans"];
}elseif($_GET["b"] == "success" or $_GET["b"] == "canceled"){
$id_trans = $_GET["c"];	
}else{
$id_trans = $_GET["b"];
}

$SQL = "SELECT * FROM tb_order WHERE `orderNumber` = '$id_trans'";
$SQL = mysqli_query($connect, $SQL);

$SQL_Q = mysqli_fetch_assoc($SQL);
extract($SQL_Q, EXTR_OVERWRITE);
$full_name = $cFirstName." ".$cLastName;
$first_name = $cFirstName;
$last_name = $cLastName;
$email = $cEmail;
$telephone = $cTel;
$address = $cAddress1;
$address_2 = $cAddress2;
$postcode = $cZipcode;
$city = $cCity;
$province = $cState;
$country = $cCountry;
$payment_method =$method;

$total = $_SESSION["TOTAL"];
$discount = ($total*$_SESSION["discount"])/100;
$total = $total-$discount;
$_SESSION["TOTAL"] = $total;
?>
<main class="main-content">
				<div class="fullwidth-block download">
					<div class="container">
						<div class="row">
                        <div class="col-md-12">
								<?php
								if($_GET["b"] == "success" and  $payment_method == "card"){
								?>
                                <?php
								if($_SESSION["id_trans"] != ""){
								unset($_SESSION["id_trans"]);
								}
								?>
                                <div class="col-md-12 dark2">
                                 <h4 class="page-title text-success text-center py-3">Order completed successfully.</h4>
                               
                                <?php
								$SQL_TEMPLATE = mysqli_query($connect, "SELECT * FROM `tb_template_email` WHERE `name` = 'cardPaid' LIMIT 1");								
								if(mysqli_num_rows($SQL_TEMPLATE)>0){
								$SQL_TEMPLATE_Q = mysqli_fetch_assoc($SQL_TEMPLATE);
								$t_subject = $SQL_TEMPLATE_Q["title"];
								$t_message = $SQL_TEMPLATE_Q["text"];
								$subject = utf8_encode($t_subject);
								$message = utf8_encode($t_message);
								$message = preg_replace("/\[FULL NAME\]/", $first_name." ".$last_name, $message);
								$message = preg_replace("/\[ID\]/", $id_trans, $message);
								$message = preg_replace("/\[TOTAL\]/", $_SESSION["TOTAL"]." €", $message);
								echo '<div class="text-justify text-white">'.$message.'</div>';
								}
								mysqli_query($connect, "UPDATE `tb_order` SET `status` = 'paid' WHERE `orderNumber` = '$id_trans'");	
								mysqli_query($connect, "DELETE FROM `tb_shop_cart` WHERE `session` = '$idSession'");
								?>
                                </div>
                                <div class="col-md-12 col-xs-12 dark2 py-3">
                                <a href="<?php echo PATH ?>"><input type="button" class="btn btn-primary btn-block" value="Go to homepage!" /></a>
                                </div>
                                <?php
								}
								
								?>
                                
                                <?php
								if($payment_method == "paypal"){
								?>
                                <?php
								if($_SESSION["id_trans"] != ""){
								unset($_SESSION["id_trans"]);
								}
								?>
                                <div class="col-md-12 dark2">
                                 <h4 class="page-title text-success text-center py-3">Order completed successfully.</h4>
                               
                                <?php
								$SQL_TEMPLATE = mysqli_query($connect, "SELECT * FROM `tb_template_email` WHERE `name` = 'paypalPaid' LIMIT 1");								
								if(mysqli_num_rows($SQL_TEMPLATE)>0){
								$SQL_TEMPLATE_Q = mysqli_fetch_assoc($SQL_TEMPLATE);
								$t_subject = $SQL_TEMPLATE_Q["title"];
								$t_message = $SQL_TEMPLATE_Q["text"];
								$subject = utf8_encode($t_subject);
								$message = utf8_encode($t_message);
								$message = preg_replace("/\[FULL NAME\]/", $first_name." ".$last_name, $message);
								$message = preg_replace("/\[ID\]/", $id_trans, $message);
								$message = preg_replace("/\[TOTAL\]/", $_SESSION["TOTAL"]." €", $message);
								echo '<div class="text-justify text-white">'.$message.'</div>';
								}
								?>
                                </div>
                                <div class="col-md-12 col-xs-12 dark2 py-3">
                                <a href="<?php echo PATH ?>"><input type="button" class="btn btn-primary btn-block" value="Go to homepage!" /></a>
                                </div>
                                <?php
								}
								
								?>
                                
                                 <?php
								if($payment_method == "bank"){
								
								$SQL_TEMPLATE = mysqli_query($connect, "SELECT * FROM `tb_template_email` WHERE `name` = 'bankPending' LIMIT 1");								
								if(mysqli_num_rows($SQL_TEMPLATE)>0){
								$SQL_TEMPLATE_Q = mysqli_fetch_assoc($SQL_TEMPLATE);
								$t_subject = $SQL_TEMPLATE_Q["title"];
								$t_message = $SQL_TEMPLATE_Q["text"];
								$subject = utf8_encode($t_subject);
								$message = utf8_encode($t_message);
								$subject = preg_replace("/\[ID\]/", $id_trans, $subject);
								$message = preg_replace("/\[FULL NAME\]/", $first_name." ".$last_name, $message);
								$message = preg_replace("/\[ID\]/", $id_trans, $message);
								$message = preg_replace("/\[TOTAL\]/", $_SESSION["TOTAL"]." EUR", $message);
								
								}
								mysqli_query($connect, "UPDATE `tb_order` SET `status` = 'pending' WHERE `orderNumber` = '$id_trans'");	
								mysqli_query($connect, "DELETE FROM `tb_shop_cart` WHERE `session` = '$idSession'");
								
								
								?>
                                <?php
								if($_SESSION["id_trans"] != ""){	
								$myObj["name"] = $first_name." ".$last_name;
								$myObj["email"] = $email;
								$myObj["id_trans"] = $id_trans;
								$myObj["id"] = $id_trans;
								$myObj["amount_euro"] = $amount_euro;
								$myObj["message"] = $message;
								$myObj["subject"] = $subject;
								$myObj["payment_status"] = $payment_status;
								$myObj["product"] = $product;
								
								$myJSON = json_encode($myObj, 0);
								
								
								$mail = new PHPMailer(TRUE);
								try{
								//$mail->AddReplyTo('levelspacesmusic@gmail.com', 'Henry Terron - Level Spaces');
								$mail->setFrom('henry@levelspaces.com', 'Level Spaces');
								$mail->addAddress($email, $first_name." ".$last_name);
								$mail->Subject = $subject;
								$mail->isHTML(TRUE);
								$mail->msgHTML(get_content(PATH.'mail/template/index.php', $myJSON),  __DIR__);
								$mail->send();
								}
								catch (Exception $e)
								{
								echo $e->errorMessage();die;
								}
								catch (\Exception $e)
								{
								echo $e->getMessage();die;
								}
								
								$mail = new PHPMailer(TRUE);
								try{
								$mail->setFrom("henry@levelspaces.com", "Level Spaces", 0);
								$mail->addAddress("levelspacesmusik@gmail.com", "Henry Terron");
								$mail->Subject = "New order on website: #$id_trans from $first_name $last_name";
								$mail->isHTML(TRUE);
								$mail->msgHTML("ID: #$id_trans | Name: ".$first_name." ".$last_name." | E-mail: ".$email." | Telephone: ".$prefix." ".$telephone,  __DIR__);
								//$mail->send();
								}
									catch (Exception $e)
								{
								echo $e->errorMessage();die;
								}
								catch (\Exception $e)
								{
								echo $e->getMessage();die;
								}
								
								unset($_SESSION["id_trans"]);
								}
								?>
                                 <div class="col-md-12 dark2">
                                 <h4 class="page-title text-success text-center py-3">Order completed successfully.</h4>
                               <div class="text-justify text-white"><?php echo $message ?></div>
                                </div>
                                <div class="col-md-12 col-xs-12 dark2 py-3">
                                <a href="<?php echo PATH ?>"><input type="button" class="btn btn-primary btn-block" value="Go to homepage!" /></a>
                                </div>
                                <?php
								}
								?>
                                <?php
								if($payment_method == "invoice"){
									
									$SQL_TEMPLATE = mysqli_query($connect, "SELECT * FROM `tb_template_email` WHERE `name` = 'invoicePending' LIMIT 1");								
								if(mysqli_num_rows($SQL_TEMPLATE)>0){
								$SQL_TEMPLATE_Q = mysqli_fetch_assoc($SQL_TEMPLATE);
								$t_subject = $SQL_TEMPLATE_Q["title"];
								$t_message = $SQL_TEMPLATE_Q["text"];
								$subject = utf8_encode($t_subject);
								$message = utf8_encode($t_message);
								$subject = preg_replace("/\[ID\]/", $id_trans, $subject);
								$message = preg_replace("/\[FULL NAME\]/", $first_name." ".$last_name, $message);
								$message = preg_replace("/\[ID\]/", $id_trans, $message);
								$message = preg_replace("/\[TOTAL\]/", $_SESSION["TOTAL"]." EUR", $message);
								
								}
								
								
									
								?>
                                <?php
								if($_SESSION["id_trans"] != ""){	
								$myObj["name"] = $first_name." ".$last_name;
								$myObj["email"] = $email;
								$myObj["id_trans"] = $id_trans;
								$myObj["payment_status"] = $payment_status;
								$myObj["product"] = $product;
								$myObj["id"] = $id_trans;
								$myObj["amount_euro"] = $amount_euro;
								$myObj["message"] = $message;
								$myObj["subject"] = $subject;
								
								$myJSON = json_encode($myObj, 0);

								$mail = new PHPMailer(TRUE);
								try{
								//$mail->AddReplyTo('levelspacesmusic@gmail.com', 'Henry Terron - Level Spaces');
								$mail->setFrom('henry@levelspaces.com', 'Level Spaces');
								$mail->addAddress($email, $first_name." ".$last_name);
								$mail->Subject = $subject;
								$mail->isHTML(TRUE);
								$mail->msgHTML(get_content(PATH.'mail/template/index.php', $myJSON),  __DIR__);
								$mail->send();
								}
								catch (Exception $e)
								{
								echo $e->errorMessage();die;
								}
								catch (\Exception $e)
								{
								echo $e->getMessage();die;
								}
								
								$mail = new PHPMailer(TRUE);
								try{
								$mail->setFrom("henry@levelspaces.com", "Level Spaces", 0);
								$mail->addAddress("levelspacesmusik@gmail.com", "Henry Terron");
								$mail->Subject = "New order on website: #$id_trans from $first_name $last_name";
								$mail->isHTML(TRUE);
								$mail->msgHTML("ID: #$id_trans | Name: ".$first_name." ".$last_name." | E-mail: ".$email." | Telephone: ".$prefix." ".$telephone,  __DIR__);
								$mail->send();
								}
									catch (Exception $e)
								{
								echo $e->errorMessage();die;
								}
								catch (\Exception $e)
								{
								echo $e->getMessage();die;
								}
								$LIVE = true;
								if($LIVE == true){
								\Stripe\Stripe::setApiKey('#PK');
								}else{
								\Stripe\Stripe::setApiKey('#PK');
								}
								$last_customer = NULL;
								while (true) {
									$customers = \Stripe\Customer::all(array("limit" => 100, "starting_after" => $last_customer));
									foreach ($customers->autoPagingIterator() as $customer) {
										if ($customer->email == $email) {
											$customerIamLookingFor = $customer;
											$cus_id = $customerIamLookingFor["id"];
											break 2;
										}
									}
									if (!$customers->has_more) {
										break;
									}
									$last_customer = end($customers->data);
								}
								
								if($customerIamLookingFor == ""){
								$customer = \Stripe\Customer::create([
										'description' => 'Customer website',
										'email' => $email,
										'name' => $full_name,
										'address' => [
											'line1' => $address,
											'line2' => $address_2,
											'postal_code' => $postcode,
											'city' => $city,
											'state' => $province,
											'country' => $country
										],
										'phone' => $telephone,
									]);	
									$cus_id = $customer["id"];	
								}
$time = time()+600;
// create invoice items

   $SQL2 = mysqli_query($connect, "SELECT a.*, b.*,b.price FROM tb_shop_cart a LEFT JOIN tb_shop_products b ON a.id_product = b.id WHERE a.checkout = 'N' AND a.session = '$session'");
	$SQL2_N = mysqli_num_rows($SQL2);
	$n = 1;
	if($SQL2_N > 0){
	while($SQL2_Q = mysqli_fetch_assoc($SQL2)){
	extract($SQL2_Q, EXTR_OVERWRITE);
	$price = number_format((float)$price, 2, '', '');
	if(isset($_SESSION["discount"])){
	$discount = ($price*$_SESSION["discount"])/100;
	$price = $price-$discount;
	}

\Stripe\InvoiceItem::create(array(
    "customer" => $cus_id,
    "quantity" => $amount,
	"unit_amount" => $price,
    "currency" => "eur",
    "description" => $title)
);


	$n++;
	}
	}

$invoice = \Stripe\Invoice::create(array(
    "customer" => $cus_id,
	'collection_method' => 'send_invoice',
	'days_until_due' => 30,
	'metadata' => [
	'order_id' => $id_trans
	]
));
$invoice->sendInvoice();	
								
								mysqli_query($connect, "UPDATE `tb_order` SET `status` = 'pending' WHERE `orderNumber` = '$id_trans'");	
								mysqli_query($connect, "DELETE FROM `tb_shop_cart` WHERE `session` = '$idSession'");
								
								//unset($_SESSION["id_trans"]);
								}
								?>
                                 <div class="col-md-12 dark2">
                                 <h4 class="page-title text-success text-center py-3">Order completed successfully.</h4>
                               <div class="text-justify text-white"><?php echo $message ?></div>
                                </div>
                                <div class="col-md-12 col-xs-12 dark2 py-3">
                                <a href="<?php echo PATH ?>"><input type="button" class="btn btn-primary btn-block" value="Go to homepage!" /></a>
                                </div>
                                <?php
								}
								?>
                                 
                               
                                
                                 
                                
                                    
                                    
                                    
                                    
                                   
                                   
                               
							
							
							
						</div>
					</div>
				</div> <!-- .testimonial-section -->

				
			</main> <!-- .main-content -->
          