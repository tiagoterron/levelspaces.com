<!-- Loading third party fonts -->
		<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,900" rel="stylesheet" type="text/css">
		<link href="<?php echo PATH ?>fonts/font-awesome.min.css" rel="stylesheet" type="text/css">
        
        <link rel="apple-touch-icon" sizes="57x57" href="<?php echo PATH ?>images/ico/apple-icon-57x57.png">
        <link rel="apple-touch-icon" sizes="60x60" href="<?php echo PATH ?>images/ico/apple-icon-60x60.png">
        <link rel="apple-touch-icon" sizes="72x72" href="<?php echo PATH ?>images/ico/apple-icon-72x72.png">
        <link rel="apple-touch-icon" sizes="76x76" href="<?php echo PATH ?>images/ico/apple-icon-76x76.png">
        <link rel="apple-touch-icon" sizes="114x114" href="<?php echo PATH ?>images/ico/apple-icon-114x114.png">
        <link rel="apple-touch-icon" sizes="120x120" href="<?php echo PATH ?>images/ico/apple-icon-120x120.png">
        <link rel="apple-touch-icon" sizes="144x144" href="<?php echo PATH ?>images/ico/apple-icon-144x144.png">
        <link rel="apple-touch-icon" sizes="152x152" href="<?php echo PATH ?>images/ico/apple-icon-152x152.png">
        <link rel="apple-touch-icon" sizes="180x180" href="<?php echo PATH ?>images/ico/apple-icon-180x180.png">
        <link rel="icon" type="image/png" sizes="192x192"  href="<?php echo PATH ?>images/ico/android-icon-192x192.png">
        <link rel="icon" type="image/png" sizes="32x32" href="<?php echo PATH ?>images/ico/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="96x96" href="<?php echo PATH ?>images/ico/favicon-96x96.png">
        <link rel="icon" type="image/png" sizes="16x16" href="<?php echo PATH ?>images/ico/favicon-16x16.png">
        <link rel="manifest" href="<?php echo PATH ?>images/ico/manifest.json">
        <meta name="msapplication-TileColor" content="#000000">
        <meta name="msapplication-TileImage" content="<?php echo PATH ?>images/ico/ms-icon-144x144.png">
        <meta name="theme-color" content="#000000">
        
        <meta name="google-site-verification" content="ME2p0QhDbTp8Q7mslo76QH9570PoMFNtpXsvR6uWoW8" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<base href="./" />
<meta name="robots" content="index" />
<meta name="Distribution" content="global"/>
<meta http-equiv="Content-Language" content="en" /> 
<meta name="rating" content="general" />
<meta name="author" content="Terron Web Developer" />
<meta name="DC.title" content="Level Spaces" />
<meta name="DC.creator " content="Terron Web Developer" />
<meta name="DC.creator.address" content="" />
<meta name="DC.subject" content="Level Spaces" />
<meta name="DC.date.created" content="2011-01-01" />
<meta name="geo.placename" content="Germany" />
<meta name="geo.region" content="Berlin" />


<meta property="og:title" content="<?php echo TITLE ?>" />
<meta property="og:image:type" content="image/jpeg">
<meta property="og:image" content="<?php echo IMAGE ?>">
<meta property="og:image:width" content="700">
<meta property="og:image:height" content="700">
<meta property="og:type" content="article">
<meta property="og:url" content="https://levelspaces.com<?php echo $_SERVER['REQUEST_URI']; ?>">
<meta property="og:site_name" content="Level Spaces"/>
<meta property="og:description" content="<?php echo DESC ?>"/>

