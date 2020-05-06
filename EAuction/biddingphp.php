<!DOCTYPE HTML>
<html>
<body style="background-image: url(img/bidbg.jpg); background-size: cover; background-repeat: no-repeat;">
    
<?php

$uname = $_GET['user'];       

echo "<br><br>";
    
echo "<center><h1 style='font-family: Copperplate; font-size:55px; color: #1976D2'><u>Bid successfully placed!<u></h1></center>";
    
echo "<a href='bidderpage.php?user=$uname'> <button style='margin-left: 650px; margin-top: 50px; padding: 8px; font-size: 32px; background-color: #03A9F4; border-radius: 8px; color: #e3f2fd;'> Go Back </button></a>";

?>

</body>
</html>