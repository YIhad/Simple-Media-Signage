<?php 
require "previsioni.php";
require "oroscopo.php";
?>
<!DOCTYPE HTML>
<html>

<head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>Pubblicit&agrave;</title>
		<link href="style.css" rel="stylesheet" type="text/css" media="screen" />
		<link rel="stylesheet" type="text/css" href="carousel.css" />
		<link rel="stylesheet" type="text/css" href="ticker.css" />
		<link href="./jplayer.blue.monday.css" rel="stylesheet" type="text/css">
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

		<script type="text/javascript" src="./js/jquery.js"></script>
		<script type="text/javascript" src="./js/jquery.ticker.min.js"></script>
		<script src="./js/jcarousellite.js" type="text/javascript"></script>
		<script type="text/javascript" async="" src="./js/load.js"></script>
		<script type="text/javascript" src="./js/flattr.js"></script>
		<script type="text/javascript" src="./js/jquery.jplayer.min.js"></script>
		<script type="text/javascript" src="./js/jquery.jplayer.inspector.js"></script>
		
		
		<script type="text/javascript">
		    $(document).ready(function() {
		    
		
				$("#boxtempo").jCarouselLite({
				        vertical: true,
					    visible: 1,
						auto:3500,
						speed:1500
				    });
					var Playlist = function(instance, playlist, options) {
						var self = this;

						this.instance = instance; // String: To associate specific HTML with this playlist
						this.playlist = playlist; // Array of Objects: The playlist
						this.options = options; // Object: The jPlayer constructor options for this playlist

						this.current = 0;

						this.cssId = {
							jPlayer: "jquery_jplayer_",
							interface: "jp_interface_",
							playlist: "jp_playlist_"
						};
						this.cssSelector = {};

						$.each(this.cssId, function(entity, id) {
							self.cssSelector[entity] = "#" + id + self.instance;
						});

						if(!this.options.cssSelectorAncestor) {
							this.options.cssSelectorAncestor = this.cssSelector.interface;
						}

						$(this.cssSelector.jPlayer).jPlayer(this.options);

						$(this.cssSelector.interface + " .jp-previous").click(function() {
							self.playlistPrev();
							$(this).blur();
							return false;
						});

						$(this.cssSelector.interface + " .jp-next").click(function() {
							self.playlistNext();
							$(this).blur();
							return false;
						});
					};

					Playlist.prototype = {
						displayPlaylist: function() {
							var self = this;
							$(this.cssSelector.playlist + " ul").empty();
							for (i=0; i < this.playlist.length; i++) {
								var listItem = (i === this.playlist.length-1) ? "<li class='jp-playlist-last'>" : "<li>";
								listItem += "<a href='#' id='" + this.cssId.playlist + this.instance + "_item_" + i +"' tabindex='1'>"+ this.playlist[i].name +"</a>";

								// Create links to free media
								if(this.playlist[i].free) {
									var first = true;
									listItem += "<div class='jp-free-media'>(";
									$.each(this.playlist[i], function(property,value) {
										if($.jPlayer.prototype.format[property]) { // Check property is a media format.
											if(first) {
												first = false;
											} else {
												listItem += " | ";
											}
											listItem += "<a id='" + self.cssId.playlist + self.instance + "_item_" + i + "_" + property + "' href='" + value + "' tabindex='1'>" + property + "</a>";
										}
									});
									listItem += ")</span>";
								}

								listItem += "</li>";

								// Associate playlist items with their media
								$(this.cssSelector.playlist + " ul").append(listItem);
								$(this.cssSelector.playlist + "_item_" + i).data("index", i).click(function() {
									var index = $(this).data("index");
									if(self.current !== index) {
										self.playlistChange(index);
									} else {
										$(self.cssSelector.jPlayer).jPlayer("play");
									}
									$(this).blur();
									return false;
								});

								// Disable free media links to force access via right click
								if(this.playlist[i].free) {
									$.each(this.playlist[i], function(property,value) {
										if($.jPlayer.prototype.format[property]) { // Check property is a media format.
											$(self.cssSelector.playlist + "_item_" + i + "_" + property).data("index", i).click(function() {
												var index = $(this).data("index");
												$(self.cssSelector.playlist + "_item_" + index).click();
												$(this).blur();
												return false;
											});
										}
									});
								}
							}
						},
						playlistInit: function(autoplay) {
							if(autoplay) {
								this.playlistChange(this.current);
							} else {
								this.playlistConfig(this.current);
							}
						},
						playlistConfig: function(index) {
							$(this.cssSelector.playlist + "_item_" + this.current).removeClass("jp-playlist-current").parent().removeClass("jp-playlist-current");
							$(this.cssSelector.playlist + "_item_" + index).addClass("jp-playlist-current").parent().addClass("jp-playlist-current");
							this.current = index;
							$(this.cssSelector.jPlayer).jPlayer("setMedia", this.playlist[this.current]);
						},
						playlistChange: function(index) {
							this.playlistConfig(index);
							$(this.cssSelector.jPlayer).jPlayer("play");
						},
						playlistNext: function() {
							var index = (this.current + 1 < this.playlist.length) ? this.current + 1 : 0;
							this.playlistChange(index);
						},
						playlistPrev: function() {
							var index = (this.current - 1 >= 0) ? this.current - 1 : this.playlist.length - 1;
							this.playlistChange(index);
						}
					};
http://www.pclinuxos.com/
					var videoPlaylist = new Playlist("1", [
						{
							name:"Big Buck Bunny Trailer",
							free:true,
							m4v:"./video/video1.m4v",

							poster:"http://www.happyworm.com/video/poster/Big_Buck_Bunny_Trailer_480x270.png"
						},
						{
							name:"Finding Nemo Teaser",
							m4v: "./video/video2.m4v",

							poster: "http://www.happyworm.com/video/poster/Finding_Nemo_Teaser_640x352.png"
						},
						{
							name:"Incredibles Teaser",
							m4v: "http://www.happyworm.com/video/m4v/Incredibles_Teaser_640x272_h264aac.m4v",

							poster: "http://www.happyworm.com/video/poster/Incredibles_Teaser_640x272.png"
						}
					], {
						ready: function() {
							videoPlaylist.displayPlaylist();
							videoPlaylist.playlistInit(true); // Parameter is a boolean for autoplay.
						},
						ended: function() {
							videoPlaylist.playlistNext();
						},
						play: function() {
							$(this).jPlayer("pauseOthers");
						},
						supplied: "ogv, m4v"
					});

				
		});
		</script>
		<script type="text/javascript">
			$(function () {
				$('#boxoroscopo').ticker({
					speed: 0.10,
					pauseOnItems: 11000
					
				});
			});
		</script>
	
	
