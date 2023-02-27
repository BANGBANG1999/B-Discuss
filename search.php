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

<div class="container my-3 mx-3">
    
    <h1 class="searchArea mb-3">Search results for <i>"<?php echo $_GET['search_query'];?>"</i></h1>
    <style>
        .result{
            padding-bottom: 18px;
            padding-top: 20px;
        }
    </style>
    <style>
        .searchArea{
            padding-bottom: 30px;
           
        }
    </style>
    
    <?php 
    $noResult = true;
    $query = $_GET['search_query'];
    //ALTER TABLE threads ADD FULLTEXT (`thread_title`, `thread_desc`)---this query will enable fulltext search
    $sql = "select * from threads where match (thread_title, thread_desc) against ('$query')";
    $result = mysqli_query($conn, $sql);
    while($row = mysqli_fetch_assoc($result))
    {
        $noResult = false;
        $thread_title = $row['thread_title'];
        $thread_desc = $row['thread_desc'];
        $thread_id = $row['thread_id'];
        echo '  
            <div class="p-5 text-center bg-light p-2" >
                <h1 class="mb-3">'.$thread_title.'</h1>
                <h4 class="mb-3">'.$thread_desc.'</h4>
                <a class="btn btn-primary" href="threads.php?threadid='.$thread_id.'" role="button">Visit thread</a>
            </div>';
    }

    if($noResult)
    {
        echo '
                <div class="p-4 shadow-4 rounded-3" style="background-color: hsl(0, 0%, 94%);">
                    <h2>No Results Found!</h2>
                    <hr class="my-4" />
                    <p>
                        Suggestions: <ul>
                        <li>Make sure that all words are spelled correctly.</li>
                        <li>Try different keywords.</li>
                        <li>Try more general keywords.</li>
                        <li>Try fewer keywords.</li>
                    </p>
                    
                </div>';
    }
    ?>   
</div>
    
    <?php include 'partials/_footer.php'?>
   
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous">
    </script>
</body>

</html>