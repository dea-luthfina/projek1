<?php
    require('config/config.php');

    session_start();

    $error = '';
    $success = '';
    $errorCaptcha = '';

    // mengecek apakah session username tersedia atau tidak, kalau ada nanti dia langsung ke index
    if(isset($_SESSION['username'])) header('Location: index.php');

    // fungsi tombol submit
    if(isset($_POST['submit'])){
        // menghilangkan backlashes
        $username = stripslashes($_POST['username']);
        // menghindari sql injection
        $username = mysqli_real_escape_string($conn, $username);

        $password = stripslashes($_POST['password']);
        $password = mysqli_real_escape_string($conn, $password);

        // validasi form kosong
        if(!empty(trim($username)) && !empty(trim($password))){
            // mengambil data dari database berdasarkan username
            $query = "SELECT *FROM users WHERE username = '$username'";
            $result = mysqli_query($conn, $query);
            $rows = mysqli_num_rows($result);

            // cek password pas username udah ketemu
            if($rows != 0){
                $hash = mysqli_fetch_assoc($result)['password'];
                if(password_verify($password, $hash) && $_SESSION['code'] == $_POST['captchaCode']){
                    $_SESSION['username'] = $username;

                    header('Location: index.php');
                }
            // gagal akan menampilkan pesan error
            } else {
                $error = 'Login failed! Please enter the right username and password.';
            }
        } else {
            $error = 'Data must not empty';
        }

        // validasi kode captcha
        if($_SESSION['code'] != $_POST['captchaCode']){
            $errorCaptcha = "Invalid captcha value!";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <title>Login | Komura Library</title>
    <link rel="stylesheet" href="assets/css/form-style.css">
    <script src="https://kit.fontawesome.com/021b758c3a.js" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container">
        <div class="forms">
            <div class ="form register">
                <center><h3><i class="fa-solid fa-book-open"></i> KOMURA'S LIBRARY</h3></center>
                <br>
                <span class="title">Login</span>
                <form action="login.php" method="post">
                    <?php if($error != ''){ ?>
                        <div class="alert alert-danger alert-dismissible fade show" style="margin-top: 10px;" role="alert">
                            <?=$error; ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                            </button>
                        </div>
                    <?php } ?>
                    <?php if($errorCaptcha != ''){ ?>
                        <div class="alert alert-danger alert-dismissible fade show" style="margin-top: 10px;" role="alert">
                            <?=$errorCaptcha; ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                            </button>
                        </div>
                    <?php } ?>
                    <div class="input-group mb-3">
                        <span class="input-group-text"><i class="fa-solid fa-user"></i></span>
                        <input type="text" class="form-control" required name="username" id="username" autocomplete="off" placeholder="Username">
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text"><i class="fa-solid fa-lock"></i></span>
                        <input type="password" class="form-control" minlength=6 maxlength=8 required name="password" id="password" autocomplete="off" placeholder="Password">
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text">Security Code</i></span>
                        <img src="captcha.php">
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text">Enter Security Code</i></span>
                        <input type="text" class="form-control" required name="captchaCode" maxlength="6">
                    </div>
                    <div class="checkbox-text">
                        <div class="checkbox-content">
                            <input type="checkbox" id="logCheck">
                            <label for="logCheck" class="text">Remember Me</label>
                        </div>
                        <a href="#" class="text">Forgot Password?</a>
                    </div>
                    <div class="d-grid gap-2 col-14 mx-auto" style="margin-top: 20px;">
                        <button class="btn btn-primary" type="submit" name="submit">Login</button>
                    </div>

                    <div class="login-signup">
                        <span class="text">Not a librarian?
                            <a href="register.php" class="signup-text">Register now</a>
                        </span>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>