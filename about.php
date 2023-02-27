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
    
    <!--corousel starts-- -->
    <div class="container">
    <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="images/naruto.jpg" class="d-block w-100" width="2400" height="400" alt="...">
    </div>
    
  </div>
</div>
    </div>




    <div class="container text-center my-4">
        <div class="jumbotron-fluid bg-light">
            <h1 class="display-4"><b>“THE MOMENT PEOPLE COME TO KNOW LOVE, THEY RUN THE RISK OF CARRYING HATE.”</b></h1>
            <p class="lead my-3"> </p>


            <hr class="my-2">

            <p></p>
        </div>
    </div>

    





    </div>
    </div>
    
    <?php include 'partials/_footer.php'?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous">
    </script>


</body>

</html>