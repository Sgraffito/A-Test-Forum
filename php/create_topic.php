<!-- create_topic.php -->

<?php
    include 'connect.php';
    include 'header.php';
   
    echo '<h2>Create a Topic</h2>';

    // Check to make sure user is signed in
    if ($_SESSION['signed_in']==false) {
        echo '<p>Sorry, you have to be <a href="signin.php">signed in</a> to create a topic.';
    }
    // The user is signed in
    else {
        // The user has not posted the form yet
        if($_SERVER['REQUEST_METHOD'] != 'POST') {
        
            // Display the form
            $sql= 'SELECT cat_id, cat_name, cat_description FROM categories';
                    $select = $pdo->prepare($sql); 
                    $select->execute();
                    $result = $select->fetchAll(PDO::FETCH_ASSOC);
                    $row_count = count($result);
            if (!$result) {
                echo 'An error has occured. Please try again later';
            }
            if ($row_count == 0) {
                echo 'There are no categories posted yet';
            }
            else {
                echo '<form role="form" method="post" action="">
                    <div class="form-group">
                        <label for="subject">Subject:</label>
                        <input type="text" class="form-control" name="topic_subject">
                    </div>
                    <div class="form-group">
                        <label for="topic_cat">Categories:</label>
                        <select class="form-control" name="topic_cat">';
                foreach($result as $row) {
                    echo '<option value=' . $row['cat_id']. '>' . $row['cat_name'] . '</option>';
                }
                    echo '</select>';
                echo '</div>';

                echo '<div class="form-group">
                    <label for="cat_desc">Message:</label>
                    <textarea rows="8" type="text" class="form-control intput-lg" 
                    name="post_content" placeholder=""></textarea>
                </div>';

                echo '<div class="form-group">
                </div>
                    <button type="submit" value="Add category" class="btn btn-warning">Create Topic</button>
                </form>';
            }
        }
        // The user has submitted a new topic
        // Insert into the posts and topics tables
        else {
                        
            try {
                // Start a transaction (turn off auto-commit)
                $pdo->beginTransaction();
                
                // Insert into topics
                $insert = $pdo->prepare("INSERT INTO topics
                (topic_subject, topic_date, topic_cat, topic_by)
                VALUES (:field1, :field2, :field3, :field4)");
                $insert->execute(array(':field1'=>$_POST['topic_subject'],
                                       ':field2'=>getdate(),
                                       ':field3'=>$_POST['topic_cat'],
                                       ':field4'=>$_SESSION['user_id']));
                

                // Get the id of the last inserted topic
                $topicID = $pdo->lastInsertId();

                // Insert into posts
                $insert = $pdo->prepare("INSERT INTO posts
                (post_content, post_date, post_topic, post_by)
                VALUES (:field1, :field2, :field3, :field4)");
                $insert->execute(array(':field1'=>$_POST['post_content'],
                                       ':field2'=>getdate(),
                                       ':field3'=>$topicID,
                                       ':field4'=>$_SESSION['user_id']));

                $pdo->commit();
                echo '<h3>Your topic was created</h3>';
                echo 'You have successfully created <a href="topic.php?id='. $topicID . '">your new topic</a>.';
            }
            catch (PDOException $ex) {
                // Rollback the transaction if anything bad occurs
                $pdo->rollBack();
                echo 'Something went wrong while registering. Please try again later.';
                //echo $ex->getMessage(); // For debugging
            }
        }
    }

include 'footer.php';
?>
