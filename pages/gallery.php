<?php
if($ADMIN != ""){
	include "seo.php";
}
?>
<main class="main-content">
				<div class="fullwidth-block gallery">
					<div class="container">
						<div class="content fullwidth">
                        <?php
						if($ADMIN != ""){
						?>
                        <form action="<?php echo PATH ?>send/uploadPhotos/" method="POST" class="contact-form">
                            <div class="upload fs-upload-target" data-upload-options='{"action":"<?php echo PATH ?>_functions/upload.php","theme":"test"}'></div>
                                      
                         <div class="filelists">
                                <div class="filelist complete row">
                                </div>
                                 <input type="submit" class="btn-primary">
                            </div>
                        </form>
                        <?php
						}
						?>
                        <?php
						if($ADMIN != ""){
						?>
                        <form action="<?php echo PATH ?>send/editGallery" method="post">
						<?php
						}
						?>
							<h2 class="entry-title">Gallery</h2>
							<div class="filter-links filterable-nav">
								<select class="mobile-filter">
									<option value="*">Show all</option>
									<option value=".concert">Concert</option>
									<option value=".band">Band</option>
									<option value=".stuff">Stuff</option>
								</select>
								<a href="#" class="current" data-filter="*">Show all</a>
								<a href="#" data-filter=".concert">Concert</a>
								<a href="#" data-filter=".band">Band</a>
								<a href="#" data-filter=".stuff">Stuff</a>
							</div>
							<div class="filterable-items">
                            <?php
							$SQL = mysqli_query($connect, "SELECT * FROM `tb_gallery`");
							if(mysqli_num_rows($SQL)){
								while($SQL_Q = mysqli_fetch_assoc($SQL)){
								extract($SQL_Q, EXTR_OVERWRITE);
							?>
								<div class="filterable-item <?php echo $type?>">
									<a href="<?php echo PATH ?>uploads/<?php echo $image?>"><figure><img src="<?php echo PATH ?>uploads/<?php echo $image?>" alt="<?php echo $desc?>"></figure></a>
                                    <?php
						if($ADMIN != ""){
						?>
                        <div class="col-12"><textarea name="desc_<?php echo $id ?>" /><?php echo $desc ?></textarea></div>
                        <div class="col-12"><a href="<?php echo PATH ?>send/deletePhoto/<?php echo $id ?>">[X]</a></div>
						<?php
						}
						?>
								</div>
                                <?php
							}
							}
								?>
								
								
							</div>
                             <?php
						if($ADMIN != ""){
						?>
                            <input type="submit" class="btn-primary">
                            <?php
						}
						?>
						</div>
					</div>
                    </form>
                    
				</div> <!-- .testimonial-section -->

				
			</main> <!-- .main-content -->