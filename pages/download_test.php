<script type="text/javascript">
        $(document).ready(function(){
            var description = '';

            $('#player').ttwMusicPlayer(myPlaylist, {
                autoPlay:false, 
                description:description,
                jPlayer:{
                    swfPath:'../plugin/jquery-jplayer' //You need to override the default swf path any time the directory structure changes
                }
            });
        });
    </script>
<?php
if($_GET["b"] == ""){
$id_trans = $_SESSION["id_trans"];
}else{
$id_trans = $_GET["b"];
}

$SQL = "SELECT * FROM `tb_kit` WHERE `id_trans` = '$id_trans' AND `payment_status` = 'CONFIRMED'";
$SQL = mysqli_query($connect, $SQL) or die(mysql_error($connect));
if(!mysqli_num_rows($SQL)){
header("Location:".PATH);
die;
}
$SQL_Q = mysqli_fetch_assoc($SQL);
extract($SQL_Q, EXTR_OVERWRITE);


?>
<main class="main-content">
				<div class="fullwidth-block download">
					<div class="container">
						<div class="row">
                        <div class="col-lg-12" id="player">
                        
                        </div>
                        <div class="col-md-12">
								
                                <div class="col-md-12">
                                <p class="text-justify">Dear <strong><?php echo $first_name." ".$last_name; ?></strong>,</p>
                                <p>Please, come back on <strong>1st of March (01/03)</strong> to download our new album.<br />
                                  <br />
                                  With love,<br />
                                  Level Spaces</p>
<p class="text-justify"><a href="<?php echo PATH ?>">
          <input type="button" class="btn btn-primary btn-block" value="Go to homepage!" /></a>
                                </p>
                                </div>
						</div>
					</div>
				</div> <!-- .testimonial-section -->

				
			</main> <!-- .main-content -->
          