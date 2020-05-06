<?php
// include database connection
include 'config/database.php';
 
try {
     
    // get record ID
    // isset() is a PHP function used to verify if a value is there or not
    $pid=isset($_GET['pid']) ? $_GET['pid'] : die('ERROR: Record ID not found.');

    // delete query
    $query = "DELETE FROM products WHERE pid = ?";
    $stmt = $con->prepare($query);
    $stmt->bindParam(1, $pid);

    if($stmt->execute()){
        // redirect to read records page and 
        // tell the user record was deleted
        header('Location: auctionproducts.php?action=deleted');
    }
    else{
        die('Unable to delete product.');
    }
}
 
// show error
catch(PDOException $exception){
    die('ERROR: ' . $exception->getMessage());
}
?>