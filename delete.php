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

  $query = "DELETE FROM trainings WHERE id = $id";

  $result = mysqli_query($connection, $query);
  if (!$result) {
    die("Delete query failed" . mysqli_error($connection));
  }
}

?>

<form action="delete.php" method="post" >
    <select name="id" id="">
        <?php
        while($row = mysqli_fetch_array($result)) {
            $id = $row['id'];
            echo "<option value='$id'>$id</option>";
        }    
        ?>    
    </select>
    <input type="submit" name="submit" value="Delete">
</form>