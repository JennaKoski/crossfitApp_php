<?php include './db.php';

$query = "SELECT * FROM trainings";
$result = mysqli_query($connection, $query);
if (!$result) {
  die('Query failed');
}
?>

<?php
if (isset($_POST['submit'])) {
    $id = $_POST['id'];
    $movement = $_POST['movement'];
    $repeats = $_POST['repeats'];
    $weight = $_POST['weight'];
    $query = "UPDATE trainings SET movement='$movement', repeats='$repeats', weight='$weight' WHERE id = $id";
  
    $result = mysqli_query($connection, $query);
    if (!$result) {
      die("Update query failed" . mysqli_error($connection));
    }
  }
?>

<h1>Update repeats</h1>
<form action="update.php" method="post">
<select name="id" id="">
        <?php
        while($row = mysqli_fetch_array($result)) {
            $id = $row['id'];
            echo "<option value='$id'>$id</option>";
        }    
        ?>    
    </select>
    <select name="movement" class="movement" required>
        <option value="" invalid="true" hidden>
          Select movement
        </option>
        <option value="snatch">Snatch</option>
        <option value="powerclean">Power clean</option>
        <option value="jerk">Jerk</option>
        <option value="frontsquat">Front squat</option>
        <option value="backsquat">Back squat</option>
        <option value="pushpress">Push press</option>
        <option value="deadlift">Deadlift</option>
    <input type="number" name="repeats" class="input_repeats" placeholder="Insert repeats">
    <input type="number" name="weight" class="input_weight" placeholder="Insert weight (kg)">
    <input type="submit" name="submit" value="Update">
</form>