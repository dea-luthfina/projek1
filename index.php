<?php 
    session_start();
    $username = $_SESSION['username'];
    if(!isset($username)){
        $_SESSION['msg'] = 'Anda harus login untuk mengakses halaman ini';
        header('Location: login.php');
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <title>Home | Komura Library</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <script src="https://kit.fontawesome.com/021b758c3a.js" crossorigin="anonymous"></script>
</head>
<body>
    <nav class="navbar navbar-dark navbar-expand-lg" style="background-color: #5837D0;">
    <div class="container-fluid">
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
            <a class="nav-link active" href="index.php">Home</a>
            </li>
            <li class="nav-item">
            <a class="nav-link active" href="src/books/books.php"></i>Book's List</a>
            </li>
            <li class="nav-item">
            <a class="nav-link active" href="src/readers/readers.php"></i>Borrowers's List</a>
            </li>
        </ul>
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="btn btn-danger" href="logout.php" name="logout" id="logout">Log Out</a>
            </li>
        </ul>
        </div>
    </div>
    </nav>

    <center>
        <br>
        <h2>WELCOME, <?=$username;?>!</h2>
        <h3>KOMURA LIBRARY</h3>
        <h3><i class="fa-solid fa-book-open"></i></h3>
        <br>
        <div class="wrapper">
            <div class="row row-cols-1 row-cols-md-2 g-4">
                <div class="col">
                    <div class="card">
                        <img src="assets/img/bg-book.jpg" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Books</h5>
                            <a href="src/books/books.php" class="btn btn-primary">See Book Shelf >></a>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card">
                        <img src="assets/img/bg-reader.jpg" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Borrowers</h5>
                            <a href="src/readers/readers.php" class="btn btn-primary">See Borrower's data >></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </center>
</body>
</html>