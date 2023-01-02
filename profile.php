<?php
    require"connection.php";
    $con = connect();
    session_start();

    $user_id = $_GET['id'];

    //===get the user profile info
    $get_user_info = "SELECT * FROM `users` WHERE id='$user_id'";
    $list = $con->query($get_user_info); 
    $info = $list->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Information</title>
    <link rel="stylesheet" href="css/profile.css">
</head>
<body>
    <header>
        <div>
            <img src="<?php echo $info['picture'] ?>"></img><?php echo $info['nickname'] ?>
        </div>
        <a href="users_home.php">BACK</a>
    </header>

    <section>
        <div class='profile_info_wrapper'>
            <div>
                <img src="img/cover.png" alt="">
            </div>
            <div class='profile_img_wrapper'>
                <div>
                    <img src="<?php echo $info['picture'] ?>" alt="">
                    <div>
                        <p><?php echo $info['name'] ?></p>
                        <p>(<?php echo $info['nickname'] ?>)</p>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <script src='js/profile.js'></script>
</body>
</html>