<?php
include "inc/menu_nav.php"
?>

                            <div class="row d-flex justify-content-center">
							<div class="col-md-10">
                            <table id="cart" class="table table-hover table-dark table-condensed">
    				<thead>
						<tr>
							<th style="width:50%">Item</th>
							
							<th style="width:10%"></th>
						</tr>
					</thead>
					<tbody>
                     <?php
					$total = 0;
					$SQL = mysqli_query($connect, "SELECT a.*, b.title, b.image FROM tb_review a LEFT JOIN tb_shop_products b ON a.id_product = b.id");
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
										<h6><strong><?php echo $name; ?> (<?php echo $email; ?>)</strong></h6>
										<p><?php echo $message; ?></p>
									</div>
								</div>
							</td>
							
							<td class="actions" align="right" data-th="">
								<button onclick="location.href='<?php echo PATH ?>edit-review/<?php echo $id?>'" class="btn btn-info btn-sm"><i class="fa fa-edit"></i></button>
				<button class="btn btn-danger btn-sm delete-cart" onclick="location.href='<?php echo PATH ?>send/delete-review/<?php echo $id?>'">
                                <i class="fa fa-trash-o"></i></button>						
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
                       