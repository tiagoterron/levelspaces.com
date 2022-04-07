<script language="javascript">
$(document).ready(function(){
	$("#saveAsTemplate").click(function(){	
	$("#idReq").val("saveAsTemplate");
	$("#idType").val("newsletter");
	$(".contact-form").submit();
	})
});
</script>
<?php
$SQL = mysqli_query($connect, "SELECT * FROM `tb_template_email` WHERE `name` = 'newsletter'");
if(mysqli_num_rows($SQL)){
	$SQL_Q = mysqli_fetch_assoc($SQL);
	$title = $SQL_Q["title"]; 
	$message = $SQL_Q["text"]; 
}
?>

<div class="row">
							<div class="col-md-12">
								<form action="<?php echo PATH ?>send/sendNewsletter" class="contact-form" method="post">
                                <input type="hidden" value="sendNewsletter" name="req" id="idReq" />
                                <input type="hidden" value="" name="type" id="idType" />
                                <?php
								$SQL = "SELECT * FROM `tb_newsletter` WHERE `status` = 'Y' ORDER BY id DESC";
	$SQL = mysqli_query($connect, $SQL);
	$SQL_N = mysqli_num_rows($SQL);
	while($SQL_Q = mysqli_fetch_assoc($SQL)){
		extract($SQL_Q, EXTR_OVERWRITE);
		$emails[] = $email;
	}
	$_SESSION["emails"] = implode(";", $emails);
								?>
									<input type="text" required="required" name="subject" placeholder="" value="<?php echo $title; ?>">
                                    <input type="text" value="<?php echo implode(";", $emails)?>" name="emails"/>																		<textarea name="message" required="required" id="summernote" placeholder=""><?php echo $message; ?></textarea>
									<input type="button" value="Save as template" id="saveAsTemplate"><input type="submit" value="Send message"></a>

								</form>
							</div>
							<?php /*?><div class="col-md-6">
								<div class="map-wrapper">
									<div class="map"></div>
									<address>
										<div class="row">
											<div class="col-sm-6">
												<strong>Company Name INC.</strong>
												<span>40 Sibley St, Detroit</span>
											</div>
											<div class="col-sm-6">
												<a href="mailto:office@companyname.com">office@companyname.com</a> <br>
												<a href="tel:532930098891">(532) 930 098 891</a>
											</div>
										</div>
									</address>
								</div>
							</div><?php */?>
						</div>
                         <?php
				include "inc/logs_email_sent.php";
				?>