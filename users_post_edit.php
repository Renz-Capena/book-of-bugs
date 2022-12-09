<?php
    require"connection.php";
    $con = connect();
    
    $post_id = $_GET['post_id'];

    $get_post_info = "SELECT * FROM `post` WHERE id = '$post_id'";
    $list = $con->query($get_post_info);
    $post_info_edit = $list->fetch_assoc();

    if(isset($_POST['updateBtn'])){
        $date = $_POST['date'];
        $time = $_POST['time'];
        $edit = $_POST['edit'];
        $post_text = $_POST['post_text'];
        $bg_color = $_POST['color'];
        
        //-----------Upload pic
        $picture = $_FILES['upload_img']['name'];
        $pictureTmpName = $_FILES['upload_img']['tmp_name'];
        $picNewDestination = 'uploads_img_post/'.$picture;

        move_uploaded_file($pictureTmpName,$picNewDestination);
        //--------------------

        $update_post = "UPDATE `post` SET `post_text`='$post_text',`bg_color`='$bg_color',`uploaded_img`='$picNewDestination',`date`='$date',`time`='$time',`edit`='$edit' WHERE id='$post_id'";

        $con->query($update_post);

        echo "<script>alert('Update Success!')</script>";

        header("Refresh:0");
    }


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit post</title>
    <link rel="stylesheet" href="css/users_post_edit.css">
</head>
<body>
    <!-- <a href="users_home.php">BACK</a> -->
    <div id="create_post_wrapper">
        <form method="post" enctype="multipart/form-data">
            <h2>UPDATE POST</h2>
            <input type="hidden" name="date">
            <input type="hidden" name="time">
            <input type="hidden" name="edit" value='YES'>
            <br>
            <textarea style='background-color:<?php echo $post_info_edit['bg_color'] ?>' name="post_text" placeholder="What's on your mind?" required><?php echo $post_info_edit['post_text'] ?></textarea>
            <br>
            <div class='bg_color_select_wrapper'>
                <label>BACKGROUND :</label><input type="color" name='color' class='input_color_post' >
            </div>
            <br>
            <input type="file" name="upload_img" class='input_file_upload'>
            <br>
            <button name='updateBtn'>UPDATE</button>
        </form>
    </div>

    <script src='js/users_home.js'></script>
</body>
</html>