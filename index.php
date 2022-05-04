<?php
include './db.php';
date_default_timezone_set('Europe/Helsinki');

if (isset($_POST['submit'])){
    $movement = test_inputs($_POST['movement']);
    $repeats = test_inputs($_POST['repeats']);
    $weight = test_inputs($_POST['weight']);
    $date = date("Y-m-d H:i:s");

    $query = "INSERT INTO trainings(movement,repeats,weight,date) VALUES('$movement','$repeats','$weight','$date')"; 
    $result = mysqli_query($connection, $query);

    if(!$result){
        die("Could not post. Sorry.");
     }
};

if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $movement = test_inputs($_POST['movement']);
    $repeats = test_inputs($_POST['repeats']);
    $weight = test_inputs($_POST['weight']);
    $date = date("Y-m-d H:i:s");

    $query = "UPDATE trainings SET movement='$movement', repeats='$repeats', weight='$weight', date='$date'  WHERE id = $id";
  
    $result = mysqli_query($connection, $query);
    if (!$result) {
      die("Update query failed" . mysqli_error($connection));
    }
  };

if (isset($_POST['delete'])) {  
    $id = $_POST['id']; 
    $query = "DELETE FROM trainings WHERE id = $id";
    $result = mysqli_query($connection, $query);
    if (!$result) {
      die("Delete query failed" . mysqli_error($connection));
    }
  };

  function test_inputs($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="index.css">
    <title>Crossfit App</title>
</head>
<body>
  <header>
    <h1>Crossfit App</h1>
    <h3>By Jenna Koski</h3>
  </header>
  <div class="container">     
    <form action="index.php" method="POST" class="form">
      <label for="movement">Select movement:</label>
        <select name="movement" class="input_movement" required>
        <option value="" invalid="true" hidden>
          Select movement
        </option>
        <option value="Snatch">Snatch</option>
        <option value="Power clean">Power clean</option>
        <option value="Jerk">Jerk</option>
        <option value="Frontsquat">Front squat</option>
        <option value="Backsquat">Back squat</option>
        <option value="Pushpress">Push press</option>
        <option value="Deadlift">Deadlift</option>
        </select>
      <label for="repeats">Repeats:</label>
      <input type="number" name="repeats" class="input_repeats" placeholder="Insert repeats">
      <label for="weight">Weight:</label>
      <input type="number" name="weight" class="input_weight" placeholder="Insert weight (kg)">
      <input type="submit" name="submit" value="Add" class="btn">
    </form>
  </div>
<div class="container">
<?php
$query = "SELECT * FROM trainings ORDER BY 'date' desc";
$result = mysqli_query($connection, $query);
if(!$result){
  die('Nothing to get');
};
while($row = mysqli_fetch_array($result)){
    $id = $row['id'];
    $movement = $row['movement'];
    $repeats = $row['repeats'];
    $weight = $row['weight'];
    $date = $row['date'];
 ?>

<div>
  <form class="updateForm" action="index.php" method="post">
    <select name="id" hidden>
      <?= "<option value='$id'>$id</option>"
      // "<input type='hidden' name='id' value='$id'>"
      ?>
    </select>
    <!-- <select name="movement" class="movement" required>
        <option value="" invalid="true" hidden>
          Select movement
        </option>
        <option value="snatch">Snatch</option>
        <option value="powerclean">Power clean</option>
        <option value="jerk">Jerk</option>
        <option value="frontsquat">Front squat</option>
        <option value="backsquat">Back squat</option>
        <option value="pushpress">Push press</option>
        <option value="deadlift">Deadlift</option> -->
    <input class="input_movement" type="text" value="<?= $movement ?>" name="movement" />
    <input class="input_repeats" type="number"  value="<?= $repeats ?>"  name="repeats" /> 
    <input class="input_weight" type="number"  value="<?= $weight ?>"  name="weight" />
      <p> <?=$date?> </p> 
    <input class="inputButton" type="submit" name="update" value="Update">
    <input class="inputButton" type="submit" name="delete" value="Delete">
  </form>
</div>
 <?php } ?> 
</div>
</body>
</html>