<script language="javascript" type="text/javascript">
$(document).ready(function() {
    $('.amount-change').change(function() {
        var pos = $(this).attr('data-id');
		var amount = $(this).val();
		var amount_before = $(this).attr('data-amount');
        $.ajax({
            url: PATH+"ajax/form.php",
            type: "POST",
            data: {id: pos, req: 'addToCart', amount: amount, amount_before: amount_before,  session: '<?php echo session_id(); ?>'},
            success: function(data) {
			alert("Shopping cart updated!");
            location.reload(true);
			}
        });
		return false;
    });
});

$(document).ready(function() {
    $('.delete-cart').click(function() {
        var pos = $(this).attr('data-id');
        $.ajax({
            url: PATH+"ajax/form.php",
            type: "POST",
            data: {id: pos, req: 'removeItem',  session: '<?php echo session_id(); ?>'},
            success: function(data) {
			alert("Shopping cart updated!");
            location.reload(true);
			}
        });
		return false;
    });
});


</script>
<?php

require_once('_functions/stripe/vendor/autoload.php');

$LIVE = true;	

$id_trans = $_SESSION["id_trans"];

$SQL = "SELECT * FROM `tb_order` WHERE `orderNumber` = '$id_trans'";
$SQL = mysqli_query($connect, $SQL);

$SQL_Q = mysqli_fetch_assoc($SQL);
extract($SQL_Q, EXTR_OVERWRITE);
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
$full_name = $first_name." ".$last_name;
$SKU = $extra;

