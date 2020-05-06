<!DOCTYPE HTML>
<html>
<head>
    <title>Reading one record</title>
 
    <!-- Latest compiled and minified Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
 
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    
    <style>
        #bidbtn{
            padding: 7px;
            border-radius: 5px;
            background-color: #1976D0;
            color: #fff;
        }
    </style>
    
</head>
<body style="background-image: url(img/bluebg.png); background-size: cover; background-repeat: no-repeat;">
 
    <!-- container -->
    <div class="container">
  
        <div class="page-header">
            <h1 style="font-family: papyrus; color: #009688"><b>Bid On Product</b></h1>
        </div>
         
<?php
// get passed parameter value, in this case, the record ID
// isset() is a PHP function used to verify if a value is there or not
$pid=$_GET['pid'];
        

//include database connection
include 'config/database.php';
        
$uname = $_GET['user'];       

// read current record's data
try {
    // prepare select query
    $query = "SELECT * FROM products WHERE pid = ? LIMIT 0,1";

    $stmt = $con->prepare($query);
 
    // this is the first question mark
    $stmt->bindParam(1, $pid);
 
    // execute our query
    $stmt->execute();
 
    // store retrieved row to a variable
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    // values to fill up our form
    $pname = $row['pname'];
    $seller = $row['seller'];
    $category = $row['category'];
    $description = $row['description'];
    $startprice = $row['startprice'];
    $endtime = $row['endtime'];
    $image = $row['image'];   
    
    
    $pid=$_GET['pid'];
    $ba=$_GET['bidamount'];
    
    
    $sql="SELECT startprice FROM `products` WHERE pid=$pid";
    
    $stmt1 = $con->prepare($sql);
    $stmt1->bindParam(1, $pid);
    $stmt1->execute(); 
    
    $row1=$stmt1->fetch(PDO::FETCH_ASSOC);
    
    $sql3="select max(bidamount) from bidproducts where pid=$pid";
        $stmt3 = $con->prepare($sql3);
        $stmt3->bindParam(1, $pid);
        $stmt3->execute();
        $num3 = $stmt3->rowCount();
        $row2=$stmt3->fetch(PDO::FETCH_ASSOC);
    
        if($row2['max(bidamount)']!=NULL ){
            $maxbid = $row2['max(bidamount)']; 
        }
        else{
            $maxbid=$startprice;
        }
    
    
    if($ba!=0 && $ba>$row1['startprice'])
    {
        $sql2="insert into bidproducts values('$uname',$pid,$ba)";
        $stmt2 = $con->prepare($sql2);
        $stmt2->bindParam(1, $pid);
        
        if($stmt2->execute())
        {
            echo"<script>alert('You have placed a bid.')</script>";
            header("Location: biddingphp.php?user=$uname");
        }  
    }
    
    else if($ba!=0 && $ba<$row1['startprice'])
    {
        echo"<script>alert('Bid amount should be greater than minimum bid amount.')</script>";
    }
}
     
        
// show error
catch(PDOException $exception){
    die('ERROR: ' . $exception->getMessage());
}

?>
 
        <!--we have our html table here where the record will be displayed-->
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="get">
<table class='table table-hover table-responsive table-bordered' style="font-size: 16px;">
    <tr>  
        <td>Username</td>
        <td><input type="text" name='user' value="<?php echo htmlspecialchars($uname, ENT_QUOTES);  ?>" readonly /></td>
    </tr>
    <tr>
        <td>Photo</td>
        <td>
            <?php echo $image ? "<img src='uploads/{$image}' style='width: 300px;' />" : "No image found.";  ?>
        </td>
    </tr>
    <tr>  
        <td>Product Name</td>
        <td><?php echo htmlspecialchars($pname, ENT_QUOTES); ?></td>
    </tr>
    <?php
        if($seller==""){
            echo "<tr>
                <td>Seller Name</td>
                <td>No Seller Found.</td>
            </tr>";
        } 
        else{
            echo "<tr>
                <td>Seller Name</td>
                <td>$seller</td>
            </tr>";
        }
    ?>
    <tr>
        <td>Category</td>
        <td><?php echo htmlspecialchars($category, ENT_QUOTES); ?></td>
    </tr>
    <tr>
        <td>Description</td>
        <td><?php echo htmlspecialchars($description, ENT_QUOTES); ?></td>
    </tr>
    <tr>
        <td>Minimum Bid (in Rs.)</td>
        <td><?php echo htmlspecialchars($startprice, ENT_QUOTES); ?></td>
    </tr>
    <tr>
        <td>Maximum Bid Placed (Current)</td>
        <td><?php echo htmlspecialchars($maxbid, ENT_QUOTES); ?></td>
    </tr>
    <tr>
        <td>Bid Amount (in Rs.)</td>
        <td><input type='number' min='1' name='bidamount' style="width: 100%; padding: 3px"/>
            <h4 style="color: red"><i>Bid carefully. You can bid only once.</i></h4>
        </td>
    </tr>
    <tr>
        <td></td>
        <td><button type="submit" name="pid" value="<?php echo htmlspecialchars($pid, ENT_QUOTES);?>" class='btn btn-primary' style="font-size: 16px">Place Bid</button>
               
        <a href='bidderpage.php?user=<?php echo htmlspecialchars($uname, ENT_QUOTES);  ?>' class='btn btn-danger' style="font-size: 16px;">Back</a>
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