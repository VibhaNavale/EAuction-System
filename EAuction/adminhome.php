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
    <title>Administrator Home Page</title>
    
    <!--Template based on URL below-->
    <link rel="canonical" href="https://getbootstrap.com/docs/4.3/examples/starter-template/">

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    
<style>
    .active a{
        color: #efebe9 !important;
    }
    
</style>
</head>
    
<body style="background-image: url(img/adminhome.jpg); background-size: cover; background-repeat: no-repeat; color: #4e342e; font-family: Luminari, fantasy;">

<nav class="navbar navbar-expand-md navbar-dark fixed-top">
    <a class="navbar-brand"><img src="img/logo.jpg" 
    style="height: 50px ; width:50px; border-radius: 100%"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
            <h5><li class="nav-item active">
                <a class="nav-link" href="adminhome.php?user=<?php echo htmlspecialchars($uname, ENT_QUOTES);  ?>">Home<span class="sr-only">(current)</span></a>
            </li></h5>
            
            <h5><li class="nav-item active">
                <a class="nav-link" href="auctionproducts.php?user=<?php echo htmlspecialchars($uname, ENT_QUOTES);  ?>">Auction Products</a>
            </li></h5>

            <h5><li class="nav-item active">
                <a class="nav-link" href="adwinners.php?user=<?php echo htmlspecialchars($uname, ENT_QUOTES);  ?>">Winners</a>
            </li></h5>
        </ul>
        
        <h4><pre style="font-family: Comic Sans MS; color: #3e2723"><b>Hello Admin!                               </b></pre></h4>
        
        <h4><a href="logout.php"><b><label style="font-family: Oldtown; color: #efebe9">Logout</label></b></a></h4>
        
    </div>

</nav>

    <div style="font-family: Luminari, fantasy; text-align: center; margin-top: 235px">
        <h1 style="font-size: 50px;"><b><u>WELCOME ADMINISTRATOR</u></b></h1>
    </div>
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>