$total = $_SESSION["TOTAL"];
$discount = ($total*$_SESSION["discount"])/100;
$total = $total-$discount;
$_SESSION["TOTAL"] = $total;
?>
<main class="main-content">
				<div class="fullwidth-block download">
					<div class="container dark2">
					  <div class="row">
                        <div class="col-md-12">
								
                          <div class="col-md-12 dark2">
                                 <?php /*?><h4 class="page-title text-success text-center py-3">We are almost there!</h4><?php */?>
                                <?php
								if($payment_method == "invoice"){
								?>
                               
                                <?php
								$SQL_TEMPLATE = mysqli_query($connect, "SELECT * FROM `tb_template_email` WHERE `name` = 'invoicePending' LIMIT 1");								
								if(mysqli_num_rows($SQL_TEMPLATE)>0){
								$SQL_TEMPLATE_Q = mysqli_fetch_assoc($SQL_TEMPLATE);
								$t_subject = $SQL_TEMPLATE_Q["title"];
								$t_message = $SQL_TEMPLATE_Q["text"];
								$subject = utf8_encode($t_subject);
								$message = utf8_encode($t_message);
								$message = preg_replace("/\[FULL NAME\]/", $first_name." ".$last_name, $message);
								$message = preg_replace("/\[ID\]/", $id_trans, $message);
								$message = preg_replace("/\[TOTAL\]/", $_SESSION["TOTAL"]." €", $message);
								//echo '<div class="text-justify text-white">'.$message.'</div>';
								}
								?>
                         
                                <?php
								}
								?>
                                <?php
								if($payment_method == "bank"){
									?>
                                    
								<?php
								$SQL_TEMPLATE = mysqli_query($connect, "SELECT * FROM `tb_template_email` WHERE `name` = 'bankPending' LIMIT 1");								
								if(mysqli_num_rows($SQL_TEMPLATE)>0){
								$SQL_TEMPLATE_Q = mysqli_fetch_assoc($SQL_TEMPLATE);
								$t_subject = $SQL_TEMPLATE_Q["title"];
								$t_message = $SQL_TEMPLATE_Q["text"];
								$subject = utf8_encode($t_subject);
								$message = utf8_encode($t_message);
								$message = preg_replace("/\[FULL NAME\]/", $first_name." ".$last_name, $message);
								$message = preg_replace("/\[ID\]/", $id_trans, $message);
								$message = preg_replace("/\[TOTAL\]/", $_SESSION["TOTAL"]." €", $message);
								//echo '<div class="text-justify text-white">'.$message.'</div>';
								}
								?>
                                <?php
								}
								?>
                                
                              <?php
								if($payment_method == "card"){
								?>
                             <?php
								$SQL_TEMPLATE = mysqli_query($connect, "SELECT * FROM `tb_template_email` WHERE `name` = 'cardPending' LIMIT 1");								
								if(mysqli_num_rows($SQL_TEMPLATE)>0){
								$SQL_TEMPLATE_Q = mysqli_fetch_assoc($SQL_TEMPLATE);
								$t_subject = $SQL_TEMPLATE_Q["title"];
								$t_message = $SQL_TEMPLATE_Q["text"];
								$subject = utf8_encode($t_subject);
								$message = utf8_encode($t_message);
								$message = preg_replace("/\[FULL NAME\]/", $first_name." ".$last_name, $message);
								$message = preg_replace("/\[ID\]/", $id_trans, $message);
								$message = preg_replace("/\[TOTAL\]/", $_SESSION["TOTAL"]." €", $message);
								//echo '<div class="text-justify text-white">'.$message.'</div>';
								}
								?>
                        
                                <?php
								}
								?>
                                 <?php
								if($payment_method == "paypal"){
								?>
                                
                                <?php
								$SQL_TEMPLATE = mysqli_query($connect, "SELECT * FROM `tb_template_email` WHERE `name` = 'paypalPending' LIMIT 1");								
								if(mysqli_num_rows($SQL_TEMPLATE)>0){
								$SQL_TEMPLATE_Q = mysqli_fetch_assoc($SQL_TEMPLATE);
								$t_subject = $SQL_TEMPLATE_Q["title"];
								$t_message = $SQL_TEMPLATE_Q["text"];
								$subject = utf8_encode($t_subject);
								$message = utf8_encode($t_message);
								$message = preg_replace("/\[FULL NAME\]/", $first_name." ".$last_name, $message);
								$message = preg_replace("/\[ID\]/", $id_trans, $message);
								$message = preg_replace("/\[TOTAL\]/", $_SESSION["TOTAL"]." €", $message);
								//echo '<div class="text-justify text-white">'.$message.'</div>';
								}
								?>
                               
                                <?php
								}
								?>
                                </div>
                                <div class="">&nbsp;</div>
               
                                 <div class="">&nbsp;</div>
                                 <div class="col-md-12 col-lg-6 text-white">
                                <h5 class="page-title bg-primary p-2 px-2 w100p">Personal information</h5>
                                <span class="d-flex flex-wrap">
                                <span class="w100p"><?php echo $first_name ?> <?php echo $last_name ?></span>
                               <span class="w100p"><?php echo $email ?></span>
                                <span class="w100p"><?php echo "(+".$prefix.") ".$telephone ?></span>
                                </span>
                                <div class="">&nbsp;</div>
                                </div>
                                <?php
									if($_SESSION["ONLYDIGITAL"] == "NO"){
									?>
                                <div class="col-md-12 col-lg-6 text-white">
                                    <h5 class="page-title bg-primary p-2 px-2 w100p">Shipping address</h5>
								   <span class="d-flex flex-wrap">
                                   <span class="w100p"><?php echo $address ?></span>
                                   <?php
								   if($address_2 != ""){
								   ?>
                                   <span class="w100p"><?php echo $address_2 ?></span>
                                   <?php
								   }
								   ?>
                                   <span class="w100p"><?php echo $postcode. " ".$city ?></span>
                                   <span class="w100p"><?php echo $province." ".$country ?></span>
                                    <div class="">&nbsp;</div>
                                    </span></div>
                                    <?php
								}
									?>
                                    <div class="container container_shop shopping-cart my-4">
