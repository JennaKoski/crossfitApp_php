<?php 
include './db.php';

$query = "SELECT * FROM trainings ORDER BY 'date' desc";
$result = mysqli_query($connection, $query);
if(!$result){
  die('Nothing to get');
};


if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $movement = $_POST['movement'];
    $repeats = $_POST['repeats'];
    $weight = $_POST['weight'];
    $query = "UPDATE trainings SET movement='$movement', repeats='$repeats', weight='$weight' WHERE id = $id";
  
    $result = mysqli_query($connection, $query);
    if (!$result) {
      die("Update query failed" . mysqli_error($connection));
    }
  };

if (isset($_POST['delete'])) {  
    $id = $row['id']; 
    $query = "DELETE FROM trainings WHERE id = $id";
    $result = mysqli_query($connection, $query);
    if (!$result) {
      die("Delete query failed" . mysqli_error($connection));
    }
  };
?>

<?php while($row = mysqli_fetch_array($result)){
    $id = $row['id'];
    $movement = $row['movement'];
    $repeats = $row['repeats'];
    $weight = $row['weight'];
    $date = $row['date'];
 ?>
 <div>
     <form action="delete.php" method="post" >
     <select name="id" id="">
         <?= "<option value='$id'>$id</option>" ?>    
     </select>
     <input type="submit" name="submit" value="Delete">
 </form>

    <form action="read.php" method="post">
         <select name="id" id="">
          <?= "<option value='$id'>$id</option>"?>     
        </select> 
        <p>
        <?= $_POST["movement"] ?>
      </p>
         <input class="input_repeats" type="number"  value="<?= $repeats ?>"  name="repeats" />
         <input class="input_weight" type="number"  value="<?= $weight ?>"  name="weight" /> 
          <p> <?=$date?> </p> 
         <input type="submit" name="update" value="Update">
    </form>
</div>
 <?php } ?>   