<?php
$id = $_GET["id"];
if(isset($id)){
$SQL = mysqli_query($connect, "SELECT * FROM tb_blog WHERE id = $id");
if(mysqli_num_rows($SQL)){
$SQL_Q = mysqli_fetch_assoc($SQL);
extract($SQL_Q, EXTR_OVERWRITE);	
if(!preg_match("/http/", $image)){
$image = PATH."uploads/".$image;	
}
}	
}
?>

<link rel="stylesheet" href="<?php echo PATH ?>css/blog.css" />
<section class="banner-section" style="background-image:url('https://mackenzienz.com/wp-content/uploads/2017/07/Starlight-Festival-Header-Background-1024x337.jpg');">
</section>
<section class="post-content-section">
    <div class="container">

        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 post-title-block">
                <h1 class="text-center"><?php echo $title; ?></h1>
                <?php /*?><div class="d-flex">
                <ul class="list-top list-group list-group-horizontal mx-auto justify-content-center">
                    <li>Henry Terron |</li>
                    <li>General |</li>
                    <li>20th of May, 2020</li>
                </ul>
                </div><?php */?>
            </div>
            <div class="col-lg-9 col-md-9 col-sm-12 first_div">
                <p class="lead">Nullam quis risus eget urna mollis ornare vel eu leo. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nullam id dolor id nibh ultricies vehicula.</p>
<p>Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec ullamcorper nulla non metus auctor fringilla. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Donec ullamcorper nulla non metus auctor fringilla.</p>
                 <div class="well ">
                    <large>This is image</large>
                </div>
<p>Maecenas sed diam eget risus varius blandit sit amet non magna. Donec id elit non mi porta gravida at eget metus. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit.</p>
                <blockquote class="blockquote">
  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>
  <footer>Someone famous in <cite title="Source Title">Source Title</cite></footer>
</blockquote>
                <p>Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec ullamcorper nulla non metus auctor fringilla. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Donec ullamcorper nulla non metus auctor fringilla.</p>
<p>Maecenas sed diam eget risus varius blandit sit amet non magna. Donec id elit non mi porta gravida at eget metus. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit.</p>
                <blockquote class="blockquote">
  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante. nascetur ridiculus mus. Donec ullamcorper nulla non metus auctor fringilla. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Donec ullamcorper nulla non metus auctor fringilla.</p>
  
</blockquote>

                 <div class="image-block">
                     <img src="https://static.pexels.com/photos/268455/pexels-photo-268455.jpeg" width="100%" class="img-responsive" >
                 </div>

<p>Maecenas sed diam eget risus varius blandit sit amet non magna. Donec id elit non mi porta gravida at eget metus. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit.</p>
<div class="row">
               <div class="col-xl-6 mx-auto text-center">
                  <div class="section-title mb-50">
                     <h4>latest blog</h4>
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-lg-4 col-md-6">
                  <!-- Single Blog -->
                  <div class="single-blog">
                     <div class="blog-img">
                        <img src="http://infinityflamesoft.com/html/abal-preview/assets/img/blog/blog1.jpg" alt="">
                        <div class="post-category">
                           <a href="#">Creative</a>
                        </div>
                     </div>
                     <div class="blog-content">
                        <div class="blog-title">
                           <h4><a href="#">Mobilies UX Treend</a></h4>
                           <div class="meta">
                              <ul>
                                 <li>04 June 2018</li>
                              </ul>
                           </div>
                        </div>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas in pulvinar neque.</p>
                        <a href="#" class="box_btn">read more</a>
                     </div>
                  </div>
               </div>
               <div class="col-lg-4 col-md-6">
                  <!-- Single Blog -->
                  <div class="single-blog">
                     <div class="blog-img">
                        <img src="http://infinityflamesoft.com/html/abal-preview/assets/img/blog/blog2.jpg" alt="">
                        <div class="post-category">
                           <a href="#">Creative</a>
                        </div>
                     </div>
                     <div class="blog-content">
                        <div class="blog-title">
                           <h4><a href="#">Mobilies UX Treend</a></h4>
                           <div class="meta">
                              <ul>
                                 <li>23 June 2018</li>
                              </ul>
                           </div>
                        </div>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas in pulvinar neque.</p>
                        <a href="#" class="box_btn">read more</a>
                     </div>
                  </div>
               </div>
               <div class="col-lg-4 col-md-6">
                  <!-- Single Blog -->
                  <div class="single-blog">
                     <div class="blog-img">
                        <img src="http://infinityflamesoft.com/html/abal-preview/assets/img/blog/blog3.jpg" alt="">
                        <div class="post-category">
                           <a href="#">Creative</a>
                        </div>
                     </div>
                     <div class="blog-content">
                        <div class="blog-title">
                           <h4><a href="#">Mobilies UX Treend</a></h4>
                           <div class="meta">
                              <ul>
                                 <li>31 July 2018</li>
                              </ul>
                           </div>
                        </div>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas in pulvinar neque.</p>
                        <a href="#" class="box_btn">read more</a>
                     </div>
                  </div>
               </div>
            </div>
            <div class="mb-5"></div>
             </div>
             
            <div class="col-lg-3  col-md-3 col-sm-12 first_div">
                <div class="card bg-dark mb-2">
  				<div class="card-body">
                    <h2>Subscription Box</h2>
                    <p>Form Description Goes here</p>
                    <div class="input-group">
      <input type="text" class="form-control" placeholder="Search for...">
      <span class="input-group-btn">
        <button class="btn btn-default" type="button">Go!</button>
      </span>
    </div>
    </div>
                </div>
                <div class="card bg-dark mb-2">
  				<div class="card-body">
                    <h2>Share love</h2>
                    <ul class="list-inline">
                        <li><span class="glyphicon glyphicon-heart" aria-hidden="true"></span></li>
                        <li><span class="glyphicon glyphicon-heart" aria-hidden="true"></span></li>
                        <li><span class="glyphicon glyphicon-heart" aria-hidden="true"></span></li>
                        <li><span class="glyphicon glyphicon-heart" aria-hidden="true"></span></li>
                        
                    </ul>
                    </div>
                </div>
                <div class="card bg-dark mb-2">
  				<div class="card-body">
                    <h2>About Author</h2>
                    <img src="" class="img-rounded" />
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna</p>
                    <a href="#" class="btn btn-default">Read more</a>
                </div>
                </div>
                
                        </div>
        </div>
      

    </div> <!-- /container -->
</section>