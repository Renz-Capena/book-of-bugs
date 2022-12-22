<?php
    require"connection.php";
    $con = connect();
    session_start();


    //--user id
    $user_id = $_SESSION['user_id'];
    //--receiver id
    $receiver_id = $_GET['id'];

    //--get sender info
    $get_sender_info = "SELECT * FROM `users` WHERE id='$user_id'";
    $list_sender = $con->query($get_sender_info);
    $sender_info = $list_sender->fetch_assoc();



    //--get receiver info
    $get_receiver_info = "SELECT * FROM `users` WHERE id='$receiver_id'";
    $list_receiver = $con->query($get_receiver_info);
    $receiver_info = $list_receiver->fetch_assoc();
    //-----------


    if(isset($_POST['sendMsg'])){
        $sender = $user_id;
        $receiver = $receiver_id;
        $date = $_POST['date'];
        $time = $_POST['time'];
        $msgText = $_POST['message_text'];
        // $pic = $_POST['picture'];

        //-----------Upload pic
        $picture = $_FILES['picture']['name'];
        $pictureTmpName = $_FILES['picture']['tmp_name'];
        $picNewDestination = 'uploads_message/'.$picture;

        move_uploaded_file($pictureTmpName,$picNewDestination);
        //--------------------
        // $msgText == null

        if($picture == null && $msgText == null){
            echo "<script>alert('Please type a message or upload a picture!')</script>";
        }else{

            // echo "<script>alert('Success!')</script>";

            $send = "INSERT INTO `message`(`sender_id`, `receiver_id`, `date`, `time`, `message_text`, `message_upload`) VALUES ('$sender','$receiver','$date','$time','$msgText','$picNewDestination')";

            $con->query($send);


            // sleep(1);
            header("Refresh: 0");
        }

    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book of Bugs | Message</title>
    <link rel="stylesheet" href="css/message.css">
</head>
<body>
    <header>
        <div>
            <img src="<?php echo $receiver_info['picture'] ?>"></img><?php echo $receiver_info['nickname'] ?>
        </div>
        <a href="users_home.php">BACK</a>
    </header>

    <section>
        <?php
            $get_all_message = "SELECT * FROM `message` WHERE sender_id='$user_id' AND receiver_id='$receiver_id' OR sender_id='$receiver_id' AND receiver_id='$user_id' ORDER BY id DESC";
            $message_list = $con->query($get_all_message);
            $message_infos = $message_list->fetch_assoc();
            $num_message = $message_list->num_rows;
        ?>

        <?php if($num_message){ ?>

            <?php do{ ?>

                <?php if($message_infos['sender_id'] == $user_id){ ?>

                    <div class='message_wrapper_sender'>
                        
                        <div>
                            <div>
                                <div>
                                    <?php echo $message_infos['message_text'] ?>
                                    <br>
                                    <img src="<?php echo $message_infos['message_upload'] ?>" alt="">
                                </div>
                            </div>
                            <p>
                                <?php echo $message_infos['date']?>
                                <br>
                                <?php echo $message_infos['time']?>
                            </p>
                        </div>

                        <img src="<?php echo $sender_info['picture'] ?>" alt="Profile">

                    </div>

                

                <?php }else{ ?>

                    <div class='message_wrapper_receiver'>

                        <img src="<?php echo $receiver_info['picture'] ?>" alt="Profile" alt="Profile">

                        <div>
                            <div>
                                <?php echo $message_infos['message_text'] ?>
                                <br>
                                <img src="<?php echo $message_infos['message_upload'] ?>" alt="">
                            </div>
                            <p>
                                <?php echo $message_infos['date']?>
                                <br>
                                <?php echo $message_infos['time']?>
                            </p>
                        </div>

                        </div>

                <?php } ?>

            <?php }while($message_infos = $message_list->fetch_assoc()) ?>

        <?php }else{ ?>

            <div>No message yet!</div>

        <?php } ?>
    </section>

    <div class='send_message_wrapper'>
        <form method='post' enctype='multipart/form-data'>
            <input type="hidden" id='date' name='date'>
            <input type="hidden" id='time' name='time'>

            <div class='file_upload_wrapper'>
                <div>
                    <input type="file" name='picture'>
                </div>
                <img src="img/more_dot.png" alt="File Upload">
            </div>

            <textarea name='message_text' id='textArea' placeholder='Your message...'></textarea>
            <button name='sendMsg'><img src="img/send_icon.png" alt=""></button>
        </form>
    </div>



    <script src='js/message.js'></script>
</body>
</html>