<?php /*?><img src="<?php echo PATH ?>images/banner_top_email.jpg" width="100%">
<?php */?>	<table id="cart" class="table table-hover table-dark table-condensed">
    				<thead>
						<tr>
							<th style="width:50%">Item</th>
							<th style="width:10%">Price</th>
							<th style="width:8%">Quantity</th>
							<th style="width:22%" class="text-center">Subtotal</th>
							<th style="width:10%"></th>
						</tr>
					</thead>
					<tbody>
                    
                    <?php
					$total = 0;
					$SQL = mysqli_query($connect, "SELECT a.*, b.*,b.price FROM tb_shop_cart a LEFT JOIN tb_shop_products b ON a.id_product = b.id WHERE a.checkout = 'N' AND a.session = '$session'");
					$SQL_N = mysqli_num_rows($SQL);
					$total_amount = 0;
					$total_price = 0;
					if($SQL_N > 0){
					while($SQL_Q = mysqli_fetch_assoc($SQL)){
					extract($SQL_Q, EXTR_OVERWRITE);	
					$price = $SQL_Q["price"];
					$total_price = $SQL_Q["price"]*$SQL_Q["amount"];
					$price = number_format((float)$price, 2, '.', '');
					$total_price = number_format((float)$total_price, 2, '.', '');
					$total += $total_price;	
					$linkProduct = make_url($id."-".$title, "1");
					?>
						<tr>
							<td data-th="Product">
								<div class="row">
									<div class="col-4 hidden-xs"> 
                                    <span class="item-left p-2">
                        <img src="<?php echo $image ?>" alt="<?php echo $title ?>" width="75px" />
                        </span>
                        </div>
									<div class="col-8">
										<h4><a href="<?php echo PATH ?>product/<?php echo $linkProduct; ?>"><?php echo $title; ?></a></h4>
										<p><?php echo $short_desc; ?></p>
									</div>
								</div>
							</td>
							<td data-th="Price">€<?php echo $price; ?></td>
							<td data-th="Quantity">
								 <?php
							if($type == "DOWNLOAD"){
								echo $amount;
							}else{
							?>
								<input type="number" class="form-control text-center amount-change" data-id="<?php echo $id_product; ?>" data-amount="<?php echo $total_amount; ?>" value="<?php echo $amount; ?>">
							<?php } ?>
							</td>
							<td data-th="Subtotal" class="text-center">€<?php echo $total_price; ?></td>
							<td class="actions" align="right" data-th="">
								<?php /*?><button class="btn btn-info btn-sm"><i class="fa fa-refresh"></i></button><?php */?>
				<button class="btn btn-danger btn-sm delete-cart" data-id="<?php echo $id_product; ?>">
                                <i class="fa fa-trash-o"></i></button>							
							</td>
						</tr>
                       <?php
					   }
					}
					$total = number_format((float)$total, 2, '.', '');
					$_SESSION["TOTAL"] = $total;
					   ?> 
                        
					</tbody>
					<tfoot>
                    <tr>
                        <td colspan="5" class="text-right">

	                    <form action="<?php echo PATH ?>send/applyDiscount" method="post">
	                        <div class="form-group mt-3" align="center">
                            <?php
							if(!isset($coupon) or $coupon == 0){
							?>
	                        <div class="col-6 input-group"> <input type="text" class="form-control coupon" name="coupon" placeholder="#COUPONNAME"> <span class="input-group-append"> <button class="btn btn-primary btn-apply coupon">Apply</button> </span> </div>
                            <?php
}else{
								$discount = ($total*$coupon)/100;
								$total = $total-$discount;
							?>
                             <strong class="col-12">Discount:<span class=" text-danger"> -<?php echo $coupon?>%</span></strong>
                             <?Php
							}
							 ?>
	                        </div>
	                    </form>
                        </td>
                        </tr>
						<tr class="visible-xs">
							<td class="text-center"><strong>Total €<?php echo $total ?></strong></td>
						</tr>
                        <tr>
                        <td colspan="5" class="hidden-xs text-right"><strong>Total €<?php echo $total ?></strong></td>
                        </tr>
						
					</tfoot>
				</table>
