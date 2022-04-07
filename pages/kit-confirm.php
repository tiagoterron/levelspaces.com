<?php

require_once('_functions/stripe/vendor/autoload.php');


if($_GET["b"] != "test"){
$LIVE = true;
}else{
$LIVE = false;	
}
$id_trans = $_SESSION["id_trans"];
$SQL = "SELECT * FROM tb_kit WHERE `id_trans` = '$id_trans'";
$SQL = mysqli_query($connect, $SQL);

$SQL_Q = mysqli_fetch_assoc($SQL);
extract($SQL_Q, EXTR_OVERWRITE);

?>

<?php
if($product == "1"){
$stripe_product = "sku_GiU1ZnuvRzabmE";
$amount_total = "35.00";
$amount_euro = "35 EUR";	
$amount = 3500;
}else if($product == "2"){
$stripe_product = "sku_H78WwcAHVISb3Q";	
$amount_total = "15.00";
$amount_euro = "15 EUR";
$desc = "CD / Universo Paralelo (2020)";
$amount = 1500;
}else if($product == "3"){
$stripe_product = "sku_H78Yyu2YVRMv4A";	
$amount_total = "10.00";
$amount_euro = "10 EUR";
$desc = "Download / Universo Paralelo (2020)";
$amount = 1000;
}else if($product == "4"){
$stripe_product = "sku_H78XUqYrO4glUb";	
$amount_total = "20.00";
$amount_euro = "20 EUR";
$desc = "CD + Download / Universo Paralelo (2020)";
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
$desc = "3x1 Collection (CD 2018 / 2019 / 2020)";
$amount = 3000;
}
/*if($product == "1"){
$stripe_product = "sku_GiU1ZnuvRzabmE";
$amount_total = "00.01";	
}else if($product == "2"){
$stripe_product = "sku_GkGVJhPKiuXnll";	
$amount_total = "00.01";
}else if($product == "3"){
$stripe_product = "sku_GkGXNDwEHR722b";	
$amount_total = "00.01";
}else if($product == "4"){
$stripe_product = "sku_GkGYIfIthKqZMk";	
$amount_total = "00.01";
}*/


$full_name = $first_name." ".$last_name;
?>

