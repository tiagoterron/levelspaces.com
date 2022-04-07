<?php





extract($_POST, EXTR_OVERWRITE);
extract($_GET, EXTR_OVERWRITE);
?>

<?php
		$SQL = mysqli_query($connect, "SELECT * FROM tb_log_email_sent WHERE `type` = '".TYPE."' ORDER BY date DESC") or die(mysqli_error($connect));
		if(mysqli_num_rows($SQL)){
		?>
        <table class="table table-striped">
  <thead>
    <tr style="color:white;">

      <th scope="col">Company </th>
      <th scope="col">E-mail </th>
       <th scope="col" align="right">[ACTION]</th>
    </tr>
  </thead>
  <tbody>
<?php
while($SQL_Q = mysqli_fetch_assoc($SQL)){
$id = $SQL_Q["id"];
$name = $SQL_Q["name"];
$email = $SQL_Q["email"];
$city = $SQL_Q["city"];
$venue = $SQL_Q["venue"];
$status = $SQL_Q["status"];
$clicks = $SQL_Q["clicks"];
$clicks = explode(";", $clicks);
$LISTEN = 0;
$DOWNLOAD = 0;
foreach($clicks as $k => $v){
	if($v == "LISTEN") $LISTEN++;
	if($v == "DOWNLOAD") $DOWNLOAD++;
}
$sent_by = $SQL_Q["sent_by"];
$date = date ("H:i:s | d-M-Y", strtotime($SQL_Q["date"]));
$date_read = date ("H:i:s | d-M-Y", strtotime($SQL_Q["date"]));

if($status == "READ"){
$bgColor = "#6F6";	
}elseif($status == "OPENED"){
$bgColor = "#FF6";	
}else{
$bgColor = "#F99";	
}?>
    <tr style="background-color:<?php echo $bgColor; ?>;color:">
      <th scope="row"><?php echo $venue ?><br /><?php echo "L: ".$LISTEN." / D: ".$DOWNLOAD ?></th>
      <td><a style="color:darkblue" href="<?php echo $email?>"><?php echo substr($email, 0, 10) ?>...</a><br /> <?php echo $date_read ?></td><td align="right"><a href="<?php echo PATH ?>send/deleteEmailLog/<?php echo $id ?>" style="color:#000">[X]</a></td>
         </tr>
<?php
}
		}
?>
</table>