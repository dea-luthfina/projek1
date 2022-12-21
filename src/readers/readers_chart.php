<?php
include('../../config/config.php');

// label
$label = ["January","February","March","April","May","June","Jule","August","September","October", "November", "December"] ;
for($month = 1;$month < 13;$month++) {
    //pakai count untuk menghitung berapa banyak peminjam perbulan
    $query = mysqli_query($conn,"SELECT COUNT(id_book) AS id_book FROM readers WHERE MONTH(borrow_date)='$month'");
    //setelah diquery, dibuat variabel untuk dientry ke chart
    $row = $query->fetch_array();
    //buat variable array perbulan
    $total_books[] = $row['id_book'];
}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="../../assets/css/style.css">
    <!-- import icons -->
    <script src="https://kit.fontawesome.com/021b758c3a.js" crossorigin="anonymous"></script>
    <title>Readers Chart</title>
    <!-- import library chart -->
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
    <center>
        <div class="wrapper">
        <h2>Total Books Loan by Month</h2>
        <br>
            <ul>
                <li style="list-style: none; margin-bottom: 30px;">
                    <div style="width: 800px; height: 500px;">
                        <h4><i class="fa-solid fa-chart-line"></i>  Line Chart</h4>
                        <canvas id="myChart"></canvas>
                    </div>
                </li>
                <br>
                <br>
                <li style="list-style: none; margin-top:10px;">
                    <div style="width: 800px; height: 500px;">
                        <h4><i class="fa-solid fa-chart-area"></i> Donut Chart</h4>
                        <canvas id="donutChart"></canvas>
                    </div>
                </li>
            </ul>
            <br>
            <br>
            <br>
            <br>
            <br>
            </div>
    </center>

        <script>
            var ctx = document.getElementById("myChart").getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: <?php echo json_encode($label); ?>,
                    datasets: [{
                        label: 'Book Loan Totals',
                        data: <?php echo json_encode($total_books); ?>,
                        borderWidth: 3
                    }]
                },
                options: {
                    scales : {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
            });

            var donut = document.getElementById("donutChart").getContext('2d');
            var donutChart = new Chart(donut, {
                type: 'doughnut',
                data: {
                    labels: <?php echo json_encode($label); ?>,
                    datasets: [{
                        label: 'Book Loan Totals',
                        data: <?php echo json_encode($total_books); ?>,
                        borderWidth: 3,
                        hoverOffset: 4,
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
                        'rgba(121, 113, 125, 0.7)',
                        'rgba(255, 0, 248, 0.7)'
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
                        'rgba(121, 113, 125, 1)',
                        'rgba(255, 0, 248, 1)'
                        ],
                    }]
                }
                
            });


        </script>
</body>
</html>