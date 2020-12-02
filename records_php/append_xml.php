<?php

try {
    if($_SERVER["REQUEST_METHOD"] == "POST")
{
    $name = $_POST['author'];

    $title = $_POST['title'];
    $author = $name;
    $body = $_POST['body'];
    $date = date('D, jS M Y');
    
    $xml = simplexml_load_file("blogs.xml");
    $blog = $xml->addChild('blog');
    $blog->addChild('title',$title);
    $blog->addChild('author',$author);
    $blog->addChild('date',$date);
    $blog->addChild('body',$body);

    $xml->asXML("blogs.xml");

    //echo "Success";

     echo "<script>alert('Blog Successfully Created');
     window.location.replace('blogs.php?name=".$name."');</script>";
}
else{
    echo "<script>alert('Something Went Wrong');
    window.location.replace('create_blog.php?name=".$name."');</script>";
}
} catch (\Throwable $th) {
     echo "<script>alert('Something Went Wrong');
     window.location.replace('create_blog.php?name=".$name."');</script>";
  echo "Catch Caught";
}
