<script language="javascript">
$(document).ready(function(){
	$("#saveAsTemplate").click(function(){	
	$("#idReq").val("saveAsTemplate");
	$("#idType").val("venue");
	$(".contact-form").submit();
	})
});
</script>
<?php
$SQL = mysqli_query($connect, "SELECT * FROM `tb_template_email` WHERE `name` = 'venue'");
if(mysqli_num_rows($SQL)){
	$SQL_Q = mysqli_fetch_assoc($SQL);
	$title = $SQL_Q["title"]; 
	$message = $SQL_Q["text"]; 
	$_SESSION["date"] = $SQL_Q["dates"]; 
}
if(!isset($_SESSION["date"])){
	$_SESSION["date"] = "11.11 | 12.11 | 13.11 | 18.11 | 19.11 | 20.11 | 25.11 | 26.11 | 27.11";
}
?>

<div class="row">
							<div class="col-md-12">
								<form action="<?php echo PATH ?>send" class="contact-form" method="post">
                                <input type="hidden" value="sendEmail" name="req" id="idReq" />
                                <input type="hidden" value="" name="type" id="idType" />
									<input type="text" name="name" placeholder="Contact name"..>
									<input type="text" required name="email" placeholder="Email Address..">
									<input type="text" required="required" name="subject" placeholder="" value="<?php echo $title; ?>">
                                    <input type="text" required name="city" placeholder="City" value="<?php echo $_SESSION["city"]; ?>">
                                    <input type="text" required name="venue" placeholder="Venue name" value="">
                                    <input type="text" required name="date" placeholder="xx/xx" value="<?php echo $_SESSION["date"]; ?>">
									<textarea name="message" required="required" id="summernote" placeholder=""><?php echo $message; ?></textarea>
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