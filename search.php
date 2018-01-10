
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Search | Hope</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/prettyPhoto.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <link href="css/main.css" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->
    <link rel="shortcut icon" href="images/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">
</head><!--/head-->
<body>
  <header class="navbar navbar-inverse navbar-fixed-top wet-asphalt" role="banner">
      <div class="container">
          <div class="navbar-header">
              <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                  <span class="sr-only">Toggle navigation</span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
              </button>
              <a class="navbar-brand" href="index.html"><img src="images/hope.png" style="height:80px;width:150px" alt="logo"></a>
          </div>
          <div class="collapse navbar-collapse">
              <ul class="nav navbar-nav navbar-right">
                  <li><a href="index.html">Home</a></li>
                  <li><a href="about-us.html">About Us</a></li>
                  <li><a href="query.html">Register a Query</a></li>
                  <li><a href="registration.html">Administration</a></li>
                  <li><a href="terms.html">Terms of Use</a></li>
              </ul>
          </div>
      </div>
  </header><!--/header-->

<section class="search_main container">
<form action="search.php" method="POST">
  <div class="row center">
    <div class="col-sm-2"></div>
    <div class="col-sm-4">
      <div class="form-group">
        <label for="age">Enter Age:</label>
          <input type="text" class="form-control" id="age" name="by_age">
      </div>
    </div>
    <div class="col-sm-4">
      <div class="form-group">
        <label for="place">Enter Place:</label>
        <input type="text" class="form-control" id="place" name="by_place">
      </div>
    </div>
    <div class="col-sm-2"></div>
    </div>
<center><input type="submit" name="submit" value="Search" class="btn btn-default"></center>
  </form>
</section>

<?php
if(isset($_POST['submit'])){
  if(empty($_POST['by_age']) && empty($_POST['by_place'])){
    ?>
      <center><h4>Enter anyone or both the fields to search.</h4></center>
    <?php
  }else{
    include 'connect.php';
    $by_age = $_POST['by_age'];
    $by_place = $_POST['by_place'];

    $query = "SELECT * from child WHERE age_when_found LIKE '%$by_age%' AND place_found LIKE '%$by_place%' AND reason='lost'";

    $sql = $query;
    $res = mysql_query($sql);
    $row = mysql_num_rows($res);
    if($row){
    while($data = mysql_fetch_assoc($res)){
    $ngoid = $data['ngoid'];
    $ngoinfo = mysql_query("SELECT * from ngo where ngoid='$ngoid'");
    $nrow = mysql_fetch_assoc($ngoinfo);

    $id = $data['kid'];
    ?>
    <div class="row container">
    <div class="col-sm-1"></div>
    <div class="col-sm-3">
      <img src="showimage.php?kid=<?php echo $id; ?>" height="100px" width="100px">
    </div>
    <div class="col-sm-3">
      <p><strong>Name : </strong><?php echo $data['name']; ?></p>
      <p><strong>Date when Found : </strong><?php echo $data['date_when_found']; ?></p>
    </div>
    <div class="col-sm-3">
      <p><strong>Place Found : </strong><?php echo $data['place_found']; ?></p>
      <p><strong>Age when Found : </strong><?php echo $data['age_when_found']; ?></p>
    </div>
    <div class="col-sm-2">
      <p><strong>NGO ID : </strong><?php echo $nrow['ngoid']; ?></p>
      <p><strong>City : </strong><?php echo $nrow['city']; ?></p>
    </div>
    </div>
    <hr width="80%">
    <?php
  }
}else{
  ?>
    <center><h4>This search does not match any result. Try another search.</h4></center>
  <?php
}
}
}
?>

    <footer id="footer" class="midnight-blue">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    &copy; 2018 <a target="_blank" >VOID</a>. All Rights Reserved.
                </div>
                <div class="col-sm-6">
                    <ul class="pull-right">
                        <li><a id="gototop" class="gototop" href="#"><i class="icon-chevron-up"></i></a></li><!--#gototop-->
                    </ul>
                </div>
            </div>
        </div>
    </footer><!--/#footer-->

    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.prettyPhoto.js"></script>
    <script src="js/main.js"></script>

</body>
</html>