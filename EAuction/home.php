<!DOCTYPE html>
<html lang="en">
<?php
  $uname=$_GET['user'];    
?>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../../../favicon.ico">
    <title>E-Auction Home Page</title>
    
    <!--Template based on URL below-->
    <link rel="canonical" href="https://getbootstrap.com/docs/4.3/examples/starter-template/">

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    
<style>
    
    .carousel-item {
        width: 1150px;
        background: no-repeat scroll;
        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover;
    }
    .active a{
        color: #009688 !important;
    }
    
</style>
</head>
    
<body style="background-image: url(img/home.jpg); background-size: cover; background-repeat: no-repeat; color: #009688">

<nav class="navbar navbar-expand-md navbar-dark fixed-top">
    <a class="navbar-brand"><img src="img/logo.jpg" 
    style="height: 50px ; width:50px; border-radius: 100%"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
            <h5><li class="nav-item active">
                <a class="nav-link" href="home.php?user=<?php echo htmlspecialchars($uname, ENT_QUOTES);  ?>">Home<span class="sr-only">(current)</span></a>
            </li></h5>
            <h5><li class="nav-item active">
                <a class="nav-link" href="bidderpage.php?user=<?php echo htmlspecialchars($uname, ENT_QUOTES);  ?>">Bid products</a>
            </li></h5>
            <h5><li class="nav-item active">
                <a class="nav-link" href="mybids.php?user=<?php echo htmlspecialchars($uname, ENT_QUOTES);  ?>">My Bids</a>
            </li></h5>
            <h5><li class="nav-item active">
                <a class="nav-link" href="sellerpage.php?user=<?php echo htmlspecialchars($uname, ENT_QUOTES);  ?>">Sell products</a>
            </li></h5>
            
            <h5><li class="nav-item dropdown active">
                <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Categories</a>
                <div class="dropdown-menu" aria-labelledby="dropdown01">
                    <a class="dropdown-item" href="clothing.php?user=<?php echo htmlspecialchars($uname, ENT_QUOTES);  ?>">Clothing</a>
                    <a class="dropdown-item" href="furniture.php?user=<?php echo htmlspecialchars($uname, ENT_QUOTES);  ?>">Furniture</a>
                    <a class="dropdown-item" href="mobiles.php?user=<?php echo htmlspecialchars($uname, ENT_QUOTES);  ?>">Mobile Phones</a>
                    <a class="dropdown-item" href="footwear.php?user=<?php echo htmlspecialchars($uname, ENT_QUOTES);  ?>">Footwear</a>
                </div>
            </li></h5>
            <h5><li class="nav-item active">
                <a class="nav-link" href="winners.php?user=<?php echo htmlspecialchars($uname, ENT_QUOTES);  ?>">Winners</a>
            </li></h5>
        </ul>
        <h4><pre style="font-family: Comic Sans MS; color: #1976D2"><b>WELCOME TO E-AUCTION!                           </b></pre></h4>
        
        <h4><a href="logout.php"><label style="font-family: Oldtown; color: #1976D2">Logout</label></a></h4>
        
    </div>

</nav>
<main role="main" class="container">
    <br><br><br>

<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
  <ol class="carousel-indicators">
    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
  </ol>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img class="d-block w-100" src="img/winners.png" alt="winner">
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="img/clothing.jpg" alt="clothes">
        <div class="middle">
            <div class="carousel-caption">
                <h3 style="color: #E64A19; font-size: 24px"><strong>AMAZING PRODUCTS AT THE BEST PRICES!</strong></h3></div>
        </div>
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="img/phones.jpg" alt="TV">
        <div class="middle">
            <div class="carousel-caption">
                <h3 style="color: #FBC02D; font-size: 23px"><strong>THE MOST IN-DEMAND MOBILE PHONES AND MANY MORE!</strong></h3></div>
        </div>
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="img/Shoes.png" alt="shoes">
        <div class="middle">
            <div class="carousel-caption">
                <h3 style="color: #03A9F4; font-size: 23px"><strong>C'MON, RUN! GRAB THE FINEST PRODUCTS BEFORE THEY'RE GONE!</strong></h3></div>
        </div>
    </div>
  </div>

  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>

    </main><!-- /.container -->

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>