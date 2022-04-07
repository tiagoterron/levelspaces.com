<?php
	if($ADMIN != ""){
	$id = $_GET["b"];
	if(isset($id)){
	$SQL = mysqli_query($connect, "SELECT * FROM tb_blog WHERE id = $id");
	if(mysqli_num_rows($SQL)){
	$SQL_Q = mysqli_fetch_assoc($SQL);
	extract($SQL_Q, EXTR_OVERWRITE);	
	if(!preg_match("/http/", $image)){
	$image = PATH."uploads/".$image;	
	}
	}	
	}
	
	?>
<?php
include "inc/menu_nav.php"
?>
<div class="row d-flex justify-content-center">

                        <div class="col-md-10">

<div  style="background-color:#000;">

<form action="#" method="GET" class="contact-form">
                            <div class="upload fs-upload-target" data-upload-options='{"action":"<?php echo PATH ?>_functions/upload.php","theme":""}'></div>
 
                        </form>
                        </div>
<form action="<?php echo PATH ?>send/new-blog" class="contact-form" method="post">
<input type="hidden" value="<?php echo $id ?>" name="id" />
<input type="text" name="image" id="img_upload_text" value="<?php echo $image; ?>" placeholder="Image URL" />
<img src="<?php echo $image ?>" id="img_upload" width="100%" />
<hr />
<input type="text" value="<?php echo $title ?>" name="title" placeholder="Blog title" />

<textarea name="text" id="summernote" placeholder=""><?php echo $text; ?></textarea>
<hr />
<textarea name="meta" placeholder="Meta description"><?php echo $meta; ?></textarea>
<input type="submit" value="Save as template">
								</form>

<div class="both"></div>
  </div>
</div>
                        
<?php
$id = "";
$title = "";
$text = "";	
	}
 ?>

<div class="row d-flex justify-content-center">
							<div class="col-md-10">
                            <table id="cart" class="table table-hover table-dark table-condensed">
    				<thead>
						<tr>
							<th style="width:50%">Title</th>
							<th style="width:10%"></th>
						</tr>
					</thead>
					<tbody>
                     <?php
					$total = 0;
					$SQL = mysqli_query($connect, "SELECT * FROM tb_blog");
					$SQL_N = mysqli_num_rows($SQL);
					if($SQL_N > 0){
					while($SQL_Q = mysqli_fetch_assoc($SQL)){
					extract($SQL_Q, EXTR_OVERWRITE);	
					?>
                    <tr>
							<td data-th="Product">
								<div class="row">
									<div class="col-sm-2 hidden-xs"><img src="<?php echo $image ?>" alt="<?php echo $title ?>" class="img-responsive" width="75px"/></div>
									<div class="col-sm-10">
										<h4><a href="<?php echo PATH ?>blog/<?php echo $id; ?>"><?php echo $title; ?></a></h4>
										<p><?php echo $meta; ?></p>
									</div>
								</div>
							</td>
							<td class="actions" align="right" data-th="">
								<button onclick="location.href='<?php echo PATH ?>new-blog/<?php echo $id?>'" class="btn btn-info btn-sm"><i class="fa fa-edit"></i></button>
				<?php /*?><button class="btn btn-danger btn-sm delete-cart" data-id="<?php echo $id_product; ?>">
                                <i class="fa fa-trash-o"></i></button><?php */?>							
							</td>
						</tr>
                        <?php
					   }
					}
				
					   ?> 
                        </tbody>
					<tfoot>

					</tfoot>
				</table>
						</div></div>
