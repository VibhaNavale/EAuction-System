<!DOCTYPE HTML>
<html>
   
<head>
    <title>Search Product</title>
     
    <!-- Latest compiled and minified Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
         
    <!-- custom css -->
    <style>
    .m-r-1em{ margin-right:1em; }
    .m-b-1em{ margin-bottom:1em; }
    .m-l-1em{ margin-left:1em; }
    .mt0{ margin-top:0; }
        
    img{
        height: 150px;
        width: 150px;
    }
        
        
    </style>
 
</head>
<body style="background-image: url(img/bluebg.png); background-size: cover; background-repeat: no-repeat;">
 
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
   
<!-- Latest compiled and minified Bootstrap JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
 
</body>
</html>


<?php 

include "config/database.php";

$uname = $_GET['user'];

$Pname = $_POST['Pname'];

$sql = "CALL search('$Pname')";

$stmt = $con->prepare($sql);

$stmt->execute();

// this is how to get number of rows returned
$num = $stmt->rowCount();
 
//check if more than 0 record found
if($num > 0){
 
    echo "<table class='table table-hover table-responsive table-bordered' style='font-size:15px;'>";//start table
 
    //creating our table heading
    echo "<tr>";
        echo "<th>Photo</th>";
        echo "<th>Product Name</th>";
        echo "<th>Category</th>";
        echo "<th>Minimum Bid (in Rs.)</th>";
        echo "<th>End Time</th>";
        echo "<th>Action</th>";

    echo "</tr>";
     
    // retrieve our table contents
// fetch() is faster than fetchAll()
// http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop

while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
    // extract row
    // this will make $row['firstname'] to
    // just $firstname only
    extract($row);
    
    // creating new table row per record

    echo "<tr>";
        echo "<td><img src='uploads/$image'/></td>";
        echo "<td>{$pname}</td>";
        echo "<td>{$category}</td>";
        echo "<td>{$startprice}</td>";
        echo "<td>{$endtime}</td>";
        echo "<td>";
            // read one record 
            echo "<a href='bidder_read_one.php?pid={$pid}&user={$uname}' class='btn btn-info m-r-1em'>Read</a>";
        
            //place bid
            echo "<a href='bids.php?pid={$pid}&user={$uname}&bidamount=0' class='btn btn-primary m-r-1em'>Bid!</a>";
 
        echo "</td>";
    echo "</tr>";

}
 
// end table
echo "</table>";
echo "<a href='bidderpage.php?user=$uname' class='btn btn-primary m-r-1em'>Back</a>";
    
}
 
// if no products found
else{
    echo "<div class='alert alert-danger'>No products found.</div>";
}

?>