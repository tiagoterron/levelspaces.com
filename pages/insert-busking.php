<?php
$id = $_GET["b"];
if($id != ""){
$SQL = mysqli_query($connect, "SELECT * FROM tb_insert_busking WHERE id = $id");
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
                                <input type="hidden" value="create-insert-busking" name="req" />
                                <input type="hidden" value="<?php echo $id ?>" name="id" />
								<input type="text" name="spot" placeholder="SPOT" value="<?php echo $spot ?>">
                                 <input type="text" name="amount" placeholder="00.00 EUR" value="<?php echo $amount?>">
                                 <input type="text" name="cds" placeholder="CDS" value="<?php echo $cds ?>">																	
                                 <input type="text" name="date" placeholder="DATE YYYY-MM-DD" value="<?php echo date("Y-m-d") ?>">
                                
									<input type="submit" value="Save"></a>
								</form>
							</div>
                            </div>
                            <div class="row d-flex justify-content-center">
							<div class="col-md-10">
                            <table id="cart" class="table table-hover table-dark table-condensed">
    				<thead>
						<tr>
                        	<th style="width:20%">Date</th>
							<th style="width:50%">Spot</th>
							<th style="width:15%">Amount</th>
							<th style="width:15%">CDs</th>
							<th style="width:5%"></th>
						</tr>
					</thead>
					<tbody>
                     <?php
					$total = 0;
					$first_month = "";
					$next_month = "";
					$cds_total = 0;
					$SQL = mysqli_query($connect, "SELECT *, DATE_FORMAT(`date`, '%d-%b-%Y') as `date_formatted`, DATE_FORMAT(`date`, '%b') as `mes` FROM tb_insert_busking ORDER BY STR_TO_DATE(`date_formatted`,'%d-%b-%Y') DESC");
					$SQL_N = mysqli_num_rows($SQL);
					$total_amount = 0;
					$total_price = 0;
					$loop = 0;
					if($SQL_N > 0){
					while($SQL_Q = mysqli_fetch_assoc($SQL)){
					extract($SQL_Q, EXTR_OVERWRITE);	
					$amount = $SQL_Q["amount"];
					$amount = number_format((float)$amount, 2, '.', '');
					$total_amount += $amount;
					$cds_total += $cds;
					$mes_cds[$mes] += $cds;
					?>
                    <tr>
                    		<td data-th="Date"><h4><?php echo $date_formatted; ?></h4></td>
							<td data-th="Spot">
								<div class="row">
									
									<div class="col-sm-8">
										<h4><a href="<?php echo PATH ?>insert-busking-data/<?php echo $id_insert_busking; ?>"><?php echo $spot; ?></a></h4>
									</div>
								</div>
							</td>
                            <td data-th="Amount"><h4><?php echo $amount; ?> €</h4></td>
							<td data-th="CDs"><h4><?php echo $cds; ?></h4></td>
							<td class="actions" align="right" data-th="">
								<button onclick="if(window.confirm())location.href='<?php echo PATH ?>send/delete-busking/<?php echo $id?>'" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
				<?php /*?><button class="btn btn-danger btn-sm delete-cart" data-id="<?php echo $id_product; ?>">
                                <i class="fa fa-trash-o"></i></button><?php */?>							
							</td>
						</tr>
                        <?php
					   }
					}
					$total_amount = number_format((float)$total_amount, 2, '.', '');

					   ?> 
                       <tr>
                        	<th colspan="5" align="right" width="100%"><h2>SETS: <?php echo $SQL_N; ?> | TOTAL: <?php echo $total_amount ?> | CDs: <?php echo $cds_total;?></h2></th>
                            </tr>
                            <tr>
                        	<th colspan="5" align="right" width="100%"><h2 style="color:white;"><?php  
							
							foreach($mes_cds as $k => $v){
							echo $k. " - ".$v." CDS <br>";	
							}
							?></h2></th>
                            </tr>
                        </tbody>
					<tfoot>

					</tfoot>
				</table>
						</div></div>
                       