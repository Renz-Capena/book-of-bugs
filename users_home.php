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
        $edit = $_POST['edit'];

        //-----------Upload pic
        $picture = $_FILES['upload_img']['name'];
        $pictureTmpName = $_FILES['upload_img']['tmp_name'];
        $picNewDestination = 'uploads_img_post/'.$picture;

        move_uploaded_file($pictureTmpName,$picNewDestination);
        //--------------------

        $insert_command = "INSERT INTO `post`(`user_id`, `user_nickname`, `profile_img`, `post_text`, `bg_color`, `uploaded_img`, `date`, `time`, `edit`) VALUES ('$user_id','$user_nickname','$profile_img','$post_text','$bg_color','$picNewDestination','$date','$time', '$edit')";


        $con->query($insert_command);

        header("Refresh: 0");
    }
    if(isset($_POST['deletePostBtn'])){
        $delete_post_id = $_POST['delete_post_id'];

        $delete_command = "DELETE FROM `post` WHERE id='$delete_post_id'";
        $con->query($delete_command);

        header("Refresh: 0");
    }

    if(isset($_POST['heartBtn'])){
        $post_id  = $_POST['post_id'];
        $user_id  = $_POST['user_id'];
        $value = $_POST['heartBtn'];

        $add_heart = "INSERT INTO `hearts`(`post_id`, `user_id`, `value`) VALUES ('$post_id','$user_id','$value')";

        $con->query($add_heart);

        header("Refresh: 0");

        // echo "<script>alert($value)</script>";
    }

    if(isset($_POST['deleteHeartBtn'])){
        $user_id = $info['id'];
        $post_id = $_POST['post_id'];

        $delete = "DELETE FROM `hearts` WHERE user_id='$user_id' AND post_id='$post_id'";

        $con->query($delete);

        header("Refresh: 0");
    }
    if(isset($_POST['commentBtn'])){
        $user_id = $info['id'];
        $post_id = $_POST['post_id'];
        $comment = $_POST['comment'];
        $picture = $_POST['picture'];
        $nick_nickname = $_POST['nick_name'];
        $date = $_POST['comment_date'];
        $time = $_POST['comment_time'];

        $add_comment = "INSERT INTO `comments`(`post_id`, `user_id`, `comment`, `nick_name`, `pic`, `date`, `time`) VALUES ('$post_id','$user_id','$comment','$nick_nickname','$picture','$date','$time')";

        $con->query($add_comment);

        header("Refresh: 0");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book of Bugs | Home</title>
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
        <div class='iframe_edit_post_wrapper'>
            <div>
                <img src="img/close.png" alt="Close" id='close_edit_post_form'>
            </div>
            <iframe class='iframe_edit_post' name='iframe_edit_post'></iframe>
        </div>
        <div id='layerOne'></div>

        <?php do{ ?>
        <div class='post_container'>
            <div class='post_head_profile_details'>
                <div>
                    <img src="<?php echo $post_info['profile_img'] ?>" alt="Profile pic">
                    <div>
                        <p><?php echo $post_info['user_nickname'] ?></p>
                        <p>
                            <?php echo $post_info['date'] ?>
                            <?php if($post_info['edit'] == 'YES') echo '(EDITED)'  ?>
                        </p>
                        <p><?php echo $post_info['time'] ?></p>
                    </div>
                </div>

                <?php if($user_id == $post_info['user_id']){ ?>
                    <div>
                        <img src="img/more_dot.png" alt="Modify" id='modify_post_btn'>
                        <div class='delete_and_edit_btn_wrapper'>
                            <a href="users_post_edit.php?post_id=<?php echo $post_info['id'] ?>" target='iframe_edit_post' id='edit_post_btn'>EDIT</a>
                            <form method='post'>
                                <input type="hidden" name='delete_post_id' value='<?php echo $post_info['id'] ?>'>
                                <button name='deletePostBtn'>DELETE</button>
                            </form>
                        </div>
                    </div>
                <?php } ?>
                
            </div>
            <div class='post_content_text_and_img'>
                <?php if($post_info['uploaded_img'] === 'uploads_img_post/'){ ?>
                    <div class='post_text_only' style='background-color:<?php echo $post_info['bg_color'] ?>'>
                        <?php echo $post_info['post_text'] ?>
                    </div>
                <?php }else{ ?>
                    <p><?php echo $post_info['post_text'] ?></p>
                    <img src="<?php echo $post_info['uploaded_img'] ?>">
                <?php } ?>
            </div>
            <div class='like_and_comment_wrapper'>
                <?php
                    $user_id_log_in = $info['id'];


                    //===============COUNT THE COMMENTS
                    $select_all_comment = "SELECT * FROM `comments` WHERE post_id='$post_info[id]'";
                    $list_comment = $con->query($select_all_comment);
                    $number_comment = $list_comment->num_rows;
                    //==========================================

                    //===============COUNT THE HEARTS
                    $select_all_heart = "SELECT * FROM `hearts` WHERE post_id='$post_info[id]'";
                    $list = $con->query($select_all_heart);
                    $number = $list->num_rows;
                    //==========================================

                    //==============Check if already react in the post
                    $check_if_already_react = "SELECT * FROM `hearts` WHERE user_id = '$user_id_log_in' AND post_id='$post_info[id]'";
                    $temp_list = $con->query($check_if_already_react);
                    $valid = $temp_list->num_rows;
                    
                ?>
                <form method='post'>
                    <input type="hidden" name="user_id" value='<?php echo $info['id'] ?>'>
                    <input type="hidden" name="post_id" value='<?php echo $post_info['id'] ?>'>

                    <?php if($valid){ ?>

                        <button name='deleteHeartBtn'><p><?php echo $number ?></p><img src="img/heart_fill.png" alt="Heart"></button>
                        
                    <?php }else{ ?>
                            
                        <button name='heartBtn' value='1'><p><?php echo $number ?></p><img src="img/heart_no_fill.png" alt="Heart"></button>

                    <?php } ?>
                </form>
                    <button id='commentBtn'><p><?php echo $number_comment ?></p><img src="img/comment.png" alt="Comment"></button>
            </div>

            <div class='comments_wrapper'>
                <div>
                    <form method='post'>
                        <input type="hidden" name="post_id" value='<?php echo $post_info['id'] ?>'>
                        <input type="hidden" name="user_id" value='<?php echo $info['id'] ?>'>
                        <input type="hidden" name="picture" value='<?php echo $info['picture'] ?>'>
                        <input type="hidden" name="nick_name" value='<?php echo $info['nickname'] ?>'>
                        <input type="hidden" name="comment_date" >
                        <input type="hidden" name="comment_time" >

                        <input type="text" name='comment' placeholder='Write a comment...'>
                        <button name='commentBtn'><img src="img/send_icon.png" alt=""></button>
                    </form>
                </div>

                <?php
                        //===========GET ALL THE COMMENTS IN THE POST
                        $post_id_for_comments = $post_info['id'];
                        $show_comment = "SELECT * FROM `comments` WHERE post_id='$post_id_for_comments'";
                        $comment_list = $con->query($show_comment);
                        $comment_info = $comment_list->fetch_assoc();
                        $valid_comment = $comment_list->num_rows;
                ?>

                <?php if($valid_comment){ ?>
                    
                    <?php do{ ?>
                        <div class='all_comments_wrapper'>
                            <img src="<?php echo $comment_info['pic'] ?>" alt="Prifile Picture">
                            <div>
                                <p><?php echo $comment_info['nick_name'] ?></p>
                                <p><?php echo $comment_info['date'] ?></p>
                                <p><?php echo $comment_info['time'] ?></p>
                                <p><?php echo $comment_info['comment'] ?></p>
                            </div>
                        </div>
                    <?php }while($comment_info = $comment_list->fetch_assoc()) ?>

                <?php } ?>
            </div>
        </div>
        <?php }while($post_info = $post_list->fetch_assoc()) ?>
    </section>

    <div class='users_wrapper_list'>
        <div class='users_list_head'>
            <p>USERS</p>
            <img src="img/close.png" alt="Close" id='users_wrapper_list_closebtn'>
        </div>
        <?php 
            $get_all_users = "SELECT * FROM `users`";
            $users_list = $con->query($get_all_users);
            $users_info = $users_list->fetch_assoc();
        ?>
        <?php do{ ?>
            <div class='users_card_list'>
                <div>
                    <img src="<?php echo $users_info['picture'] ?>" alt="">
                    <p><?php echo $users_info['name'] ?></p>
                </div>
                <div>
                    <a href="message.php?id=<?php echo $users_info['id'] ?>"><img src="img/message.png" alt="Message"></a>
                    <a href="#"><img src="img/account_circle_FILL1_wght400_GRAD0_opsz48.png" alt="Profile"></a>
                </div>
            </div>
        <?php }while($users_info = $users_list->fetch_assoc()) ?>
    </div>

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
            <input type="hidden" name="edit" value='NO'>
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
        <img src="img/add_circle_FILL0_wght400_GRAD0_opsz48.png" alt="USERS" id='postBtn'>
        <img src="img/message.png" alt="MESSAGE">
        <img src="img/group_FILL1_wght400_GRAD0_opsz48.png" alt="USERS" id='showUsersBtn'>
        <a href="update_info.php"><img src="img/account_circle_FILL1_wght400_GRAD0_opsz48.png" alt="Profile"></a>
    </nav>

    <script src='js/users_home.js'></script>
</body>
</html>