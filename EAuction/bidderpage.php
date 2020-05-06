<!DOCTYPE HTML>
<html>
<?php 
    
$uname = $_GET['user'];
    
?>  
<head>
    <title>Bidder Page</title>
     
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
 
    <!-- container -->
    <div class="container">
  
        <div class="page-header">
             
            <h1 style="font-family: Bradley Hand; color: #009688"><b>Welcome Bidder!</b></h1>
            
            <form class="form-inline my-2 my-lg-0" action="search.php?user=<?php echo htmlspecialchars($uname, ENT_QUOTES);  ?>" method="post">
                <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search" name="Pname">
                <button class="btn btn-secondary my-2 my-sm-0" type="submit">Search</button>
            </form> 
        </div>
        
    </div> <!-- end .container -->
     
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
   
<!-- Latest compiled and minified Bootstrap JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
 
</body>
</html>

<?php
// include database connection
include 'config/database.php';

// PAGINATION VARIABLES
// page is the current page, if there's nothing set, default is page 1
$page = isset($_GET['page']) ? $_GET['page'] : 1;
 
// set records or rows of data per page
$records_per_page = 5;
 
// calculate for the query LIMIT clause
$from_record_num = ($records_per_page * $page) - $records_per_page;

 
// select all data
// select data for current page
$query = "SELECT * FROM products ORDER BY pid ASC
    LIMIT :from_record_num, :records_per_page";
 
$stmt = $con->prepare($query);
$stmt->bindParam(":from_record_num", $from_record_num, PDO::PARAM_INT);
$stmt->bindParam(":records_per_page", $records_per_page, PDO::PARAM_INT);
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
echo "<a href='home.php?user=$uname' class='btn btn-primary m-r-1em'>Home</a>";
    
// PAGINATION
// count total number of rows
$query = "SELECT COUNT(*) as total_rows FROM products";
$stmt = $con->prepare($query);
 
// execute query
$stmt->execute();
 
// get total rows
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$total_rows = $row['total_rows'];     
    
    
// paginate records
$page_url="bidderpage.php?user=$uname&";
include_once "paging.php";
    
    
}
 
// if no records found
else{
    echo "<div class='alert alert-danger'>No products found.</div>";
}
?>