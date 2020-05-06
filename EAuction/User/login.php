<?php
// include database and object files
include_once '../config/usersdb.php';
include_once '../user.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare user object
$user = new User($db);

// set ID property of user to be edited
$user->username = isset($_GET['username']) ? $_GET['username'] : die();
$user->password = isset($_GET['password']) ? $_GET['password'] : die();

$uname = $_GET['username'];

// read the details of user to be edited
$stmt = $user->login();
if($stmt->rowCount() > 0){
    // get retrieved row
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    // create array
//    $user_arr=array(
//        "status" => true,
//        "message" => "Successfully Login!",
//        "id" => $row['id'],
//        "username" => $row['username']
//    );

    if($_GET['username']!='admin'){
        header("Location: ../home.php?user=$uname");
        exit;
    }
    else{
        header("Location: ../adminhome.php?user=$uname");
        exit;
    }
        
}
else{
//    $user_arr=array(
//        "status" => false,
//        "message" => "Invalid Username or Password!",
//    );

    header("Location: ../index.php");
    exit;
}
// make it json format
//print_r(json_encode($user_arr));
?>

