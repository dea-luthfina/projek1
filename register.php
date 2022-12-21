<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <title>Register | Komura Library</title>
    <link rel="stylesheet" href="assets/css/form-style.css">
    <script src="https://kit.fontawesome.com/021b758c3a.js" crossorigin="anonymous"></script>
</head>
<body>
    <?php
        // import config
        require("config/config.php");

        // inisialisasi session
        session_start();

        // field variabel
        $error = '';
        $validate = '';

        // ngecek data username kosong atau enggak
        if(isset($_SESSION['user'])){
            header('Location: index.php');
        } 

        // mengecek apakah username udah diinput sama user
        if(isset($_POST['submit'])){
            // menghilangkan backshlases
            $username = stripslashes($_POST['username']);
            // mencegah sql injection
            $username = mysqli_real_escape_string($conn, $username);

            $name = stripslashes($_POST['name']);
            $name = mysqli_real_escape_string($conn, $name);

            $email = stripslashes($_POST['email']);
            $email = mysqli_real_escape_string($conn, $email);

            $password = stripslashes($_POST['password']);
            $password = mysqli_real_escape_string($conn, $password);

            $repass = stripslashes($_POST['repass']);
            $repass = mysqli_real_escape_string($conn, $repass);

            // validasi inputan kosong atau tidak
            if(!empty(trim($name)) && !empty(trim($username)) && !empty(trim($email)) && !empty(trim($password)) && !empty(trim($repass))){
                // validasi password sama confirm password sama atau engga
                if($password == $repass){
                    // function check_name untuk ngecek apakah username udah ada di database atau belum
                    if(check_name($name, $conn) == 0 ){
                        $pass = password_hash($password, PASSWORD_DEFAULT);
                        $query = "INSERT INTO users (username, name, email, password) VALUES ('$username', '$name', '$email', '$pass')";
                        $result = mysqli_query($conn, $query);
                        if($result){
                            header('Location: login.php');
                        } else{
                            $error = 'Register failed!';
                        } 
                    } else {
                        $error = 'Username already exist.';
                    } 
                } else {
                    $validate = "Password doesn't match!";
                }
            } else {
                $error = 'Data must not empty!';
            }
        }

        // fungsi ngecek username sama di database
        function check_name($username, $conn){
            $name = mysqli_real_escape_string($conn, $username);
            $query = "SELECT * FROM users WHERE username = '$username'";
            if($result = mysqli_query($conn, $query)) return mysqli_num_rows($result);
        }


    ?>
    <div class="container">
        <div class="forms">
            <div class ="form register">
                <center><h3><i class="fa-solid fa-book-open"></i> KOMURA'S LIBRARY</h3></center>
                <br>
                <span class="title">Register</span>
                <form action="" method="post">
                    <?php if($error != ''){?>
                        <div class= "alert alert-danger" role="alert" style="margin-top: 10px;"><?= $error; ?></div>
                    <?php } ?>
                    <div class="input-group mb-3">
                        <span class="input-group-text"><i class="fa-solid fa-user"></i></span>
                        <input type="text" class="form-control" required minlength=6 name="name" id="name" autocomplete="off" placeholder="Name">
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text">@</span>
                        <input type="text" class="form-control" minlength= 6 required name="username" id="username" autocomplete="off" placeholder="Username">
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text"><i class="fa-solid fa-envelope"></i></span>
                        <input type="email" class="form-control" required name="email" id="email" autocomplete="off" placeholder="Email">
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text"><i class="fa-solid fa-lock"></i></span>
                        <input type="password" class="form-control" minlength=6 maxlength=8 required name="password" id="password" autocomplete="off" placeholder="Password">
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text"><i class="fa-solid fa-lock"></i></span>
                        <input type="password" class="form-control" minlength=6 maxlength=8 required name="repass" id="repass" autocomplete="off" placeholder="Confirm Password">
                    </div>
                    <?php if($validate != ''){?>
                            <div class= "text-danger"><?= $validate; ?></div>
                        <?php } ?>
                    <div class="d-grid gap-2 col-14 mx-auto" style="margin-top: 20px;">
                        <button type="submit" name="submit" class="btn btn-primary">Register</button>
                    </div>
                    <div class="login-signup">
                        <span class="text">Already a librarian?
                            <a href="login.php" class="signup-text">Login now</a>
                        </span>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>