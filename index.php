<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Book Contacts</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.js"></script>

    <style type="text/css">
        .wrapper{
            width: 650px;
            margin: 0 auto;
        }
        .page-header h2{
            margin-top: 0;
        }
        table tr td:last-child a{
            margin-right: 15px;
        }
    </style>
    <script type="text/javascript">
        $(document).ready(function (){
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
</head>
<body>
<div class="wrapper">
    <div class="container-fluid">
        <div class="col-md-12">
            <h1>Van Contact</h1>
            <div class="pull-left">Contact Details</div>
            <a href="create.php" class="btn btn-success pull-right">Add New Contact</a>
        </div>
        <?php
        global $link;
        require_once 'config.php';
        $sql = "SELECT * FROM contact";
        if ($result = mysqli_query($link, $sql)) {
            if (mysqli_num_rows($result) > 0) {
                echo "<table class='table table bordered table-striped'>";
                echo "<thead>";
                echo "<tr>";
                echo "<th>#</th>";
                echo "<th>Name</th>";
                echo "<th>Phone Number</th>";
                echo "</tr>";
                echo "</thead>";
                echo "<tbody>";
                while ($row = mysqli_fetch_array($result)) {
                    echo "<tr>";
                    echo "<td>".$row['id']."</td>";
                    echo "<td>".$row['name']."</td>";
                    echo "<td>".$row['phone number']."</td>";
                    echo "<td>";
                    echo "<a href='read.php?id=".$row['id']."' title='View' data-toggle='tooltip'><span class='glyphicon glyphicon-eye-open'></span></a>";
                    echo "<a href='update.php?id=".$row['id']."' title='Update' data-toggle='tooltip'><span class='glyphicon glyphicon-pencil'></span></a>";
                    echo "<a href='delete.php?id=".$row['id']."' title='Delete' data-toggle='tooltip'><span class='glyphicon glyphicon-trash'></span></a>";
                    echo "</td>";
                    echo "</tr>";
                }
                echo "</tbody>";
                echo "</table>";
                mysqli_free_result($result);
            }else{
                echo "<p class='lead'> <em>No Record Were Found</em></p>";
            }
        } else{
            echo "ERROR : Could not able to execute $sql.".mysqli_error($link);
        } mysqli_close($link);
        ?>
    </div>
</div>
</body>
</html>