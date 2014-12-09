<!-- categories.php -->

<?php
    include 'connect.php';
    include 'header.php';

//    echo 'ID is: '. $_GET['id'];
    
    // First select the category based on $_GET['cat_id']
    $sql= 'SELECT cat_id, cat_name, cat_description FROM categories
        WHERE cat_id = :field1';
    $select = $pdo->prepare($sql); 
    $select->execute(array(':field1'=>$_GET['id']));
    $result = $select->fetchAll(PDO::FETCH_ASSOC);
    $row_count = count($result);

    if (!$result) {
        echo 'An error has occured while displaying the categories. Please try again later';
    }
    else {
        if ($row_count == 0) {
            echo 'This category does not exist';
        }
        else {
            // Display category name
            foreach($result as $row) {
                echo '<h2>Topics in ' . $row['cat_name'] . ' category</h2>';
            }
            
            // Do a query for the topics
            $sql= 'SELECT topic_id, topic_subject, topic_date, topic_cat
            FROM topics
            WHERE topic_cat = :field1';
            $select = $pdo->prepare($sql); 
            $select->execute(array(':field1'=>$_GET['id']));
            $result = $select->fetchAll(PDO::FETCH_ASSOC);
            $row_count = count($result);

            if(!$result) {
                echo 'The topics could not be displayed, please try again later.';
            }
            else {
                if ($row_count == 0) {
                    echo 'There are no topics in this category yet';
                }
                // Display the topics in a table
                else {
                    echo "<table class='table, table-striped'>
                    <thead class>
                        <tr class='forum-table-row'>
                            <th class='forum-table-label, col-md-3'><h4>Topic</h4></th>
                            <th class='forum-table-label, col-md-2'><h4>Created</h4></th>
                        </tr>
                    </thead>";

                    echo "<tbody>";
                    foreach($result as $row) {               
                            echo "<tr class='table_row'>";
                                echo "<td>";
                                    echo '<h3><a href="topic.php?id=' . 
                                        $row['topic_id'] . '">' . $row['topic_subject'] . '</a><h3>';
                                echo "</td>";

                                echo "<td>";
                                    echo date('d-m-Y', strtotime($row['topic_date']));
                                echo '</td>';
                            echo "</tr>";
                    }
                    echo "</tbody>";
                    echo "</table>";
                }
            }
        }
    }

    include 'footer.php';
?>