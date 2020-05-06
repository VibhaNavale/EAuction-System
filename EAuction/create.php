<!DOCTYPE HTML>
<html>
<head>
    <title>Add Products</title>
      
    <!-- Latest compiled and minified Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
          
</head>
<body style="background-image: url(img/bluebg.png); background-size: cover; background-repeat: no-repeat;">
  
    <!-- container -->
    <div class="container">
   
        <div class="page-header">
            <h1 style="font-family: papyrus; color: #009688"><b>Create Product</b></h1>
        </div>
      
<?php
        
$uname = $_GET['user'];        
        
if($_POST){
 
    // include database connection
    include 'config/database.php';
            
    try{
     
        // insert query
        $query = "INSERT INTO products SET pid=:pid, seller=:seller, pname=:pname, category=:category, description=:description, startprice=:startprice, endtime=:endtime, image=:image";
 
        // prepare query for execution
        $stmt = $con->prepare($query);
 
        // posted values
        $pid = $_POST['pid'];
        $seller = $_GET['user'];
        $pname = $_POST['pname'];
        $category = $_POST['category'];
        $description = $_POST['description'];
        $startprice = $_POST['startprice'];
        $endtime = $_POST['endtime'];

        // new 'image' field
        $image=$_FILES["image"]["name"];
        $image=htmlspecialchars(strip_tags($image));
        
        // bind the parameters
        $stmt->bindParam(':pid', $pid);
        $stmt->bindParam(':seller', $seller);
        $stmt->bindParam(':pname', $pname);
        $stmt->bindParam(':category', $category);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':startprice', $startprice);
        $stmt->bindParam(':endtime', $endtime);
        $stmt->bindParam(':image', $image);

        // Execute the query
        if($stmt->execute()){
            
            echo "<div class='alert alert-success'>Record was saved.</div>";
            // now, if image is not empty, try to upload the image
            if($image){
 
                // sha1_file() function is used to make a unique file name
                $target_directory = "uploads/$image";
                $target_file = $target_directory . $image;
                
                $file_type = pathinfo($target_file, PATHINFO_EXTENSION);
 
                // error message is empty
                $file_upload_error_messages="";
                
                // make sure that file is a real image
                $check = getimagesize($_FILES["image"]["tmp_name"]);
                if($check!==false){
                    // submitted file is an image
                }else{
                    $file_upload_error_messages.="<div>Submitted file is not an image.</div>";
                }
                
                // make sure certain file types are allowed
                $allowed_file_types=array("jpg", "jpeg", "png", "gif");
                if(!in_array($file_type, $allowed_file_types)){
                    $file_upload_error_messages.="<div>Only JPG, JPEG, PNG, GIF files are allowed.</div>";
                }
                
                // make sure file does not exist
                if(file_exists($target_file)){
                    $file_upload_error_messages.="<div>Image already exists. Try to change file name.</div>";
                }
                
                // make sure submitted file is not too large, can't be larger than 16 MB
                if($_FILES['image']['size'] > (6777215)){
                    $file_upload_error_messages.="<div>Image must be less than 16 MB in size.</div>";
                }
                
                // make sure the 'uploads' folder exists
                // if not, create it
//                if(!is_dir($target_directory)){
//                    mkdir($target_directory, 0777, true);
//
//                }
                
                // if $file_upload_error_messages is still empty
                if(empty($file_upload_error_messages)){
                    // it means there are no errors, so try to upload the file
                    
                    if(move_uploaded_file($_FILES["image"]["tmp_name"], $target_directory)){
                    // it means photo was uploaded
                    }else{
                        echo "<div class='alert alert-danger'>";
                            echo "<div>Unable to upload photo.</div>";
                            echo "<div>Update the record to upload photo.</div>";
                        echo "</div>";
                    }
                }
 
                // if $file_upload_error_messages is NOT empty
                else{
                // it means there are some errors, so show them to user
                echo "<div class='alert alert-danger'>";
                    echo "<div>{$file_upload_error_messages}</div>";
                    echo "<div>Update the record to upload photo.</div>";
                echo "</div>";
                }
            }
        }
        
        else{
            echo "<div class='alert alert-danger'>Unable to save record.</div>";
            
        }
         
    }
     
    // show error
    catch(PDOException $exception){
        die('ERROR: ' . $exception->getMessage());
    }
}
?>
 
<!-- html form here where the product information will be entered -->
<form action="?user=<?php echo htmlspecialchars($uname);?>" method="post" enctype="multipart/form-data">

    <table class='table table-hover table-responsive table-bordered'>
        <tr>
            <td>Product ID</td>
            <td><input type='number' min='1' name='pid' class='form-control' required="required"/></td>
        </tr>
        <tr>
            <td>Product Name</td>
            <td><input type='text' name='pname' class='form-control' required="required"/></td>
        </tr>
        <tr>
            <td >Category</td>
            <td><select name="category">
            <option value="clothing">Clothing</option>
            <option value="furniture">Furniture</option>
            <option value="mobiles">Mobile Phones</option>
            <option value="footwear">Footwear</option>
            </select></td>
        </tr>
        <tr>
            <td>Description</td>
            <td><textarea name='description' class='form-control' required="required"></textarea></td>
        </tr>
        <tr>
            <td>Minimum Bid (in Rs.)</td>
            <td><input type='number' min="1" name='startprice' class='form-control' required="required"/></td>
        </tr>

        <tr>
            <td>End Time</td>
            <td><input type=datetime-local name='endtime' class='form-control' required="required"></td>
        </tr>
        <tr>
            <td>Photo</td>
            <td><input type="file" name="image"> </td>
        </tr>
        <tr>
            <td></td>
            <td>
                <input type='submit' value='Save' class='btn btn-primary' />
                <a href='sellerpage.php?user=<?php echo htmlspecialchars($uname, ENT_QUOTES); ?>' class='btn btn-danger'>Back</a>
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