<link rel="stylesheet" href="<?php echo PATH ?>css/shop.css" type="text/css" />
<script language="javascript">
$(document).ready(function(){
	var id_user = $("#id_user");
	$("#payment-form .insert").change(function(){
 $.ajax({
	url: PATH+'ajax/form.php',
	type: 'post',
	data: {
		'req': 'saveFormShop',
		'name': $(this).attr('name'),
		'value': $(this).val(),
		'session': SESSION
	},
	success: function(data)          
         {   
            id_user.val(data);
         }
	});
	});
})
</script>
<?php
if($ADMIN != ""){
	include "seo.php";
}

?>
<style type="text/css">
.products{
    -webkit-transition: all 100ms ease-in;
       -moz-transition: all 100ms ease-in;
            transition: all 100ms ease-in;
    -webkit-filter: brightness(1.8) grayscale(1) opacity(.7);
       -moz-filter: brightness(1.8) grayscale(1) opacity(.7);
            filter: brightness(1.8) grayscale(1) opacity(.7);	
}
</style>
<?php

$SQLFORM = mysqli_query($connect, "SELECT * FROM tb_customers WHERE session = '$session'");
if(mysqli_num_rows($SQLFORM)){
$SQLFORMQ = mysqli_fetch_assoc($SQLFORM);	
extract($SQLFORMQ, EXTR_OVERWRITE);
}


if(!isset($_SESSION["id_trans"])){
$id_trans = rand();
$_SESSION["id_trans"] = $id_trans;
}else{
$id_trans = $_SESSION["id_trans"];	
}
$status = $_GET["b"];
if($status == "success"){
$id_trans = $_GET["c"];
$SQL = mysqli_query($connect, "UPDATE `tb_kit` SET `payment_status` = 'CONFIRMED' WHERE `id_trans` = '$id_trans' LIMIT 1");
unset($_SESSION["id_trans"]);
header("Location: ".PATH."ordercomplete/".$id_trans);
}elseif($status == "edit"){
$SQL = "SELECT * FROM tb_order WHERE `orderNumber` = '$id_trans'";
$SQL = mysqli_query($connect, $SQL);

$SQL_Q = mysqli_fetch_assoc($SQL);
extract($SQL_Q, EXTR_OVERWRITE);
}
if($product == ""){$product="6";}

if($_GET["b"] != ""){
$product = $_GET["b"];
}
?>
<main class="main-content">
				<div class="fullwidth-block download">
                <?php
				include "inc/cart.php";
				?>
                <form action="<?php echo PATH ?>send" class="contact-form" id="payment-form" method="post">
                                <input type="hidden" value="checkout" name="req" />
                                <input type="hidden" value="" name="id_user" id="id_user" />
                                <input type="hidden" value="<?php echo $_SESSION["id_trans"]; ?>" name="id_trans" />
					<div class="container dark2 my-2">
						<div class="row">
                         
                                <div class="col-md-6 col-xs-12 col-lg-12 mb-3">
                                <h5 class="page-title m-3">Payment method</h5>
                                <ul class="list-group list-group-horizontal-sm" style="text-align:center">

                                  <li class="list-group-item list-group-item-dark col-md-6 col-lg-3"><div class="card">
  <label for="id_bank"><img src="<?php echo PATH ?>images/icons/bank.png" class="card-img-top img-fluid" style="width:100px;" alt="Bank"/></label>
  <div class="card-body">
    <p class="card-text">
    <input type="radio" required <?php if($payment_method=="bank")echo "checked='checked'"; ?> id="id_bank" name="payment_method" value="bank" /><label for="id_bank">Bank transfer</label>
    </p>
  </div>
</div></li>
                                <li class="list-group-item list-group-item-dark col-md-6 col-lg-3"><div class="card ">
  <label for="id_card"><img src="<?php echo PATH ?>images/icons/card.png" class="card-img-top img-fluid" style="width:100px;" alt="Card"/></label>
  <div class="card-body">
    <p class="card-text"><input type="radio" <?php if($payment_method=="card")echo "checked='checked'"; ?> id="id_card" name="payment_method" value="card"  /><label for="id_card">Debit/credit card</label></p>
  </div>
</div></li>
<li class="list-group-item list-group-item-dark col-md-6 col-lg-3"><div class="card ">
  <label for="id_invoice"><img src="<?php echo PATH ?>images/icons/invoice.png" class="card-img-top img-fluid" style="width:100px;" alt="Invoice"/></label>
  <div class="card-body">
    <p class="card-text"><input type="radio" id="id_invoice" <?php if($payment_method=="invoice")echo "checked='checked'"; ?> name="payment_method" value="invoice"  /><label for="id_invoice">Invoice</label></p>
  </div>
</div></li>
<li class="list-group-item list-group-item-dark col-md-6 col-lg-3"><div class="card ">
  <label for="id_paypal"><img src="<?php echo PATH ?>images/icons/paypal.png" class="card-img-top img-fluid" style="width:100px;" alt="Paypal"/></label>
  <div class="card-body">
    <p class="card-text"><input type="radio" id="id_paypal" <?php if($payment_method=="paypal")echo "checked='checked'"; ?> name="payment_method" value="paypal"  /><label for="id_paypal">Paypal</label></p>
  </div>