<main class="main-content">
				<div class="fullwidth-block download">
					<div class="container">
					  <div class="row">
                        <div class="col-md-12">
								
                          <div class="col-md-12">
                            <h4 class="page-title text-success">Thank you for ordering our music</h4>
                                <?php
								if($payment_method == "invoice"){
								?>
                               
                                <p class="text-justify text-success"></p>
                                <p class="text-justify text-white">Dear <strong><?php echo $first_name." ".$last_name; ?></strong>,<br /><br />
                                  We'd like to thank you for pre-ordering our product.<br /><br />
                                 
<?php
if($product == "1"){
?>                                
As in the description, the kit includes one copy of our  latest album, as well as the digital version, one T-shirt, one autographed  photo from the band, one button, and five stickers, all done with much love.<br /><br />
<?php } ?>
                                  Your purchase is currently being processed, and within the next  hours you will receive an e-mail with an invoice, which can be paid by any  other way you find convenient.<br /><br />
                                  We'd just like to remind you that after the payment, it can  take up to 5 working days until it's confirmed.<br />
                                  The ID of your order is: <strong><?php echo $id_trans; ?></strong>.<br />
                                 As soon as the deposit is received, you will receive a confirmation e-mail with more details.<br /></p>
                         
                                <?php
								}
								?>
                                <?php
								if($payment_method == "bank"){
								?>
                                <p class="text-justify text-success"></p>
                          <p class="text-justify text-white">Dear <strong><?php echo $first_name." ".$last_name; ?></strong>,<br /><br />
                                  We'd like to thank you for pre-ordering our product.<br /><br />
                                  <?php
if($product == "1"){
?>                                
As in the description, the kit includes one copy of our  latest album, as well as the digital version, one T-shirt, one autographed  photo from the band, one button, and five stickers, all done with much love.<br /><br />
<?php } ?>
                                  To complete the purchase, we ask you for the deposit of <strong><?php echo $amount_euro; ?></strong>  into the following account:<br /><br />
  <strong>Reginaldo Terron</strong><br />
                                  IBAN: <strong>DE35 1001 1001 2626 8381 42</strong><br />
                                  BIC: <strong>NTSBDEB1XXX</strong><br />
                                  Description: <strong><?php echo $id_trans; ?></strong><br /><br />
                                  And please include this reference number with the transfer:  <strong><?php echo $id_trans; ?></strong><br />
                                  As soon as the deposit is received, you will receive a confirmation e-mail with more details.<br />
                        
                              <?php
								}
								?>
                              <?php
								if($payment_method == "card"){
								?>
                              <p class="text-justify text-success"></p>
                                <p class="text-justify text-white">Dear <strong><?php echo $first_name." ".$last_name; ?></strong>,<br /><br />
                                  We'd like to thank you for pre-ordering our product.<br /><br />
                                  <?php
if($product == "1"){
?>                                
As in the description, the kit includes one copy of our  latest album, as well as the digital version, one T-shirt, one autographed  photo from the band, one button, and five stickers, all done with much love.<br /><br />
<?php } ?>
                                 
                                  The ID of your order is: <strong><?php echo $id_trans; ?></strong>.<br /><br />
                                 As soon as the deposit is received, you will receive a confirmation e-mail with more details.<br /></p>
                        
                                <?php
								}
								?>
                                 <?php
								if($payment_method == "paypal"){
								?>
                                <p class="text-justify text-white">Dear <strong><?php echo $first_name." ".$last_name; ?></strong>,<br /><br />
                                  We'd like to thank you for pre-ordering our product.<br /><br />
                                  <?php
if($product == "1"){
?>                                
As in the description, the kit includes one copy of our  latest album, as well as the digital version, one T-shirt, one autographed  photo from the band, one button, and five stickers, all done with much love.<br /><br />
<?php } ?>
                                 
                                  The ID of your order is: <strong><?php echo $id_trans; ?></strong>.<br /><br />
                                 As soon as the deposit is received, you will receive a confirmation e-mail with more details.<br /><br /><br />
                                  
                                  To complete your order, click in on the green button to be redirected to Paypal.
                                  </p>
                               
                                <?php
								}
								?>
                                </div>
                                <div class="">&nbsp;</div>
                 
									 <?php /*?><div class="col-md-6 col-xs-12">
                                     <div class="input-group mb-6">
                                     <div class="card text-white bg-dark mb-3" style="text-align:center">
  <label for="id_card"><img src="<?php echo PATH ?>images/tshirt_<?php echo strtolower
  ($t_shirt_color); ?>.png" class="card-img-top img-fluid" style="width:200px;" alt="Bank"/></label>
  <div class="card-body">
    <p class="card-text"><?php echo $t_shirt_color; ?> (<?php echo $t_shirt_size; ?>)</p>
  </div>
</div>
                                     
  </div>
</div><?php */?>
                                 <div class="">&nbsp;</div>
                                 <div class="col-md-6 text-white">
                                <h5 class="page-title">Personal information</h5>
                                <div class="col-md-12"><label class="col-sm-6"><?php echo $first_name ?> <?php echo $last_name ?></label></div> 
                                <div class="col-md-12"><label class="col-sm-6"><?php echo $email ?></label></div>
                                <div class="col-md-12"><label class="col-sm-6"><?php echo "(+".$prefix.") ".$telephone ?></label></div><div class="">&nbsp;</div>
                                </div>
                                <div class="col-md-6 text-white">
                                    <h5 class="page-title">Shipping address</h5>
								   <div class="col-md-12"><label class="col-sm-12"><?php echo $address ?></label></div>
                                   <?php
								   if($address_2 != ""){
								   ?>
                                   <div class="col-md-12"><label class="col-sm-12"><?php echo $address_2 ?></label></div>
                                   <?php
								   }
								   ?>
                                   <div class="col-md-12"><label class="col-sm-12"><?php echo $postcode. " ".$city ?></label></div>
                                   <div class="col-md-12"><label class="col-sm-12"><?php echo $province." ".$country ?></label></div>
                                    <div class="">&nbsp;</div>
                                    </div>
                                    
                                    
                                    
                                    
                                   <div class="col-md-6 col-xs-12 mb-2">

                              <a href="<?php echo PATH ?>kit/edit/<?php echo $id_trans; ?>"><input type="button" class="btn btn-warning btn-block" value="EDIT" /></a>
                                   </div>
                                    <?php
								if($payment_method == "card"){
								?>
                                    <div class="col-md-6 col-xs-12">
                                    <?php
if($LIVE == true){
?>
                                    <button id="checkout-button-<?php echo $stripe_product; ?>" class="btn btn-success btn-block" role="link" >Continue with payment</button>
                                    <?php
}else{
?>
<button id="checkout-button-sku_GiTycc0qDgvtLc" class="btn btn-success btn-block" role="link" >Continue with payment</button>
<?php
}
?>
                                   </div>
                                   <?php }elseif($payment_method == "paypal"){
									   ?>
                                       <div class="col-md-6 col-xs-12">
									   <form action="https://www.paypal.com/cgi-bin/webscr" method="post">
    <input type="hidden" name="cmd" value="_cart">
    <input type="hidden" name="upload" value="1">
<?php /*?>    <input type="hidden" name="business" value="office@greenvalleyrockfestival.com">
<?php */?>    <input type="hidden" name="business" value="levelspacesmusik@gmail.com">
    <input type="hidden" name="item_name_1" value="<?php echo $desc ?>">
    <input type="hidden" name="item_number_1" value="1">
    <input type="hidden" name="quantity_1" value="1" />
    <input type="hidden" name="amount_1" value="<?php echo $amount_total?>">
    <input type="hidden" name="no_note" value="1">
    <input type="hidden" name="currency_code" value="EUR">
    <input type="hidden" name="address_override" value="0">
    <input type="hidden" name="first_name" value="<?php echo $first_name; ?>">
    <input type="hidden" name="last_name" value="<?php echo $last_name; ?>">
    <input type="hidden" name="address1" value="<?php echo $address." ".$address_2; ?>">
    <input type="hidden" name="city" value="<?php echo $city; ?>">
    <input type="hidden" name="state" value="<?php echo $province; ?>">
    <input type="hidden" name="zip" value="<?php echo $postcode; ?>">
    <input type="hidden" name="night_phone_a" value="<?php echo $prefix." ".$telephone; ?>">
    <input type="hidden" name="email" value="<?php echo $email; ?>">
    <input type="hidden" name="country" value="<?php echo $country; ?>">
    <input type="hidden" name="custom" id="id_custom" value="<?php echo $id_trans; ?>">


    <input type="hidden" name="return" value="https://levelspaces.com/ordercomplete/<?php echo $id_trans; ?>/">
    <button class="btn btn-success btn-block" role="link" >Continue with paypal</button>
</form></div>
									   
									   <?php }else{ ?>
                                   <div class="col-md-6 col-xs-12">
                                   <a href="<?php echo PATH ?>ordercomplete/<?php echo $id_trans; ?>"><input type="button" class="btn btn-success btn-block" value="COMPLETE ORDER" /></a>
                                   </div>
								   <?php
								   }
								   ?>
                               
                               
    
							
							
							
						</div>
					</div>
				</div> <!-- .testimonial-section -->
                
			

				
			</main> <!-- .main-content -->
            <?php if($payment_method == "card"){

					   ?>
            <!-- Load Stripe.js on your website. -->
<script src="https://js.stripe.com/v3"></script>

<!-- Create a button that your customers click to complete their purchase. Customize the styling to suit your branding. -->


<div id="error-message"></div>
<?php

if($LIVE == true){
?>
<script>
(function() {
  var stripe = Stripe('pk_live_BdZAhnbO8IWOPZFFq8Y1VKmV');

  var checkoutButton = document.getElementById('checkout-button-<?php echo $stripe_product; ?>');
  checkoutButton.addEventListener('click', function () {
    // When the customer clicks on the button, redirect
    // them to Checkout.
    stripe.redirectToCheckout({
      items: [{sku: '<?php echo $stripe_product; ?>', quantity: 1}],

      // Do not rely on the redirect to the successUrl for fulfilling
      // purchases, customers may not always reach the success_url after
      // a successful payment.
      // Instead use one of the strategies described in
      // https://stripe.com/docs/payments/checkout/fulfillment
      successUrl: 'http://levelspaces.com/kit/success/<?php echo $id_trans; ?>',
      cancelUrl: 'http://levelspaces.com/kit/canceled/<?php echo $id_trans; ?>',
	  customerEmail: "<?php echo $email ?>",
    })
    .then(function (result) {
      if (result.error) {
        // If `redirectToCheckout` fails due to a browser or network
        // error, display the localized error message to your customer.
        var displayError = document.getElementById('error-message');
        displayError.textContent = result.error.message;
      }
    });
  });
})();
</script>
<?php
}else{
?>
<script>
(function() {
  var stripe = Stripe('#PK');

  var checkoutButton = document.getElementById('checkout-button-sku_GiTycc0qDgvtLc');
  checkoutButton.addEventListener('click', function () {
    // When the customer clicks on the button, redirect
    // them to Checkout.
    stripe.redirectToCheckout({
      items: [{sku: 'sku_GiTycc0qDgvtLc', quantity: 1}],

      // Do not rely on the redirect to the successUrl for fulfilling
      // purchases, customers may not always reach the success_url after
      // a successful payment.
      // Instead use one of the strategies described in
      // https://stripe.com/docs/payments/checkout/fulfillment
      successUrl: 'http://levelspaces.com/kit/success/<?php echo $id_trans; ?>',
      cancelUrl: 'http://levelspaces.com/kit/canceled/<?php echo $id_trans; ?>',
	  customerEmail: "<?php echo $email ?>",
    })
    .then(function (result) {
      if (result.error) {
        // If `redirectToCheckout` fails due to a browser or network
        // error, display the localized error message to your customer.
        var displayError = document.getElementById('error-message');
        displayError.textContent = result.error.message;
      }
    });
  });
})();
</script>
<?php
}
			}
?>