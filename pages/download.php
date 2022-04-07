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
$id_email = $_GET["d"];
if(isset($id_email)){
$SQL = mysqli_query($connect, "SELECT clicks FROM `tb_log_email_sent` WHERE `id_email` = '$id_email' LIMIT 1") or die(mysqli_error($connect));
if(mysqli_num_rows($SQL)){
$SQL_Q = mysqli_fetch_assoc($SQL);
$clicks = $SQL_Q["clicks"];
mysqli_query($connect, "UPDATE `tb_log_email_sent` SET `clicks` = '$clicks;DOWNLOAD' WHERE `id_email` = '$id_email'");	
}
}

if($_GET["b"] == ""){
$id_trans = $_SESSION["id_trans"];
}elseif($_GET["b"] == "wav" or $_GET["b"] == "mp3" or $_GET["b"] == "pdf"){
$id_trans = $_GET["c"];

$SQL = "SELECT * FROM `tb_kit` WHERE `id_trans` = '$id_trans' AND `payment_status` = 'CONFIRMED'";
$SQL = mysqli_query($connect, $SQL) or die(mysql_error($connect));
if(!mysqli_num_rows($SQL) and $_GET["b"] != "pdf"){
if($id_trans != "universo_paralelo"){
header("Location:".PATH);
die;
}
}


if($_GET["b"] == "wav"){
header("Location: https://www.dropbox.com/s/b0mm1l1jx19arx9/level_spaces_universo_paralelo_2020_wav2.rar?dl=0");
//$filepath = "songs/level_spaces_universo_paralelo_2020_wav.rar";
}elseif($_GET["b"] == "pdf"){
	header("Location: https://levelspaces.com/level_spaces_presskit_2021.pdf");
}else{
header("Location: https://www.dropbox.com/s/pb2k1etjj2jc294/level_spaces_universo_paralelo_2020_mp32.rar?dl=0");
}

die;


	
}else{
$id_trans = $_GET["b"];
}

$SQL = "SELECT * FROM `tb_kit` WHERE `id_trans` = '$id_trans' AND `payment_status` = 'CONFIRMED'";
$SQL = mysqli_query($connect, $SQL) or die(mysql_error($connect));
if(!mysqli_num_rows($SQL)){
if($id_trans != "universo_paralelo"){
header("Location:".PATH);
die;
}
}
$SQL_Q = mysqli_fetch_assoc($SQL);
extract($SQL_Q, EXTR_OVERWRITE);

$date_now = date("Y-m-d"); // this format is string comparable
?>
<main class="main-content">
				<div class="fullwidth-block download">
					<div class="container">
						<div class="row">
                       
                        <div class="col-md-12">
								
                                <div class="col-md-12">
                                <p class="text-justify text-white">Dear <strong><?php echo $first_name." ".$last_name; ?></strong>,</p>
                              
                                     <p class=" text-white">Thank you for ordering our music.<br /> Now, you can listen to our new album or download it in WAV or MP3.<br /><br />Important! Use <strong>WinRar</strong> to uncompress the file and so reach the songs.

                                  <div class="row my-5">
<div class="d-flex mx-auto">
	<div class="p-2"><a href="<?php echo PATH ?>download/wav/<?php echo $id_trans; ?>" target="_blank"><img class="w25p" src="<?php echo PATH ?>images/icons/wav.png" /></a></div>
    <div class="p-2"><a href="<?php echo PATH ?>download/mp3/<?php echo $id_trans; ?>" target="_blank"><img class="w25p" src="<?php echo PATH ?>images/icons/mp3.png" /></a></div>
</div></div>
<div class="col-lg-12" id="player">
                        
                        </div>
                                  	
                                
                                   
<p class="text-justify"><a href="<?php echo PATH ?>">
          <input type="button" class="btn btn-primary btn-block" value="Go to homepage!" /></a>
                                </p>
                                </div>
						</div>
                        
					</div>
				</div> <!-- .testimonial-section -->

				
			</main> <!-- .main-content -->
          