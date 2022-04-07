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
if($_GET["a"] != "cart"){
	$total = 0;
					$SQL = mysqli_query($connect, "SELECT a.*, b.*,b.price FROM tb_shop_cart a LEFT JOIN tb_shop_products b ON a.id_product = b.id WHERE a.checkout = 'N' AND a.session = '$session'");
					$SQL_N = mysqli_num_rows($SQL);
					
					if($_GET["a"] == "checkout" and $SQL_N ==0){
					header("location:".PATH."shop");
					}
					$total_amount = 0;
					$total_price = 0;
					
					
?>
<div class="container_shop shopping-cart d-flex flex-row <?php if($SQL_N >0)echo "fixed-bottom container-fluid";else echo "container"; ?> mb-4">

<ul class="nav navbar-nav navbar-right flex-fill">

        <li class="dropdown p-4">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"> <i class="fas fa-shopping-cart mr-3"></i><?php echo $SQL_N; ?> item(s) <span class="caret"></span></a>
          <ul class="dropdown-menu dropdown-cart ml-2" role="menu">
          
          <?php
					
					if($SQL_N > 0){
					$_SESSION["ONLYDIGITAL"] = "YES";
					while($SQL_Q = mysqli_fetch_assoc($SQL)){
					extract($SQL_Q, EXTR_OVERWRITE);	
					if($type == "CD"){
					$_SESSION["ONLYDIGITAL"] = "NO";
					}
					$price = $SQL_Q["price"];
					$total_price = $SQL_Q["price"]*$SQL_Q["amount"];
					$price = number_format((float)$price, 2, '.', '');
					$total_price = number_format((float)$total_price, 2, '.', '');
					$total += $total_price;	
					$amount = $SQL_Q["amount"];
					
					
					?>
              <li>
                  <span class="item d-flex justify-content-between">
                    <span class="item-left p-2 flex-fill">
                        <img src="<?php echo $image ?>" alt="<?php echo $title ?>" width="35px" />
 					<span class="p-2 flex-fill"><?php echo $SQL_Q["amount"] ?>x <?php echo $title ?></span>
                    </span>
                     <span class="p-2 justify-content-between pull-right">
                    
                            <span class="p-2 flex-fill">€<?php echo $total_price ?></span>
                     </span>
                    <span class="p-2 justify-content-between pull-right">
                        <button class="btn btn-danger btn-sm delete-cart" data-id="<?php echo $id_product; ?>">
                                <i class="fa fa-trash-o"></i></button>	
                    </span>
                </span>
                
              </li>
              <?php
					}
					}
					$discount = ($total*$_SESSION["discount"])/100;
					$total = $total-$discount;
					$_SESSION["TOTAL"] = $total;
			  ?>
             
              <li style="text-align:center;"><span class="item">TOTAL: €<?php echo $total; ?></span></li>
              <li class="divider"></li>
              <li style="text-align:center;"><a class="text-center text-dark" href="<?php echo PATH ?>cart/">View Cart</a></li>
          </ul>
        </li>
      </ul>
      
     <?php
	  $a = $_GET["a"];
	  if($a != "checkout" and $a != "checkout-confirm" and $a != "checkout-complete" and $amount >0){
	  ?>
      <div class="flex-fill fixed-bottom"><a href="<?php echo PATH ?>checkout/" class="btn btn-success btn-block">Checkout <i class="fa fa-angle-right"></i></a></div>
      <?php
	  }
	  ?>
      
</div>
<?php
}else{
?>
<div class="container container_shop shopping-cart my-4">
<?php /*?><img src="<?php echo PATH ?>images/banner_top_email.jpg" width="100%">
<?php */?>	<table id="cart" class="table table-hover table-dark table-condensed">
    				<thead>
						<tr>
							<th style="width:50%">Itema</th>
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
					//echo $coupon;
					   ?> 
                        
					</tbody>
					<tfoot>
						

<tr>
                        <td colspan="5" class="text-right"><strong>Total price: €<?php echo $total ?></strong></td>
                        </tr>    
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
								$discount = ($total*$_SESSION["discount"])/100;
								$total = $total-$discount;
								$_SESSION["TOTAL"] = $total;
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
							<td class="text-right"><strong>Total €<?php echo $total ?></strong></td>
						</tr>
                        <tr>
                        <td colspan="5" class="hidden-xs text-right"><strong>Total: €<?php echo $total ?></strong></td>
                        </tr>
						<tr>
							<td><a href="<?php echo PATH ?>shop/" class="btn btn-warning"><i class="fa fa-angle-left"></i> Continue Shopping</a></td>
							<td class="hidden-xs"></td>
                            <td class="hidden-xs"></td>
							<td colspan="2"><a href="<?php echo PATH ?>checkout/" class="btn btn-success btn-block">Checkout <i class="fa fa-angle-right"></i></a></td>
						</tr>
					</tfoot>
				</table>
</div>
<?php
///echo $_SESSION["discount"]." | ".$_SESSION["total"];
include "payment.php";
?>
<?php
}
?>