</div>
                                    
                                    
                                    
                                   <div class="col-md-6 col-xs-12 mb-2">

                              <a href="<?php echo PATH ?>checkout/edit/<?php echo $id_trans; ?>"><input type="button" class="btn btn-warning btn-block" value="EDIT" /></a>
                                   </div>
                                    <?php
								if($payment_method == "card"){
								?>
                                    <div class="col-md-6 col-xs-12">
                                    <?php
if($LIVE == true){
?>
                                    <button id="checkout-button-<?php echo $SKU; ?>" class="btn btn-success btn-block" role="link" >Continue with payment</button>
                                    <?php
}else{
$SKU = "sku_H8KEholhaMP6EB";	
?>
<button id="checkout-button-<?php echo $SKU ?>" class="btn btn-success btn-block" role="link" >Continue with payment</button>
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
   <?php
   $SQL = mysqli_query($connect, "SELECT a.*, b.*,b.price FROM tb_shop_cart a LEFT JOIN tb_shop_products b ON a.id_product = b.id WHERE a.checkout = 'N' AND a.session = '$session'");
	$SQL_N = mysqli_num_rows($SQL);
	$n = 1;
	if($SQL_N > 0){
	while($SQL_Q = mysqli_fetch_assoc($SQL)){
	extract($SQL_Q, EXTR_OVERWRITE);
	$price = number_format((float)$price, 2, '.', '');
	$discount = ($price*$_SESSION["discount"])/100;
	$price = $price-$discount;

   ?>
    <input type="hidden" name="item_name_<?php echo $n ?>" value="<?php echo $title ?>">
    <input type="hidden" name="item_number_<?php echo $n ?>" value="<?php echo $id ?>">
    <input type="hidden" name="quantity_<?php echo $n ?>" value="<?php echo $amount ?>" />
    <input type="hidden" name="amount_<?php echo $n ?>" value="<?php echo $price?>">
    <?php
	$n++;
	}
	}
	?>
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


    <input type="hidden" name="return" value="https://levelspaces.com/checkout-complete/<?php echo $id_trans; ?>/">
    <button class="btn btn-success btn-block" role="link" >Continue with paypal</button>
</form></div>
									   
									   <?php }else{ ?>
                                   <div class="col-md-6 col-xs-12">
                                   <a href="<?php echo PATH ?>checkout-complete/<?php echo $id_trans; ?>"><input type="button" class="btn btn-success btn-block" value="COMPLETE ORDER" /></a>
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

if($LIVE == false){

?>
<script>
(function() {
  var stripe = Stripe('#PK');

  var checkoutButton = document.getElementById('checkout-button-<?php echo $SKU; ?>');
  checkoutButton.addEventListener('click', function () {
    // When the customer clicks on the button, redirect
    // them to Checkout.
    stripe.redirectToCheckout({
      items: [{sku: '<?php echo $SKU; ?>', quantity: 1}],

      // Do not rely on the redirect to the successUrl for fulfilling
      // purchases, customers may not always reach the success_url after
      // a successful payment.
      // Instead use one of the strategies described in
      // https://stripe.com/docs/payments/checkout/fulfillment
      successUrl: 'http://levelspaces.com/checkout-complete/success/<?php echo $id_trans; ?>',
      cancelUrl: 'http://levelspaces.com/checkout-complete/canceled/<?php echo $id_trans; ?>',
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

  var checkoutButton = document.getElementById('checkout-button-<?php echo $SKU ?>');
  checkoutButton.addEventListener('click', function () {
    // When the customer clicks on the button, redirect
    // them to Checkout.
    stripe.redirectToCheckout({
      items: [
	  <?php
   $SQL = mysqli_query($connect, "SELECT a.*, b.*,b.price FROM tb_shop_cart a LEFT JOIN tb_shop_products b ON a.id_product = b.id WHERE a.checkout = 'N' AND a.session = '$session'");
	$SQL_N = mysqli_num_rows($SQL);
	$n = 1;
	if($SQL_N > 0){
	while($SQL_Q = mysqli_fetch_assoc($SQL)){
	extract($SQL_Q, EXTR_OVERWRITE);
	$price = number_format((float)$price, 2, '.', '');
	$discount = ($price*$_SESSION["discount"])/100;
	$price = $price-$discount;


   ?>
	  {sku: '<?php echo $SKU ?>', quantity: <?php echo $amount ?>},
	  <?php 
	  }
	  }
	  ?>
	  ],

      // Do not rely on the redirect to the successUrl for fulfilling
      // purchases, customers may not always reach the success_url after
      // a successful payment.
      // Instead use one of the strategies described in
      // https://stripe.com/docs/payments/checkout/fulfillment
      successUrl: 'http://levelspaces.com/checkout/success/<?php echo $id_trans; ?>',
      cancelUrl: 'http://levelspaces.com/checkout/canceled/<?php echo $id_trans; ?>',
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