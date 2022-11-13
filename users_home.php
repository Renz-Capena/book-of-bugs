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
    <title>Home</title>
    <link rel="stylesheet" href="css/users_home.css">
</head>
<body> 
    <header>
        <p><img src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_1280.png"></img><?php echo $info['nickname'] ?></p>


        <form method="post">
            <button name="logout_btn">LOGOUT</button>
        </form>
    </header>
    
    <div class="Add_btn">
        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT8zxl2gv0NKSE49Ady6QmRgPqTVEHsXQMIpARecrY8X8xCP7wmdVsE2783FneLOYq1tWM&usqp=CAU" alt="ADD">
    </div>
</body>
</html>