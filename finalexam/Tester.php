<?php
include_once 'db.php';
$query = "insert into Bugs (EnteredBy, Subject, Priority, Description, AssignedTo, Status, Changes) VALUES (:EnteredBy,:Subject,:priority,:Description,Null, :Status,0 )";
$sql=$conn->prepare($query);
$sql->bindValue(':EnteredBy',$_SESSION['name']);
$sql->bindValue(':Subject',$_POST['Subject']);
$sql->bindValue(':priority',$_POST['priority']);
$sql->bindValue(':Description',$_POST['description']);
$sql->execute();
?>
<html
><head>

</head>
<body>
<form>
    What doe the bug involve?<br><input type="text" name="Subject"><br>
    What's the priority of the bug?
    <select name="priority">
        <option value="high">High</option>
        <option value ="medium">medium</option>
        <option value="low">low</option>
    </select><br>
    describe the bug
    <input name="description" type="textarea" size="300%">
    <input type="submit">
</form>
</body>
</html>
