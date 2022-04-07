<script language="javascript" type="text/javascript">
$(document).ready(function() {
    $('.add-to-cart, .addtocart').click(function() {
        var pos = $(this).attr('data-id');
		var type = $(this).attr('data-type');
		var size = $(this).attr('data-size');
		var page = '<?php echo $_GET["a"]; ?>'
        $.ajax({
            url: PATH+"ajax/form.php",
            type: "POST",
            data: {id: pos, req: 'addToCart', add:'yes', type: type, size: size, session: '<?php echo session_id(); ?>'},
            success: function(data) {
                // Do stuff when the AJAX call returns
			alert("Item added to the shopping cart!");
			
			location.href=PATH+'cart';
			$('html, body').animate({
                    scrollTop: $(".product-grid4").offset().top
                }, 2000, function(){
				if(page == "home")
				location.href = 'shop';		
				else
				location.reload(true);	
				
				
				});
				

		   return false;
			}
        });
		
    });
});

</script>

                <div class="container container_shop">
                <h2 class="section-title my-0 py-4">Music/download</h2>
    <?php /*?><img src="<?php echo PATH ?>images/banner_top_email.jpg" width="100%"><?php */?>
    <div class="filter-links filterable-nav">
								<select class="mobile-filter">
									<option value="*">Show all</option>
									<option value=".CD">CD</option>
									<option value=".DOWNLOAD">DOWNLOAD</option>
								</select>
								<a href="#" class="current" data-filter="*">Show all</a>
								<a href="#" data-filter=".CD">CD</a>
								<a href="#" data-filter=".DOWNLOAD">DOWNLOAD</a>
							</div>
    <div class="row filterable-items">
    <?php
	if($_GET["b"] != "" and $_GET["a"] != "shop"){
	$SQL_ID = "AND `id` != $id";	
	}
	if($_GET["a"] != "home" or $_GET["a"] != ""){
	//$LIMIT = "LIMIT 2";
	}else{
	$LIMIT = "";	
	}
	$SQL = mysqli_query($connect, "SELECT *, DATE_FORMAT(released, '%Y') as YEAR, DATE_FORMAT(released, '%m') as MONTH, DATE_FORMAT(released, '%Y') as released FROM `tb_shop_products` WHERE `quantity` > 0 AND `status` = 'Y' $SQL_ID  ORDER BY released DESC $LIMIT");
	if(mysqli_num_rows($SQL) > 0){
	while($SQL_Q = mysqli_fetch_assoc($SQL)){
	extract($SQL_Q, EXTR_OVERWRITE);
	$price = number_format((float)$price, 2, '.', '');
	$linkProduct = make_url($id."-".$title, "1");
	$today = mktime(0,0,0,date("m"),date("d"),date("Y"));
	
	$six = mktime(0,0,0,$MONTH+6,0,$YEAR);
	
	?>
    <div class="col-md-3 col-sm-6 filterable-item <?php echo $type; ?>">
            <div class="product-grid4">
                <div class="product-image4">
                    <a href="<?php echo PATH ?>product/<?php echo $linkProduct; ?>">
                        <img class="pic-1" src="<?php echo $image ?>">
                        <img class="pic-2" src="<?php echo $image2 ?>">
                    </a>
                    <ul class="social">
                        <li><a href="<?php echo PATH ?>product/<?php echo $linkProduct; ?>" data-tip="Quick View"><i class="fa fa-eye"></i></a></li>
                        <li><a data-id="<?php echo $id; ?>" data-type="<?php echo $type; ?>" data-size="<?php echo $size; ?>" href="javascript:void(0);" class="addtocart" data-tip="Add to Cart"><i class="fa fa-shopping-cart"></i></a></li>
                    </ul>
                    <?php
					if($today < $six){
					?>
                    
                   <span class="product-new-label d-none d-lg-block">New</span>
                   <?php
	}
				   ?>
                   <span class="product-discount-label"><?php echo $type ?></span>
                </div>
                <div class="product-content">
                    <h3 class="title"><a href="<?php echo PATH ?>product/<?php echo $linkProduct; ?>"><?php echo $title ?></a></h3>
                    <span class="small text-primary d-none d-lg-block"><?php echo $short_desc?></span><br />
                    <span class="small p-2 d-none d-lg-block mb-3">Released: <?php echo $released ?></span>
                    <div class="price">
                       €<?php echo $price ?>
                        <?php /*?><span>$16.00</span><?php */?>
                    </div>
                    <a class="add-to-cart" data-id="<?php echo $id; ?>" data-type="<?php echo $type; ?>" data-size="<?php echo $size; ?>"  href="javascript:void(0);"><i class="fas fa-shopping-cart mr-3 "></i> ADD TO CART</a>
                </div>
            </div>
        </div>
        
        
        <?php
		}
	
	}
		?>
        
    </div>
    
</div>
<?php
include "payment.php";
?>
            
            									<?php /*?><div class="social-share">
										<span>Share:</span>
										<a href="#"><i class="fa fa-facebook"></i></a>
										<a href="#"><i class="fa fa-twitter"></i></a>
										<a href="#"><i class="fa fa-google-plus"></i></a>
										<a href="#"><i class="fa fa-pinterest"></i></a>
									</div><?php */?>