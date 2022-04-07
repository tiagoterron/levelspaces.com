<script type="text/javascript">
        $(document).ready(function(){
            var description = '';

            $('#player').ttwMusicPlayer(myPlaylist, {
                autoPlay:true, 
                description:description,
                jPlayer:{
                    swfPath:'../plugin/jquery-jplayer' //You need to override the default swf path any time the directory structure changes
                }
            });
        });
    </script>
<?php
$id_email = $_GET["c"];
if(isset($id_email)){
$SQL = mysqli_query($connect, "SELECT clicks FROM `tb_log_email_sent` WHERE `id_email` = '$id_email' LIMIT 1") or die(mysqli_error($connect));
if(mysqli_num_rows($SQL)){
$SQL_Q = mysqli_fetch_assoc($SQL);
$clicks = $SQL_Q["clicks"];
mysqli_query($connect, "UPDATE `tb_log_email_sent` SET `clicks` = '$clicks;LISTEN' WHERE `id_email` = '$id_email'");
header("Location: https://www.youtube.com/watch?v=kOpthuvhTN4");	
}else{
header("Location: https://www.youtube.com/watch?v=kOpthuvhTN4");		
}
}
if($_GET["b"] == ""){
$id_trans = $_SESSION["id_trans"];
}elseif($_GET["b"] == "wav" or $_GET["b"] == "mp3"){
$id_trans = $_GET["c"];
$SQL = "SELECT * FROM `tb_kit` WHERE `id_trans` = '$id_trans' AND `payment_status` = 'CONFIRMED'";
$SQL = mysqli_query($connect, $SQL) or die(mysql_error($connect));
if(!mysqli_num_rows($SQL) or $_GET["c"] != "universo_paralelo"){
header("Location:".PATH);
die;
}

	
}else{
$id_trans = $_GET["b"];
}

if($id_trans != "universo_paralelo"){
header("Location:".PATH);
die;
}
$date_now = date("Y-m-d"); // this format is string comparable
?>
<main class="main-content">
				<div class="fullwidth-block download">
					<div class="container">
						<div class="row">
                       
                        <div class="col-md-12">
								
                        
                                  
<div id="player"></div>
                        
                   

                                
                                   
<p class="text-justify"><a href="<?php echo PATH ?>">
          <input type="button" class="btn btn-primary btn-block" value="Go to homepage!" /></a>
                                </p>
                                </div>
						</div>
                        
					</div>
				</div> <!-- .testimonial-section -->

				
			</main> <!-- .main-content -->
          