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
    <title>Add diary</title>
    <link rel="stylesheet" href="css/add.css">
</head>
<body>
    <header>
        <p><img src="<?php echo $info['picture'] ?>"></img><?php echo $info['nickname'] ?></p>

        <form method="post">
            <button name="logout_btn">LOGOUT</button>
        </form>
    </header>

    <main>
        <section>
            <form class="form_container">
                <label for="">TITLE</label>
                <br><br>
                <input type="text">
                <br><br><br>
                <label for="">Diary</label>
                <br><br>
                <textarea name="content" id="textarea" placeholder="Dear Diary,"></textarea>
                <br>
                <a href="users_home.php">BACK</a>
                <button>SUBMIT</button>
            </form>
        </section>
    </main>
    

    <script src="js/add.js"></script>
</body>
</html>