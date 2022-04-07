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
}else{
$id_trans = $_GET["b"];
}
$SQL = "SELECT * FROM tb_kit WHERE `id_trans` = '$id_trans'";
$SQL = mysqli_query($connect, $SQL);

$SQL_Q = mysqli_fetch_assoc($SQL);
extract($SQL_Q, EXTR_OVERWRITE);
$full_name = $first_name." ".$last_name;

if($product == "1"){
$stripe_product = "sku_GiU1ZnuvRzabmE";
$amount_total = "35.00";
$amount_euro = "35 EUR";	
$amount = 3500;
}else if($product == "2"){
$stripe_product = "sku_H78WwcAHVISb3Q";	
$amount_total = "15.00";
$amount_euro = "15 EUR";
$desc = "CD / Universo Paralelo (2020) | ID: $id_trans";
$amount = 1500;
}else if($product == "3"){
$stripe_product = "sku_H78Yyu2YVRMv4A";	
$amount_total = "10.00";
$amount_euro = "10 EUR";
$desc = "Download / Universo Paralelo (2020) | ID: $id_trans";
$amount = 1000;
}else if($product == "4"){
$stripe_product = "sku_H78XUqYrO4glUb";	
$amount_total = "20.00";
$amount_euro = "20 EUR";
$desc = "CD + Download / Universo Paralelo (2020) | ID: $id_trans";
$amount = 2000;
}else if($product == "5"){
$stripe_product = "sku_GkISbJR4eqpEao";	
$amount_total = "20.00";
$amount_euro = "20 EUR";
$amount = 2000;
}else if($product == "6"){
$stripe_product = "sku_H78VFxTpCSUN5x";	
$amount_total = "30.00";
$amount_euro = "30 EUR";
$desc = "3x1 Collection (CD 2018 / 2019 / 2020) | ID: $id_trans";
$amount = 3000;
}

