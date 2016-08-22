<?php
?><!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>.FMZilla - a test project for Aquent</title>

    <!-- Bootstrap Core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom hack CSS -->
    <link href="css/custom.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">

    <!-- Theme CSS -->
    <link href="css/grayscale.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">

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

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse navbar-right navbar-main-collapse">
                <ul class="nav navbar-nav">
                    <!-- Hidden li included to remove active class from about link when scrolled up past about section -->
                    <li class="hidden">
                        <a href="#page-top"></a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#about">About</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#signin">Sign in</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#contact">Contact</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <!-- Intro Header -->
    <header class="intro">
        <div class="intro-body">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <h1 class="brand-heading">.fmZilla</h1>
                        <p class="intro-text">a small app for browsing your favorite last.fm albums
                            <br>Created by Kevin Yu for Aquent</p>
                        <a href="#about" class="btn btn-circle page-scroll">
                            <i class="fa fa-angle-double-down animated"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- About Section -->
    <section id="about" class="container content-section text-center">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2">
                <h2>About</h2>
                <p>Kevin Yu is a UI/UX developer, accessibility fan, and car enthusiast. He has been designing for 10 years and developing consumer web portals for 5 years with focus on science & tech. His favorite tools include Adobe Illustrator, Adobe Photoshop, HTML5, Sublime Text 2, CentOS6 Linux; He knows a bit of open source & enterprise cloud as well.</p>
               <p><strong>Selected Work</strong></p>
               <div class="col-md-4">
                    <a href="http://www.allcampussecurity.com/" target="_blank">
                    <span class="portfoliotitle">All Campus Security</span><br/>
                    <img src="portfolio/acs-homepage.jpg" title="E-commerce" class="img-responsive"><br/>
                    Magento powered e-commerce website development</a>
               </div>
               <div class="col-md-4">
                    <a href="http://www.video-insight.com/cameras/ptz-dome/" target="_blank">
                    <span class="portfoliotitle">Video Insight</span><br/>
                    <img src="portfolio/camera-browsing.jpg" title="Product Launch" class="img-responsive"><br/>
                    Panasonic product catalog & MySQL Tools</a>
               </div>
               <div class="col-md-4">
                    <a href="http://www.excessivedetailing.com/" target="_blank">
                    <span class="portfoliotitle">Excessive Detailing</span><br/>
                    <img src="portfolio/excessive-detailing.jpg" title="Design" class="img-responsive"><br/>
                    Car enthusiast landing page, branding  and hosting</a>
               </div>
            </div>
        </div>
    </section>

    <!-- Download Section -->
    <section id="signin" class="content-section text-center">
        <div class="download-section">
            <div class="container">
                <div class="row">
                    <div class="form-group">
                    <h2>Sign in with Last.fm</h2>
                    <form name="signin" action="myaccount.php" method="post">
                    Username<br/>
                    <input type="text" name="username" id="username" tabindex="0" value="last_tomato"><br/>
                    Password</br>
                    <input type="password" name="password" id="password" tabindex="1"><br/><br/>
                    <input type="submit" class="btn btn-default btn-lg" value="Submit">
                    </form>
                    </div>
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

    <!-- jQuery -->
    <script src="vendor/jquery/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>

</body>

</html>
