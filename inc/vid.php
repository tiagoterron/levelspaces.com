<?php
/*if (!isset($_COOKIE['firsttime']))
{*/
    //setcookie("firsttime", "no", time()+3600);
?>
<script type="text/javascript">
    $(window).on('load',function(){
        $('#modalYT').modal('show');
    });
</script>

<script src="https://apis.google.com/js/platform.js"></script>



<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v6.0&appId=301590887228097&autoLogAppEvents=1"></script>


<!--Modal: modalYT-->
<div class="modal fade" id="modalYT" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">

    <!--Content-->
    <div class="modal-content">

      <!--Body-->
      <div class="modal-body mb-0 p-0">

        <div class="embed-responsive embed-responsive-16by9 z-depth-1-half">
          <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/zXw8_iILqiQ"
            allowfullscreen></iframe>
        </div>

      </div>

      <!--Footer-->
      <div class="modal-footer justify-content-center flex-column flex-md-row">
      <span class="text-align-left">Follow us in Facebook and Youtube:</span></div>
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
// }
?>