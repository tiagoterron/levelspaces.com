<?php
if($ADMIN == ""){
header("Location: ".PATH);	
}
?>
<?php
include "inc/menu_nav.php"
?>
<script language="javascript" type="text/javascript">
$(document).ready(function() {
    $('.delete-order').click(function() {
		var conf = confirm("Are you sure you want to delete this order?");
		if(conf == true){
        var id = $(this).attr('data-id');
        $.ajax({
            url: PATH+"ajax/form.php",
            type: "POST",
            data: {id: id, req: 'delete-order'},
            success: function(data) {
                // Do stuff when the AJAX call returns
			alert("Item deleted!");
			location.href=PATH+'orders';
			 return false;
			}
        });
		}
    });
	$('.shipped-order').click(function() {
		var conf = confirm("Are you sure you want to update this order?");
		if(conf == true){
        var id = $(this).attr('data-id');
        $.ajax({
            url: PATH+"ajax/form.php",
            type: "POST",
            data: {id: id, req: 'shipped-order'},
            success: function(data) {
                // Do stuff when the AJAX call returns
			alert("Item updated!");
			location.href=PATH+'orders';
			 return false;
			}
        });
		}
    });
	
});

</script>
<main class="main-content">

<div class="container container_shop shopping-cart my-4">
<?php /*?><img src="<?php echo PATH ?>images/banner_top_email.jpg" width="100%">
<?php */
if($_GET["b"] != "all"){
$LAST30 = "WHERE a.dt_cad BETWEEN CURDATE() - INTERVAL 30 DAY AND CURDATE()";
}
?>	<table id="cart" class="table table-dark table-condensed">
    				<thead>
						<tr align="center">
                        	<th style="width:30%">Buyer</th>
							<th style="width:30%">Info</th>
							<th style="width:25%">Item</th>
                            <th style="width:15%" align="right">#</th>
						</tr>
					</thead>
					<tbody>
                    
                    <?php
					
					$total = 0;
$SQL = mysqli_query($connect, "SELECT DATE_FORMAT(a.dt_cad, '%m/%d/%Y'), a.*, DATE_FORMAT(a.dt_cad, '%d/%m/%Y') AS date, a.id AS id_order, a.status AS orderStatus, b.* FROM tb_order a LEFT JOIN tb_shop_products b ON a.idProduct = b.id $LAST30 ORDER BY a.dt_cad DESC"); //WHERE a.status != 'none' 
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
					$cState = $SQL_Q["cState"];
					if($cState == 0)$cState ="";
					$cAddress = $SQL_Q["cAddress1"]." ".$SQL_Q["cAddress2"]." <br />".$SQL_Q["cZipcode"]." ".$SQL_Q["cCity"]." <br />".$cState." ".$SQL_Q["cCountry"];
				
					if($orderStatus == "paid"){
if($delivered == "Y"){
$bgColor = "#3CC";	
}else{
$bgColor = "#6F6";	
}
}elseif($orderStatus == "pending"){
$bgColor = "#FF6";	
}else{
$bgColor = "#F99";	
}
					?>
						<tr bgcolor="<?php echo $bgColor; ?>" class="text-dark">
          <td>
          <ul class="list-group text-center mb-4" style="list-style:none;">
          <li><h4><strong><?php echo $cFirstName; ?> <?php echo $cLastName ?></strong></h4></li>
          <li><?php echo $cTelPrefix." ".$cTel ?></li>
		  <li> <?php echo $cAddress ?></li>
          </ul>
          </th>
      <td>
	  <ul class="list-group text-center" style="list-style:none;">
          <li><h5><strong><?php echo $date ?></strong></h5></li>
          <li><?php echo $cEmail ?></li>
          <li>Order: #<?php echo $orderNumber; ?></li>
		  <li><?php echo strtoupper($method) ?></li>
          </ul></td>
							<td>
								<div class="d-flex">
									<div class="flex-fill align-items-stretch"><img src="<?php echo $image ?>" alt="<?php echo $title ?>" class="img-responsive" width="75px"/></div>
									<div class="flex-fill align-items-stretch text-center align-self-baseline p-2">
										<h5><?php echo $amount ?>x <?php echo $title; ?></h5>
									</div>
								</div>
							</td>
							
							<td align="right">
                             <button class="btn btn-warning btn-sm" data-id="<?php echo $id_order; ?>">
                                <i class="fa fa-edit"></i></button>
                            <?php
							if($delivered == "N"){
							?>
                            <button class="btn btn-primary btn-sm shipped-order" data-id="<?php echo $id_order; ?>">
                                <i class="fa fa-shipping-fast"></i></button>
                                <button class="btn btn-danger btn-sm delete-cart delete-order" data-id="<?php echo $id_order; ?>">
                                <i class="fa fa-trash"></i></button>
                                <?php
							}else{
								?>
                                
                                <?php
							}
								?>
                                 <?php
							if($orderStatus != "paid"){
							?>
                                <a class="btn btn-success btn-sm delete-cart text-white" href="<?php echo PATH ?>send/changeStatusOrderPaid/<?php echo $orderNumber ?>">
                                <i class="fa fa-check-circle"></i></a>
                                <?php
							}
								?>
                                </td>
                            
                            
						</tr>
                       <?php
					   }
					}
					$total = number_format((float)$total, 2, '.', '');
					$_SESSION["TOTAL"] = $total;
					   ?> 
                        
					</tbody>
				
				</table>

				</div> <!-- .testimonial-section -->
               

				
			</main> <!-- .main-content -->