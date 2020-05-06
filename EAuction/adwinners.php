<!DOCTYPE HTML>
<html>
   
<head>
    <title>Winners</title>
     
    <!-- Latest compiled and minified Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
         
    <!-- custom css -->
    <style>
    .m-r-1em{ margin-right:1em; }
    .m-b-1em{ margin-bottom:1em; }
    .m-l-1em{ margin-left:1em; }
    .mt0{ margin-top:0; }
        
    img{
        height: 130px;
        width: 130px;
    }
        
        
    </style>
 
</head>
<body style="background-image: url(img/bluebg.png); background-size: cover; background-repeat: no-repeat;">
 
    <!-- container -->
    <div class="container">
  
        <div class="page-header">
            <h1 style="font-family: Bradley Hand; color: #009688"><b>Winners</b></h1>
        </div>
         
    </div> <!-- end .container -->
     
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
   
<!-- Latest compiled and minified Bootstrap JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
 
</body>
</html>


<?php
include "config/database.php";
$uname = $_GET['user']; 

$query = "SELECT image, pname, category, winningbid, username
            FROM winners";

$stmt = $con->prepare($query);

$stmt->execute(); 

// this is how to get number of rows returned
$num = $stmt->rowCount();

if($num > 0){

    echo "<table class='table table-hover table-responsive table-bordered' style='font-size:16px;'>"; //start table
 
    //creating our table heading
    echo "<tr>";
        echo "<th>Photo</th>";
        echo "<th>Product Name</th>";
        echo "<th>Category</th>";
        echo "<th>Winning Bid</th>";
        echo "<th>Bid Winner</th>";
    echo "</tr>";

    // retrieve our table contents
// fetch() is faster than fetchAll()
// http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop

while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
    // extract row
    // this will make $row['firstname'] to
    // just $firstname only
    extract($row);

    $pname = $row['pname'];
    $category = $row['category'];
    $winningbid = $row['winningbid'];
    $username = $row['username'];
    
    // creating new table row per record

    echo "<tr>";
        echo "<td><img src='uploads/$image'/></td>";
        echo "<td>$pname</td>";
        echo "<td>$category</td>";
        echo "<td>$winningbid</td>";
        echo "<td>$username</td>";
    echo "</tr>";

}
 
// end table
echo "</table>";
echo "<a href='adminhome.php?user=$uname' class='btn btn-primary m-r-1em'>Home</a>"; 
    
}
 
// if no records found
else{
    echo "<div class='alert alert-danger'>No winners yet.</div>";
}

?>