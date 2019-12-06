<?php
//passwords are all ballstate0

ini_set('display_errors',1);
ini_set("display_startup_errors",1);
error_reporting(E_ALL);
?>

<html>
<head>
    <?php include_once "db.php";
    session_start();
    if(!empty($_POST))
    {
        if(!empty($_POST['login']))
        {
            $username = trim($_POST['username']);
            $password = trim($_POST['password']);
            $query = "select Password, Userid,Type from Users where Username=:username";
            $sql = $conn->prepare($query);
            $sql->bindValue("username", $username);
            $sql->execute();
            $user = $sql->fetchAll();
            if(empty($user))
            {
                $error[] = "Username and password do not match";
            }
            else
            {
                if($user[0]['Password'] == sha1($password))
                {
                    $_SESSION['userid'] = $user[0]['Userid'];
                    $_SESSION['Type'] = $user[0]['Type'];
                    if ($user[0]['Type']==="Manager"){
                        header('Location:Manager.php');
                    }
                    if ($user[0]['Type']==="Developer"){
                        header('Location:Developer.php');
                    }
                    if ($user[0]['Type']==="Tester"){
                        header('Location:Tester.php');
                    }



                }
                else
                {
                    $error[] = "Username and password do not match";
                }
            }
        }
    }
    ?>

</head>
<body>
<form action="" method="post">
    Username: <input type="text" name="username"/><br><br>
    Password: <input type="password" name="password"/><br><br>
    <input type="submit" name="login" value="Login"/><br><br>
    <span class="error"><?php if(!empty($error)) foreach($error as $e) echo $e . "<br>"; ?></span>
</form><br>
</body>
</html>

</html>