<?php require "../../config/config.php" ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <title>Create New Data Books</title>
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
				<a class="nav-link active" href="create.php"><i class="fa-solid fa-plus"></i>  Add Books</a>
				</li>
				<li class="nav-item">
				<a class="nav-link active" href="books.php">Book's List</a>
				</li>
				<li class="nav-item">
				<a class="nav-link active" href="../readers/readers.php">Borrower's List</a>
				</li>
				<li class="nav-item">
				<a class="nav-link active" href="books_chart.php">See Books Chart</a>
				</li>
			</ul>
		</div>
    </nav>

    <div class="wrapper">
		<div style="color:red">
			<?php 
				if(isset($_POST['submit'])){
					if(isset($_FILES['cover'])){
						$title = $_POST['title']; 
						$writer = $_POST['writer']; 
						$genre = $_POST['genre']; 
						$pages = $_POST['pages']; 
						$publisher = $_POST['publisher'];
						$years = $_POST['years'];
						$file_tmp= $_FILES['cover']['tmp_name'];
						$type = pathinfo($file_tmp, PATHINFO_EXTENSION); 
						$data = file_get_contents($file_tmp); 
						$cover='data:assets/img/' . $type.';base64,'. base64_encode($data);

						$script = "INSERT INTO books SET title='$title', writer='$writer', genre='$genre', pages='$pages', publisher='$publisher', years='$years', cover='$cover'";

						$query = mysqli_query($conn, $script); 
						
						if($query) {
							header("location: books.php");
						}else{
							echo "gagal mengupload data";
						}
					}
				}
			?>
			<br>
		</div>
        
        <center>
            <h4><i class="fa-solid fa-plus"></i>  Create New Data</h4>
        </center>
		<form method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label class="form-label">Title</label>
                <input type="text" class="form-control" required name="title" autocomplete="off">
            </div>
            <div class="mb-3">
                <label class="form-label">Writer</label>
                <input type="text" class="form-control" required name="writer" autocomplete="off">
            </div>
            <div class="mb-3">
                <label class="form-label">Genre</label>
                <select class="form-select" aria-label="Default select example" required name="genre">
                    <option selected>Select</option>
                    <option value="Romance">Romance</option>
                    <option value="Fiction">Fiction</option>
                    <option value="Non-Fiction">Non-Fiction</option>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Cover</label>
                <input type="file" class="form-control" required name="cover" autocomplete="off">
            </div>
            <div class="mb-3">
                <label class="form-label">Pages</label>
                <input type="number" min=0 class="form-control" required name="pages" autocomplete="off">
            </div>
            <div class="mb-3">
                <label class="form-label">Years</label>
                <input type="number" min=1500 max=2022 class="form-control" required name="years" autocomplete="off">
            </div>
            <div class="mb-3">
                <label class="form-label">Publisher</label>
                <input type="text" class="form-control" required name="publisher" autocomplete="off">
            </div>
            <a href="books.php" type="submit" class="btn btn-danger">Cancel</a> 
            <input type="submit" class="btn btn-success" name="submit" value="Add">
		</form>
		<br><br><br> 
	</div>
</body>
</html>