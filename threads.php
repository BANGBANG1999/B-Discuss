<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bdiscuss - Discussion forum</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
</head>

<body>
    <?php
    include 'partials/_dbconnect.php';
    ?>
    <?php include 'partials/_header.php';?>

    <?php 
        $id = $_GET['threadid'];
        $sql = "SELECT * FROM `threads` WHERE thread_id=$id;";
        $result = mysqli_query($conn,$sql);
        while($row = mysqli_fetch_assoc($result))
        {
            
            $title = $row['thread_title'];
            $desc = $row['thread_desc'];
        }
    ?>

    <?php 
    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        $id = $_GET['threadid'];
        //$comment_id = $_POST['comment_id'];
        $comment_content = $_POST['comment'];
        //It is being done to counter xss attack. So that no one can use some <scripts> to attack
        $comment_content = str_replace("<", "&lt;", "$comment_content");
        $comment_content = str_replace(">", "&gt;", "$comment_content");
        $comment_by = $_POST['user_id'];

        if($comment_content == '')
            {
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>oops! </strong> Comment cannot be blank
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
            }
        else{
                $sql = "INSERT INTO `comments` (`comment_content`, `thread_id`, `comment_by`, `comment_time`) VALUES ('$comment_content', '$id', '$comment_by', current_timestamp());";
                $result = mysqli_query($conn, $sql);
                if($result)
                {
                    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>Success! </strong> Your comment is added
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>';
                }
            }
        //$num_rows = mysqli_num_rows($result);
        // while($row=mysqli_fetch_assoc([$result]))
        // {
        //     $comment_content = $row['comment_content'];
        //     $thread_id = $row['thread_id'];

        //     echo '<div class="container-fluid bg-light mt-4">
        //     <p class="lead my-3">'.$comment_content.'</p>
        //     <hr class="my-2">
        // </div>';
        }   
    ?>

<?php
//This is being done to pull the user name from users who posted the thread.
//We can have add sql2 in 37 line also and do this job.
        $id = $_GET['threadid'];
        $sql = "select * from threads where thread_id='$id'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        $thread_asked_by = $row['thread_user_id'];
        $sql2 = "select user_email from users where user_id='$thread_asked_by'";
        $result2 = mysqli_query($conn, $sql2);
        $row2 = mysqli_fetch_assoc($result2);
        

    echo '<div class="container-fluid bg-light mt-4" align="center">
        <h1 class="display-4"> '.$title.'</h1>
        <p class="lead my-3"> '.$desc.' </p>
        <hr class="my-2">

        <p>Do not challenge or attack others. Do not post commercial messages. All defamatory, abusive, profane,
            threatening, offensive, or illegal materials are strictly prohibited.</p>
        <p>posted by: <b> '.$row2["user_email"].'</b></p>
    </div>';
?>


    


        <!--A form to read questions from users-->
        <?php
        if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true)
        {
            echo '<div class="container mb-4">
                    <h2 class="my-4">Post a comment</h2>
                    <form action=" '.$_SERVER['REQUEST_URI'].'" method="post">
                        <div class="mb-3">
                            <label for="problem_desc" class="form-label">Make your comment</label>
                            <textarea class="form-control" id="comment" name="comment" rows="3"></textarea>
                        </div>
                        <input type="hidden" name="user_id" value="'.$_SESSION['sno'].'">
                        <button type="submit" class="btn btn-success">Post comment</button>
                    </form>
                  </div>';
        }
        else{
            echo '<div class="alert alert-secondary text-center" role="alert">
                    <h3 class="my-4">Post a comment</h3>
                    <p class="lead my-3">Please login to post a new comment</p>
                  </div>';
        }
        ?>


     <div class="container mt-4 mb-4">
                    <h2>Comments</h2>
     <?php
        $id = $_GET['threadid'];
        $empty = true;
        $sql = "select * from comments where thread_id='$id'";
        $result = mysqli_query($conn, $sql);
        while($row = mysqli_fetch_assoc($result))
        {
            $empty = false;
            $comment_content = $row['comment_content'];
            $comment_time = $row['comment_time'];
            $comment_by = $row['comment_by'];
            $sql2 = "select user_email from users where user_id='$comment_by'";
            $result2 = mysqli_query($conn, $sql2);
            $row2 = mysqli_fetch_assoc($result2);
            $printTime = date("F j, Y, g:i a", strtotime($comment_time));
            //Here date("F j, Y, g:i a", strtotime($comment_time)), it is used to make the date time more readable
            echo '<div class="media mt-3">
            <img class="mr-3" src="images/user.png" width="34px" alt="unable to load image">
            <div class="media-body">
            <p class="fw-bold mb-0">'.$row2['user_email'].' at '.$printTime.'</p>
              '.$comment_content.'
            </div>
          </div>';
        }


        if($empty)
            {
                echo '<div class="container bg-light mt-2 p-3">
                <p class="display-6">No threads found</p>
                <p class="lead mb-4">Be the first to start a discussion</p></div>
                <hr class="my-2">';
            }
        ?>


    </div>
    <?php include 'partials/_footer.php'?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous">
    </script>
</body>

</html>