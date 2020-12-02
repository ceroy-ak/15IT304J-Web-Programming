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
  <button class='btn btn-danger' onclick="window.open('','_self').close()">Close</button>
</nav>
<?php
   define('DB_SERVER', 'localhost:3306');
   define('DB_USERNAME', 'root');
   define('DB_PASSWORD', 'root');
   define('DB_DATABASE', 'jobtasker');
   $db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);

   // Checking connection
    if (!$db) {
        die("Connection failed: " . mysqli_connect_error());
    }

   if( isset($_COOKIE["jobtasker_user"]))
   {

        try {
            $email = $_COOKIE["jobtasker_user"];
            $query = "SELECT * FROM jobtasker.user WHERE email='$email'";
            $result = mysqli_query($db, $query);
            $num = mysqli_num_rows($result);
            $row = mysqli_fetch_assoc($result);
            $name = $row["name"];
            if($num == 1)
            {
                echo "<h3 align = 'center'> Welcome, $name !!</h3>";
                echo    "<h1 align ='center'><u>Records</u></h1>";
                echo "<br><br>";

                $record_query = "SELECT * FROM jobtasker.`$email`";
                $record_result = mysqli_query($db,$record_query);

                if (mysqli_num_rows($record_result) > 0) {

                    echo "<table class='table'>
                    <thead>
                      <tr>
                        <th scope='col'>#</th>
                        <th scope='col'>Title</th>
                        <th scope='col'>Company</th>
                        <th scope='col'>URL</th>
                        <th scope='col'>JD</th>
                        <th scope='col'>Apply Date</th>
                        <th scope='col'>Status</th>
                        <th scope='col'> </th>
                      </tr>
                    </thead>
                    <tbody>";
                      
                    
                    while($row = mysqli_fetch_assoc($record_result)) {
                    
                      echo "<tr>
                      <td>".$row['id']."</td>
                      <td>".$row['title']."</td>
                      <td>".$row['company']."</td>
                      <td><a target='_blank' href='".$row['url']."'>".$row['url']."</a></td>
                      <td>".$row['jobDescription']."</td>
                      <td>".$row['applydate']."</td>
                      <td>".$row['status']."</td>
                      <td><a class='btn btn-primary' href='records_form.php?editId=".$row['id']."'>Edit</a></td>
                    </tr>";
                    }

                    echo "</tbody>
                    </table>
                    <br>
                    <br>
                    <hr>
                    <center>
                    <a class='btn btn-info' href='records_form.php'> Add Records </a>
                    </center>
                    ";

                  } else {
                    echo "0 results";
                  }

            }
            else
            {
                echo "Wrong Username or password";
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