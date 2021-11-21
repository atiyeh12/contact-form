<?php
ini_set('display_errors', 1);
error_reporting(~0);
require_once ('../database/config.php');

if(isset($_REQUEST['del'])){
    $servicesId = intval($_GET['del']);
   
    $sql = "DELETE from services  WHERE id=$servicesId";

    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('record deleted successfully');</script>";
        echo "<script>window.location.href='index.php'</script>";
    } else {
        echo "<script>alert('Error deleted record');</script>";
        echo "Error updating record: " . mysqli_error($conn);
    }
}
    ?>
    <!DOCTYPE html>
    <html>
        <head>
            <link rel="stylesheet" href="style.css">
            <style>

            
            </style>
        </head>
        <body>
            <p class="outset">services</p>
            <?php

            $sql = "SELECT * FROM services";
            $result = $conn->query($sql);


            if ($result->num_rows > 0) {
                // output data of each row
                ?>
                <table style="width:100%" border="2">
                    <tr>
                        <th>name</th>
                        <th>edit item </th>
                        <th>delete item</th>

                    </tr>   
            
                    <?php
            
                    while($row = $result->fetch_assoc()) {
                        ?>
                        <tr>
                            <td>
                                <?php echo $row["name"]; ?>
                            </td>
                    
                                        <td><a href="update.php?id=<?php echo $row ['id']; ?>">edit</a></td>
                                        <td><a href="index.php?del=<?php echo  $row ['id']; ?>">delete</a></td>
                                </tr>
                                <?php
                            }
                        } else {
                        echo "0 results";
                    }
                    $conn->close();
                    ?>
                    	
         <a href="create.php">Visit create.php</a>

         

    </body>
    </html>