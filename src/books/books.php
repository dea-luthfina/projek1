<?php require "../../config/config.php" 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <title>Book Shelfs</title>
    <link rel="stylesheet" href="../../assets/css/style.css">
    <script src="https://kit.fontawesome.com/021b758c3a.js" crossorigin="anonymous"></script>
</head>
<body>
    <nav class="navbar navbar-dark navbar-expand-lg" style="background-color: #5837D0;">
		<div class="container-fluid">
			<!-- link item -->
			<div class="container-fluid">
			<!-- link item -->
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

				<form class="d-flex" method="get">
					<input class="form-control me-2" autocomplete="off" type="search" id="form1" placeholder="Search book's title..." aria-label="Search" name="search">
					<input type="submit" class="btn btn-success" value="Search">
				</form>
				<a href="books.php" class="btn btn-info" style="margin-left:5px;"><i class="fa-solid fa-arrows-rotate"></i></a>
    </nav>
    <br>
    <br>
    <br>

    <div class="wrapper">
		<center>
			<h2><i class="fa-solid fa-book"></i> Books Shelf</h2>
			<br>
		</center>
		<div class="row">
			<?php
                // pagination, batas itu contentnya ada berapa dalam satu page
				$batas = 6; 
				$halaman = $_GET['halaman'] ?? null;

				if(empty($halaman)){
					$posisi = 0; $halaman = 1;
				}else{
					$posisi = ($halaman-1) * $batas;
				}

				if(isset($_GET['search'])){ 
					$search = $_GET['search']; 
					$sql="SELECT * FROM books WHERE title LIKE '%$search%' ORDER BY id_book ASC LIMIT $posisi, $batas"; 
				}else{ 
					$sql="SELECT * FROM books ORDER BY id_book ASC LIMIT $posisi, $batas";
				}

                // mengambil data dari database
				$hasil=mysqli_query($conn, $sql); 
				while ($data = mysqli_fetch_array($hasil)) {
			?>

			
			<div class="col-sm-2">
			<a href="details.php?id_book=<?= $data['id_book'] ?>">
                <div class="card" style="width: 10rem; height: 23rem;">
                    <img src="<?= $data['cover'] ?>" class="card-img-top" alt="">
                    <div class="card-body">
                        <h6 class="card-title"><?= $data['title'] ?></h6>
                        <p class="card-text"><?= $data['writer'] ?></p>
                    </div>
                </div>
			</a>
			</div>
			<?php } ?>
		</div> 

		<?php
			if(isset($_GET['search'])){
				$search= $_GET['search']; 
				$query2="SELECT * FROM books WHERE title LIKE '%$search%' ORDER BY id_book ASC"; 
			}else{ 
				$query2="SELECT * FROM books ORDER BY id_book ASC";
			}
			
			$result2 = mysqli_query($conn, $query2); 
			$jmldata = mysqli_num_rows($result2); 
			$jmlhalaman = ceil($jmldata/$batas);
		?>
		<br>
		<ul class="pagination"> 
			<?php 
				for($i=1;$i<=$jmlhalaman; $i++) {
					if ($i != $halaman) { 
						if(isset($_GET['search'])){ 
							$search = $_GET['search'];
							echo "<li class='page-item'><a class='page-link' href='books.php?halaman=$i&search=$search'>
								  $i</a></li>";
						}else{ 
							echo "<li class='page-item'><a class='page-link' href='books.php?halaman=$i'>$i</a></li>";
						}
					} else {
						echo "<li class='page-item active'><a class='page-link' href='#'>$i</a></li>";
					}
				}
			?>
		</ul> 
	</div>
</body>
</html>