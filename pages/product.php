<?php
if($ADMIN != ""){
	include "seo.php";
}
?>
<script language="javascript" type="text/javascript">
	jQuery(document).ready(function($){
	    
	$(".btnrating").on('click',(function(e) {
	
	var previous_value = $("#selected_rating").val();
	
	var selected_value = $(this).attr("data-attr");
	$("#selected_rating").val(selected_value);
	
	$(".selected-rating").empty();
	$(".selected-rating").html(selected_value);
	
	for (i = 1; i <= selected_value; ++i) {
	$("#rating-star-"+i).toggleClass('btn-warning');
	$("#rating-star-"+i).toggleClass('btn-default');
	}
	
	for (ix = 1; ix <= previous_value; ++ix) {
	$("#rating-star-"+ix).toggleClass('btn-warning');
	$("#rating-star-"+ix).toggleClass('btn-default');
	}
	
	}));
	
	$(".form_review").submit(function(){
	var selected_rating = $("#selected_rating").val();
	if(selected_rating == ""){
	alert("Please! You need to rate it first!");
	return false;	
	}else{
	return true;	
	}
	})
	
		
});


</script>
<main class="main-content">
				<div class="fullwidth-block">
                <?php
				include "inc/cart.php";
				?>
                <div class="container my-2 py-1">
                <?php
	$id = explode("-", $_GET["b"]);
	$id = $id[0];
	$id_product = $id;
	$SQL = mysqli_query($connect, "SELECT *, DATE_FORMAT(released, '%Y') as released FROM `tb_shop_products` WHERE `status` = 'Y' AND `id` = $id LIMIT 1");
	if(mysqli_num_rows($SQL) > 0){
	while($SQL_Q = mysqli_fetch_assoc($SQL))
	extract($SQL_Q, EXTR_OVERWRITE);
	$price = number_format((float)$price, 2, '.', '');
	
	?>
   <div class="row">
         <div class="col-md-6 col-sm-6">
        <div class="card text-white bg-dark p-2 mt-2">
          <img class="card-img-top" src="<?php echo $image ?>" alt="">
        </div>
        
        </div>
        <div class="col-md-6 col-sm-6">
        <div class="card text-white bg-dark mt-2">
          <div class="card-body">
            <h3 class="card-title"><?php echo $title ?></h3>
            <span class="small text-primary"><?php echo $short_desc?></span><br />
                    <span class="small my-2">Released: <?php echo $released ?></span>
            
            <p class="card-text"><?php echo $desc ?></p>
          </div>
          <div class="d-flex text-center my-3">
          
          <h5 class=" flex-fill">  <span class="mr-2">Price: </span>€<?php echo $price ?></h5>
          <?php /*?><div class="flex-fill">
        <span class="mr-2">Share:</span>
        <span class="mx-1"><a href="#"><i class="fa fa-facebook"></i></a></span>
        <span class="mx-1"><a href="#"><i class="fa fa-twitter"></i></a></span>
        <span class="mx-1"><a href="#"><i class="fa fa-google-plus"></i></a></span>
        <span class="mx-1"><a href="#"><i class="fa fa-pinterest"></i></a></span>
   		</div><?php */?>
          </div>
          
          <div class="product-grid4 mb-0">
                    <a class="add-to-cart d-block" data-id="<?php echo $id; ?>" data-type="<?php echo $type; ?>" data-size="<?php echo $size; ?>"  href="javascript:void(0);"><i class="fas fa-shopping-cart mr-3"></i> ADD TO CART</a>
                </div>
          </div>
        </div>
        <?php
		if($link != ""){
		$link = explode("v=", $link);
		?>
        <div class="embed-responsive embed-responsive-16by9 z-depth-1-half my-3">
          <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/<?php echo $link[1]?>"
            allowfullscreen></iframe>
        </div>
        <?php
		}
		?>
        </div>
        <!-- /.card -->
<?php 
		$S1 = 0;
		$S2 = 0;
		$S3 = 0;
		$S4 = 0;
		$S5 = 0;
		$n_stars = 0;
	   $SQL1 = mysqli_query($connect, "SELECT * FROM `tb_review` WHERE `id_product` = $id_product OR `id_product` = $id_type");
	   $total = mysqli_num_rows($SQL1);
	   
	   while($SQL_Q1 = mysqli_fetch_assoc($SQL1)){
		 extract($SQL_Q1, EXTR_OVERWRITE);
		 if($rating == 1) {$S1++;$n_stars = $n_stars+1;} 
		 if($rating == 2) {$S2++;$n_stars = $n_stars+2;} 
		 if($rating == 3) {$S3++;$n_stars = $n_stars+3;} 
		 if($rating == 4) {$S4++;$n_stars = $n_stars+4;} 
		 if($rating == 5) {$S5++;$n_stars = $n_stars+5;} 
		  $average = ceil ($n_stars/$total);
	   }
	   if(!isset($average)) $average = 5;
	  
	   $stars = "";
	   
	   ?>
       
  <div class="my-4">
<div class="card card-outline-secondary my-4">
       
          <div class="card-header">
           Average user rating
          </div>
          <div class="card-body">
			<div class="col-sm-6">
				<div class="">
					<h2 class="bold padding-bottom-7"><?php echo $average?> <small>/ 5</small></h2>
                    <?php
					for($i=0;$i<5;$i++){
					if($i < $average){
					?>
					<button type="button" class="btn btn-warning btn-sm" aria-label="Left Align">
					  <span class="fa fa-star" aria-hidden="true"></span>
					</button>
					<?php
					}else{
					?>
                    <button type="button" class="btn btn-default btn-grey btn-sm" aria-label="Left Align">
					  <span class="fa fa-star" aria-hidden="true"></span>
					</button>
                    
                    <?php	
					}
					}
					?>
					
				</div>
			</div>
			<div class="col-sm-3">
            <div class="mt-5 d-md-none d-sm-block"></div>
				<h4>Rating breakdown</h4>
				<div class="pull-left">
					<div class="pull-left" style="width:35px; line-height:1;">
						<div style="height:9px; margin:5px 0;">5 <i class="fa fa-star text-warning" aria-hidden="true"></i></div>
					</div>
					<div class="pull-left" style="width:180px;">
						<div class="progress" style="height:9px; margin:8px 0;">
						  <div class="progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar" aria-valuenow="5" aria-valuemin="0" aria-valuemax="5" style="width: <?php echo ($S5/$total*100); ?>%">
							<span class="sr-only">80% Complete (danger)</span>
						  </div>
						</div>
					</div>
					<div class="pull-right" style="margin-left:10px;"><?php echo $S5; ?></div>
				</div>
				<div class="pull-left">
					<div class="pull-left" style="width:35px; line-height:1;">
						<div style="height:9px; margin:5px 0;">4 <i class="fa fa-star text-warning" aria-hidden="true"></i></div>
					</div>
					<div class="pull-left" style="width:180px;">
						<div class="progress" style="height:9px; margin:8px 0;">
						  <div class="progress-bar progress-bar-striped progress-bar-animated bg-primary" role="progressbar" aria-valuenow="4" aria-valuemin="0" aria-valuemax="5" style="width: <?php echo ($S4/$total*100); ?>%">
							<span class="sr-only">80% Complete</span>
						  </div>
						</div>
					</div>
					<div class="pull-right" style="margin-left:10px;"><?php echo $S4; ?></div>
				</div>
				<div class="pull-left">
					<div class="pull-left" style="width:35px; line-height:1;">
						<div style="height:9px; margin:5px 0;">3 <i class="fa fa-star text-warning" aria-hidden="true"></i></div>
					</div>
					<div class="pull-left" style="width:180px;">
						<div class="progress" style="height:9px; margin:8px 0;">
						  <div class="progress-bar progress-bar-striped progress-bar-animated bg-info" role="progressbar" aria-valuenow="3" aria-valuemin="0" aria-valuemax="5" style="width: <?php echo ($S3/$total*100); ?>%">
							<span class="sr-only">80% Complete</span>
						  </div>
						</div>
					</div>
					<div class="pull-right" style="margin-left:10px;"><?php echo $S3; ?></div>
				</div>
				<div class="pull-left">
					<div class="pull-left" style="width:35px; line-height:1;">
						<div style="height:9px; margin:5px 0;">2 <i class="fa fa-star text-warning" aria-hidden="true"></i></div>
					</div>
					<div class="pull-left" style="width:180px;">
						<div class="progress" style="height:9px; margin:8px 0;">
						  <div class="progress-bar progress-bar-striped progress-bar-animated bg-warning" role="progressbar" aria-valuenow="2" aria-valuemin="0" aria-valuemax="5" style="width: <?php echo ($S2/$total*100); ?>%">
							<span class="sr-only">80% Complete</span>
						  </div>
						</div>
					</div>
					<div class="pull-right" style="margin-left:10px;"><?php echo $S2; ?></div>
				</div>
				<div class="pull-left">
					<div class="pull-left" style="width:35px; line-height:1;">
						<div style="height:9px; margin:5px 0;">1 <i class="fa fa-star text-warning" aria-hidden="true"></i></div>
					</div>
					<div class="pull-left" style="width:180px;">
						<div class="progress" style="height:9px; margin:8px 0;">
						  <div class="progress-bar progress-bar-striped progress-bar-animated bg-danger" role="progressbar" aria-valuenow="1" aria-valuemin="0" aria-valuemax="5" style="width: <?php echo ($S1/$total*100); ?>%">
							<span class="sr-only">80% Complete</span>
						  </div>
						</div>
					</div>
					<div class="pull-right" style="margin-left:10px;"><?php echo $S1; ?></div>
				</div>
			</div>			
		</div>
</div>
</div>
       <div class="card card-outline-secondary my-4">
       
          <div class="card-header">
            Reviews of this album
          </div>
          <div class="card-body">
          <?php 
	   $SQL = mysqli_query($connect, "SELECT *, DATE_FORMAT(`dt_cad`, '%d of %M, %Y') as dt_cad FROM `tb_review` WHERE `id_product` = $id_product OR `id_product` = $id_type ORDER BY `dt_cad` DESC");
	   while($SQL_Q = mysqli_fetch_assoc($SQL)){
		 extract($SQL_Q, EXTR_OVERWRITE);
	   ?>
       
            <p><?php echo $message ?>
            </p>
            <small class="text-muted">Posted by <?php echo $name ?> on <?php echo $dt_cad ?> <?php
			for($i=0;$i<$rating;$i++){
			echo '<i class="fa fa-star text-warning" aria-hidden="true"></i> ';	
			}
			?></small>
            <hr>
            
            <?php
	   }
            ?>
           
            <?php /*?><a href="#" class="btn btn-success">Leave a Review</a><?php */?>
            
          </div>
          <table width="100%" border="0">
      <div class="col-md-12 col-md-offset-0">
        <tr width="100%"><td>
        <div class="col">
          <form class="form-horizontal form_review" action="<?php echo PATH ?>send" method="post" name="form_review">
          <input type="hidden" name="req" value="add_review" />
          <input type="hidden" name="id_product" value="<?php echo $id_product;?>" />
          <fieldset>
    
            <!-- Name input-->
            <div class="form-group">
              <label class="col-md-3 control-label" for="name">Your name</label>
              <div class="col-md-9 mb-3">
                <input id="name" name="name" required="required" type="text" placeholder="Your name" class="form-control">
              </div>
            </div>
    
            <!-- Email input-->
            <div class="form-group">
              <label class="col-md-3 control-label" for="email">Your e-mail</label>
              <div class="col-md-9 mb-3">
                <input id="email" name="email" type="email" required="required" placeholder="Your email" class="form-control">
              </div>
            </div>
    
            <!-- Message body -->
            <div class="form-group">
              <label class="col-md-3 control-label" for="message">Your message</label>
              <div class="col-md-9 mb-3">
                <textarea class="form-control" id="message" required="required" name="message" placeholder="Please enter your feedback here..." rows="5"></textarea>
              </div>
            </div>


            <!-- Rating -->
            <div class="form-group" id="rating-ability-wrapper">
            <label class="col-md-3 control-label" for="message">Rating</label>
	    <label class="control-label" for="rating">
	    <span class="field-label-info"></span>
	    <input type="hidden" id="selected_rating" name="rating" value="" required="required">
	    </label>
	    
	    <div class="col-md-12 mb-3">
        <button type="button" class="btnrating btn btn-default" data-attr="1" id="rating-star-1">
	        <i class="fa fa-star" aria-hidden="true"></i>
	    </button>
	    <button type="button" class="btnrating btn btn-default" data-attr="2" id="rating-star-2">
	        <i class="fa fa-star" aria-hidden="true"></i>
	    </button>
	    <button type="button" class="btnrating btn btn-default" data-attr="3" id="rating-star-3">
	        <i class="fa fa-star" aria-hidden="true"></i>
	    </button>
	    <button type="button" class="btnrating btn btn-default" data-attr="4" id="rating-star-4">
	        <i class="fa fa-star" aria-hidden="true"></i>
	    </button>
	    <button type="button" class="btnrating btn btn-default" data-attr="5" id="rating-star-5">
	        <i class="fa fa-star" aria-hidden="true"></i>
	    </button>
        </div>
	</div>
    </td>
    </tr>
    <tr width="100%">
    <td align="center" valign="bottom" >
            <!-- Form actions -->
            <div class="form-group">
              <div class="col-md-12 text-center my-3">
                
                <button type="submit" class="btn btn-primary btn-md">Submit</button>
                <button type="reset" class="btn btn-default btn-md">Clear</button>
              </div>
            </div>
          </fieldset>
          </form>
        </div>
    </div>
    </td>
    </tr>
    </table>
        </div>
        <!-- /.card -->
        

      
      <?php
	}
	  ?>
      </div>
                
                 <?php
				include "inc/shop.php";
				?>
					
				</div> <!-- .testimonial-section -->

				
			</main> <!-- .main-content -->
            
            									