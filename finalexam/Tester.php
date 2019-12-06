<?php
include_once 'db.php';
$query = "insert into Bugs (EnteredBy, Subject, Priority, Description, AssignedTo, Status, Changes) VALUES (:EnteredBy,:Subject,:priority,:Description,Null, :Status,0 )";
$sql=$conn->prepare($query);
$sql->bindValue(':EnteredBy',);
$sql->bindValue(':Subject',);
$sql->bindValue(':priority')

?>
<html
><head>

</head>
<body>
<form>
    <input type="text" name="Subject"><br>
</form>
</body>
</html>
