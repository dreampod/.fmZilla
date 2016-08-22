<?php
//contains paths, api keys, misc needed for basic site operation
include '_config.php';

//grab needed variables to login to last.fm
session_start();

$album=$_GET['album'];
$artist=$_GET['artist'];

//let's sanitize it
$album = stripslashes($album);
$artist = stripslashes($artist);


?>

<!DOCTYPE html>
<html lang="en">

<head>

    <?php include "_header.php" ?>



    <!--ok let's start the party with creating the lastFM object and finding if the artist exists-->
    <script>

    function grabAlbum(artistname){
        //this function primarily used to double check the name
         var cache = new LastFMCache();

        //plug in existing variables from php config
        var lastfm = new LastFM({
        apiKey    : '<?php echo $api_key; ?>',
        apiSecret : '<?php echo $api_secret; ?>',
        cache     : cache
        });

        var artistString=artistname;

        lastfm.artist.getInfo({artist: artistString}, {success: function(data){ 

        //Prints Albums from api
        printAlbums(artistString);

        }, error: function(code, message){
       document.write('<div class="alert alert-danger"><strong>Alert</strong> The service is having problems at the moment. You may have trouble retrieving information.</div>');
        }});
    }
    </script>

    <!--we have to lookup the track info to get the duration because the album doesn't contain it-->

    <script>

    function grabCurrentDuration(trackname,artistname,count){
    
    $.ajax({type : 'POST',url : 'http://ws.audioscrobbler.com/2.0/',data : 'method=track.getinfo&' +'artist='+ artistname +'&track='+trackname+'&api_key=<?php echo $api_key; ?>&' +'format=json',dataType : 'jsonp',
        success : function(data) {
            duration=parseInt(data.track.duration)/1000;

            //convert seconds to minutes & seconds
            var minutes=Math.floor(duration/60);
            var seconds=minutes * 60-duration;
            seconds=Math.abs(seconds);
            if (seconds<10){seconds='0'+seconds;}

            //need to show in correct format
            friendlyDuration=minutes+':'+seconds;
            selector='#duration-'+count;
            $(selector).append(friendlyDuration);
            
    },
        error : function(code, message){
         $('#error').html('Error Code: ' + code + ', Error Message: ' + message);    
     }

    });

}

    </script>


  
  
     <!--lets print out current album-->
     <script>
        function grabCurrentAlbum(albumname,artistname){

        albumname= encodeURIComponent(albumname);
        $.ajax({type : 'POST',url : 'http://ws.audioscrobbler.com/2.0/',data : 'method=album.getinfo&' +'artist='+ artistname +'&album='+albumname+'&api_key=<?php echo $api_key; ?>&' +'format=json',dataType : 'jsonp',
        success : function(data) {

        //We have to get the number of tracks
       
            //checks length
            length=data.album.tracks.track.length;

        //lets iterate through tracks
         for (i=0;i<length;i++){
        
        // Handle success code here. Enable the block

            document.getElementById("success3").style.display="block";
            
            document.getElementById("success2").style.display="block";
                trackNumber=i+1;
                //$('#success2 #albumName').append(data.topalbums.album[i].name+"<br/>");

                //find the trackname
                trackname=data.album.tracks.track[i].name;
                //get the track duration
                grabCurrentDuration(trackname,artistname,i);

                $('#currentAlbumTrackName').append(''+trackNumber+') '+data.album.tracks.track[i].name+' <i id="duration-'+i+'"></div>');
                $('#currentAlbumTrackName').append('<br/>');
                console.log(data.album.tracks.track[i].name);

             
            }

            // Handle success code here. Enable the block
            document.getElementById("success").style.display="block";
            //send artwork
            coverart=data.album.image[3]['#text'];

               
            $('#success #currentAlbumImage').append('<img src="' + coverart + '"/><br/>');
            //get publication date
           date=data.album.wiki['published'];
           $('#success #currentAlbumImage').append('Published on: '+date); 
       
        },
        error : function(code, message){
         $('#error').html('Error Code: ' + code + ', Error Message: ' + message);    
     }
    });
    }
    </script>
    

    <!--lets print out the list of albums-->

    <script>
        function printAlbums(artistname){

        $.ajax({type : 'POST',url : 'http://ws.audioscrobbler.com/2.0/',data : 'method=artist.gettopalbums&' +'artist='+ artistname +'&api_key=<?php echo $api_key; ?>&' +'format=json',dataType : 'jsonp',
        success : function(data) {

        //We have to get the length of the json
     
        //checks length
        length=data.topalbums.album.length;
        //lets iterate through albums
        for (i=0;i<length;i++){
        
        // Handle success code here. Enable the block
            document.getElementById("success2").style.display="block";

        // Only prints playcount over 100.000
        if (parseInt(data.topalbums.album[i].playcount)>100000){

            //only prints out albums with art
            if (data.topalbums.album[i].image[1]['#text']!=''){
                $('#success2 #albumImage').append('<a href="album.php?album='+data.topalbums.album[i].name+'&artist='+artistname+'" title="'+data.topalbums.album[i].name+'"><img src="' + data.topalbums.album[i].image[1]['#text'] + '"/></a>');
                $('#success2 #albumMbid').append(data.topalbums.album[i].artist.mbid+"<br/>");
            }
        }
         }
        },
        error : function(code, message){
         $('#error').html('Error Code: ' + code + ', Error Message: ' + message);    
     }
    });
    }
    </script>

   
