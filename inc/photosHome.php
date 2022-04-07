<div class="fullwidth-block why-chooseus-section">
					<div class="container">
						<h2 class="section-title"><a href="<?php echo PATH ?>gallery">Gallery</a></h2>
<div class="filterable-items">
                            <?php
							$SQL = mysqli_query($connect, "SELECT * FROM `tb_gallery` WHERE `home` = 'Y' ORDER BY RAND() LIMIT 8");
							if(mysqli_num_rows($SQL)){
								while($SQL_Q = mysqli_fetch_assoc($SQL)){
								extract($SQL_Q, EXTR_OVERWRITE);
							?>
								<div class="filterable-item <?php echo $type?>">
									<a href="<?php echo PATH ?>uploads/<?php echo $image?>"><figure><img src="<?php echo PATH ?>uploads/<?php echo $image?>" alt="<?php echo $desc?>"></figure></a>
                                    <h6 class="text-white text-center"><?php echo $desc?></h6>
                                    </div>
                                    <?php
						}
							}
						?>
						</div>
						
                        
					</div> <!-- .container -->
				</div>