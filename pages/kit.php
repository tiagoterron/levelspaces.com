<?php
header("location:https://levelspaces.com/product/26-universo-paralelo-cd");
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
$SQL = "SELECT * FROM tb_kit WHERE `id_trans` = '$id_trans'";
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
					<div class="container">
						<div class="row">
                        <div class="col-md-12"><img src="<?php echo PATH ?>images/universo_paralelo.png" alt="thumbnail 1" width="100%"></div>
                        <div class="">&nbsp;</div>
                        <div class="text-white col-md-12">
								<form action="<?php echo PATH ?>send" class="contact-form" method="post">
                                <input type="hidden" value="buy-kit" name="req" />
                                <input type="hidden" value="<?php echo $_SESSION["id_trans"]; ?>" name="id_trans" />
                                <?php if($_GET["b"] == ""){ ?>
                                <h4>Universo Paralelo 2020</h4>
                                <br />
                                <?php /*?><div class="text-white col-md-12">
                                  <p class="text-justify">Why pre-order our promotional kit?<br /><br />
                                  <ol>
                                    <li>You will be helping us with the mastering and CD pressing  expenses;</li>
                                    <li>By pre-ordering the full kit, you will also be saving on the purchase of the  individual items, which cost the following:</li>
                                    <p><br />
                                    1x   CD <strong>Universo Paralelo</strong> (2020) = <strong><u>15€</u></strong> (after the official release)<br />
                                    1x   T-shirt (black or white) = <strong><u>20€</u></strong><br />
                                    1x   <strong>Universo Paralelo</strong> themed button = <strong><u>2€</u></strong><br />
                                    5x   Stickers = <strong><u>2,50€</u></strong><br />
                                    1x   <strong>Universo Paralelo</strong> digital download = <strong><u>10€</u></strong><br /><br />
                                    All of which add up to <strong><u>49,50€</u></strong>,  while the full kit goes for <strong><u>35€</u></strong> (including shipping);<br /><br />
                                    </p>
                                    <li>You'll be able to download the <strong><u>10 songs</u></strong> from the new album, so you can listen in any device  of your choice, even before the release of the physical album;</li>
                                    <li>And last, but not least, you also get a beautiful band  picture with our autographs, which you can frame or put up in your  mural/fridge/wall/etc.</li>
                                  </ol>
                                    <br />
                                    <ul>
                                    <li>The digital version will be available for download from  the <strong><u>1st of March (01/03/2020)</u></strong>;</li>
                                    <li>The cost of <strong><u>35€</u></strong> already includes worldwide shipping;</li>
                                   <li>The kits will be available from the <strong><u>15th of April, 15/04/2020</u></strong> (This date is subject to  alteration or delays).
                                   </li></ul>
                                   </p>
                                </div><?php */?>
                                <?php
								}
							
								?>
                                <?php if($_GET["b"] == ""){ ?>
                                <h4 class="page-title">Choose your item:</h4>
                                <ul class="list-group list-group-horizontal-sm col-xs-12" style="text-align:center">

                                  <li class="list-group-item list-group-item-dark col-md-6 col-lg-2 col-xs-3 p-0 mb-2">
                                  <div class="card">
  <label for="id_product_6"><img src="<?php echo PATH ?>images/icons/collection.jpg" class="card-img-top img-fluid <?php if($product != "6")echo " products"?>" id="product_6" style="width:100%" /></label>
  <div class="card-body">
    <p class="card-text"><input type="radio" required <?php if($product=="6")echo "checked='checked'"; ?> id="id_product_6" name="product" value="6" checked="checked" /><label for="id_product_6">Full Collection</label></p>
  </div></div>
</li>
<li class="list-group-item list-group-item-dark col-md-6 col-lg-2 col-xs-3 p-0 mb-2">
                                  <div class="card">
  <label for="id_product_2"><img src="<?php echo PATH ?>images/icons/button2.jpg?" class="card-img-top img-fluid <?php if($product != "2")echo " products"?>" id="product_2" style="width:100%" /></label>
  <div class="card-body">
    <p class="card-text"><input type="radio" <?php if($product=="2")echo "checked='checked'"; ?> id="id_product_2" name="product" value="2" /><label for="id_product_2">1x CD</label></p>
  </div></div>
</li>
<li class="list-group-item list-group-item-dark col-md-6 col-lg-2 col-xs-3 p-0 mb-2">
                                  <div class="card">
  <label for="id_product_3"><img src="<?php echo PATH ?>images/icons/button3.jpg" class="card-img-top img-fluid <?php if($product != "3")echo " products"?>" id="product_3" style="width:100%" /></label>
  <div class="card-body">
    <p class="card-text"><input type="radio" <?php if($product=="3")echo "checked='checked'"; ?> id="id_product_3" name="product" value="3" /><label for="id_product_3">1x download</label></p>
  </div></div>
</li>
<li class="list-group-item list-group-item-dark col-md-6 col-lg-2 col-xs-3 p-0 mb-2">
                                  <div class="card">
  <label for="id_product_4"><img src="<?php echo PATH ?>images/icons/button4.jpg" class="card-img-top img-fluid <?php if($product != "4")echo " products"?>" id="product_4" style="width:100%" /></label>
  <div class="card-body">
    <p class="card-text"><input type="radio" <?php if($product=="4")echo "checked='checked'"; ?> id="id_product_4" name="product" value="4" /><label for="id_product_4">1x CD + download</label></p>
  </div></div>
</li>
<?php /*?><li class="list-group-item list-group-item-dark col-md-6 col-lg-2 col-xs-3 p-0 mb-2">
                                  <div class="card">
  <label for="id_product_5"><img src="<?php echo PATH ?>images/icons/button5.jpg" class="card-img-top img-fluid <?php if($product != "5")echo " products"?>" id="product_5" style="width:100%" /></label>
  <div class="card-body">
    <p class="card-text"><input type="radio" <?php if($product=="5")echo "checked='checked'"; ?> id="id_product_5" name="product" value="5" /><label for="id_product_4">1x t-shirt</label></p>
  </div></div>
</li><?php */?>
</ul><div class="mt-2">&nbsp</div><?php }else{ ?>
<input type="hidden" name="product" value="<?php echo $product; ?>" />
<?php
}
?>
                                <h5 class="page-title">Choose the payment method that better suits you:</h5>
                                <div class="col-md-6 col-xs-12 col-lg-12 mb-3">
                                <ul class="list-group list-group-horizontal-sm" style="text-align:center">

                                  <li class="list-group-item list-group-item-dark col-md-6 col-lg-2"><div class="card">
  <label for="id_bank"><img src="<?php echo PATH ?>images/icons/bank.png" class="card-img-top img-fluid" style="width:100px;" alt="Bank"/></label>
  <div class="card-body">
    <p class="card-text"><input type="radio" required <?php if($payment_method=="bank")echo "checked='checked'"; ?> id="id_bank" name="payment_method" value="bank" /><label for="id_bank">Bank transfer</label></p>
  </div>
