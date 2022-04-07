<?php
	if($ADMIN != "" and ($_GET["b"] == "edit" or $_GET["c"] == "edit")){
$a = $_GET["a"];

if($_GET["c"] == "edit") $a = $_GET["a"]."/".$_GET["b"];
	?>
<?php
if(!empty($a)){
$SQL = "SELECT * FROM tb_seo WHERE url = '$a'";	
$SQL = mysqli_query($connect, $SQL);
if(mysqli_num_rows($SQL)){
$SQL_Q = mysqli_fetch_assoc($SQL);
	$id = $SQL_Q['id'];
	$title = ent($SQL_Q['title'], "2");
	$text = ent($SQL_Q['text'], "2");
	$tag = ent($SQL_Q['tag'], "2");
	$url = ent($SQL_Q['url'], "2");
	//$image = PATH."uploads/".ent($SQL_Q['image'], "2");
	$image = $SQL_Q['image'];
}else{
$id = "";
$title = "";
$text = "";	
$tag = "";	
$url = $a;
$image = PATH."levelspaces.jpg";
}
}
 ?>
<div class="row d-flex justify-content-center">
<div class="col-md-10" style="background-color:#000;">
<?php
if($SQL_Q['image'] ==""){
$image = PATH."levelspaces.jpg";
}
?>
<form action="#" method="GET" class="contact-form">
                            <div class="upload fs-upload-target" data-upload-options='{"action":"<?php echo PATH ?>_functions/upload.php","theme":""}'></div>
                           <center>
 <img src="<?php echo $image ?>" id="img_upload" class="d-flex justify-content-center m-3" width="450px" />
</center>
                            
                           <?php /*?> <div class="filelists">
                                <h5>Complete</h5>
                                <ol class="filelist complete">
                                </ol>
                                <h5>Queued</h5>
                                <ol class="filelist queue">
                                </ol>
                            </div><?php */?>
                        </form>
                        </div>
                        <div class="col-md-10">
        <form method="post" class="contact-form" action="<?php echo PATH ?>send/saveSeo">
        <input type="text" readonly="readonly" class="required i_radious i_account" value="<?php echo $url; ?>" name="url" />
		
                        
        <input type="input" name="title" class="required i_radious i_account" value="<?php echo $title; ?>" />
<?php /*?>        <input type="input" name="image" class="i_radious i_account" value="<?php echo $image; ?>" /><?php */?>
  <textarea name="text" class=" i_radious i_account h50"><?php echo $text; ?></textarea>
  <input type="text" name="img_upload_text" id="img_upload_text" value="<?php echo $image; ?>" />
  <textarea name="tag" class=" i_radious i_account h50"><?php echo $tag; ?></textarea>
 <input type="submit" class="btn-primary">
  <br clear="all" />
</form>

<div class="both"></div>
  </div>
</div>
                        
<?php
$id = "";
$title = "";
$text = "";	
	}
 ?>

