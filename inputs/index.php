<?php

ini_set('display_errors', 1);
error_reporting(~0);
require_once('../database/config.php');

if (isset($_REQUEST['del'])) {
    $inputsId = intval($_GET['del']);
   
    $sql = "DELETE from inputs  WHERE id=$inputsId";

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
        <p class="inset">inputs</p>


        <?php

        $sql = "SELECT * FROM inputs";
        $result = $conn->query($sql);


        if ($result->num_rows > 0) {
            // output data of each row?>
			<table style="width:100%" border="1">
                <tr>
                    <th>fullname</th>
                    <th>subject</th>
                    <th>description</th>
                    <th>services</th>
                    <th>satisfie</th>
                </tr>   

                <?php
                while ($row = $result->fetch_assoc()) {
                    ?>
                    <tr>
                        <td>
                            <?php echo $row["fullname"]; ?>
                        </td>
                        <td>
                            <?php echo $row["subject"]; ?>
                        </td>

                        <td>
                            <?php echo $row["description"]. " " ; ?>
                        </td>
                      
                        <td>
                            <?php 
                                $sql2 = "SELECT name FROM services WHERE id=".$row['servises_id'];
                                $result2 = $conn->query($sql2);
                                $row2 = $result2->fetch_assoc();
                                echo $row2["name"];
                            ?>
                        </td>
                        <td>
                            <?php
                            if ($row["is-satisfie"]==1)
                                echo 'true'; 
                            else
                                echo 'false'; 

                            
                            ?>
                        </td>
                            <?php
                            $sql2 = "SELECT name FROM services WHERE id=".$row['servises_id'];
                    $result2 = $conn->query($sql2);
                           
                    // while ($row2 = $result2->fetch_assoc()) {
                    //     echo $row2["name"];
                    // }
                    // echo "services_id: " . $row["services_id"]."<br>";
                    echo "<br><br>"; ?>
                            <td><a href="update.php?id=<?php echo $row ['id']; ?>">edit</a></td>
                            <td><a href="index.php?del=<?php echo  $row ['id']; ?>">delete</a></td>
                    </tr>
                    <?php
                }
            ?>
            </table>
            <?php
        } else {
            echo "0 results";
        }
        $conn->close();
        ?>
         <a href="create.php">Visit create.php</a>

	</body>
</html>