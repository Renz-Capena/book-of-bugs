<?php
    require"connection.php";
    $con = connect();
    session_start();

    $user_id = $_SESSION['user_id'];

    $get_user_info = "SELECT * FROM `users` WHERE id='$user_id'";
    $list = $con->query($get_user_info); 
    $info = $list->fetch_assoc();

    if(isset($_POST['logout_btn'])){
        unset($_SESSION['user_id']);
        
        header("location: index.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Information</title>
    <link rel="stylesheet" href="css/update_info.css">
</head>
<body>
    <header>
        <a href="update_info.php"><img src="<?php echo $info['picture'] ?>"></img><?php echo $info['nickname'] ?></a>


        <form method="post">
            <button name="logout_btn">LOGOUT</button>
        </form>
    </header>

    <form method="post">
        
    </form>




    <a href="users_home.php">Back</a>
</body>
</html>