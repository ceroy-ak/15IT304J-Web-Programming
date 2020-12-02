<?php
$name = null;
if(!isset($_COOKIE['jobtasker_user']))
{
    header("Location: blogs.php");
} else {
    $name = $_GET['name'];
}
?>

<html>

<head>
<title>Write Something</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="180x180" href="http://localhost:15459/favicon/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="http://localhost:15459/favicon/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="http://localhost:15459/favicon/favicon-16x16.png">
<link rel="manifest" href="http://localhost:15459/favicon/site.webmanifest">
<!-- CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
</head>

<body>
<form class="form-horizontal" method="POST" action="append_xml.php">
<fieldset>

<!-- Form Name -->
<legend>Unleash Creativity....</legend>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="title">Title</label>  
  <div class="col-md-5">
  <input id="title" name="title" type="text" placeholder="Enter Title of Blog" class="form-control input-md" required="">
    
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="author">Author</label>  
  <div class="col-md-4">
  <input id="author" name="author" type="text" value="<?php echo $name??""; ?>" placeholder="Who wrote this" class="form-control input-md" required="">
    
  </div>
</div>

<!-- Textarea -->
<div class="form-group">
  <label class="col-md-4 control-label" for="body">Body</label>
  <div class="col-md-4">                     
    <textarea class="form-control" id="body" name="body">Lorem Ipsum</textarea>
  </div>
</div>

<!-- Button (Double) -->
<div class="form-group">
  <label class="col-md-4 control-label" for="submit"></label>
  <div class="col-md-8">
    <button type="submit" name="submit" class="btn btn-success">Submit</button>
    <button type="reset" name="reset" class="btn btn-danger">Reset</button>
  </div>
</div>

</fieldset>
</form>
<!-- jQuery and JS bundle w/ Popper.js -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</body>
</html>