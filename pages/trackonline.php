<?php
if($_GET["a"] == "trackonline"){
	$id_email = $_GET["b"];
	$SQL = mysqli_query($connect, "UPDATE tb_log_email_sent SET status = 'OPENED' WHERE id_email = '$id_email' AND status = 'UNREAD'");
}

?>