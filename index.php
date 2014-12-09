<?php
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
        else {
            //prepare the table
            echo '<table border="1">
                  <tr>
                    <th>Category</th>
                    <th>Last topic</th>
                  </tr>'; 

            foreach($result as $row) {               
                echo '<tr>';
                    echo '<td class="leftpart">';
                        echo '<h3><a href="category.php?id">' 
                        . $row['cat_name'] . '</a></h3>' . $row['cat_description'];
                    echo '</td>';
                    echo '<td class="rightpart">';
                        echo '<a href="topic.php?id=">Topic subject</a> at 10-10';
                    echo '</td>';
                echo '</tr>';
            }
            echo '</table>' ;
        }
    }

    include 'footer.php';
?>