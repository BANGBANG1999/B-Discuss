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
    <?php 
        $id = $_GET['cat_id'];
        $sql = "SELECT * FROM `categories` WHERE category_id=$id;";
        $result = mysqli_query($conn,$sql);
        while($row = mysqli_fetch_assoc($result))
        {
            $category_name = $row['category_name'];
            $category_desc = $row['category_description'];
        }
    ?>
    <?php include 'partials/_header.php';?>

    <?php 
    $method = $_SERVER['REQUEST_METHOD'];
    // echo $method;
    if($method == 'POST')
    {
        $th_title = $_POST['title'];
        $th_desc = $_POST['desc'];
        //It is being done to counter xss attack. So that no one can use some <scripts> to attack
        $th_title = str_replace("<", "&lt;", "$th_title");
        $th_title = str_replace(">", "&gt;", "$th_title");
        $th_desc = str_replace("<", "&lt;", "$th_desc");
        $th_desc = str_replace("<", "&lt;", "$th_desc");
        $th_user_id = $_POST['sno'];
        if($th_title == '')
        {
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>oops! </strong> Title cannot be blank
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
        }
        else
        {
            $check_in_db = "select * from threads where thread_title='$th_title'";
            $result = mysqli_query($conn, $check_in_db);
            $num_rows = mysqli_num_rows($result);
            if($num_rows > 0)
            {
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>oops! </strong> Your question is already present. Please look for it
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
            }
            else
            {
                    $sql = "INSERT INTO `threads` (`thread_title`, `thread_desc`, `thread_cat_id`, `thread_user_id`, `timestamp`) VALUES ('$th_title', '$th_desc', '$id', '$th_user_id', current_timestamp());";
                    $result = mysqli_query($conn, $sql);
                    
                    if($result)
                    {
                        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>Success! </strong> Your question is updated successfully. Wait for the community to respond.
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>';
                    }
            }
        }      
}
    ?>

    <div class="container-fluid bg-light mt-4" align="center">
        <h1 class="display-4">Welcome to <?php echo $category_name;?> forums</h1>
        <p class="lead my-3"><?php echo $category_desc;?> </p>
        <hr class="my-2">

        <p>Do not challenge or attack others. Do not post commercial messages. All defamatory, abusive, profane,
            threatening, offensive, or illegal materials are strictly prohibited.</p>
    </div>
    <!-- <div class="container mb-4">
        <h2 class="my-4">Start a discussion</h2> -->

        <?php
        //A form to read questions from users
        if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true)
        {
            echo '<div class="container mb-4">
                  <h2 class="my-4">Start a discussion</h2>
                    <form action = "'.$_SERVER['REQUEST_URI'].'" method = "post">
                    <div class="mb-3">
                        <label for="problem" class="form-label">Problem title</label>
                        <input type="text" class="form-control" id="title" name="title" aria-describedby="emailHelp">
                        <div id="emailHelp" class="form-text">Make your problem title short</div>
                    </div>
                    <input type="hidden" name="sno" value="'. $_SESSION["sno"] .'">
                    <div class="mb-3">
                        <label for="problem_desc" class="form-label">Elaborate your problem</label>
                        <textarea class="form-control" id="desc" name="desc" rows="3"></textarea>
                    </div>
                        <button type="submit" class="btn btn-success">Submit</button>
                    </form>
                </div>';
        
        }
        else{
            echo '<div class="alert alert-secondary text-center" role="alert">
                    <h2 class="my-4">Start a discussion</h2>
                    <p class="lead my-3">Please login to start a discussion</p>
                  </div>';
        }
      
    ?>
    <div class="container mb-4">
        <h2 class="my-4">Browse Questions</h2>
        <?php 
        $id = $_GET['cat_id'];
        $sql = "SELECT * FROM `threads` WHERE thread_cat_id=$id;";
        $result = mysqli_query($conn,$sql);
        $noResult = true;
        while($row = mysqli_fetch_assoc($result))
        {
            $noResult = false;
            $thread_time = $row['timestamp'];
            $thread_id = $row['thread_id'];
            $thread_title = $row['thread_title'];
            $thread_desc = $row['thread_desc'];
            $thread_user_id = $row['thread_user_id'];
            $sql2 = "select user_email from users where user_id='$thread_user_id'";
            $result2 = mysqli_query($conn, $sql2);
            $row2 = mysqli_fetch_assoc($result2);
            $printTime = date("F j, Y, g:i a", strtotime($thread_time));
            echo '<div class="media mt-3">
                        <img class="mr-3" src="images/user.png" width="34px" alt="unable to load image">
                        
                        <div class="media-body">
                        <h5 class="mt-2"><a class="text-dark" href="threads.php?threadid='.$thread_id.'">'.$thread_title.'</a></h5>
                        '.$thread_desc.'
                        <p class="fw-bold mb-0">Asked by: '.$row2['user_email'].' at '.$printTime.'</p>
                        </div>
                      </div>';
        }
        if($noResult)
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