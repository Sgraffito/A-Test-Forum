<!-- signup.php -->

<?php
    include 'connect.php';
    include 'header.php';
    echo '<h3>Sign Up</h3>';

    if($_SERVER['REQUEST_METHOD'] != 'POST') {
     /* If user has not submitted anything yet, show the form */
        createForm();      
    }

    /* The form has been posted - validate and save the data*/
    else {
        $userName = "";
        $userPass = "";
        $userEmail = "";
        $userPassRepeat = "";

        $errors = array(); // Array of errors

        // Check user name
        if ($_POST['user_name'] == "") {
            $errors[] = 'The username field must not be empty.';
        }
        else {
            $userName = filter_var($_POST['user_name'], FILTER_SANITIZE_STRING);
        }

        // Check user password
        if ($_POST['user_pass'] == "") {
            $errors[] = 'The password field cannot be empty.';
        }
        else {
            $userPass = filter_var($_POST['user_pass'], FILTER_SANITIZE_STRING);
            
            // Check to make sure two passwords are the same
            if($_POST['user_pass'] != $_POST['user_pass_check']) {
                $errors[] = 'The two passwords did not match.';
            }
        }
        
        // Check user email
        if ($_POST['user_email'] == "") {
            $errors[] = 'The email field cannot be empty.';
        }
        else {
            $userEmail = filter_var($_POST['user_email'], FILTER_SANITIZE_EMAIL);
            if (!filter_var($_POST['user_email'], FILTER_VALIDATE_EMAIL)) {
                $errors[] = $_POST['user_email'] . " is not a valid email address.";
            }
        }

        // Check for all errors
        if (!empty($errors)) {
            echo 'Some fields were filled in incorrectly';
            echo '<ul>';
            foreach($errors as $key => $value) {
                echo '<li>' . $value . '</li>';
            }
            echo '</ul>';
            createForm();

        }
        
        // There are no errors, add to database
        else {
            
            // Insert the user into the database
            try {
                $defaultLevel = 0;
                $insert = $pdo->prepare("INSERT INTO users
                (user_name, user_pass, user_email, user_date, user_level)
                VALUES (:field1, :field2, :field3, :field4, :field5)");
                $insert->execute(array(':field1'=>$_POST['user_name'],
                                       ':field2'=>$_POST['user_pass'],
                                       ':field3'=>$_POST['user_email'],
                                       ':field4'=>$_SERVER['REQUEST_TIME'],
                                       ':field5'=>$defaultLevel));

                echo '<p class="success"> Successfully registered. You can now <a href="signin.php">sign in</a> 
                    and start posting! :-)</p>';
            }
            // Catch any errors from inserting user
            catch (PDOException $ex) {
                if ($ex->errorInfo[1] == 1062) {
                    echo '<p class="error">The username already exists. Please choose another user name.</p>';
                }
                else {
                    echo '<p class="error">Something went wrong while registering. Please try again later.</p>';
                }
                // echo $ex->getMessage(); // For debugging
                
                // Show the form again so user can resubmit
                createForm();

            }
                        
//            $sql= 'SELECT * FROM users';
//            $stmt = $pdo->query($sql); 
//            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
//            foreach($result as $row){
//                echo $row['user_id'];
//                echo ' ';
//                echo $row['user_name'];
//                echo ' ';
//                echo $row['user_pass'];
//                echo ' ';
//                echo $row['user_email'];
//                echo '<br>';
//            }
        }
    }
function createForm() {
    echo '<form role="form" method="post" action="">
            <div class="form-group">
                <label for="user_name">Username:</label>
                <input type="text" class="form-control" id="email" 
                name="user_name" value=' . $_POST['user_name'] . ' >
            </div>
            <div class="form-group">
                <label for="pwd">Password:</label>
                <input type="password" class="form-control" id="pwd" name="user_pass">
            </div>
            <div class="form-group">
                <label for="pwd">Retype Password:</label>
                <input type="password" class="form-control" id="pwd" name="user_pass_check">
            </div>
            <div class="form-group">
                <label for="email">Email address:</label>
                <input type="email" class="form-control" id="email" 
                name="user_email" value=' . $_POST['user_email'] . '>
            </div>
            <div class="checkbox">
                <label><input type="checkbox"> Remember me</label>
            </div>
            <button type="submit" value="Add category" class="btn btn-warning">Submit</button>
        </form>';
}  

include 'footer.php';
?>