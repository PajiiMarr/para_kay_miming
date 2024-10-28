<?php
session_start();
require_once 'user.class.php';
require_once 'clean.php';

$objUser = new User;

$username = $password = '';
$usernameErr = $passwordErr = $incorrect_credentials = '';
$allinputsfield = true;

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $username = isset($_POST['username']) ? clean_input($_POST['username']) : '' ;
    $password = isset($_POST['password']) ? clean_input($_POST['password']) : '' ;
    $record_exist_function = $objUser->record_exist($username);

    if(empty($username)){
        $usernameErr = ' Username is required!';
        $allinputsfield = false;
    }

    if(empty($password)){
        $passwordErr = ' Password required!';
        $allinputsfield = false;
    }

    if($allinputsfield){
        $objUser->login($username, $password);
        $incorrect_credentials = $_SESSION['incorrect_credentials'];
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        * {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
            font-family: sans-serif;
            font-size: 14px;
        }

        body {
            background: linear-gradient(to right, #ff6e6e, #873232);
        }

        .parent{
            height: 100vh;
            width: 100%;
            display: flex;
        }

        .child {
            width: 50%;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .one {
            color: white;
        }

        .one h1,
        .one p{
            transition: 0.1s ease-in-out;
        }

        .one h1:hover,
        .one p:hover {
            transform: scale(2,2);
        }

        

        form {
            background-color: white;
            padding: 2em;
            width: 35%;
            border-radius: 10px;    
            height: 50%;
            display:flex;
            justify-content: center;
            align-items: center;
            box-shadow: 0 0 5px 5px rgba(100,100,100, 0.3);
        }

        form .f_child{
            display: flex;
            flex-direction: column;
            width: 100%;
            gap: 0.5em;
        }

        h1 {
            font-size: 1.5em;
        }

        input {
            width: 100%;
            padding: 5px;
        }

        .required {
            color: red;
        }
    </style>
</head>
<body>
    <section class="parent">
        <div class="child one">
            <h1>Assignment Web Development 2</h1>
            <p>Manon-og, Marlo B.</p>
        </div>
        <div class="child">
            <form method="post">
                <div class="f_child">
                    <h1>Login</h1>
                    <span class="required"><?= $incorrect_credentials; ?></span>
                    <div>
                        Username <span class="required">* <?= $usernameErr; ?></span><br>
                        <input type="text" name="username" id="username">
                    </div>
                    <div>
                        Password <span class="required">* <?= $passwordErr; ?></span><br>
                        <input type="password" name="password" id="password">
                    </div>
                    <input type="submit" value="Submit">
                </div>
            </form>
        </div>
    </section>
</body>
</html>