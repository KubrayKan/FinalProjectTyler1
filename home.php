<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="icon" type="image/gif" href="https://preview.ibb.co/j2A5Yo/fav.gif">
  <title>Home | Loltyler1.com</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="loltyler1.css"/>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <script src="https://player.twitch.tv/js/embed/v1.js"></script>
</head>
<body>

<?php
  include('navbar.php');
?>

<div class="jumbotron text-center" id="topCard">
    <img src="https://assets.bigcartel.com/theme_images/51543572/t3.png?auto=format&amp;fit=max&amp;h=250&amp;w=1300" alt="Loltyler1.com Home" style="margin-top:100px;"> 
</div>

<div style="background-color:#6d6d70; height:1px;"></div><br>

<h2 class="text-center" style="margin-bottom:30px;">The Show</h2>

<div class="container" style="margin-bottom:50px">
  <div id="twitch-embed" style="display: block; width: 100%; height: 500px"></div>
</div>

<script type="text/javascript">
  new Twitch.Player("twitch-embed", {
    width: "100%",
    height: "100%",
    theme: "dark",
    channel: "loltyler1"
  });
</script>

<div class="container" id="socialMedia">
  <div class="row">
    <div class="col-md-3">
        <h2>Youtube</h2>
        <p class="purple">Best Content Creator</p>
        <p><a class="btn btn-secondary" href="https://www.youtube.com/channel/UCwV_0HmQkRrTcrReaMxPeDw" style="background-color:#FF0000; color:#282828; border-color:#1a1a1a;">loltyler1 <i class="fa fa-youtube-play" aria-hidden="true"></i></a></p>
    </div>
    <div class="col-md-3">
        <h2>Twitter</h2>
        <p class="purple">T1 OK GOOD YES</p>
        <p><a class="btn btn-secondary" href="https://twitter.com/loltyler1" style="background-color:#1DA1F2; border-color:#1a1a1a;">loltyler1 <i class="fa fa-twitter" aria-hidden="true"></i></a></p>
    </div>
    <div class="col-md-3">
        <h2>Instagram</h2>
        <p class="purple">Alpha Built Different</p>
        <p><a class="btn btn-secondary" href="https://www.instagram.com/tyler1_alpha/?hl=es" style="background-image: linear-gradient(to right, #405DE6 10%, #5851DB 20%, #833AB4 30%, #C13584 40%, #E1306C 50%, #FD1D1D 60%, #F56040 70%, #F77737 80%, #FCAF45 90%, #FFDC80 100%); border-color:#1a1a1a;">tyler1_alpha <i class="fa fa-instagram" aria-hidden="true"></i></a></p>
    </div>
    <div class="col-md-3">
        <h2>Twitch</h2>
        <p class="purple">Absolute Domination</p>
        <p><a class="btn btn-secondary" href="https://www.twitch.tv/loltyler1" style="background-color:#6441a5; border-color:#1a1a1a;">loltyler1<i class="fa fa-twitch" aria-hidden="true"></i></a></p>
    </div>
  </div>
</div>

</body>
</html>