</div></li>
                                </ul>
                                </div>
                        
                        </div></div>
                        <div class="container dark2 my-2">
						<div class="row">
                        <div class="text-white col-md-12 d-flex flex-wrap">
								
                                 <div class="">&nbsp;</div>
                                <h4 class="page-title w100p">Personal information</h4>
                                <div class="col-md-6"><input type="text" required="required" name="first_name" value="<?php echo $first_name?>" placeholder="* First name" class="insert"></div> 
                                <div class="col-md-6"><input type="text" class="insert" value="<?php echo $last_name?>"  required="required" name="last_name" placeholder="* Last name"..></div>
									<div class="col-md-6"><input type="email" class="insert" value="<?php echo $email?>" required="required" name="email" placeholder="email@domain.com"></div>
                                    <div class="col-md-2"><?php include (dirname(__FILE__)."/../inc/country_code.php"); ?></div>
                                    <div class="col-md-4"><input type="text" required="required" value="<?php echo $telephone?>" name="telephone" placeholder="* Telephone number" class="telephone insert"></div>
                                    
                                    <?php
									if($_SESSION["ONLYDIGITAL"] == "NO"){
									?>
                                    <div class="">&nbsp;</div>
                                    <h4 class="page-title w100p">Shipping address</h4>
									<div class="col-md-8"><input type="text" class="insert" value="<?php echo $address?>" required="required" name="address" placeholder="* Straße, 123"></div><div class="col-md-4"><input class="insert" type="text" name="address_2" value="<?php echo $address_2?>" placeholder="Ap, house, suite, etc"></div>
                                    <div class="col-md-4"><input type="text" value="<?php echo $postcode?>" required="required" name="postcode" class="insert" placeholder="* Postcode"></div><div class="col-md-8"><input type="text" required="required" value="<?php echo $city?>" class="insert" name="city" placeholder="* City"></div>
                                    
                                    <div class="col-md-6"><input type="text" name="province" value="<?php echo $province?>" placeholder="Province" class="insert"></div><div class="col-md-6"><?php include (dirname(__FILE__)."/../inc/countries.php"); ?></div>
                                    <div class="">&nbsp;</div>
                                    <?php
									}
									?>
                                   <div class="col-md-12"> 
                                   <input type="submit" value="NEXT >>" />
                                   </div></div>
								</form>
							</div>
                           
							
						</div>
                        
					</div>
                     <?php
include "inc/payment.php";
?>
				</div> <!-- .testimonial-section -->

				
			</main> <!-- .main-content -->
            <script language="javascript">
$(function () {
	$('input[type=radio][name=product]').change(function() {
    if (this.value == '1') {
        $(".div_tshirt").fadeIn();
		$('#id_tshirt_color').prop('required',true);
		$('#id_tshirt_size').prop('required',true);
		$("#product_1").removeClass(' products');
		$("#product_2").addClass(' products');
		$("#product_3").addClass(' products');
		$("#product_4").addClass(' products');
		$("#product_5").addClass(' products');
		$("#product_6").addClass(' products');
    }else if(this.value == '2'){
		$(".div_tshirt").fadeOut();
		$('#id_tshirt_color').removeAttr('required');
		 $('#id_tshirt_size').removeAttr('required');
		 $("#product_2").removeClass(' products');
		 $("#product_1").addClass(' products');
		$("#product_3").addClass(' products');
		$("#product_4").addClass(' products');
		$("#product_5").addClass(' products');
		$("#product_6").addClass(' products');
	}else if(this.value == '3'){
		$(".div_tshirt").fadeOut();
		$('#id_tshirt_color').removeAttr('required');
		 $('#id_tshirt_size').removeAttr('required');
		  $("#product_3").removeClass(' products');
		 $("#product_2").addClass(' products');
		$("#product_1").addClass(' products');
		$("#product_4").addClass(' products');
		$("#product_5").addClass(' products');
		$("#product_6").addClass(' products');
	}else if(this.value == '4'){
		$(".div_tshirt").fadeOut();
		$('#id_tshirt_color').removeAttr('required');
		 $('#id_tshirt_size').removeAttr('required');
		  $("#product_4").removeClass(' products');
		 $("#product_2").addClass(' products');
		$("#product_3").addClass(' products');
		$("#product_1").addClass(' products');
		$("#product_5").addClass(' products');
		$("#product_6").addClass(' products');
	}else if(this.value == '5'){
		$(".div_tshirt").fadeIn();
		$('#id_tshirt_color').prop('required',true);
		$('#id_tshirt_size').prop('required',true);
		$("#product_5").removeClass(' products');
		$("#product_1").addClass(' products');
		$("#product_2").addClass(' products');
		$("#product_3").addClass(' products');
		$("#product_4").addClass(' products');
		$("#product_6").addClass(' products');
		
	}else if(this.value == '6'){
		$(".div_tshirt").fadeOut();
		$('#id_tshirt_color').removeAttr('required');
		 $('#id_tshirt_size').removeAttr('required');
		 $("#product_2").addClass(' products');
		 $("#product_1").addClass(' products');
		$("#product_3").addClass(' products');
		$("#product_4").addClass(' products');
		$("#product_5").addClass(' products');
		 $("#product_6").removeClass(' products');
	}
	
	});
	
	$(".divBank").fadeOut();
  $('[data-toggle="popover"]').popover();
})
            </script>