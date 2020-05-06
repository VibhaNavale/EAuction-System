<!DOCTYPE HTML>
<html>
<head>
    <title>Reading one record</title>
 
    <!-- Latest compiled and minified Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
 
</head>
<body style="background-image: url(img/bluebg.png); background-size: cover; background-repeat: no-repeat;">
 
    <!-- container -->
    <div class="container">
  
        <div class="page-header">
            <h1 style="font-family: papyrus; color: #009688"><b>Product Info</b></h1>
        </div>
         
<?php
// get passed parameter value, in this case, the record ID
// isset() is a PHP function used to verify if a value is there or not
$pid=isset($_GET['pid']) ? $_GET['pid'] : die('ERROR: Record ID not found.');
 
//include database connection
include 'config/database.php';
$uname = $_GET['user'];
        
// read current record's data
try {
    // prepare select query
    $query = "SELECT * FROM products WHERE pid = ? LIMIT 0,1";

    $stmt = $con->prepare( $query );
 
    // this is the first question mark
    $stmt->bindParam(1, $pid);

 
    // execute our query
    $stmt->execute();
 
    // store retrieved row to a variable
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
 
    // values to fill up our form
    $pid = $row['pid'];
    $seller = $row['seller'];
    $pname = $row['pname'];
    $category = $row['category'];
    $description = $row['description'];
    $startprice = $row['startprice'];
    $endtime = $row['endtime'];
    $image = $row['image'];

}
 
// show error
catch(PDOException $exception){
    die('ERROR: ' . $exception->getMessage());
}
        
?>
 
        <!--we have our html table here where the record will be displayed-->
<table class='table table-hover table-responsive table-bordered' style="font-size: 16px;">
    <tr>
        <td>Product Name</td>
        <td><?php echo htmlspecialchars($pname, ENT_QUOTES);  ?></td>
    </tr>
    <tr>
        <td>Seller Name</td>
        <td><?php echo htmlspecialchars($seller, ENT_QUOTES);  ?></td>
    </tr>
    <tr>
        <td>Category</td>
        <td><?php echo htmlspecialchars($category, ENT_QUOTES);  ?></td>
    </tr>
    <tr>
        <td>Description</td>
        <td><?php echo htmlspecialchars($description, ENT_QUOTES);  ?></td>
    </tr>
    <tr>
        <td>Minimum Bid (in Rs.)</td>
        <td><?php echo htmlspecialchars($startprice, ENT_QUOTES);  ?></td>
    </tr>
    <tr>
        <td>End Time</td>
        <td><?php echo htmlspecialchars($endtime, ENT_QUOTES);   ?></td>
    </tr>
    <tr>
        <td>Image</td>
        <td>
            <?php echo $image ? "<img src='uploads/{$image}' style='width:300px;' />" : "No image found.";  ?>
        </td>
    </tr>
    <tr>
        <td></td>
        <td>
            <a href='auctionproducts.php?user=<?php echo htmlspecialchars($uname, ENT_QUOTES); ?>' class='btn btn-danger'>Back</a>
        </td>
    </tr>
</table>
 
    </div> <!-- end .container -->
     
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
   
<!-- Latest compiled and minified Bootstrap JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
 
</body>
</html>