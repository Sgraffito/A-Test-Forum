<!-- index.php -->

<?php
    session_start();
    include 'connect.php';
    include 'header.php';
   
    $sql= 'SELECT cat_id, cat_name, cat_description FROM categories';
    $stmt = $pdo->query($sql); 
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $row_count = count($result);

    if(!$result) {
        echo 'The categories could not be displayed, please try again later.';
    }
    else {
        if($row_count == 0) {
            echo 'No categories defined yet.';
        }
        // Create the table
        else {
            echo "<table class='table, table-striped'>
                <thead class>
                    <tr class='forum-table-row'>
                        <th class='forum-table-label'><h4>Category</h4></th>
                        <th class='forum-table-label'><h4>Last Topic</h4></th>
                    </tr>
                </thead>";
            
            echo "<tbody>";
            foreach($result as $row) {               
                    echo "<tr class='table_row'>";
                        echo "<td class='col-md-3'>";
                            echo '<h3><a href="categories.php?id=' . $row['cat_id'] . '">' 
                            . $row['cat_name'] . "</a></h3>" . $row['cat_description'];
                        echo "</td>";
                
                        echo "<td class='col-md-2'>";
                            echo '<a href="topic.php?id=">Topic subject</a> at 10-10';
                        echo '</td>';
                    echo "</tr>";
            }
            echo "</tbody>";
            echo "</table>";
        }
    }

    include 'footer.php';
?>