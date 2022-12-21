<?php
    if(isset($_POST["id_reader"]) && !empty($_POST["id_reader"])){

        require_once "../../config/config.php";

        $sql = "DELETE FROM readers WHERE id_reader = ?";

        if($stmt = mysqli_prepare($conn, $sql)){
            mysqli_stmt_bind_param($stmt, "i", $param_id_reader);

            $param_id_reader = trim($_POST["id_reader"]);

            if(mysqli_stmt_execute($stmt)){
                header("location: readers.php");
                exit();
            } else {
                echo "Oops! SOmething went wrong. Please try again later.";
            }
        }

        mysqli_stmt_close($stmt);

        mysqli_close($conn);
    } else {
        if(empty(trim($_GET["id_reader"]))){
            header("location: error.php");
            exit();
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Borrowers Data</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        .wrapper{
            width: 800px;
            margin: 0 auto;
        }
    </style>
</head>

<head>

<body>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <center>
                    <div class="page-header">
                        <h1>Delete Borrower's Data</h1>
                    </div>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="alert alert-danger fade in">
                            <input type="hidden" name="id_reader" value="<?php echo trim($_GET["id_reader"]); ?>"/>
                            <p>Are you sure want to delete this data?</p></br>
                            <p>
                                <a href="readers.php" class="btn btn-danger">No</a>
                                <input type="submit" value="Yes" class="btn btn-success">
                            </p>
                        </div>
                    </form>
                    </center>
                </div>
            </div>
        </div>
    </div>
</body>
</html>