<?php

mysqli_query($connect, "DELETE FROM tb_user_online WHERE user_id = ".ID) or die(mysqli_error($connect));


$_SESSION["user_on"] = false;
$_SESSION["id"] = "";
$_SESSION["email"] = "";
$_SESSION["name"] = "";
$_SESSION["type"] = "";
$_SESSION["member"] = "";
$_SESSION["guest_email"] = "";
$_SESSION["guest_name"] = "";
$_SESSION["guest_ref_id"] = "";

unset($_SESSION["iuser_on"]);
unset($_SESSION["id"]);
unset($_SESSION["email"]);
unset($_SESSION["name"]);
unset($_SESSION["type"]);
unset($_SESSION["member"]);
unset($_SESSION["guest_name"]);
unset($_SESSION["guest_email"]);
unset($_SESSION["guest_ref_id"]);


call_notice("", "You logout of your account!", "2");
header("Location: ".PATH."login");

?>