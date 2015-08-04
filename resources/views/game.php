<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo csrf_token(); ?>">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Kartuvės - <?php echo $category; ?></title>
    <meta name="author" content="Vuidaa">
    <meta name="description" content="Žaidimas kartuvės Lietuvių kalba. Pasirinkta kategorija - <?php echo $category;?>.">
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/app.css" rel="stylesheet">
    <link rel="icon" type="image/png" href="favicon.png">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <div class='container-fluid'>
      <div class='row'>
      <h3 id='category'><?php echo $category;?></h3>
      <h5 id ='points'>Taškai - <span class='red'><?php echo $points;?></span></h5>
      <h1 id='blank'><?php echo $blank;?></h1>
      <div class="progress">
        <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="<?php echo $mistakes; ?>" aria-valuemin="0" aria-valuemax="5"
          style="width: <?php echo $mistakes * 20;?>%">
        </div>
      </div>
      <div id='info-box'>
       <?php 
          foreach ($alphabet as $letter) 
          {
            echo "<button class=' letter' value=$letter>".$letter."</button>";
          }
        ?>
      </div>
      </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/fittext.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.5/js/bootstrap-select.min.js"></script>
    <script src="js/vertical.js"></script>
    <script src="js/app.js"></script>
  </body>
</html>