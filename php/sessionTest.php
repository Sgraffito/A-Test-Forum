<?php
session_start();
if (isset($_SESSION['views']))
    $_SESSION['views']=$_SESSION['views']+1;
else 
    $_SESSION['views']=1;
    
echo "in this sesion, you are visiting this page for " . $_SESSION['views']. "times";
?>

<br/>
Today's temp is 75.