?>
<main class="main-content">
				<div class="fullwidth-block download">
					<div class="container">
						<div class="row">
                        <div class="col-md-12">
								<?php
								if($payment_method == "card"){
								?>
                                <?php
								if($_SESSION["id_trans"] != ""){	
								$myObj["name"] = $first_name." ".$last_name;
								$myObj["email"] = $email;
								$myObj["id_trans"] = $id_trans;
								$myObj["id"] = $id_trans;
								$myObj["amount_euro"] = $amount_euro;
								$myObj["message"] = "email_card2.php";
								$myObj["payment_status"] = $payment_status;
								$myObj["product"] = $product;
								
								$myJSON = json_encode($myObj, 0);
								
								$mail = new PHPMailer(TRUE);
								try{
								$mail->AddReplyTo('levelspacesmusic@gmail.com', 'Henry Terron - Level Spaces');
								$mail->setFrom('henry@levelspaces.com', 'Level Spaces');
								$mail->addAddress($email, $first_name." ".$last_name);
								$mail->Subject = "Level Spaces // order number: $id_trans";
								$mail->isHTML(TRUE);
								$mail->msgHTML(get_content(PATH.'mail/email_template.php', $myJSON),  __DIR__);
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
								$mail->addAddress("levelspacesmusic@gmail.com", "Henry Terron");
								$mail->Subject = "Pre-order: $id_trans from $first_name $last_name";
								$mail->isHTML(TRUE);
								$mail->msgHTML("Name: ".$first_name." ".$last_name." | E-mail: ".$email." | Telephone: ".$prefix." ".$telephone,  __DIR__);
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
								
								unset($_SESSION["id_trans"]);
								}
								?>
                                <div class="col-md-12">
                                 <h4 class="page-title text-success">Order completed successfully.</h4>
                               
                               
                                 <p class="text-justify text-success"></p>
                                <p class="text-justify text-white">Dear <strong><?php echo $first_name." ".$last_name; ?></strong>,<br /><br />
                                  We'd like to thank you for pre-ordering our product.<br />
                                   <?php
if($product == "1"){
?>                                
As in the description, the kit includes one copy of our  latest album, as well as the digital version, one T-shirt, one autographed  photo from the band, one button, and five stickers, all done with much love.<br /><br />
<?php } ?>
                                 
                                  The ID of your order is: <strong><?php echo $id_trans; ?></strong>.<br /><br />
                                 
                                 <?php
								if($payment_status == "CONFIRMED" and $product != "2"){
								?>
                                <p class="text-justify">You can already download the digital version of  our new album, so you can already listen to it before the physical copy comes. <br /><br /><br /><a href="http://levelspaces.com/download/<?php echo $id_trans?>">>> DOWNLOAD NEW ALBUM <<</a></p><br /><br /><br />
                                <?php }else{ ?>
                                 As soon as the payment is confirmed, you will receive an  e-mail with more details, as well as a link to download the digital version of  our new album, so you can already listen to it before the physical copy comes.</p>
								<?php
								}
								?>
                                </p>
                                </div>
                                <div class="col-md-12 col-xs-12">
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
                                <div class="col-md-12">
                                 <h4 class="page-title text-success">Order completed successfully.</h4>
                               
                               
                                 <p class="text-justify text-success"></p>
                                <p class="text-justify text-white">Dear <strong><?php echo $first_name." ".$last_name; ?></strong>,<br /><br />
                                  We'd like to thank you for pre-ordering our product.<br />
                                   <?php
if($product == "1"){
?>                                
As in the description, the kit includes one copy of our  latest album, as well as the digital version, one T-shirt, one autographed  photo from the band, one button, and five stickers, all done with much love.<br /><br />
<?php } ?>
                                 
                                  The ID of your order is: <strong><?php echo $id_trans; ?></strong>.<br /><br />
                                 <?php
								 if($product != "2" and $product != "5"){
								if($payment_status == "CONFIRMED"){
								?>
                                <p class="text-justify text-white">You can already download the digital version of  our new album, so you can already listen to it before the physical copy comes. <br /><br /><br /><a href="https://levelspaces.com/download/mp3/universo_paralelo" target="_blank">>> DOWNLOAD NEW ALBUM <<</a></p><br /><br /><br />
                                <?php }else{ ?>
                                 As well as a link to download the digital version of  our new album, so you can already listen to it before the physical copy comes.</p>
								<?php
								}
								 }
								?>
                                </p>
                                </div>
                                <div class="col-md-12 col-xs-12">
                                <a href="<?php echo PATH ?>"><input type="button" class="btn btn-primary btn-block" value="Go to homepage!" /></a>
                                </div>
                                <?php
								}
								
								?>
                                
                                 <?php
								if($payment_method == "bank"){
								?>
                                <?php
								if($_SESSION["id_trans"] != ""){	
								$myObj["name"] = $first_name." ".$last_name;
								$myObj["email"] = $email;
								$myObj["id_trans"] = $id_trans;
								$myObj["id"] = $id_trans;
								$myObj["amount_euro"] = $amount_euro;
								$myObj["message"] = "email_bank2.php";
								$myObj["payment_status"] = $payment_status;
								$myObj["product"] = $product;
								
								$myJSON = json_encode($myObj, 0);
								
								$mail = new PHPMailer(TRUE);
								try{
								//$mail->AddReplyTo('levelspacesmusic@gmail.com', 'Henry Terron - Level Spaces');
								$mail->setFrom('henry@levelspaces.com', 'Level Spaces');
								$mail->addAddress($email, $first_name." ".$last_name);
								$mail->Subject = "Number order #$id_trans // Payment pending";
								$mail->isHTML(TRUE);
								$mail->msgHTML(get_content(PATH.'mail/email_template.php', $myJSON),  __DIR__);
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
								$mail->addAddress("levelspacesmusic@gmail.com", "Henry Terron");
								$mail->Subject = "Pre-order: $id_trans from $first_name $last_name";
								$mail->isHTML(TRUE);
								$mail->msgHTML("Name: ".$first_name." ".$last_name." | E-mail: ".$email." | Telephone: ".$prefix." ".$telephone,  __DIR__);
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
								
								unset($_SESSION["id_trans"]);
								}
								?>
                                <div class="col-md-12">
                                <h4 class="page-title text-success">Order completed successfully.</h4>
                               <p class="text-justify text-success"></p>
                          <p class="text-justify text-white">Dear <strong><?php echo $first_name." ".$last_name; ?></strong>,<br /><br />
                                  We'd like to thank you for pre-ordering our product.<br />
                                  <?php
if($product == "1"){
?>                                
As in the description, the kit includes one copy of our  latest album, as well as the digital version, one T-shirt, one autographed  photo from the band, one button, and five stickers, all done with much love.<br /><br />
<?php } ?>
                                  To complete the purchase, we ask you for the deposit of <?php echo $amount_euro; ?>  into the following account:<br /><br />
  <strong>Reginaldo Terron</strong><br />
                                  IBAN: <strong>DE35 1001 1001 2626 8381 42</strong><br />
                                  BIC: <strong>NTSBDEB1XXX</strong><br />
                                  Description: <strong><?php echo $id_trans; ?></strong><br /><br />

                                  And please include this reference number with the transfer:  <strong><?php echo $id_trans; ?></strong><br />
                                  As soon as the deposit is received, you will receive a  confirmation e-mail with more details.<br />
                                </div>
                                <div class="col-md-12 col-xs-12">
                                <a href="<?php echo PATH ?>"><input type="button" class="btn btn-primary btn-block" value="Go to homepage!" /></a>
                                </div>
                                <?php
								}
								?>
                                <?php
								if($payment_method == "invoice"){
								
									
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
								$myObj["message"] = "../email_invoice.php";
								
								$myJSON = json_encode($myObj, 0);
								
								$myJSON = json_encode($myObj, 0);
								
								$mail = new PHPMailer(TRUE);
								try{
								//$mail->AddReplyTo('levelspacesmusic@gmail.com', 'Henry Terron - Level Spaces');
								$mail->setFrom('henry@levelspaces.com', 'Level Spaces');
								$mail->addAddress($email, $first_name." ".$last_name);
								$mail->Subject = "Number order #$id_trans // Payment pending";
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
								$mail->addAddress("levelspacesmusic@gmail.com", "Henry Terron");
								$mail->Subject = "Pre-order: $id_trans from $first_name $last_name";
								$mail->isHTML(TRUE);
								$mail->msgHTML("Name: ".$first_name." ".$last_name." | E-mail: ".$email." | Telephone: ".$prefix." ".$telephone,  __DIR__);
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
\Stripe\InvoiceItem::create(array(
    "customer" => $cus_id,
    "amount" => $amount,
    "currency" => "eur",
    "description" => $desc)
);

$invoice = \Stripe\Invoice::create(array(
    "customer" => $cus_id,
	'collection_method' => 'send_invoice',
	'days_until_due' => 30,
	'metadata' => [
	'order_id' => $id_trans
	]
));
$invoice->sendInvoice();	
								
								
								unset($_SESSION["id_trans"]);
								}
								?>
                                <div class="col-md-12">
                                <h4 class="page-title text-success">Order completed successfully.</h4>
                               <p class="text-justify text-success"></p>
                                <p class="text-justify text-white">Dear <strong><?php echo $first_name." ".$last_name; ?></strong>,<br /><br />
                                  We'd like to thank you for pre-ordering our product.<br />
                                  <?php
if($product == "1"){
?>                                
As in the description, the kit includes one copy of our  latest album, as well as the digital version, one T-shirt, one autographed  photo from the band, one button, and five stickers, all done with much love.<br /><br />
<?php } ?>
                                  Your purchase is currently being processed, and within the next  hours you will receive an e-mail with an invoice, which can be paid by any  other way you find convenient.<br /><br />
                                  We'd just like to remind you that after the payment, it can  take up to 5 working days until it's confirmed.<br />
                                  The ID of your order is: <strong><?php echo $id_trans; ?></strong>.<br />
                                  As soon as the payment is received, you will receive a  confirmation e-mail with a link to download the digital version of our new  album, so you can already listen to it before the physical copy comes.</p>
                                </div>
                                <div class="col-md-12 col-xs-12">
                                <a href="<?php echo PATH ?>"><input type="button" class="btn btn-primary btn-block" value="Go to homepage!" /></a>
                                </div>
                                <?php
								}
								?>
                                 
                               
                                
                                 
                                
                                    
                                    
                                    
                                    
                                   
                                   
                               
							
							
							
						</div>
					</div>
				</div> <!-- .testimonial-section -->

				
			</main> <!-- .main-content -->
          