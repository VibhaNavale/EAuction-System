<!DOCTYPE HTML>
<html>
<head>
    <title>Update a Record</title>
     
    <!-- Latest compiled and minified Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
         
</head>
<body style="background-image: url(img/bluebg.png); background-size: cover; background-repeat: no-repeat;">
 
    <!-- container -->
    <div class="container">
  
        <div class="page-header">
            <h1 style="font-family: papyrus; color: #009688"><b>Update Product</b></h1>
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
    $pname = $row['pname'];
    $category = $row['category'];
    $description = $row['description'];
    $startprice = $row['startprice'];
    $endtime = $row['endtime'];
}
 
// show error
catch(PDOException $exception){
    die('ERROR: ' . $exception->getMessage());
}
?>
 
    <?php
 
// check if form was submitted
if($_POST){
     
    try{
        
        // write update query
        // in this case, it seemed like we have so many fields to pass and 
        // it is better to label them and not use question marks
        $query = "UPDATE products 
                    SET pname=:pname, category=:category, description=:description, startprice=:startprice, endtime=:endtime WHERE pid= :pid";
 
        // prepare query for excecution
        $stmt = $con->prepare($query);
 
        // posted values
        $pname=htmlspecialchars(strip_tags($_POST['pname']));
        $category=htmlspecialchars(strip_tags($_POST['category']));
        $description=htmlspecialchars(strip_tags($_POST['description']));
        $startprice=htmlspecialchars(strip_tags($_POST['startprice']));
 
        // bind the parameters
        $stmt->bindParam(':pname', $pname);
        $stmt->bindParam(':category', $category);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':startprice', $startprice);
        $stmt->bindParam(':endtime', $endtime);
        $stmt->bindParam(':pid', $pid);
         
        // Execute the query
        if($stmt->execute()){
            echo "<div class='alert alert-success'>Record was updated.</div>";
        }else{
            echo "<div class='alert alert-danger'>Unable to update record. Please try again.</div>";
        }
         
    }
     
    // show errors
    catch(PDOException $exception){
        die('ERROR: ' . $exception->getMessage());
    }
}
?>
 
<!--we have our html form here where new record information can be updated-->
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?pid={$pid}&user={$uname}"); ?>" method="post">
    <table class='table table-hover table-responsive table-bordered' style="font-size: 17px;">
        <tr>
            <td>Product Name</td>
            <td><input type='text' required="required" name='pname' value="<?php echo htmlspecialchars($pname, ENT_QUOTES);  ?>" class='form-control' style="font-size: 16px;"/></td>
        </tr>
            <tr>
            <td>Category</td>
            <td><select name="category" value="<?php echo htmlspecialchars($category, ENT_QUOTES);  ?>" class='form-control' style="font-size: 16px;">
            <option value="clothing">Clothing</option>
            <option value="furniture">Furniture</option>
            <option value="mobiles">Mobile Phones</option>
            <option value="footwear">Footwear</option>
            </select></td>
        </tr>
        <tr>
            <td>Description</td>
            <td><textarea name='description' required="required" class='form-control' style="font-size: 15px;"><?php echo htmlspecialchars($description, ENT_QUOTES);  ?></textarea></td>
        </tr>
        <tr>
            <td>Minimum Bid (in Rs.)</td>
            <td><input type='number' min=1 required="required" name='startprice' value="<?php echo htmlspecialchars($startprice, ENT_QUOTES);  ?>" class='form-control' style="font-size: 15px;"/></td>
        </tr>
        <tr>
            <td></td>
            <td>
                <input type='submit' value='Save Changes' class='btn btn-primary' />
                <a href='sellerpage.php?user=<?php echo htmlspecialchars($uname, ENT_QUOTES);  ?>' class='btn btn-danger'>Back</a>
            </td>
        </tr>
    </table>
</form>
         
    </div> <!-- end .container -->
     
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
   
<!-- Latest compiled and minified Bootstrap JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
 
</body>
</html>