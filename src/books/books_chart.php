<?php
// konfigurasi dulu
include('../../config/config.php');

// ambil data judul buku di tabel buku
$books = mysqli_query($conn, "SELECT * FROM books");

// ambil judul buku
while($row = mysqli_fetch_array($books)) {
    // jadi harus ada data yang sama antara si buku dan si peminjam. di sini ada title, jadi yang diambil title
    $books_title[] = $row['title'];
    // kita ngambil data judul buku di tabe buku, tapi menghitung total si buku dipinjam di tabel pembaca dengan query
    $query = mysqli_query($conn, "SELECT COUNT(title) AS title FROM readers WHERE title='".$row['title']."'");
    // ambil hasil query dengan memasukkannya ke dalam variable row
    $row = $query->fetch_array();
    // masukin variable row tadi ke dalam array dengan rownya itu si title sendiri
    $total_books[] = $row['title'] ;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Books Chart</title>
    <!-- panggil library js -->
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <!-- css -->
    <link rel="stylesheet" href="../../assets/css/style.css">
    <!-- icons -->
    <script src="https://kit.fontawesome.com/021b758c3a.js" crossorigin="anonymous"></script>
</head>
<body>
    <!-- navigation -->
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
    <br>
    <br>
    
    <center>
        <h2>Total Books Borrowed by Titles</h2>
        <br>
        <div class="wrapper">
            <ul">
                <li style="list-style: none;">
                    <div style="width: 900px; height: 400px">
                        <h3><i class="fa-solid fa-chart-simple"></i>  Bar Chart</h3>
                        <!-- grafik ada di dalam canvas -->
                        <!-- line graph -->
                        <canvas id="myChart"></canvas>
                    </div>
                    <br>
                    <br>
                    <br>
                    <br>
                </li>
                <li style="list-style: none; margin-top: 100px;">
                    <!-- pie chart -->
                    <div id="canvas-holder" style="width: 800px; height: 500px;">
                        <h3><i class="fa-solid fa-chart-pie"></i>  Pie Chart</h3>
                        <canvas id="chart-area"></canvas>
                    </div>
                </li>
            </ul>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        </div>
    </center>

        <script>
            // idnya janlup
            var ctx = document.getElementById("myChart").getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: <?php echo json_encode($books_title); ?>,
                    datasets: [{
                        // judul
                        label: 'Total Books Borrowed',
                        // datanya itu format json jadi di encode dulu
                        data: <?php echo json_encode($total_books); ?>,
                    // warna chartnya
                    backgroundColor: [
                    'rgba(255, 99, 132, 0.7)',
                    'rgba(54, 162, 235, 0.7)',
                    'rgba(255, 286, 86, 0.7)',
                    'rgba(75, 192, 192, 0.7)',
                    'rgba(255, 79, 79, 0.7)',
                    'rgba(79, 255, 106, 0.7)',
                    'rgba(255, 143, 79, 0.7)',
                    'rgba(79, 255, 242, 0.7)',
                    'rgba(191, 79, 255, 0.7)',
                    'rgba(121, 113, 125, 0.7)'
                    ],
                    // warna bodernya
                    borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(255, 79, 79, 1)',
                    'rgba(79, 255, 106, 1)',
                    'rgba(255, 143, 79, 1)',
                    'rgba(79, 255, 242, 1)',
                    'rgba(191, 79, 255, 1)',
                    'rgba(121, 113, 125, 1)'
                    ],
                        borderWidth: 3
                    }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero:true
                            }
                        }]
                    }
                }
            });

            var config = {
                type: 'pie',
                data: {
                datasets: [{
                    // datanya tuh kudu format json, nah karena kita udah punya variable yang nampung array data itu tapi blm bentuk json
                    // jadi kita encode dulu biar bentuk json terus kita masukin ke data 
                    data: <?php echo json_encode($total_books); ?>,
                    // warna chartnya
                    backgroundColor: [
                    'rgba(255, 99, 132, 0.7)',
                    'rgba(54, 162, 235, 0.7)',
                    'rgba(255, 286, 86, 0.7)',
                    'rgba(75, 192, 192, 0.7)',
                    'rgba(255, 79, 79, 0.7)',
                    'rgba(79, 255, 106, 0.7)',
                    'rgba(255, 143, 79, 0.7)',
                    'rgba(79, 255, 242, 0.7)',
                    'rgba(191, 79, 255, 0.7)',
                    'rgba(121, 113, 125, 0.7)'
                    ],
                    // warna bodernya
                    borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(255, 79, 79, 1)',
                    'rgba(79, 255, 106, 1)',
                    'rgba(255, 143, 79, 1)',
                    'rgba(79, 255, 242, 1)',
                    'rgba(191, 79, 255, 1)',
                    'rgba(121, 113, 125, 1)'
                    ],
                    // judul chart
                    label: "Total Books Borrowed"
                }],
                // datanya tuh kudu format json, nah karena kita udah punya variable yang nampung array data itu tapi blm bentuk json
                // jadi kita encode dulu biar bentuk json terus kita masukin ke data 
                labels: <?php echo json_encode($books_title); ?>},
            options: {
                responsive: true
            }
        };
        
        window.onload = function() {
            var ctx = document.getElementById('chart-area').getContext('2d');
            window.myPie = new Chart(ctx, config);
        };
        
        document.getElementById('randomizeData').addEventListener('click', function() {
            config.data.datasets.forEach(function(dataset) {
                dataset.data = dataset.data.map(function() {
                    return randomScalingFactor();
                });
            });
            window.myPie.update();
        });

        var colorNames = Object.keys(window.chartColors);
        document.getElementById('addDataset'),addEventListener('click',function() {
            var newDataset = {
                backgroundColor: [],
                data: [],
                label: 'New dataset ' + config.data.datasets.length,
            };

            for (var index = 0; index < config.data.labels.length; ++index) {
                newDataset.data.push(randomScalingFactor());
                
                var colorName = colorNames [index % colorNames.length];
                var newColor = window.chartColors[colorName];
                newDataset.backgroundColor.push(newColor);
            }
            
            config.data.datasets.push(newDataset);
            window.myPie.update();
        });
        
        document.getElementById('removeDataset').addEventListener('click', function() {
            config.data.datasets.splice(0, 1);
            window.myPie.update();
        });
        </script>
</body>
</html>