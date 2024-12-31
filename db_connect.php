<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "petra";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

function check_login($con)//check session value exists
{
   if(isset($_SESSION['user_id'])) //if value is set
   {
      $id = $_SESSION['user_id'];
      $query = "select * from users where id = '$id' limit 1";

      $result = mysqli_query($con,$query);

      if($result && mysqli_num_rows($result) > 0)
      {
          $user_data = mysqli_fetch_assoc($result);    //assoc = associative array
          return $user_data;
      }
   }

   else if(isset($_SESSION['admin_id'])) //if value is set
   {
      $id = $_SESSION['admin_id'];
      $query = "select * from admin where admin_id = '$id' limit 1";

      $result = mysqli_query($con,$query);

      if($result && mysqli_num_rows($result) > 0)
      {
          $user_data = mysqli_fetch_assoc($result);    //assoc = associative array
          return $user_data;
      }
   }
   else
   //redirect to login
   header("location: loginform.php");
}

function check_userIndex($con) // to make sure user goes to the right page
{
   if(isset($_SESSION['user_id'])) //if value is set
   {
      header("Location: user/index.php");
   }

   else if(isset($_SESSION['admin_id'])) //if value is set
   {
      header("Location: admin/index.php");
   }

   else
   header("location:index.html");

}

?>
