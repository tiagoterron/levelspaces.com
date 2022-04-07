<?php
$id_product = $_GET["b"];
if($id_product != ""){
$SQL = mysqli_query($connect, "SELECT * FROM tb_shop_products WHERE id = $id_product");
if(mysqli_num_rows($SQL) >0){
$SQL_Q = mysqli_fetch_assoc($SQL);
extract($SQL_Q, EXTR_OVERWRITE);
//print_r($SQL_Q);	
}
}
?>
<?php
include "inc/menu_nav.php"
?>
<div class="row d-flex justify-content-center">
							<div class="col-md-10">
								<form action="<?php echo PATH ?>send" class="contact-form" method="post">
                                <input type="hidden" value="create-product" name="req" />
                                <input type="hidden" value="<?php echo $id_product ?>" name="id_product" />
									<input type="text" name="name" placeholder="Product name" value="<?php echo $title ?>">
                                    <input type="text" name="short_desc" placeholder="Short Description" value="<?php echo $short_desc ?>">
                                    <input type="text" name="price" placeholder="Price" value="<?php echo $price ?>">
                                    <input type="text" name="quantity" placeholder="Quantity in stock" value="<?php echo $quantity ?>">
									<input type="text" name="image1" placeholder="Image 01" value="<?php echo $image ?>">
                                    <input type="text" name="image2" placeholder="Image 02" value="<?php echo $image2 ?>">
                                    <input type="text" name="link" placeholder="Link" value="<?php echo $link ?>">
                                    <input type="text" name="link_download_wav" placeholder="Link Download WAV" value="<?php echo $link_download_wav ?>">
                                    <input type="text" name="link_download_mp3" placeholder="Link Download MP3" value="<?php echo $link_download_mp3 ?>">
                                    <input type="text" name="weight" placeholder="0.1 (WEIGHT)" value="<?php echo $weight ?>">
                                    <input type="text" name="released" placeholder="YYYY-MM" value="<?php echo $released ?>">
                                    <input type="text" name="type" placeholder="type" value="<?php echo $type ?>">
									
									<textarea name="desc" required="required" id="summernote" placeholder=""><?php echo $desc; ?></textarea>
									<input type="submit" value="Save product"></a>
								</form>
							</div>
                            </div>
                            <div class="row d-flex justify-content-center">
							<div class="col-md-10">
                            <table id="cart" class="table table-hover table-dark table-condensed">
    				<thead>
						<tr>
							<th style="width:50%">Item</th>
							<th style="width:10%">Price</th>
							<th style="width:8%">Quantity</th>
							<th style="width:10%"></th>
						</tr>
					</thead>
					<tbody>
                     <?php
					$total = 0;
					$SQL = mysqli_query($connect, "SELECT * FROM tb_shop_products");
					$SQL_N = mysqli_num_rows($SQL);
					$total_amount = 0;
					$total_price = 0;
					if($SQL_N > 0){
					while($SQL_Q = mysqli_fetch_assoc($SQL)){
					extract($SQL_Q, EXTR_OVERWRITE);	
					$price = $SQL_Q["price"];
					$price = number_format((float)$price, 2, '.', '');
					?>
                    <tr>
							<td data-th="Product">
								<div class="row">
									<div class="col-sm-2 hidden-xs"><img src="<?php echo $image ?>" alt="<?php echo $title ?>" class="img-responsive" width="75px"/></div>
									<div class="col-sm-10">
										<h4><a href="<?php echo PATH ?>product/<?php echo $id_product; ?>"><?php echo $title; ?></a></h4>
										<p><?php echo $short_desc; ?></p>
									</div>
								</div>
							</td>
							<td data-th="Price"><?php echo $price; ?> €</td>
							<td data-th="Quantity"><?php echo $quantity; ?></td>
							<td class="actions" align="right" data-th="">
								<button onclick="location.href='<?php echo PATH ?>create-product/<?php echo $id?>'" class="btn btn-info btn-sm"><i class="fa fa-edit"></i></button>
				<?php /*?><button class="btn btn-danger btn-sm delete-cart" data-id="<?php echo $id_product; ?>">
                                <i class="fa fa-trash-o"></i></button><?php */?>							
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

					</tfoot>
				</table>
						</div></div>
                       