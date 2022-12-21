<?php require "../../config/config.php";

    if($_GET['id_reader'] != null){
        $id_reader = $_GET['id_reader']; 
        $script = "SELECT * FROM readers WHERE id_reader=$id_reader"; 
        $query = mysqli_query($conn, $script);
        $data = mysqli_fetch_array($query);
    }else{
        header("location: readers.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <title>Borrowers Details</title>
    <link rel="stylesheet" href="../../assets/css/style.css">
    <script src="https://kit.fontawesome.com/021b758c3a.js" crossorigin="anonymous"></script>
</head>
<body>
    <nav class="navbar navbar-dark navbar-expand-lg" style="background-color: #5837D0;">
    <div class="container-fluid" style="width: 80%;">
			<ul class="navbar-nav me-auto mb-2 mb-lg-0">
				<li class="nav-item">
				<a class="nav-link active" href="../../index.php">Home</a>
				</li>
				<li class="nav-item">
				<a class="nav-link active" href="readers.php">Borrowers List</a>
				</li>
				<li class="nav-item">
				<a class="nav-link active" href="../books/books.php">Books List</a>
				</li>
                <li class="nav-item">
				<a class="nav-link active" href="../readers/readers_chart.php">See Readers Chart</a>
				</li>
			</ul>
    </div>
    </nav>
    <br>
    <br>

        <div class="wrapper">
            <div class="card">
            <center><h1 class="card-header">Borrower's Data</h1></center>
            <div class="card-body">
                <div class="container">
                    <div class="row">
                        <div class="col">
                            <h4 class="card-text">Borrower's Identity</h4>
                            <h5 class="card-text">ID READER</h5>
                            <p class="card-text"><?= $data['id_reader'] ?></p>
                            <h5 class="card-text">Name</h5>
                            <p class="card-text"><?= $data['name'] ?></p>
                            <h5 class="card-text">Phone Number</h5>
                            <p class="card-text"><?= $data['phone'] ?></p>
                            <h5 class="card-text">Role</h5>
                            <p class="card-text"><?= $data['role'] ?></p>
                            <h5 class="card-text">Borrow's Date</h5>
                            <p class="card-text"><?= $data['borrow_date'] ?></p>
                            <h5 class="card-text">Return's Date</h5>
                            <p class="card-text"><?= $data['return_date'] ?></p>
                        </div>
                        <div class="col">
                            <h4 class="card-text">Book's Identity</h4>
                            <h5 class="card-text">ID_BOOK</h5>
                            <p class="card-text"><?= $data['id_book'] ?></p>
                            <h5 class="card-text">Title</h5>
                            <p class="card-text"><?= $data['title'] ?></p>
                            <h5 class="card-text">Writer</h5>
                            <p class="card-text"><?= $data['writer'] ?></p>
                        </div>
                    </div>
                </div>
            </div>
            </div>
            <br>
            <center>
                <ul><a href="readers.php" type="submit" class="btn btn-primary">Back</a></ul>
            </center>
        </div>
</body>
</html>