<script language="javascript" type="text/javascript">
$(document).ready(function() {
    $('.go-download').click(function(e) {
	var link_mp3 = $(this).attr('data-mp3');
	var link_wav = $(this).attr('data-wav');
	e.preventDefault(); 
	if($(this).attr('data-type') == "mp3"){
    window.open(link_mp3, '_blank');
	}else{
	window.open(link_wav, '_blank');	
	}
		
		
    });
	
});

</script>

<main class="main-content">
				<div class="fullwidth-block inner-content">
                <?php
				
				if($_POST["orderNumber"] != "" or ($_GET["b"] != "" and $_GET["c"] != "")){
					
					if($_GET["b"] != "" and $_GET["c"] != ""){
					$URL = explode("/", $_SERVER['REQUEST_URI']);
					$orderNumber = $URL[3];
					$email = $URL[2];
					}else{
					$orderNumber = $_POST["orderNumber"];
					$email = $_POST["email"];
					}			?>
                <div class="container container_shop shopping-cart my-4">
<?php /*?><img src="<?php echo PATH ?>images/banner_top_email.jpg" width="100%">
<?php */?>	<table id="cart" class="table table-hover table-dark table-condensed">
    				<thead>
						<tr>
							<th style="width:50%">Item</th>
							<th style="width:30%">Status</th>
                            <th style="width:20%">Download</th>
						</tr>
					</thead>
					<tbody>
                    
                    <?php
					
					$total = 0;
$SQL = mysqli_query($connect, "SELECT a.*, a.status AS orderStatus, b.* FROM tb_order a LEFT JOIN tb_shop_products b ON a.idProduct = b.id WHERE a.orderNumber = '$orderNumber'");
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
					
					
					if($orderStatus =="pending"){$status = "<span class='text-danger'><strong>PAYMENT PENDING</strong></span>";} 
					elseif($orderStatus =="paid"){$status = "<span class='text-success'><strong>IN SHIPPING PROCESS</strong></span>";} 
					?>
                    
						<tr>
							<td data-th="Product">
								<div class="row">
									<div class="col-sm-2 hidden-xs"><img src="<?php echo $image ?>" alt="<?php echo $title ?>" class="img-responsive" width="75px"/></div>
									<div class="col-sm-10">
										<h4><?php echo $amount ?>x <?php echo $title; ?></h4>
										<p><?php echo $short_desc; ?></p>
									</div>
								</div>
							</td>
							
							<td><?php echo $status ?></td>
                            <td align="right">
                            <?php
                            if($orderStatus == "paid" and $type == "DOWNLOAD"){
							?>
                            <?php
							if($link_download_wav != ""){
							?>
                            <button class="btn btn-success btn-sm delete-cart go-download" data-wav="<?php echo $link_download_wav; ?>" data-id="<?php echo $id_product; ?>" data-type='wav'>
                                <i class="fa fa-download"></i>  <span class="mx-2">Download .WAV</span></button>
                                <?php
							}
								?>
                                 <?php
							if($link_download_mp3 != ""){
							?>
                                <button class="btn btn-success btn-sm delete-cart go-download mt-2" data-type='mp3' data-mp3="<?php echo $link_download_mp3; ?>" data-id="<?php echo $id_product; ?>">
                                <i class="fa fa-download"></i>  <span class="mx-2">Download .MP3</span></button>
                                <?php
							}
								?>
                                </td>
							<?php
							}
							?>
						</tr>
                        
                       <?php
					   }
					}
					$total = number_format((float)$total, 2, '.', '');
					$_SESSION["TOTAL"] = $total;
					   ?> 
                        
					</tbody>
				
				</table>
                
</div>


<?php
					}else{
?>
					<div class="container">
                        <h2 class="page-title">Check Order</h2>
						<div class="row">
							<div class="col-md-6">
								<form action="check-order" class="contact-form" method="post">
                                <input type="hidden" value="check-order" name="req" />
                               <div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text w100" id="inputGroup-sizing-default">E-mail</span>
  </div>
  <input type="text" class="form-control" aria-label="Default" name="email" aria-describedby="inputGroup-sizing-default" placeholder="Insert your e-mail">
</div>
        							<div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text w100" id="inputGroup-sizing-default">Order ID</span>
  </div>
  <input type="text" class="form-control" aria-label="Default" name="orderNumber" aria-describedby="inputGroup-sizing-default" placeholder="Insert your Order ID">
</div>
									<input type="submit" value="Check">
								</form>
							</div>
						</div>
					</div>
                    <?php
					}
					?>
				</div>
			</main>