
<?php require "../../config/config.php"?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <title>Create New Borrowers Data</title>
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
				<a class="nav-link active" href="readers.php">Borrowers List</a>
				</li>
				<li class="nav-item">
				<a class="nav-link active" href="../books/books.php">Books List</a>
				</li>
			</ul>
	</div>
    </nav>
    <br>
    <br>

    <div class="wrapper">
		<div style="color:red">
        <?php 
            // mengambil data album
				if($_GET['id'] == null) {
					header("location: books.php");
				}

				$id = $_GET['id']; 
				$script = "SELECT * FROM books WHERE id = $id"; 
				$query = mysqli_query($conn, $script); 
				$data = mysqli_fetch_array($query); 

            // membuat data pembaca
				if(isset($_POST['submit'])){
                    $name = $_POST['name'];
                    $phone = $_POST['phone'];
                    $role = $_POST['role'];
                    $borrow_date = $_POST['borrow_date'];
                    $return_date = $_POST['return_date'];
                    $title = $_POST['title'];
                    $writer = $_POST['writer'];

						$script = "INSERT INTO readers SET name='$name', phone='$phone', role='$role', borrow_date='$borrow_date', return_date='$return_date', title='$title', writer='$writer'";

						$query = mysqli_query($conn, $script); 
						if($query) {
							header("location: readers.php");
						} else {
							echo "gagal mengupload data";
						}
				}

			?>
		</div>

        <form method="post" enctype="multipart/form-data">
        <center>
            <h1><i class="fa-solid fa-book-open-reader"></i> Borrower's Form</h1>
            <br>
        </center>

            <div class="row">
                <div class="col">
                <center><h4>Borrower's Identity</h4></center>
                    <div class="mb-3">
                        <label class="form-label">Name</label>
                        <input type="text" class="form-control" required name="name" autocomplete="off">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Phone</label>
                        <input type="number" class="form-control" required name="phone" autocomplete="off">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Role</label>
                        <select class="form-select" aria-label="Default select example" required name="role">
                            <option selected>Select</option>
                            <option value="Student">Student</option>
                            <option value="College student">College student</option>
                            <option value="Civilian">Civilian</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Borrow Date</label>
                        <input type="date" class="form-control" required name="borrow_date">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Return Date</label>
                        <input type="date" class="form-control" required name="return_date">
                    </div>
                </div>

                <div class="col">
                    <center><h4>Book's Identity</h4></center>
                    <div class="mb-3">
                        <label class="form-label">Title</label>
                        <input type="text" class="form-control" required name="title" value="<?= $data['title']?>" autocomplete="off">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Writer</label>
                        <input type="text" class="form-control" required name="writer" value="<?= $data['writer']?>" autocomplete="off">
                    </div>
                </div>
            </div>

            <center>
                <a href="../books/books.php" type="submit" class="btn btn-danger">Cancel</a> 
                <input type="submit" class="btn btn-success" name="submit" value="Add">
            </center>
		</form>
		<br><br><br> 
	</div>
</body>
</html>