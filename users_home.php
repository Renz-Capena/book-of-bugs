<?php
    require"connection.php";
    $con = connect();
    session_start();

    $user_id = $_SESSION['user_id'];

    //--get user info
    $get_user_info = "SELECT * FROM `users` WHERE id='$user_id'";
    $list = $con->query($get_user_info); 
    $info = $list->fetch_assoc();
    //-----------


    //--get post
    $get_post = "SELECT * FROM `post` ORDER BY id DESC";
    $post_list = $con->query($get_post);
    $post_info = $post_list->fetch_assoc();
    //------------

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

        //-----------Upload pic
        $picture = $_FILES['upload_img']['name'];
        $pictureTmpName = $_FILES['upload_img']['tmp_name'];
        $picNewDestination = 'uploads_img_post/'.$picture;

        move_uploaded_file($pictureTmpName,$picNewDestination);
        //--------------------

        $insert_command = "INSERT INTO `post`(`user_id`, `user_nickname`, `profile_img`, `post_text`, `bg_color`, `uploaded_img`, `date`, `time`) VALUES ('$user_id','$user_nickname','$profile_img','$post_text','$bg_color','$picNewDestination','$date','$time')";


        $con->query($insert_command);

        header("location: users_home.php");
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


    <section>
        <?php do{ ?>
        <div class='post_container'>
            <div class='post_head_profile_details'>
                <img src="<?php echo $post_info['profile_img'] ?>" alt="Profile pic">
                <div>
                    <p><?php echo $post_info['user_nickname'] ?></p>
                    <p><?php echo $post_info['date'] ?></p>
                    <p><?php echo $post_info['time'] ?></p>
                </div>
            </div>
            <div class='post_content_text_and_img'>
                <p><?php echo $post_info['post_text'] ?></p>
                <?php if($post_info['uploaded_img'] === 'uploads_img_post/'){ ?>
                
                <?php }else{ ?>
                    <img src="<?php echo $post_info['uploaded_img'] ?>">
                <?php } ?>
            </div>
        </div>
        <?php }while($post_info = $post_list->fetch_assoc()) ?>
    </section>

    <div id="create_post_wrapper">
        <form method="post" enctype="multipart/form-data">
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