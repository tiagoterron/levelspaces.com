<?php
if($ADMIN != ""){
	include "seo.php";
}
?>
<main class="main-content">
				<div class="fullwidth-block inner-content">
					<div class="container">
                    <?php

					if($_GET["s"] == "ok"){
					?>
                    <div class="col-*-12 alert alert-success">Thank you for your message</div>
					<?php
					}
					?>	
                        <h2 class="page-title">Contact Us</h2>
						<div class="row">
							<div class="col-md-6">
								<form action="send" class="contact-form form-captcha" id="form-contact" method="post">
                                <input type="hidden" value="contact" name="req" />
									<input type="text" required="required" name="name" placeholder="Your name"..>
									<input type="text" required="required" name="email" placeholder="Email Address..">
									<input type="text" required="required" name="subject" placeholder="Subject...">
									<textarea name="message" required="required" placeholder="Message..."></textarea>
                                    <div id="captcha"></div>
									<input type="submit" value="Send message">
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
					</div>
				</div> <!-- .testimonial-section -->

				
			</main> <!-- .main-content -->