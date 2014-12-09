<!-- header.php -->

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="description" content="A forum" />
    <title>My Awesome Forum</title>
    
    <!-- Custom stylesheet -->
    <link rel="stylesheet" href="../css/style.css" type="text/css">
    <!-- Bootstrap Core CSS -->
    <link href="../css/my-bootstrap-theme.css" rel="stylesheet">
    
    <!-- Custom Fonts -->
    <link href="font-awesome-4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href='http://fonts.googleapis.com/css?family=Kaushan+Script' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic' 
          rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700' 
          rel='stylesheet' type='text/css'>
</head>
  
<body>
<div class="wrapper">
    <!-- Header -->
    <header>
        <div class="container">
            <div class="intro-text">
                <div class="intro-lead-in">Welcome to our Super Awesome Forum!</div>
                <div class="intro-heading">Please Join In</div>
            </div>
        </div>
    </header>

    <!-- Services Section -->
    <section id="services">
        <div class="container">
            <div class="row">
               
                
                <div class="col-lg-12 text-center">
                    <div class="container">
                        <?php 
                        echo '<div class="user-intro">';
                        if($_SESSION['signed_in']) {
                            echo 'Hello ' . $_SESSION['user_name'] . 
                                '. Not you? <a class="link" href="signout.php">Sign out</a>';
                        }
                        else {
                            echo '<a class="link" href="signin.php">Sign in</a> or 
                            <a class="link" href="signup.php">create an account</a>.';
                        }
                        echo '</div>';
                        ?>
                    </div>
                </div>
                
            </div>
        </div>
    </section>
    
    <section id="content">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 forum-content">
                     <div class="col-lg-12 text-center forum-buttons">
                    <div class="btn-group" role="group" aria-label="...">
                        <a href="index.php">
                            <button type="button" class="btn btn-info btn-lg">Home</button>
                        </a>
                        <a href="create_topic.php">
                            <button type="button" class="btn btn-info btn-lg">Create a Topic</button>
                        </a>
                        <a href="create_cat.php">
                            <button type="button" class="btn btn-info btn-lg">Create a Category</button>
                        </a>
                    </div>
                </div>
                    
                
