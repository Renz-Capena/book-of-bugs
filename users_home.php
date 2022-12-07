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

    if(isset($_POST['postBtn'])){
        $user_nickname = $_POST['user_nickname'];
        $profile_img = $_POST['profile_img'];
        $date = $_POST['date'];
        $time = $_POST['time'];
        $post_text = $_POST['post_text'];
        $bg_color = $_POST['color'];


        $insert_command = "INSERT INTO `post`(`user_id`, `user_nickname`, `profile_img`, `post_text`, `bg_color`, `date`, `time`) VALUES ('$user_id','$user_nickname','$profile_img','$post_text','$bg_color','$date','$time')";


        $con->query($insert_command);

        header("location: users_home.php");

        // $img_upload = $_POST['upload_img'];
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
        <div><img src="<?php echo $info['picture'] ?>"></img><?php echo $info['nickname'] ?></div>
        <form method="post">
            <button name="logout_btn">LOGOUT</button>
        </form>
    </header>

    <div id="create_post_wrapper">
        <form method="post">
            <div class='form_post_close_btn_wrapper'>
                <img src="img/close.png" alt="CLOSE" id='form_post_close_btn'>
            </div>
            <h2>CREATE POST</h2>
            <input type="hidden" name="user_id" value='<?php echo $user_id ?>'>
            <input type="hidden" name="user_nickname" value='<?php echo $info['nickname'] ?>'>
            <input type="hidden" name="profile_img" value='<?php echo $info['picture'] ?>'>
            <input type="hidden" name="date">
            <input type="hidden" name="time">
            <br>
            <textarea name="post_text" placeholder="What's on your mind?" required></textarea>
            <br>
            <div class='bg_color_select_wrapper'>
                <label>BACKGROUND COLOR :</label><input type="color" name='color' class='input_color_post'>
            </div>
            <br>
            <input type="file" name="upload_img" class='input_file_upload'>
            <br>
            <button name='postBtn'>POST</button>
        </form>
    </div>
    
    <nav>
        <a href=""><img src="img/group_FILL1_wght400_GRAD0_opsz48.png" alt="USERS"></a>
        <img src="img/add_circle_FILL0_wght400_GRAD0_opsz48.png" alt="USERS" id='postBtn'>
        <a href="update_info.php"><img src="img/account_circle_FILL1_wght400_GRAD0_opsz48.png" alt="USERS"></a>
    </nav>

    <script src='js/users_home.js'></script>
</body>
</html>