<meta name="twitter:card" property="twitter:card" content="summary_large_image"/>
<meta name="twitter:creator" property="twitter:creator" content/>
<meta name="twitter:creator:id" property="twitter:creator:id" content/>
<meta name="twitter:url" property="twitter:url" content="https://levelspaces.com<?php echo $_SERVER['REQUEST_URI']; ?>"/>
<meta name="twitter:title" property="twitter:title" content="<?php echo TITLE ?>"/>
<meta name="twitter:description" property="twitter:description" content="<?php echo DESC ?>"/>
<meta name="twitter:image" property="twitter:image" content="<?php echo IMAGE ?>"/>
<meta name="twitter:site" content="@levelspaces">
<script language="javascript" type="text/javascript">
PATH = "<?php echo PATH ?>";
RAND = "<?php echo preg_replace("/\./", "", $_SERVER['REMOTE_ADDR']) ?>";
SESSION = "<?php echo session_id(); ?>"
</script>
<script src="https://kit.fontawesome.com/1aef7e5cc1.js" crossorigin="anonymous"></script>
        
		<!-- Loading main css file -->
		<link rel="stylesheet" href="<?php echo PATH ?>style.css?t=<?php echo time(); ?>">
        <link rel="stylesheet" href="<?php echo PATH ?>sass/jplayer.css?t=<?php echo time(); ?>">
		<!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="<?php echo PATH ?>sass/bootstrap.min.css">
        <link rel="stylesheet" href="<?php echo PATH ?>sass/default.css">
        <link rel="stylesheet" href="<?php echo PATH ?>sass/upload.css" type="text/css" />
        <link rel="stylesheet" href="<?php echo PATH ?>css/shop.css<?php time() ?>" type="text/css" />
        <script src="<?php echo PATH ?>js/jquery-1.11.1.min.js"></script>
        
        <script src="<?php echo PATH ?>sass/popper.min.js"></script>
        <script src="<?php echo PATH ?>sass/bootstrap.min.js"></script>
        
        <script src="<?php echo PATH ?>js/jquery.jplayer.js"></script>
        <script src="<?php echo PATH ?>js/ttw-music-player-min.js"></script>
        <script src="<?php echo PATH ?>js/myplaylist.js"></script>
        
        
        
       <link rel="stylesheet" href="<?php echo PATH ?>js/summernote2.css">
        <script src="<?php echo PATH ?>js/summernote.js"></script>
        
      <?php /*?> <link href="<?php echo PATH ?>js/summernote-bs4.css" rel="stylesheet">
<script src="<?php echo PATH ?>js/summernote-bs4.js"></script><?php */?>
        
        <script src="<?php echo PATH ?>js/imagesloaded.js"></script>
		<script src="<?php echo PATH ?>js/main-admin.js<?php //echo time(); ?>"></script>
        <script src="<?php echo PATH ?>js/core.js"></script>
        <script src="<?php echo PATH ?>js/background.js"></script>
        <script src="<?php echo PATH ?>js/upload.js"></script>
		<!--[if lt IE 9]>
		<script src="js/ie-support/html5.js"></script>
		<script src="js/ie-support/respond.js"></script>
		<![endif]-->
       
<script>
$(function() {
    $('#summernote').summernote({
      height: 300,
	  width:'100%',
	  prettifyHtml: true
    });
  });
(function(){
	var data = {
	    "@context": "https://schema.org",
	    "@type": "MusicGroup",
	    "@id": "https://levespaces.com",
	    "name": "Level Spaces",
		"alternateName": "LV",
		"description": "Street psychedelic techno rock band based in Berlin",
	    "logo": {
	        "@type": "ImageObject",
	        "url": "https://levelspaces.com/levelspaces.jpg"
	    },
	    "image": {
	        "@type": "ImageObject",
	        "url": "https://levelspaces.com/levelspaces.jpg"
	    },
	    "url": "https://levelspaces.com",
	    "genre": [
	        "Psychedelic Techno Rock",
	        "Instrumental Progressive"
	    ],
	    "sameAs": [
	        "https://www.facebook.com/levelspaceslivejam",
	        "https://twitter.com/levelspaces",
	        "https://instagram.com/levelspaces",
	        "https://www.youtube.com/channel/UCA9AzA60LQKt8_b8g4zPySA",
	        "https://soundcloud.com/levelspaces",
	        "https://levelspaces.bandcamp.com"
	    ],
	    "member": [
	        {
	            "@type": "OrganizationRole",
	            "member": {
	                "@type": "Person",
	                "name": "Henry Terron",
					"alternateName": "Henry",
					"givenName": "Henry Terron",
	                "sameAs": ""
	            },
	            "roleName": [
	                "lead guitar",
	                "solo guitar",
	                "bass",
	                "cajon",
	                "buckets",
	                "drumpad"
	            ]
	        }
	    ]
	};
	var script = document.createElement('script');
	script.type = 'application/ld+json';
	script.innerHTML = JSON.stringify( data );
	document.getElementsByTagName('head')[0].appendChild(script);
})(document);

$(document).ready(function(){
	$(".form-captcha").on("submit", function( ev ) {
		alert("You must complete the reCAPTCHA!")
    ev.preventDefault();
});
	});
  var verifyCallback = function(response) {
      $('.form-captcha').unbind( 'submit' );
      };
      var onloadCallback = function(response) {
        grecaptcha.render('captcha', {
          'sitekey' : '6Ld-ufUUAAAAAI0I1y71DST38qOYlIrsTUl7Xsrz',
		  'callback' : verifyCallback
        });
	
      };
</script>
<script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit"
        async defer>
    </script>
