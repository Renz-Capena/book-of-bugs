<?php
    require'connection.php';
    $con = connect();

    if(isset($_POST['signupBtn'])){
        $name = $_POST['name'];
        $nickname = $_POST['nickname'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        $command = "INSERT INTO users (`name`, `nickname`, `email`, `password`) VALUES ('$name', '$nickname', '$email', '$password')";
        $con->query($command);

        header("location: index.php");
    }

    if(isset($_POST['loginBtn'])){
        $email = $_POST['email'];
        $password = $_POST['password'];

        $validate = "SELECT * FROM `users` WHERE email = '$email' AND password = '$password' ";
        $list = $con->query($validate);
        $valid = $list->num_rows;
        if($valid > 0){
            header("location: users_home.php");
        }else{
            echo "<script>alert('Wrong Credentials!')</script>";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Diary</title>
    <link rel="stylesheet" href="css/index.css">
</head>
<body>
    <header>
        <nav>
            <div class="mobileview_burger_menu_wrapper">
                <img src="img/burger_menu.png" alt="MENU" id="burgerMenu">
                <p>book of <span>bugs</span></p>
            </div>
        </nav>
    </header>

    <div class="layer_black"></div>
    <div class="nav_btns">
        <div><img src="img/close.png" alt="close" id="close_nav"></div>
        <p>Home</p>
        <p>About</p>
        <p>Contact</p>
        <p id="signIn_Nav">Sign In</p>
    </div>

    <section>
        <div class="form_wrapper">
            <div class="close_wrapper_form"><img src="img/close.png" alt="CLOSE" id="close_form_btn"></div>
            <div class="signin_signup_wrapper">
                <button id="signInBtn" class="headbtn active">Sign in</button>
                <button id="signUpBtn" class="headbtn">Sign up</button>
            </div>
            <div class="form_wrapper_info">
                <div>
                    <form method="post" class="form_login" autocomplete="off">
                        <br><br>
                        <label>Email</label>
                        <input type="email" name="email" placeholder="Email" required>
                        <br><br><br>
                        <label>Password</label>
                        <input type="password" name="password" placeholder="Password" required>
                        <br><br>
                        <button name='loginBtn'>SIGN IN</button>
                    </form>
                    <form method="post" class="form_sign_up" autocomplete="off">
                        <label>Name</label>
                        <input type="text" name="name" placeholder="Name" required>
                        <br><br>
                        <label>Nickname</label>
                        <input type="text" name="nickname" placeholder="Nickname" required>
                        <br><br>
                        <label>Email</label>
                        <input type="email" name="email"  placeholder="Email" required>
                        <br><br>
                        <label>Password</label>
                        <input type="password" name="password" placeholder="Password" required>
                        <button name='signupBtn'>SIGN UP</button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <script src="js/index.js"></script>
</body>
</html>