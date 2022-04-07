<?php
$name = $_GET["b"];
$SQL = mysqli_query($connect, "SELECT * FROM `tb_template_email` WHERE `name` = '$name'");
if(mysqli_num_rows($SQL)){
	$SQL_Q = mysqli_fetch_assoc($SQL);
	$title = $SQL_Q["title"]; 
	$message = $SQL_Q["text"]; 
}
?>
<div class="row d-flex justify-content-center">
							<div class="col-md-10">
								<form action="<?php echo PATH ?>send" class="contact-form" method="post">
                                <input type="hidden" value="messagesTemplate" name="req" />
                                <input type="text" value="<?php echo $name ?>" name="name" />
                                <h2 class="col">INVOICE</h2>
									<input type="text" required="required" name="subject" placeholder="" value="<?php echo $title; ?>">
									<textarea name="message" required="required" id="summernote" placeholder=""><?php echo $message; ?></textarea>
									<input type="submit" value="Save as template">
								</form>
							</div>

						</div>