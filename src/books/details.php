<?php require "../../config/config.php";

    if($_GET['id'] != null){
        $id = $_GET['id']; 
        $script = "SELECT * FROM books WHERE id=$id"; 
        $query = mysqli_query($conn, $script);
        $data = mysqli_fetch_array($query);
    }else{
        header("location: read.php");
    }

    $query2 = null;

    if(isset($_POST['hapus'])) {
        $script2 = "DELETE FROM books WHERE id = $id"; 
        $query2 = mysqli_query($conn, $script2);
    }

    if($query2 != null){
        header("location:books.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <title>Book's Details</title>
    <link rel="stylesheet" href="../../assets/css/style.css">
    <script src="https://kit.fontawesome.com/021b758c3a.js" crossorigin="anonymous"></script>
</head>
<body>
    <nav class="navbar navbar-dark navbar-expand-lg" style="background-color: #5837D0;">
	<div class="container-fluid">
			<ul class="navbar-nav me-auto mb-2 mb-lg-0">
				<li class="nav-item">
				<a class="nav-link active" href="../../index.php">Home</a>
				</li>
				<li class="nav-item">
				<a class="nav-link active" href="create.php"><i class="fa-solid fa-plus"></i>   Add Books</a>
				</li>
				<li class="nav-item">
				<a class="nav-link active" href="books.php">Book's List</a>
				</li>
				<li class="nav-item">
				<a class="nav-link active" href="../readers/readers.php">Borrower's List</a>
				</li>
			</ul>
		</div>
    </nav>
    <br>
    <br>


		<div class="wrapper"> 
		<a href="books.php" type="submit" class="btn btn-primary">< Back</a>
		<br>
		<br>
		<h2><i class="fa-solid fa-circle-info"></i>   Book Details </h2>
			<div class="row"> 
				<div class="col-4"> 
					<div class="box-detail-books">
						<center>
						<img src="<?= $data['cover'] ?>" width="80%" alt=""> 
						</center>
					</div>
				</div> 
				<div class="col-6"> 
					<div class="box-desc">
					<div class="container"></div>
						<div class="row">
							<div class="col">
								<h4>Book Title</h4>
								<p><?= $data['title'] ?></p>
								<h4>Writer</h4>
								<p><?= $data['writer'] ?></p>
								<h4>Years</h4>
								<p><?= $data['years'] ?></p>
							</div>
							<div class="col">
								<h4>Genre</h4>
								<p><?= $data['genre'] ?></p>
								<h4>Total pages</h4>
								<p><?= $data['pages'] ?></p>
								<h4>Publisher</h4>
								<p><?= $data['publisher'] ?></p>
							</div>
						</div>
					</div>

					<center>
					<div class="box-button">
					<form method="post">
						<h3>Action</h3>
						<a href="edit.php?id=<?= $data['id'] ?>" class="btn btn-warning">Update</a>
						<a href="../readers/borrows.php?id=<?= $data['id'] ?>" class="btn btn-info">Borrow</a>
						<input type="submit" name="hapus" value="Delete" class="btn btn-danger"> 
					</form> 
					</div>
					</center>
				</div>
			</div>
		</div>
	</div>
</body>
</html>