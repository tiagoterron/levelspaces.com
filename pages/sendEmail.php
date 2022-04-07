<?php
if($ADMIN == ""){
header("Location: ".PATH);	
}
?>
<?php
include "inc/menu_nav.php"
?>
<main class="main-content">
				<div class="fullwidth-block inner-content">
					<div class="container">
                    <?php
					$type = $_GET["b"];
					define('TYPE', $type);
					?>
                    <div class="row">
                    <div class="col-*-2 m-1"><a href="<?php echo PATH ?>sendEmail/venue" type="button" class="btn btn-primary <?php if($type=="venue")echo "disabled"?>">VENUE</a></div>
                    <div class="col*-2 m-1"><a href="<?php echo PATH ?>sendEmail/festival" type="button" class="btn btn-primary <?php if($type=="festival")echo "disabled"?>">FESTIVAL</a></div>
                    <div class="col*-2 m-1"><a href="<?php echo PATH ?>sendEmail/label" type="button" class="btn btn-primary <?php if($type=="label")echo "disabled"?>">LABEL</a></div>
                    <div class="col*-2 m-1"><a href="<?php echo PATH ?>sendEmail/radio" type="button" class="btn btn-primary <?php if($type=="radio")echo "disabled"?>">RADIO/PRESS</a></div>
                    <div class="col*-2 m-1"><a href="<?php echo PATH ?>sendEmail/newsletter" type="button" class="btn btn-primary <?php if($type=="newsletter")echo "disabled"?>">NEWSLETTER</a></div>

                    </div>
                    <?php

					if($_GET["s"] == "ok"){
					?>
                    <div class="col-*-12 alert alert-success">Thank you for your message</div>
					<?php
					}
					?>	
                        <h2 class="page-title">Send e-mail</h2>
						<?php
						if($type == "venue"){ include "inc/email_venue.php"; }
						elseif($type == "festival"){include "inc/email_festival.php";}
						elseif($type == "label"){include "inc/email_label.php";}
						elseif($type == "radio"){include "inc/email_radio.php";}
						elseif($type == "newsletter"){include "inc/email_newsletter.php";}
						?>
					</div>
				</div> <!-- .testimonial-section -->
               

				
			</main> <!-- .main-content -->