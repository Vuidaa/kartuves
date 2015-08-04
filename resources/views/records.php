<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo csrf_token(); ?>">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Kartuvės - Rekordai</title>
    <meta name="author" content="Vuidaa">
    <meta name="description" content="Žaidimas kartuvės Lietuvių kalba. Geriausi rezultatai.">
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
        <div class='col-xs-12 col-sm-8 col-md-6 col-md-offset-3 col-sm-offset-2'>
            <h1 id='records-title'>Rekordai</h1>
            <table id='records-table' class='table'>
              <thead>
                <tr>
                  <th>Vardas</th><th>Kategorija</th><th>Taškai</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach($records as $record)
                {
                  echo "<tr><td>$record->name</td><td>".$record->category->name."</td><td>$record->score</td></tr>";
                } 
                ?>
              </tbody>
            </table>
            <a class='btn btn-warning btn-sm' href="/">Į pradžią</a>
        </div>
      </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.5/js/bootstrap-select.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/fittext.js"></script>
    <script src="js/vertical.js"></script>
    <script src="js/app.js"></script>
  </body>
</html>