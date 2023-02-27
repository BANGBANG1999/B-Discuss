<?php  
session_start();

echo '<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="/forum">B-Discuss</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="/forum">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="about.php">About</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Top Categories
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">';
  
           
            $sql = "select category_name, category_id from categories limit 3";
            $result = mysqli_query($conn, $sql);
            while($row = mysqli_fetch_assoc($result))
            {
              echo '<li><a class="dropdown-item" href="threadList.php?cat_id='.$row["category_id"].'">'.$row["category_name"].'</a></li>';
              
            }
          echo '</ul>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="contactUs.php">Contact us</a>
        </li>
      </ul>
      <div class="row mx-2">';
      if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true)
        {
          echo '<form class="d-flex" role="search" method="get" action="/forum/search.php">
          <input class="form-control me-2" type="search" name="search_query" placeholder="Search" aria-label="Search" size="30">
          <button class="btn btn-success" type="submit" href="/forum/search.php">Search</button>
          <span class="text-light col-md-6 my-2 text-center">Welcome '.$_SESSION['useremail']. '</span>
          <a href="/forum/_handlelogout.php" class="btn btn-outline-success">Logout</a>
        </form>';
        }
        else{
          echo '<form class="d-flex" role="search" method="get" action="/forum/search.php">
          <input class="form-control me-2" type="search" name="search_query" placeholder="Search" aria-label="Search">
          <button class="btn btn-success" type="submit" href="/forum/search.php">Search</button>
        </form>
      </div>
       <button class="btn btn-outline-success mx-2" data-bs-toggle="modal" data-bs-target="#loginModal">Login</button>
      <button class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#signupModal">Signup</button>';
        }
    echo '</div>
  </div>
</nav>';

include 'partials/_loginModal.php';
include 'partials/_signupModal.php';

//Showing errors and success alerts in signup process
if(isset($_GET['signupsuccess']) && $_GET['signupsuccess'] == 'true')
{
  echo '<div class="alert alert-success alert-dismissible fade show my-0" role="alert">
                <strong>Success! </strong> You can now login
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
}
if(isset($_GET['error']) && $_GET['error'] == 'Email already in use')
{
  echo '<div class="alert alert-danger alert-dismissible fade show my-0" role="alert">
                <strong>oops! </strong>Email already in use
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
}
//showing error alert in both signup and login process
if(isset($_GET['error']) && $_GET['error'] == 'Password didnot matched')
{
  echo '<div class="alert alert-danger alert-dismissible fade show my-0" role="alert">
                <strong>oops! </strong> Password didnot matched
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
}

//showing success and error alert in login process
if(isset($_GET['loginsuccess']) && $_GET['loginsuccess'] == 'true')
{
  echo '<div class="alert alert-success alert-dismissible fade show my-0" role="alert">
                <strong>Success! </strong> You are now logged in
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
}
if(isset($_GET['error']) && $_GET['error'] == 'No user found')
{
  echo '<div class="alert alert-danger alert-dismissible fade show my-0" role="alert">
                <strong>oops! </strong>User not found
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
}

?>