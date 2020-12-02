<html>
<head>
<!-- CSS -->
<title> Blogs </title>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="180x180" href="http://localhost:15459/favicon/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="http://localhost:15459/favicon/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="http://localhost:15459/favicon/favicon-16x16.png">
<link rel="manifest" href="http://localhost:15459/favicon/site.webmanifest">

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
<script src="https://kit.fontawesome.com/8874ccf928.js" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="blogs.js"></script>
</head>
<body onload="loadXML()">

<nav class="navbar navbar-dark bg-dark">
  <a class="btn btn-danger" href=<?php echo (isset($_COOKIE['jobtasker_user']))?"'http://localhost:15459/home.jsp'":"'http://localhost:15459'";  ?>>Back</a>
  <button class="btn btn-primary" style="padding:1em;" onclick="loadXML()"><i class="fas fa-sync" style="font-size:20px;"></i></button>
  <?php
    if(isset($_COOKIE['jobtasker_user']))
    {
        $name = $_GET['name']??"";
        echo "<a class='btn btn-success' href='create_blog.php?name=".$name."'>Write Something</a>";
        
    }
  ?>
</nav>
<br>
<br>
<div id="blogs"></div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</body>
</html>