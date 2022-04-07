<?php
if($ADMIN == ""){
header("Location: ".PATH);	
}
?>
<?php
include "inc/menu_nav.php"
?>
<main class="main-content">
				<div class="">
					<div class="container">
                    <?php
extract($_POST, EXTR_OVERWRITE);
extract($_GET, EXTR_OVERWRITE);
?>
<?php
		$SQL = mysqli_query($connect, "SELECT * FROM tb_spotify ORDER BY dt_cad DESC") or die(mysqli_error($connect));
		if(mysqli_num_rows($SQL)){
		?>
        <div class="row">
        <div class="col-lg-12">
       <table class="table table-dark">
  <thead>
    <tr>
      <th scope="col">Name</th>
      <th scope="col">Followers</th>
      <th scope="col">E-mail</th>
    </tr>
  </thead>
  <tbody>
<?php
while($SQL_Q = mysqli_fetch_assoc($SQL)){
$name = $SQL_Q["user_name"];
$email = $SQL_Q["user_email"];
$followers = $SQL_Q["user_followers"];
$date = date ("H:i:s | d-M-Y", strtotime($SQL_Q["dt_cad"]));

?>
    <tr style="background-color:#FF9;color:black;">
      <th scope="row" align="center"><?php echo $name ?></th>
      <td><?php echo $email ?></td>
      <td><?php echo $followers ?></td>
      <td><?php echo $date ?></td>
         </tr>
<?php
}
		}
?>
</table>

					</div></div>
                    </div>
				</div> <!-- .testimonial-section -->
               

				
			</main> <!-- .main-content -->