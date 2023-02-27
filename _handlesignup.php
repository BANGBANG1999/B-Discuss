
<?php
$show_err = 'false';
if($_SERVER["REQUEST_METHOD"] == "POST")
{
    include 'partials/_dbconnect.php';
    //$success_message = false;
    $email = $_POST['email'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];
    //check whether user email exists or not
    $exist_sql = "select * from users where user_email = '$email'";
    $result = mysqli_query($conn, $exist_sql);
    $num_rows = mysqli_num_rows($result);
    if($num_rows>0)
    {
        $show_err = 'Email already in use';
        //header("location: /forum/index.php?signupsuccess=false&error=$show_err");
    }
    else
    {
        if($password == $cpassword)
        {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $sql = "INSERT INTO `users` (`user_email`, `user_password`, `user_joined`) VALUES ('$email', '$hash', current_timestamp())";
            $result = mysqli_query($conn, $sql);
            if($result)
            {
                $show_alert = true;
                header("location: /forum/index.php?signupsuccess=true");
                exit();
            }
        }
        else
        {
            $show_err = 'Password didnot matched';
        }
    }
    header("location: /forum/index.php?signupsuccess=false&error=$show_err");
}

?>