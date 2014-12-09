<!-- create_cat.php -->

<?php
    include 'connect.php';
    include 'header.php';

//    if($_SESSION['signed_in'] == false)
//    {
//        //the user is not signed in
//        echo 'Sorry, you have to be <a href="/forum/signin.php">signed in</a> to create a topic.';
//    }
//    else {

    if($_SERVER['REQUEST_METHOD'] != 'POST') {
        //the form hasn't been posted yet, display it
        echo '<h2>Create a Category</h2>';
        echo '<form role="form" method="post" action="">
            <div class="form-group">
                <label for="cat_name">Category name:</label>
                <input type="text" class="form-control" name="cat_name">
            </div>
            <div class="form-group">
                <label for="cat_desc">Category description:</label>
                <textarea rows="8" type="text" class="form-control intput-lg" 
                name="cat_description" placeholder=""></textarea>
            </div>
            <button type="submit" value="Add category" class="btn btn-warning">Submit</button>
        </form>';  

    }

    // The form has been posted, so the category data
    else {
        
        try {
            $insert = $pdo->prepare("INSERT INTO categories
                    (cat_name, cat_description)
                    VALUES (:field1, :field2)");
            $insert->execute(array(':field1'=>$_POST['cat_name'],
                                   ':field2'=>$_POST['cat_description']));
            echo 'New category successfully added.';

        }
        // Catch any errors from inserting user
        catch (PDOException $ex) {
            echo 'Something went wrong while registering. Please try again later.';
            //echo $ex->getMessage(); // For debugging
        }
    }
//    }
    include 'footer.php';
?>