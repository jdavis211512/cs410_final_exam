<html>
<head>
    <?php include_once 'db.php';?>
</head>
<?php
$query = "select * from Bugs where AssignedTo = :name";
$sql = $conn->prepare($query);
$sql->bindValue('name',$_SESSION['name']);
$sql->execute();
$result = $sql->fetchAll();
if(!empty($result)){
    echo '<table>';
foreach ($result as $row) {
    echo "<tr>";
    echo "<td>".$row['Subject']."</td>>";
    echo "<td>".$row['Priority']."</td>>";
    echo "<td>".$row['Description']."</td>>";
    echo "<form action ='' method='post'>";
    echo '<td>is it resolved?<input type="checkbox" name="resolvedbox"></td>';
    echo "<td><input type='textarea' name='changes'></td>";
    echo "<td><input type='submit' value='resolve'></td>";
    echo '</form>';
    echo "</tr>";
    }
echo '</table>';

}else{echo "no bugs today";}
?>
</html>
