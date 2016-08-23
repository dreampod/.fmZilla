<?php
//contains paths, api keys, misc needed for basic site operation
include '_config.php';

//grab needed variables to login to last.fm
session_start();

//decide what user wants to do
$action=$_GET['a'];


//user coming back from another page
if ($action=='back'){}
else{


    //user just logged in
    $username=$_POST['username'];
    $password=$_POST['password'];
    
    //let's sanitize it
    $username = stripslashes($username);
    $password = stripslashes($password);

    if ($_POST) {

    //setup session
    $_SESSION['username']='username';
    $_SESSION['password']='password';
    header("Location: " . $_SERVER['REQUEST_URI']);
   exit();
}
}

//user wants to signout
if ($action=='signout') {
    session_destroy();
    header('Location:'.$homepage);
}



?>

<?php include "_header.php" ?>
    <script>

    function checkConnection(){
       // $.getJSON('http://ws.audioscrobbler.com/2.0/?method=artist.search&artist=cher&api_key=<?php echo $api_key?>&format=json', function(data) {

    //});
    
    }

    function grabArtist(artistname){
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

        //Prints Artist from api
        printArtist(artistString);

        //Prints Albums from api
        printAlbums(artistString);

        }, error: function(code, message){
         $('#error').html('Error Code: ' + code + ', Error Message: ' + message);    
        }});
    }
    </script>
  <!--lets print out the artist-->
        <script>

        function printArtist(artistname){

        $.ajax({type : 'POST',url : 'http://ws.audioscrobbler.com/2.0/',data : 'method=artist.getinfo&' +'artist='+ artistname +'&api_key=<?php echo $api_key; ?>&' +'format=json',dataType : 'jsonp',
        success : function(data) {

        // Handle success code here. Enable the block
         document.getElementById("success").style.display="block";

         $('#success #artistName').html(data.artist.name);
         $('#success #artistImage').html('<img src="' + data.artist.image[2]['#text'] + '" width="100%"/>');
         $('#success #artistBio').html(data.artist.bio.content);

         //reset that album view
        $('#success2 #albumImage').html("");
        },
        error : function(code, message){
         $('#error').html('Error Code: ' + code + ', Error Message: ' + message);    
     }
    });
    }
    </script>
  <!--lets print out the albums-->

    <script>
        function printAlbums(artistname){

        $.ajax({type : 'POST',url : 'http://ws.audioscrobbler.com/2.0/',data : 'method=artist.gettopalbums&' +'artist='+ artistname +'&api_key=<?php echo $api_key; ?>&' +'format=json',dataType : 'jsonp',
        success : function(data) {

        //We have to get the length of the json
        function objLength(data){
        var i=0;
        for (var x in data.topalbums.album){
            if(data.topalbums.album.hasOwnProperty(x)){
            i++;
            }
        } 
        return i;
        }
        //checks length
        length=objLength(data);
        //lets iterate through albums
        for (i=0;i<length;i++){
        
        // Handle success code here. Enable the block
            document.getElementById("success2").style.display="block";
            //only prints out albums with art
            if (data.topalbums.album[i].image[1]['#text']!=''){
                //$('#success2 #albumName').append(data.topalbums.album[i].name+"<br/>");
                $('#success2 #albumImage').append('<a href="album.php?album='+data.topalbums.album[i].name+'&artist='+artistname+'" title="'+data.topalbums.album[i].name+'"><img src="' + data.topalbums.album[i].image[1]['#text'] + '"/></a>');
                $('#success2 #albumMbid').append(data.topalbums.album[i].artist.mbid+"<br/>");
            }
         }
        },
        error : function(code, message){
         $('#error2').html('Error Code: ' + code + ', Error Message: ' + message);    
     }
    });
    }
    </script>
    <!--this is where we populate some artists -->
      <script>
            $(function() {
            $( "#autocomplete-1" ).autocomplete({

                source: function (request, response) {
              $.getJSON("http://ws.audioscrobbler.com/2.0/?method=artist.search&artist="+request.term+"&api_key=<?php echo $api_key; ?>&format=json", function (data) {
              response($.map(data.results.artistmatches.artist, function (value, key) {
              value=value['name'];
                return {
                    label: value,
                    value: value
               };
            }));
            });
            },
               minLength: 2,
               delay: 100,
               select: function( event, ui ) {

               //click event usually only captures the first letters u typed, not the whole string
               $("#autocomplete-1").val(ui.item.value);
               $("#autocomplete-1").keyup();

               //this then takes the full string value and takes it the album finder
               artist=document.getElementById("autocomplete-1").value;
               grabArtist(artist);
                }
            });
         });
      </script>




    <!--we will also need a iterative loop to suggest albums-->

    <!--albums generated can be sent to a placeholder-->

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
                    <a class="navbar-brand page-scroll" href="#page-top">
                    <i class="fa fa-play-circle"></i> <span class="light logo">.fmZilla</span>
                </a>
            </div>
        <?php if (isset($_SESSION['password'])==';*?n7$@,{2W6[I') {  ?>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse navbar-right navbar-main-collapse">
                <ul class="nav navbar-nav">
                    <!-- Hidden li included to remove active class from about link when scrolled up past about section -->
                    <li class="hidden">
                        <a href="#page-top"></a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#account">Account</a>
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
    <section id="account" class="container content-section text-center">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2">
                <h2>Browse Music</h2>
                <div class="ui-widget">
                    <label for="autocomplete-1">Start by typing in an artist: </label>
                    <input id="autocomplete-1" class="artistname">
            

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

            <!--BEGIN PLACEHOLDER FOR SELECTED ARTIST-->
            <p><div id="artist" class="col-md-6 artistinfo">
                <div id="success">
                    <div id="artistName" class="title"></div><br/>
                    <div id="artistImage"></div><br/>
                    <div id="artistBio"></div>
                </div>
                <div id="error"></div>
            </div></p>
            <!--END PLACEHOLDER FOR SELECTED ARTIST-->
            
            </div>
            <!--BEGIN PLACEHOLDER FOR SELECTED ALBUMS-->

            <div id="album" class="col-md-6 albumlist">

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
