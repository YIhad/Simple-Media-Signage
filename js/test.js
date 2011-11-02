var song1 = {artist_name:"band 1", song_name:"Southie", media_url:"/audio/01 - Southie.mp3", img_url:"/images/avatars_media/m_1.png", media_dur:"180", venue:"Water Street Music Hall"};
var song2 = {artist_name:"band 2", song_name:"The Camel City", media_url:"/audio/02 - The Camel City.mp3", img_url:"/images/avatars_media/m_2.png", media_dur:"180", venue:"Bug Jar"};
var song3 = {artist_name:"band 3", song_name:"Sounds of Cyan and Magenta", media_url:"/audio/03 - Sounds Of Cyan And Magenta.mp3", img_url:"/images/avatars_media/m_3.png", media_dur:"180", venue:"Main St Armory"};
var song4 = {artist_name:"band 4", song_name:"Danger", media_url:"/audio/05 - Danger.mp3", img_url:"/images/avatars_media/m_4.png", media_dur:"180", venue:"The Folk Place"};

function initialize_page (){
	// filter navigation initialization
		$('.nav_filter > ul > li > a').eq(0).click(function(e){
			e.preventDefault();
			playlist1();
		});

		$('.nav_filter > ul > li > a').eq(1).click(function(e){
			e.preventDefault();
			playlist2();
		});

		$('.nav_filter > ul > li > a').eq(2).click(function(e){
			e.preventDefault();
			playlist3();
		});
	// done with filter navigation init

	playlist1();
}

function playlist1() {
	var songs = [song1, song2, song3];
	TEST.process_playlist(songs);
}
function playlist2() {
	var songs = [song4, song1];
	TEST.process_playlist(songs);
}
function playlist3() {
	var songs = [song3];
	TEST.process_playlist(songs);
}

TEST = {
	manager: {
		now_playing: 0,
		/**
		  * Initialize a new media playlist
		  *
		  */
		initialize_player: function () {
			TEST.manager.initialize_JME();

			//$('audio').bind('playlistitemchange', alert("change"));

			$('#le_next').click(function(e){
				e.preventDefault();
				$('audio').loadNextPlaylistItem();		
			});

			$('#le_prev').click(function(e){
				e.preventDefault();
				$('audio').loadPreviousPlaylistItem();		
			});
		},
		/**
		  * Initialize JME audio player elements
		  *
		  */
		initialize_JME: function () {
			// cross-browserfy html5 media elements and enable control-elements in our media player
			$(function(){ $('div.media-player').jmeControl(); });

			// configure path to flash fallback for non-html5 audio support
			$(function(){ $('div.media-player').jmeControl({ embed: { jwPlayer: { path: '/jme/player.swf' } } }); }); 
		},
	},
	process_playlist: function(songs) {
		$("#playlist_count").html(songs.length+" songs");

		// clear out existing placeholder stuff
		$("#results_playlist").html('');
		var pl_array = [];			

		$.each(songs, function(i,song) {
			// display the song
			$("#results_playlist").append(
				'<div class="results_list_listing">'+
				'<img src="'+song.img_url+'"/>'+
				'<h1>'+song.artist_name+'</h1><br/>'+
				'<p>'+song.song_name+'</p><br/>'+
				'</div>'
			);
			// create the JME player playlist array
			pl_array.push({name: i, srces: song.media_url});
		});

		TEST.manager.initialize_player();
		$('audio').jmeReady(function(){
		    //this refers to audio
			$('audio').playlist(pl_array);
			$('audio').play();
		});

	}
	
} // END: TEST