</head>

<body>
<div id="wrapper">
	<div id="page">
		<div id="content">
        	<div class="post">
				<div class="entry">
               	 		<div class="jp-video jp-video-360p">
							<div class="jp-type-playlist">
								<div id="jquery_jplayer_1" class="jp-jplayer" style="background-color: rgb(0, 0, 0); "><video id="jp_video_0" preload="metadata" style="width: 0px; height: 0px; " src="./video/video1.m4v"></video></div>
								<div id="jp_interface_1" class="jp-interface">
									<div class="jp-video-play" style="display: block; "></div>


								</div>
								
							</div>
						</div>
				</div>
				<div class="entry" style="margin-top: 30px;">
					<!-- ++Begin News Bar Wizard Generated Code++ -->
					  <!--
					  // Created with a Google AJAX Search Wizard
					  // http://code.google.com/apis/ajaxsearch/wizards.html
					  -->

					  <!--
					  // The Following div element will end up holding the actual newsbar.
					  // You can place this anywhere on your page.
					  -->
					  <div id="newsBar-bar">
					    <span style="color:#676767;font-size:11px;margin:10px;padding:4px;">Caricamento...</span>
					  </div>

					  <!-- Ajax Search Api and Stylesheet
					  // Note: If you are already using the AJAX Search API, then do not include it
					  //       or its stylesheet again
					  -->
					  <script src="http://www.google.com/uds/api?file=uds.js&v=1.0&source=uds-nbw"
					    type="text/javascript"></script>
					  <style type="text/css">
					    @import url("http://www.google.com/uds/css/gsearch.css");
					  </style>

					  <!-- News Bar Code and Stylesheet -->
					  <script type="text/javascript">
					    window._uds_nbw_donotrepair = true;
					  </script>
					  <script src="http://www.google.com/uds/solutions/newsbar/gsnewsbar.js?mode=new"
					    type="text/javascript"></script>
					  <style type="text/css">
					    @import url("gsnewsbar.css");
					  </style>

					  <script type="text/javascript">
					    function LoadNewsBar() {
					      var newsBar;
					      var options = {
					        largeResultSet : true,
					        title : "Notizie dal Mondo",
					        horizontal : true,
					        autoExecuteList : {
					          executeList : ["Italia", "Auto", "Calcio", "Moda", "Politica", "Cronaca", "Estero"]
					        }
					      }

					      newsBar = new GSnewsBar(document.getElementById("newsBar-bar"), options);
					    }
					    // arrange for this function to be called during body.onload
					    // event processing
					    GSearch.setOnLoadCallback(LoadNewsBar);
					  </script>
					<!-- ++End News Bar Wizard Generated Code++ -->
				</div>
				<div class="entry"  style="margin-top: 30px;font-size: 40px;">
               	<h2 id="spot">Per info su questa pubblicit&agrave;, chiama il <br/><br/><span style="color: #ff0000;margin-top: 20px;">392 4043061</span></h2>
				</div>
        	</div>
		</div>
        <div id="sidebar">
			<ul>
               <li>
 			<img src="logo.png" height="250"/>
        	   </li>
		       <li>
 				
       			<div id="boxtempo">
                	<ul>
					<li><?php meteo("Bari"); ?>    </li>
					<li><?php meteo("Firenze"); ?> </li> 
					<li><?php meteo("Roma"); ?>    </li> 
					<li><?php meteo("Palermo"); ?> </li>
					<li><?php meteo("Milano"); ?>  </li>  
					<li><?php meteo("Napoli"); ?>  </li>  
					<li><?php meteo("Venezia"); ?> </li> 
					</ul>
			   </div>
        	   </li> 
           	   <li>
				<div id="ticker-wrapper" class="no-js">
                	<ul id="boxoroscopo" class="js-hidden">
					<li class="news-item"><?php giorno("ariete"); ?>  </li>
					<li class="news-item"><?php giorno("toro"); ?>  </li>
					<li class="news-item"><?php giorno("cancro"); ?>  </li>
					<li class="news-item"><?php giorno("gemelli"); ?>  </li>
					<li class="news-item"><?php giorno("leone"); ?>  </li>
					<li class="news-item"><?php giorno("vergine"); ?>  </li>
			AddType application/x-httpd-php .php		<li class="news-item"><?php giorno("bilancia"); ?>  </li>
					<li class="news-item"><?php giorno("scorpione"); ?>  </li>
					<li class="news-item"><?php giorno("sagittario"); ?>  </li>
					<li class="news-item"><?php giorno("capricorno"); ?>  </li>
					<li class="news-item"><?php giorno("acquario"); ?>  </li>
					<li class="news-item"><?php giorno("pesci"); ?>  </li>
				
					</ul>
				</div>
        	   </li>
			
			</ul>
		</div>
		<div style="clear: both;">&nbsp;</div>
		</div>
</div>
       
</body>

</html>
