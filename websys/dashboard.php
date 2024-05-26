<?php 
$servername = "localhost"; 
$username = "root"; 
$password = ""; 
$dbname = "fruit_sales"; 

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed". $conn->connect_error);
}
echo "success";

if(isset($_POST['submit'])) {
    $fruitName = $_POST['fruitName'];
    $fruitSold = $_POST['sold'];

   // Check if the fruit already exists in the database
   $checkQuery = "SELECT `Sold` FROM `fruits` WHERE `Fruit` = '$fruitName'";
   $checkResult = mysqli_query($conn, $checkQuery);

   if(empty($fruitName) || empty($fruitSold)) {
    echo "Blank fields are prohibited";
   }
   else if (mysqli_num_rows($checkResult) > 0) {
       // Fruit exists, update the sold quantity
       $row = mysqli_fetch_assoc($checkResult);
       $newQuantity = $row['Sold'] + $fruitSold;
       $updateQuery = "UPDATE `fruits` SET `Sold` = '$newQuantity' WHERE `Fruit` = '$fruitName'";
       mysqli_query($conn, $updateQuery);
   } else {
       // Fruit does not exist, insert new entry
       $insertQuery = "INSERT INTO `fruits` (`Fruit`, `Sold`) VALUES ('$fruitName', '$fruitSold')";
       mysqli_query($conn, $insertQuery);
   }
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit;
}

?>


<!DOCTYPE html>
<head> 
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="dashboard.css">
</head>

<body>
    
  
<form method="post">
 </div><br>

 <label> Fruit: </label>
 <input type="text" name="fruitName" class="form-control"> <br>

 <label> Sold: </label>
 <input type="text" name="sold" class="form-control"> <br>

 <button class="btn btn-success" type="submit" name="submit"> Submit </button><br>
 <a class="btn btn-info" type="submit" name="cancel" href="index.php"> Cancel </a><br>

 </div>
 </form>

 <div class="grid-container">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Fruit</th>
                    <th scope="col">Sold</th>
                    <th scope="col">Date</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                // Assuming $conn is the database connection
                $sql = "SELECT * FROM fruits";
                $result = $conn->query($sql);

                if (!$result) {
                    die("Invalid query!");
                }
                
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>{$row['Fruit']}</td>
                            <td>{$row['Sold']}</td>
                            <td>hehe</td>
                          </tr>";
                }
                ?>
            </tbody>
        </table>
    </div>      
</body>
</html>
