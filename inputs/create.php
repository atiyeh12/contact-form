<?php
ini_set('display_errors', 1);
error_reporting(~0);
require_once('../database/config.php');
?>
    <html>
        <head>
            <link rel="stylesheet" href="style.css">
            <style>
            </style>
        </head>
        <body>
            <p class="inset">inputs</p>

    <?php

        if (isset($_POST['insert'])) {
            // $sql = "INSERT INTO posts(title,description) VALUES(:title,:description)";

            $stmt = $conn->prepare("INSERT INTO inputs (fullname , subject , description , servises_id, `is-satisfie`) VALUES (?, ?, ? ,?, ?)");
            $stmt->bind_param("ssssi", $fullname, $subject, $description ,$servisesId, $issatisfie);
            $fullname = $_POST['fullname'];
            $subject= $_POST['subject'];
            $description= $_POST['description'];
            $servisesId= $_POST['servises'];
            $issatisfie=$_POST['is-satisfie'];
           
            $stmt->execute();

            $lastInsertId = $conn->insert_id;

            if ($lastInsertId) {
                echo "<script>alert('record insert successfully');</script>";
                echo "<script>window.location.href='index.php'</script>";
            } else {
                echo "<script>alert('Error');</script>";
                echo "<script>window.location.href='index.php'</script>";
            }
        }


            ?>
           
                <meta name="viewport" content="width=device-width, initial-scale=1">
                <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
                <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
                <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
              
               

                <div class="container">
            <form method="post">
                <div class="form-row">
                    <input type="hidden" name="insert" value = "true"/>
                    <div class="form-group col-md-4">
                        <label>fullname</label>
                            <input type="text" class="form-control" name="fullname" placeholder=" like name">
                    </div>
                    <div class="form-group col-md-4">
                        <label>subject</label>
                            <input type="text" class="form-control" name="subject" placeholder=" like subject">
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label>description</label>
                            <textarea class="form-control" name="description" rows="5"></textarea>
                        </div>
                    </div>
                 
                </div>
                <?php
               
                echo "<select name='servises'>";
                $sql2 = "SELECT * FROM services" ;
                            $result2 = $conn->query($sql2);
                            while ($row2 = $result2->fetch_assoc()) {
                                echo "<option value='" . $row2['id'] . "'>" . $row2['name'] . "</option>";
                            }
                        echo "</select>";
                // define variables and set to empty values
                $nameErr = $emailErr = $genderErr = $websiteErr = "";
                $name = $email = $gender = $comment = $website = "";  
                            ?>
               <br><br> do you satisfie?
        <input type="radio" name="is-satisfie" <?php if (isset($issatisfie) && $issatisfie=="true") echo "checked";?> value="true">true
        <input type="radio" name="is-satisfie" <?php if (isset($issatisfie) && $issatisfie=="false") echo "checked";?> value="false">false 
        
        <br><br>
                <br><br>
                <input type="submit" value="Submit">
            </form>
