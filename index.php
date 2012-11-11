<?php require("weather.php"); ?>
<!DOCTYPE html>
<html lang="en"><head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <title>Simple Media Signage</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Michele Adduci">
	
	<!-- Load player theme -->
    <link rel="stylesheet" href="player/theme/style.css" type="text/css" media="screen" />
    <!-- Load jquery -->
    <script type="text/javascript" src="js/jquery.min.js"></script>
	<!-- Video Player-->
	<script type="text/javascript" src="player/js/projector.min.js"></script>
    <!-- Style -->
    <link href="css/bootstrap.css" rel="stylesheet">
    <style type="text/css">
      body {
        padding-top: 60px;
        padding-bottom: 40px;
      }
      .sidebar-nav {
        padding: 9px 0;
      }
    </style>
	
    <link href="css/bootstrap-responsive.css" rel="stylesheet">
	
	<!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- Fav and touch icons -->
    <link rel="shortcut icon" href="http://twitter.github.com/bootstrap/assets/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="http://twitter.github.com/bootstrap/assets/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="http://twitter.github.com/bootstrap/assets/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="http://twitter.github.com/bootstrap/assets/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="http://twitter.github.com/bootstrap/assets/ico/apple-touch-icon-57-precomposed.png">
  </head>

  <body>

    <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container-fluid">
          <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <a class="brand" href="https://github.com/blackibiza84/Simple-Media-Signage">Simple Media Signage - <?php echo date("D d/m/Y"); ?></a>
          <div class="nav-collapse collapse">
            <p class="navbar-text pull-right">
              Author: <a href="http://www.micheleadduci.net" class="navbar-link">Michele Adduci</a>
            </p>
            <ul class="nav">
              <!-- <li class="active"><a href="#">Home</a></li> -->
              <!-- <li><a href="#about">About</a></li> -->
              <!-- <li><a href="#contact">Contact</a></li> -->
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>

    <div class="container-fluid">
      <div class="row-fluid">
        <div class="span3">
          <div class="well sidebar-nav">
            <ul class="nav nav-list">
              <li class="nav-header">Sidebar</li>
              <li class="active"><a href="#"><?php weather("70100"); ?></a></li>
             
            </ul>
          </div><!--/.well -->
        </div><!--/span-->
        <div class="span9">
          <div class="hero-unit">
            <p>
			<video id="player_a" class="projekktor" poster="player/media/intro.png" title="Video Player">
			
			</video>
			</p>
           
          </div>
          <div class="row-fluid">
            <div class="span4">
              <h2>Heading</h2>
              <p> </p>
             
            </div><!--/span-->
            <div class="span4">
              <h2>Heading</h2>
              <p></p>
             
            </div><!--/span-->
            <div class="span4">
              <h2>Heading</h2>
              <p></p>
              
            </div><!--/span-->
          </div><!--/row-->
         </div><!--/span-->
      </div><!--/row-->

      <hr>

      <footer>
        <p>Copyright &copy; <?php echo date("Y"); ?> - <a href="http://www.micheleadduci.net" target="_blank">Michele Adduci</a></p>
      </footer>

    </div><!--/.fluid-container-->
	
    <script type="text/javascript">
	$(document).ready(function() {
		//dimensions setup
		var width = document.body.offsetWidth;
		var bodyHeight = document.body.scrollHeight;
		var height = (typeof window.innerHeight !== "undefined")? window.innerHeight :  (document.documentElement)? document.documentElement.clientHeight : document.body.clientHeight;
		height = (bodyHeight > height)? bodyHeight : height;
		height = height*0.75;
		$("#player_a").height(height);
		//playlist setup
	    projekktor('#player_a',{
		width: false,
		height: false,
		loop: true,
		autoplay: true,
		controls: false,
		continuous: true,
		playlist: [
		{
		    0:{src:'player/media/augenblig.mp4', type:'video/mp4', imageScaling : "aspectratio"}
		},
		{
		    0:{src:'player/media/skyfall.mp4', type:'video/mp4', imageScaling : "aspectratio"}
		}
	    ]}); // instantiation
	});
    </script>
	

</body></html>