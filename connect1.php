<?php

$username = $_POST['username'];
$email  = $_POST['email'];
$mobile = $_POST['mobile'];




if (!empty($username) || !empty($email) || !empty($mobile) )
{

$host = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "test1";



// Create connection
$conn = new mysqli ($host, $dbusername, $dbpassword, $dbname);

if (mysqli_connect_error()){
  die('Connect Error ('. mysqli_connect_errno() .') '
    . mysqli_connect_error());
}
else{
  $SELECT = "SELECT email From register Where email = ? Limit 1";
  $INSERT = "INSERT Into register (username , email ,mobile )values(?,?,?)";

//Prepare statement
     $stmt = $conn->prepare($SELECT);
     $stmt->bind_param("s", $email);
     $stmt->execute();
     $stmt->bind_result($email);
     $stmt->store_result();
     $rnum = $stmt->num_rows;

     //checking username
      if ($rnum==0) {
      $stmt->close();
      $stmt = $conn->prepare($INSERT);
      $stmt->bind_param("ssi", $username,$email,$mobile);
      $stmt->execute();
      echo "<script>alert('Form submitted successfully!');</script>";
      echo"<a href='reindex.html'>Home Page</a>";
     } else {
      echo "<script>alert('Someone already register using this email');</script>";
     }
     $stmt->close();
     $conn->close();
    }
} else {
 echo "All field are required";
 die();
}
?>