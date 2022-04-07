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
		$SQL = mysqli_query($connect, "SELECT * FROM tb_newsletter ORDER BY dt_cad DESC") or die(mysqli_error($connect));
		if(mysqli_num_rows($SQL)){
		?>
        <div class="row">
        <div class="col-lg-12">
       <table class="table table-dark">
  <thead>
    <tr>
      <th scope="col">Name</th>
      <th scope="col">E-mail</th>
      <th scope="col">Date</th>
      <th scope="col">Actions</th>
    </tr>
  </thead>
  <tbody>
<?php
while($SQL_Q = mysqli_fetch_assoc($SQL)){
$name = $SQL_Q["name"];
$email = $SQL_Q["email"];
$date = date ("H:i:s | d-M-Y", strtotime($SQL_Q["dt_cad"]));

?>
    <tr style="background-color:#6FC;color:black;">
      <th scope="row" align="center"><?php echo $name ?></th>
      <td><?php echo $email ?></td>
      <td><?php echo $date ?></td>
      <td><a href="<?php echo PATH ?>send/deleteNewsletter/<?php echo $email ?>" style="color:#000;">[X]</a></td>
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