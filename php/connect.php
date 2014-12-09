<!-- connect.php -->
<?php
    //print_r(PDO::getAvailableDrivers());
    //phpinfo();

    session_start();
//    if (isset($_SESSION['views']))
//        $_SESSION['views']=$_SESSION['views']+1;
//    else 
//        $_SESSION['views']=1;
//
//    echo "in this sesion, you are visiting this page for " . $_SESSION['views']. "times";

    try {
        # MySQL with PDO_MYSQL
        $pdo = new PDO("mysql:host=localhost;dbname=forum", 'root', 'root');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

//        $handle = new PDO("mysql:host=orion.csl.mtu.edu;dbname=npyarroc", 'grader', 'grader');
//        $DBH = new PDO("mysql:host=db4free.net;dbname=activityforum", 'npyarroc', 'iadt,tebts');
//        $DBH = new PDO("mysql:host=db4free.net;dbname=webhelper", 'webhelper', 'webhelpers');
//        echo 'We connected to the database';
    }
    catch(PDOException $e) {
        echo $e->getMessage();
    }
?>