
<html>
<head>
    <?php
    include 'db.php';
    ?>
    <?php
    ini_set('display_errors',1);
    ini_set("display_startup_errors",1);
    error_reporting(E_ALL);
    ?>
</head>
<body>
<?php
$all_query = "Select * from Bugs";
$sql= $conn->prepare($all_query);
$sql->execute();
$result = $sql->fetchAll();
if (!empty($result)){
    echo "<table>";
    foreach($result as $r){
        echo '<form action="" method="post">';
        echo '<td>'.$r['EnteredBy'].'</td>';
        echo '<td>'.$r['Subject'].'</td>';
        echo '<td>'.$r['Priority'].'</td>';
        echo '<td>'.$r['Description'].'</td>';
        if($r['AssignedTo']=="Nobody"){
            echo '<select name="dropdown">';
            $query="select Name from Users where Type = 'Developer'";
            $sql = $conn->prepare($query);
            $sql->execute();
            $result = $sql->fetchAll();
            foreach($result as $row){
                $name = $row['Name'];
                echo '<option value="'. $name . '"' . (($name == $_POST['dropdown'])? "selected" :"") . ">" . $name . '</option>';
            }
            echo '</select>';
        }else{echo $r['AssignedTo'];}
        echo '<td>'.$r['Status'].'</td>';
        echo '<td>'.$r['changes'].'</td>';
        echo '<input type="submit" value="submit">';
        echo '</form>';
        $insert_query = "update Bugs set AssignedTo =:name, Status = Assigned where BugId =:bugid";
        $sql = $conn->prepare($insert_query);
        $sql->bindValue('name',$_POST['dropdown']);
        $sql->bindValue('bugid', $r['BugId']);
        $sql->execute();
    }echo "</table>";
}echo "no bugs today!";

?>

</body>
</html>