</div></li>
                                <li class="list-group-item list-group-item-dark col-md-6 col-lg-2"><div class="card ">
  <label for="id_card"><img src="<?php echo PATH ?>images/icons/card.png" class="card-img-top img-fluid" style="width:100px;" alt="Card"/></label>
  <div class="card-body">
    <p class="card-text"><input type="radio" <?php if($payment_method=="card")echo "checked='checked'"; ?> id="id_card" name="payment_method" value="card"  /><label for="id_card">Debit/credit card</label></p>
  </div>
</div></li>
<li class="list-group-item list-group-item-dark col-md-6 col-lg-2"><div class="card ">
  <label for="id_invoice"><img src="<?php echo PATH ?>images/icons/invoice.png" class="card-img-top img-fluid" style="width:100px;" alt="Invoice"/></label>
  <div class="card-body">
    <p class="card-text"><input type="radio" id="id_invoice" <?php if($payment_method=="invoice")echo "checked='checked'"; ?> name="payment_method" value="invoice"  /><label for="id_invoice">Invoice</label></p>
  </div>
</div></li>
<li class="list-group-item list-group-item-dark col-md-6 col-lg-2"><div class="card ">
  <label for="id_paypal"><img src="<?php echo PATH ?>images/icons/paypal.png" class="card-img-top img-fluid" style="width:100px;" alt="Paypal"/></label>
  <div class="card-body">
    <p class="card-text"><input type="radio" id="id_paypal" <?php if($payment_method=="paypal")echo "checked='checked'"; ?> name="payment_method" value="paypal"  /><label for="id_paypal">Paypal</label></p>
  </div>
