<?php
include './db.php';

$query = "SELECT * FROM trainings ORDER BY 'date' desc";
$result = mysqli_query($connection, $query);
if(!$result){
  die('Nothing to get');
};

 if (isset($_POST['submit'])){
    $movement = $_POST['movement'];
    $repeats = $_POST['repeats'];
    $weight = $_POST['weight'];
    $date = date("Y-m-d H:i:s");

    $query = "INSERT INTO trainings(movement,repeats,weight,date) VALUES('$movement','$repeats','$weight','$date')"; 
    $result = mysqli_query($connection, $query);

    if(!$result){
        die("Could not post. Sorry.");
     }
 }

?>

    <div class="container">
      <form action="create.php" method="POST" class="form">
      <p>
      <?= $_POST["movement"] ?>
      </p>
        <input type="number" name="repeats" class="input_repeats" placeholder="Insert repeats">
        <input type="number" name="weight" class="input_weight" placeholder="Insert weight (kg)">
        <div>
          <input type="submit" name="submit" value="Submit">
        </div>
      </form>
    </div>