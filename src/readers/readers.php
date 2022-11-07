<?php require "../../config/config.php"?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <title>Borrowers List</title>
    <!-- <link rel="stylesheet" href="../../assets/css/style.css"> -->
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
			</ul>

            <form class="d-flex" method="get">
					<input class="form-control me-2" size=25 autocomplete="off" type="search" id="form1" placeholder="Search borrower's name..." aria-label="Search" name="search">
					<input type="submit" class="btn btn-success" value="Search">
			</form>
            <a href="readers.php" class="btn btn-info" style="margin-left:5px;"><i class="fa-solid fa-arrows-rotate"></i></a>
    </div>
    </nav>
    <br>
    <br>

    <div class="wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <center>
                            <h2 class="pull-left"><i class="fa-solid fa-user"></i>   BORROWER'S DATA</h2>
                            <br>
                        </center>
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
                                $sql="SELECT * FROM readers WHERE name LIKE '%$search%' ORDER BY id ASC LIMIT $posisi, $batas"; 
                            }else{ 
                                $sql="SELECT * FROM readers ORDER BY id ASC LIMIT $posisi, $batas";
                            }
                        ?>
                            <table class="table table-bordered">
                                <thead class="table-info">
                                <th>ID</th>
                                <th>Name</th>
                                <th>Phone</th>
                                <th>Role</th>
                                <th>Borrow's Date</th>
                                <th>Return's Date</th>
                                <th>Title</th>
                                <th>Writer</th>
                                <th>Action</th>
                                </thead>
                                <tbody>
                                    <?php
                                        $select = mysqli_query($conn, $sql);
                                        while($data = mysqli_fetch_array($select)):
                                    ?>
                                    <tr>
                                        <td><?= $data['id']; ?></td>
                                        <td><?= $data['name']; ?></td>
                                        <td><?= $data['phone']; ?></td>
                                        <td><?= $data['role']; ?></td>
                                        <td><?= $data['borrow_date']; ?></td>
                                        <td><?= $data['return_date']; ?></td>
                                        <td><?= $data['title']; ?></td>
                                        <td><?= $data['writer']; ?></td>
                                        <td>
                                            <!-- read -->
                                            <a href="read.php?id=<?= $data['id'] ?>" style="color: green;"><i class="fa-solid fa-eye"></i></a>
                                            <!-- update -->
                                            <a href="update.php?id=<?= $data['id'] ?>" style="color: yellow;"><i class="fa-regular fa-pen-to-square"></i></a>
                                            <!-- delete -->
                                            <a href="delete.php?id=<?= $data['id'] ?>" style="color: red;"><i class="fa-regular fa-trash-can"></i></a>
                                        </td>
                                    </tr>
                                    <?php
                                        endwhile;
                                    ?>
                                </tbody>
                            </table>

                            <?php
                                if(isset($_GET['search'])){
                                    $search= $_GET['search']; 
                                    $query2="SELECT * FROM readers WHERE name LIKE '%$search%' ORDER BY id ASC"; 
                                }else{ 
                                    $query2="SELECT * FROM readers ORDER BY id ASC";
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
                                                echo "<li class='page-item'><a class='page-link' href='readers.php?halaman=$i&search=$search'>
                                                    $i</a></li>";
                                            }else{ 
                                                echo "<li class='page-item'><a class='page-link' href='readers.php?halaman=$i'>$i</a></li>";
                                            }
                                        } else {
                                            echo "<li class='page-item active'><a class='page-link' href='#'>$i</a></li>";
                                        }
                                    }
                                ?>
                            </ul> 
                </div>
            </div>
        </div>


</body>
</html>