</head>

<body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">
    <!--this is where we trap mouseclicks and changes to select artist-->

    <!-- Navigation -->
    <nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-main-collapse">
                    Menu <i class="fa fa-bars"></i>
                </button>
                    <i class="fa fa-play-circle"></i><span class="light logo">.fmzilla
            
            </div>
        <?php if (isset($_SESSION['password']) ) {  ?>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse navbar-right navbar-main-collapse">
                <ul class="nav navbar-nav">
                    <!-- Hidden li included to remove active class from about link when scrolled up past about section -->
                    <li class="hidden">
                        <a href="#page-top"></a>
                    </li>
                    <li>
                        <a class="page-scroll" href="myaccount.php?a=back">Account</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="myaccount.php?a=signout">Sign Out</a>
                    </li>
                    <!--<li>
                        <a class="page-scroll" href="#contact">Contact</a>
                    </li>
                    --></ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>



    <!-- Account Section -->
    <section id="account" class="container content-section">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2">
                <h1><?php echo $album ?> by <span class="artistalbum"><?php echo $artist ?></a></h1>
                <!--Prints the current album-->
                <script>grabCurrentAlbum('<?php echo $album ?>','<?php echo $artist ?>');</script>
                
                <!--Prints the album navigation-->
                <script>grabAlbum('<?php echo $artist?>');</script>

            </div>

            <!--BEGIN PLACEHOLDER FOR CURRENT ALBUM-->

            <div id="currentalbum" class="col-md-12">
                <div class="row">
                <!--polls to see if api service is working or not-->

            <script>
                setInterval(function(){
                $.ajax({ url: "http://ws.audioscrobbler.com/2.0/?method=artist.search&artist=cher&api_key=<?php echo $api_key?>&format=json", success: function(data){
                },error:function(data){
                    $('#error').html('<div class="alert alert-danger"><strong>Warning</strong> The API service is having issues...</div>');   
                } });
                }, 5000);
                
            </script>    
                <div id="error"></div>   
                <div class="col-md-6">
                <div id="success"><br/>
                    <div id="currentAlbumImage"></div><br/>
                    <div id="currentAlbumMbid" class="hideme"></div>
                </div></div>
                <div class="col-md-6 trackscol"><br/>
                <div id="success3">
                    <div id="currentAlbumTrackName"><span class="trackLabel">Track</span><br/></div>
                </div>
                </div>
                </div>
                

            </div>
            </div>

            <!--BEGIN PLACEHOLDER FOR SELECTED ALBUMS-->

            <div id="album" class="col-md-12 albumlist">

                <div id="success2"><br/><h3>Albums by artist</h3>
                    <div id="albumName" class="smalltitle"></div><br/>
                    <div id="albumImage"></div><br/>
                    <div id="albumMbid" class="hideme"></div>
                </div>
                <div id="error2"></div>
            </div>


            </div>
            <!--END PLACEHOLDER FOR SELECTED ALBUMS-->
            </div>
            
            </div>
        </div>
    </section>



    <!-- Contact Section -->
    <section id="contact" class="container content-section text-center">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2">
                <h2>Contact Me</h2>
                <p>The best way to contact me is to e-mail me directly. Thanks for visiting!</p>
                <p><a href="mailto:kevin@dreampod.com">kevin@dreampod.com</a>
                </p>
                <ul class="list-inline banner-social-buttons">
                    <li>
                        <a href="https://twitter.com/dreampod" class="btn btn-default btn-lg"><i class="fa fa-twitter fa-fw"></i> <span class="network-name">Twitter</span></a>
                    </li>
                    <li>
                        <a href="https://github.com/dreampod" class="btn btn-default btn-lg"><i class="fa fa-github fa-fw"></i> <span class="network-name">Github</span></a>
                    </li>
                    <li>
                        <a href="https://plus.google.com/u/1/+KevinYuWeb/posts" class="btn btn-default btn-lg"><i class="fa fa-google-plus fa-fw"></i> <span class="network-name">Google+</span></a>
                    </li>
                </ul>
            </div>
        </div>
    </section>

    <!-- Map Section -->
    <div id="map"></div>

    <!-- Footer -->
    <footer>
        <div class="container text-center">
            <p>Copyright 2016-2017 | powered by CloudFlare</p>
        </div>
    </footer>

  

    <!-- Bootstrap Core JavaScript -->
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
<?php }else {
    # code...
    echo "<p><div class=container>";
    echo "You are not logged in or aren't authorized to view this page";
    echo "</div></p>";
} ?>
</body>

</html>