</div></li>
                                </ul>
                                </div>
                                <div>&nbsp;</div>
                                <?php /*?><div class="div_tshirt" <?php if($product != "1" and $product != "5")echo "style='display:none;'"?>>
                                <h4 class="page-title">T-shirt (color & size)</h4>
									 <div class="col-md-6 mb-2"><div class="input-group mb-6">
  <div class="input-group-prepend">
    <label class="input-group-text" for="id_tshirt_color">* COLOR</label>
  </div>
  <select class="custom-select py-0" id="id_tshirt_color" name="t_shirt_color" <?php if($product == "1")echo " required"?>>
    <option></option>
    <option value="WHITE" <?php if($t_shirt_color=="WHITE")echo "selected='selected'"; ?> style="background-color:white;color:black;">WHITE</option>
    <option value="BLACK" <?php if($t_shirt_color=="BLACK")echo "selected='selected'"; ?> style="background-color:black;color:white;">BLACK</option>
  </select>
</div></div>
<div class="col-md-6"><div class="input-group mb-6">
  <div class="input-group-prepend">
    <label class="input-group-text" for="id_tshirt_size">* SIZE</label>
  </div>
  <select class="custom-select py-0" id="id_tshirt_size" name="t_shirt_size"  <?php if($product == "1")echo " required"?>>
  <option required></option>
    <option value="S" <?php if($t_shirt_size=="S")echo "selected='selected'"; ?>>S</option>
    <option value="M" <?php if($t_shirt_size=="M")echo "selected='selected'"; ?>>M</option>
    <option value="L" <?php if($t_shirt_size=="L")echo "selected='selected'"; ?>>L</option>
    <option value="XL" <?php if($t_shirt_size=="XL")echo "selected='selected'"; ?>>XL</option>
    <option value="XLL" <?php if($t_shirt_size=="XLL")echo "selected='selected'"; ?>>XLL</option>
  </select>
</div>
</div>
</div><?php */?>
                                 <div class="">&nbsp;</div>
                                <h4 class="page-title">Personal information</h4>
                                <div class="col-md-6"><input type="text" required="required" name="first_name" value="<?php echo $first_name?>" placeholder="* First name"..></div> 
                                <div class="col-md-6"><input type="text" value="<?php echo $last_name?>"  required="required" name="last_name" placeholder="* Last name"..></div>
									<div class="col-md-6"><input type="email" value="<?php echo $email?>" required="required" name="email" placeholder="* email@domain.com"></div>
                                    <div class="col-md-2"><?php include (dirname(__FILE__)."/../inc/country_code.php"); ?></div>
                                    <div class="col-md-4"><input type="text" required="required" value="<?php echo $telephone?>" name="telephone" placeholder="* Telephone number" class="telephone"></div>
                                    
                                    <div class="">&nbsp;</div>
                                    <h4 class="page-title">Shipping address</h4>
									<div class="col-md-8"><input type="text" value="<?php echo $address?>" required="required" name="address" placeholder="* Straße, 123"></div><div class="col-md-4"><input type="text" name="address_2" value="<?php echo $address_2?>" placeholder="Ap, house, suite, etc"></div>
                                    <div class="col-md-4"><input type="text" value="<?php echo $postcode?>" required="required" name="postcode" placeholder="* Postcode"></div><div class="col-md-8"><input type="text" required="required" value="<?php echo $city?>" name="city" placeholder="* City"></div>
                                    
                                    <div class="col-md-6"><input type="text" name="province" value="<?php echo $province?>" placeholder="Province"></div><div class="col-md-6"><?php include (dirname(__FILE__)."/../inc/countries.php"); ?></div>
                                    <div class="">&nbsp;</div>
                                    
                                   <div class="col-md-12"> 
                                   <input type="submit" value="NEXT >>" />
                                   </div>
								</form>
							</div>
							
						</div>
					</div>
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