<!-- signin.php -->

<?php
    include 'connect.php';
    include 'header.php';

    echo '<h2>Sign In</h2>';

    // Check if the users is already signed in.
    if (isset($_SESSION['signed_in']) && $_SESSION['signed_in'] == true) {
        echo 'You are already signed in, you can <a href="signout.php">sign out </a> if you want.';
    }
    else {
        if($_SERVER['REQUEST_METHOD'] != 'POST') {
            // Show the form
            createForm();
        }
        else {
            $userName = "";
            $userPass = "";
            $userEmail = "";

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
            }

            // Check for all errors
            if (!empty($errors)) {
                echo 'Some fields were filled in incorrectly';
                echo '<ul>';
                foreach($errors as $key => $value) {
                    echo '<li>' . $value . '</li>';
                }
                echo '</ul>';
                // Show the form again so user can resubmit
                createForm();
            }

            // There are no errors, add to database
            else {
                $sql= 'SELECT * FROM users 
                WHERE user_name = :field1 AND user_pass = :field2';
                $select = $pdo->prepare($sql); 
                $select->execute(array(':field1'=>$_POST['user_name'],
                       ':field2'=>$_POST['user_pass']));
                $result = $select->fetchAll(PDO::FETCH_ASSOC);
                $row_count = count($result);
                                
                // Print error message if nothing was returned
                if (!$result) {
                    echo 'Something went wrong while signing in. Please try again';
                    
                    // Show the form again so user can resubmit
                    createForm();
                }
                // Something was returned by the mysql query
                else {
                    // If nothing was returned, print error message
                    if ($row_count == 0) {
                        echo 'The name and password combination is invalid';
                        // Show the form again so user can resubmit
                        createForm();
                    }
                    // If more than one row was returned, print error message.
                    else if ($row_count > 1) {
                        echo 'There was an error. Please try again';
                        // Show the form again so user can resubmit
                        createForm();
                    }
                    // One row was returned, sign the user in.
                    else {
                        $_SESSION['signed_in'] = true;
            
                        foreach($result as $row) {
                            $_SESSION['user_id'] = $row['user_id'];
                            $_SESSION['user_name'] = $row['user_name'];
                            $_SESSION['user_level'] = $row['user_level'];
                        }
                    
//                        echo "second test print";
//                        var_dump($user);
                        
                        echo 'Welcome, ' . $_SESSION['user_name'] . '.
                        <a href="index.php">Proceed to the forum overview.</a>.';
                    }
                }
            }
        }
    }
    include 'footer.php';

    
function createForm() {
    echo '<form role="form" method="post" action="">
            <div class="form-group">
                <label for="user_name">Username:</label>
                <input type="text" class="form-control" name="user_name" value=' . $_POST['user_name'] . ' >
            </div>
            <div class="form-group">
                <label for="pwd">Password:</label>
                <input type="password" class="form-control" name="user_pass">
            </div>
            <button type="submit" value="Add category" class="btn btn-warning">Sign In</button>
        </form>';
    }
?>