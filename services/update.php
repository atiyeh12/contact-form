<?php
ini_set('display_errors', 1);
error_reporting(~0);
require_once ('../database/config.php');
$servicesId = intval($_GET['id']);
if(isset($_POST['update'])){
    $name = $_POST['name'];
    $sql = "UPDATE services SET name='$name' WHERE id=$servicesId";

    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('record updated successfully');</script>";
        echo "<script>window.location.href='index.php'</script>";
    } else {
        echo "<script>alert('Error updating record');</script>";
        echo "Error updating record: " . mysqli_error($conn);
    }
}


?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
    <title>update car</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    </head>
    <body>
        
    <?php   
   
    $sql = "SELECT * from services where  id=".$servicesId;
      $result = $conn->query($sql);
      while($row = $result->fetch_assoc()) {
        $name = $row['name'];
        // $id=$row['id'];
      
      }
      ?>
    <div class="container">
        <h2>update services</h2>
            <form method="post">
            <input type="hidden" name="update" value = "true"/>
            <div class="form-group">
            <label class="control-label col-sm-2" for="name">name:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="name" value="<?php echo $name ?>">

            </div>
            </div>
     
    <div class="form-group">        
      <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" class="btn btn-default">Submit</button>
      </div>
    </div>
  </form>
</div>

</body>
</html>
