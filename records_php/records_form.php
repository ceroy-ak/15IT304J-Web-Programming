<html>
<head>
<!-- CSS -->
<title> Records </title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="180x180" href="http://localhost:15459/favicon/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="http://localhost:15459/favicon/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="http://localhost:15459/favicon/favicon-16x16.png">
<link rel="manifest" href="http://localhost:15459/favicon/site.webmanifest">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
</head>
<body>
<nav class="navbar navbar-light bg-light">
  <a class="btn btn-danger" href="records.php">Back</a>
</nav>

<?php
$isUpdate = false;
if(isset($_GET['editId']))
{
    $isUpdate = true;
}

?>

<?php
   if(isset($_COOKIE["jobtasker_user"]))
   {

        try 
        {
            define('DB_SERVER', 'localhost:3306');
            define('DB_USERNAME', 'root');
            define('DB_PASSWORD', 'root');
            define('DB_DATABASE', 'jobtasker');
            $db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);

            // Checking connection
            if (!$db) 
            {
                die("Connection failed: " . mysqli_connect_error());
            }
            
            $email = $_COOKIE["jobtasker_user"];
            $title = null;
            $url = null;
            $jobDescription = null;
            $applydate = null;
            $status = null;
            $company = null;
            
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
              $process_type = $_POST['process_type'];

              $title = $_POST['title'];
              $url = $_POST['url'];
              $jobDescription = $_POST['jobDescription'];
              $applydate = $_POST['applydate'];
              $status = $_POST['status'];
              $company = $_POST['Company'];

              try {

                if($process_type == -1)
                {
                  $insertion = "INSERT INTO jobtasker.`$email`(title,url,jobDescription,applydate,status,company) VALUES ('$title','$url','$jobDescription','$applydate','$status','$company')";
                  if (mysqli_query($db, $insertion)) {
                    echo "<script>alert('Success');
                    window.location.replace('records.php');</script>";
                  } else {
                    throw new Exception("Error Processing Request", 1);
                  }
                }
                else{
                  $updatation = "UPDATE jobtasker.`$email` SET title='$title',url='$url',jobDescription='$jobDescription',applydate='$applydate',status='$status',company='$company' WHERE id=$process_type";
                  if (mysqli_query($db, $updatation)) {
                    echo "<script>alert('Success');
                    window.location.replace('records.php');</script>";
                  } else {
                    throw new Exception("Error Processing Request", 1);
                  }
                }

                
              } catch (\Throwable $th) {
                echo "<script>alert('Something Went Wrong');
                    window.location.replace('records_form.php');</script>";
              }

              
            }
            
?>
<center>
<form class="form-horizontal justify-content-center" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
<!-- Form Name -->
<legend>Job Record Form</legend>

<!-- Text input-->

<input name="process_type" id="process_type" type="hidden" value=<?php echo $isUpdate?$_GET['editId']:-1?>>
<div class="form-group">
  <label class="col-md-4 control-label" for="title">Job Title</label>  
  <div class="col-md-4 ">
  <input id="title" name="title" type="text" placeholder="Enter the Job Title" class="form-control input-md" required="">
    
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="Company">Company</label>  
  <div class="col-md-4">
  <input id="Company" name="Company" type="text" placeholder="Enter company name" class="form-control input-md" required="">
    
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="url">Application URL</label>  
  <div class="col-md-5">
  <input id="url" name="url" type="url" placeholder="Enter the application URL" class="form-control input-md" required="">
    
  </div>
</div>

<div class="form-group">
  <label class="col-md-4 control-label" for="url">Application Date</label>  
  <div class="col-md-5">
  <input id="applydate" name="applydate" type="date" placeholder="Enter the application date" class="form-control input-md" required="">
    
  </div>
</div>

<!-- Textarea -->
<div class="form-group">
  <label class="col-md-4 control-label" for="jobDescription">Job Description</label>
  <div class="col-md-4">                     
    <textarea class="form-control" id="jobDescription" name="jobDescription"></textarea>
  </div>
</div>

<!-- Select Basic -->
<div class="form-group">
  <label class="col-md-4 control-label" for="status">Status</label>
  <div class="col-md-4">
    <select id="status" name="status" class="form-control">
      <option value="Applied">Applied</option>
      <option value="Online Exam">Online Exam</option>
      <option value="In-person Exam">In-person Exam</option>
      <option value="Interview">Interview</option>
      <option value="Rejected">Rejected</option>
      <option value="Withdrawn">Withdrawn</option>
    </select>
  </div>
</div>
<div class="form-group">
<button class="btn btn-success col-md-2" type='submit'>Submit</button>
<button class="btn btn-outline-danger col-md-2" type='reset'>Reset</button>
</div>
</form>
</center>

        <?php
            if($isUpdate)
            {
                $query = "SELECT * FROM jobtasker.`".$email."` WHERE id='".$_GET['editId']."'";
                $result = mysqli_query($db, $query);
                
                $num = mysqli_num_rows($result);
                $row = mysqli_fetch_assoc($result);
                if($num == 1)
                {
                    $title = $row['title'];
                    $url = $row['url'];
                    $jobDescription = $row['jobDescription'];
                    $applydate = $row['applydate'];
                    $status = $row['status'];
                    $company = $row['company'];
                    echo "<script>
                    document.getElementById('title').value = '$title' ;
                    document.getElementById('url').value = '$url' ;
                    document.getElementById('Company').value = '$company';
                    document.getElementById('jobDescription').value = '$jobDescription';
                    document.getElementById('status').value = '$status' ;
                    document.getElementById('applydate').value = '$applydate' ;
                    </script>";    
                }
            }

            if($isUpdate)
            {
                #Update query
            }
            else
            {
                #insert query
            }

            
        } catch (\Throwable $th) {
            echo "Something wrong with Database";
        }
      

   }
   else
   {
       echo "Unauthorized Access";
       header("Location: http://localhost:15459"); 
   }
?>


<!-- jQuery and JS bundle w/ Popper.js -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</body>
</html>