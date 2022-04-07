    <?php
	$s = true;
if (!isset($_COOKIE['firsttime'])/* or $s == true*/)
{
    setcookie("firsttime", "no", time()+10000);
?>
<script type="text/javascript">
    $(window).on('load',function(){
		$('#modalDownloadForm').modal('show');
		
    });
</script>
<div class="modal fade" id="modalDownloadForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content"  style="background-color:#1b1b1b;">
      <div class="modal-header text-center">
      
        <h4 class="modal-title w-100 font-weight-bold">Follow us on Spotify to unlock a free digital download of our new album</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body mx-3">
        <a href="<?php echo PATH ?>free-download/follow/"><img src="<?php echo PATH ?>images/new_album_2020.jpg" width="100%" alt="Free download Universo Paralelo" /></a>

        

      </div>
      <div class="modal-footer d-flex justify-content-center">
        <a href="<?php echo PATH ?>free-download/follow/" class="btn btn-lg btn-block" id="unlock_download" style="background-color:#27ffb4;width:100%;"><i class="fa fa-lock mr-2" aria-hidden="true"></i> FREE DOWNLOAD</a>
      </a></div>
    </div>

  </div>
</div>

<?php 
}
?>
 <?php
 
 if (isset($_COOKIE['firsttime']) and !isset($_COOKIE['secondtime']))
{
	setcookie("secondtime", "no", time()+10000);

?>

<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v6.0&appId=301590887228097&autoLogAppEvents=1"></script>
<script type="text/javascript">$(window).on('load',function(){$('#modalYT').modal('show'); });</script>

<!--Modal: modalYT-->
<div class="modal fade" id="modalYT" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">

    <!--Content-->
    <div class="modal-content">

      <!--Body-->
      <div class="modal-body mb-0 p-0">

        <div class="embed-responsive embed-responsive-16by9 z-depth-1-half">
          <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/kOpthuvhTN4"
            allowfullscreen></iframe>
        </div>

      </div>

      <!--Footer-->
      <div class="modal-footer justify-content-center flex-column flex-md-row">
      <span class="text-align-left">Follow us on Spotify, Facebook and Youtube:</span><br />
      </div>
      <div class="text-align-center" align="center"><a href="https://levelspaces.com/spotify/"><img src="<?php echo PATH ?>images/follow_us_spotify.png" width="50%" /></a></div>
      <div class="modal-footer justify-content-center">
            <div class="fb-like col-*-12" data-href="http://facebook.com/levelspaceslivejam" style="width:250px;float:left;" data-layout="button_count" data-width="150" data-action="like" data-size="large" data-share="true"></div><div class="g-ytsubscribe col-*-12" data-channelid="UCA9AzA60LQKt8_b8g4zPySA" data-layout="default" data-count="default" style="width:150px;float:right;"></div>
        </div>
        <div class="modal-footer justify-content-center flex-column flex-md-row">
        <button type="button" class="btn btn-outline-primary btn-rounded btn-md ml-4"
          data-dismiss="modal">Close</button>


      </div>

    </div>
    <!--/.Content-->

  </div>
</div>
<!--Modal: modalYT-->

<?php
}
?>

<?php
 $s = false;
 if ($s == true and isset($_COOKIE['firsttime']) and isset($_COOKIE['secondtime'])  and !isset($_COOKIE['thirdtime']))
{
	setcookie("thirdtime", "no", time()+10000);

?>
 
 <script type="text/javascript">
    $(window).on('load',function(){
		$('#modalSubscriptionForm').modal('show');
		
    });
</script>
<div class="modal fade" id="modalSubscriptionForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
  <form action="send/subscribe" method="post">
    <div class="modal-content">
      <div class="modal-header text-center">
      
        <h4 class="modal-title w-100 font-weight-bold">Subscribe to our newsletter</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body mx-3">
        <div class="md-form mb-5">
          <i class="fas fa-user prefix grey-text"></i>
          <input type="text" id="form3" name="name" class="form-control validate">
          <label data-error="wrong" data-success="right" for="form3">Your name</label>
        </div>

        <div class="md-form mb-4">
          <i class="fas fa-envelope prefix grey-text"></i>
          <input type="email" id="form2" name="email" class="form-control validate">
          <label data-error="wrong" data-success="right" for="form2">Your email</label>
        </div>

      </div>
      <div class="modal-footer d-flex justify-content-center">
        <button class="btn btn-primary btn-lg btn-block">Send <i class="fas fa-paper-plane-o ml-1"></i></button>
      </div>
    </div>
    </form>
  </div>
</div>
<?php
}
?>