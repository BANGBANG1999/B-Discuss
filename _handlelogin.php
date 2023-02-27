<?php
if($_SERVER["REQUEST_METHOD"] == "POST")
{
    include 'partials/_dbconnect.php';
    $email = $_POST['email'];
    $password = $_POST['password'];
    $sql = "select * from users where user_email = '$email'";
    $result = mysqli_query($conn, $sql);
    $row_numbers = mysqli_num_rows($result);
    if($row_numbers == 1)
    {
       $row = mysqli_fetch_assoc($result);
       if(password_verify($password, $row['user_password']))
       {
           session_start();
           $_SESSION['loggedin'] = true;
           $_SESSION['useremail'] = $email;
           $_SESSION['sno'] = $row['user_id'];
           //echo 'SUCCESS'.$email;
           header("Location: /forum/index.php?loginsuccess=true");
           exit();
       }
       else{
           $pass_err = 'Password didnot matched';
           header("Location: /forum/index.php?loginsuccess=false&error=$pass_err");
           exit();
       }
    }
    $user_err = 'No user found';
    header("Location: /forum/index.php?loginsuccess=false&error=$user_err");
    //echo 'No user found';

    
}
?>