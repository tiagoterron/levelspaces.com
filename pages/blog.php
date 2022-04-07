<?php
$id = $_GET["b"];
if(isset($id)){
$id = make_url($id."-".$title, "2");
$WHERE = "WHERE id = $id";
}else{
$WHERE = "ORDER BY id DESC LIMIT 1";	
}
$SQL = mysqli_query($connect, "SELECT * FROM tb_blog $WHERE");
if(mysqli_num_rows($SQL)){
$SQL_Q = mysqli_fetch_assoc($SQL);
extract($SQL_Q, EXTR_OVERWRITE);	
if(!preg_match("/http/", $image)){
$image = PATH."uploads/".$image;	
}
}	

?>
<link rel="stylesheet" href="<?php echo PATH ?>css/blog.css?t=<?php echo time(); ?>" />
<section class="post-content-section mb-5">
    <div class="container bg-light">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 post-title-block px-0">
            <section class="banner-section d-flex justify-content-center" style="background-image:url('<?php echo $image; ?>');">
             <div class="tituloo justify-content-center align-self-center"><h1><?php echo $title; ?></h1></div>
</section>
               
                <?php /*?><div class="d-flex">
                <ul class="list-top list-group list-group-horizontal mx-auto justify-content-center">
                    <li>Henry Terron |</li>
                    <li>General |</li>
                    <li>20th of May, 2020</li>
                </ul>
                </div><?php */?>
            </div>
            <div class="col-lg-9 col-md-9 col-sm-12 first_div blog_content">
                <?php echo $text ?>
                <br clear="all" />
                <?php
				$id = $_GET["b"];
			$SQL = mysqli_query($connect, "SELECT *, DATE_FORMAT(date, '%d of %M, %Y') AS date2 FROM tb_blog WHERE status = 'Y' ORDER BY id DESC LIMIT 3");
			$SQL_N = mysqli_num_rows($SQL);
			if($SQL_N > 0){
				?>
<div class="row">
               <div class="col-xl-6 mx-auto text-center">
                  <div class="section-title mb-50 text-dark">
                     <h4>latest blog</h4>
                  </div>
               </div>
            </div>
            <div class="row">
            <?php
			if($SQL_N > 0){
			while($SQL_Q = mysqli_fetch_assoc($SQL)){
			extract($SQL_Q, EXTR_OVERWRITE);	
			if(!preg_match("/http/", $image)){
			$image = PATH."uploads/".$image;	
			}
			$make_url = make_url($id."-".$title, "1");
			?>
               <div class="col-lg-4 col-md-6">
                  <!-- Single Blog -->
                  <div class="single-blog">
                     <div class="blog-img">
                        <a href="<?php echo PATH ?>blog/<?php echo $make_url ?>" title="<?php echo $title ?>"><div style="background-image:url('<?php echo $image ?>');background-size:cover;width:100%;height:150px;">
                        </div></a>
                     </div>
                     <div class="blog-content">
                        <div class="blog-title">
                           <h4><a href="<?php echo PATH ?>blog/<?php echo $make_url ?>" alt="<?php echo $title; ?>"><?php echo $title ?></a></h4>
                           <div class="meta">
                              <ul>
                                 <li><?php echo $date2 ?></li>
                              </ul>
                           </div>
                        </div>
                        <p><?php echo $meta?></p>
                        <a href="<?php echo PATH ?>blog/<?php echo $make_url ?>" title="<?php echo $title ?>" class="box_btn">read more</a>
                     </div>
                  </div>
               </div>
               <?php
			}
			}
			   ?>
               
            </div>
            <?php }
			?>
            <div class="mb-5"></div>
             </div>
             
            <div class="col-lg-3  col-md-3 col-sm-12 first_div">
                <?php /*?><div class="card bg-default mb-2">
  				<div class="card-body">
                    <h2>Subscription</h2>
                    <p>Form Description Goes here</p>
                    
    </div>
                </div><?php */?>
                <?php /*?><div class="card bg-default mb-2">
  				<div class="card-body">
                    <h2>Share love</h2>
                    <ul class="list-inline">
                        <li><span class="glyphicon glyphicon-heart" aria-hidden="true"></span></li>
                        <li><span class="glyphicon glyphicon-heart" aria-hidden="true"></span></li>
                        <li><span class="glyphicon glyphicon-heart" aria-hidden="true"></span></li>
                        <li><span class="glyphicon glyphicon-heart" aria-hidden="true"></span></li>
                        
                    </ul>
                    </div>
                </div><?php */?>
                <div class="card bg-default mb-2">
  				<div class="card-body">
                    <h2>Level Spaces</h2>
                    <img src="" class="img-rounded" />
                    <p><strong>LEVEL</strong> <strong>SPACES</strong> was formed in <strong>April</strong> <strong>2018</strong>, back when all the members, even though already friends, were playing in different projects. Formed by the <strong>Terron</strong> brothers <strong>Lenny</strong> on the <strong>guitar</strong>, <strong>Henry</strong> on the <strong>bass</strong>, and <strong>Guiller</strong> on the <strong>cajon</strong>, along with <strong>Sonny</strong> <strong>Klinger</strong> also on the guitar, who were all back then playing in an acoustic band called <strong>The Red Box</strong>. Meanwhile, drummer <strong>Geraint Morton</strong> was already hitting it with the duo <strong>Buckit</strong>, as well as a parallel hard rock band, <strong>S.H.O.T.</strong>, with <strong>Lenny</strong> and <strong>Henry Terron</strong>.</p>
                    <a href="<?php echo PATH ?>about" class="btn btn-primary">Read more</a>
                </div>
                </div>
                
                        </div>
        </div>
      

    </div> <!-- /container -->
</section>