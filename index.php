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

    <!-- Slider starts here -->
    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="true">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"
                aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
                aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
                aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="images/3.jpg" class="d-block w-100" width="2400" height="400" alt="...">
            </div>
            <div class="carousel-item">
                <img src="images/1.jpg" class="d-block w-100" width="2400" height="400" alt="...">
            </div>
            <div class="carousel-item">
                <img src="images/2.jpg" class="d-block w-100" width="2400" height="400" alt="...">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
            data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
            data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    
        
    <div class="container my-5" align="center">
        <h2 class="text-center my-4">B-Discuss | Browse Categories</h2>
    <div class="row">
        
        <?php 

        //Iterate through the categories using a loop
        $sql = 'select * from categories';
        $result = mysqli_query($conn,$sql);
        while($row = mysqli_fetch_assoc($result)){
            $cat_id = $row['category_id'];
            $category_name = $row['category_name'];
            $category_desc = $row['category_description'];
            echo '<div class="col-md-4 my-3">
                    <div class="card" style="width: 18rem;">';
                         if($row['category_name'] == 'Python')
                        {
                            echo '<img src="images/pythonAllSet.jpg" class="card-img-top" alt="...">';
                        }
                        if($row['category_name'] == 'Javascript')
                        {
                            echo '<img src="images/js.jpg" class="card-img-top" alt="...">';
                        }
                        if($row['category_name'] == 'C++'){
                            echo '<img src="images/new2.jpg" class="card-img-top" alt="...">';
                        }
                        echo '<div class="card-body">
                        <h5 class="card-title">'.$category_name.'</h5>
                        <p class="card-text">'.substr($category_desc, 0, 38).'...</p>
                        <a href="threadList.php?cat_id='.$cat_id.'" class="btn btn-primary">View Threads</a>
                        </div>
                    </div>
                </div>';
        }
    ?>




    </div>
</div>

    <?php include 'partials/_footer.php'?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous">
    </script>
</body>

</html>