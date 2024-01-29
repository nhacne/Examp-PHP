<?php
global $link;
require_once 'config.php';

$name = $phone= "";
$name_err = $phone_err= "";

if(isset($_POST["id"])&& !empty($_POST["id"])){

    $id = $_POST["id"];

    $input_name = trim($_POST["name"]);
    if (empty($input_name)){
        $name_err = "Please enter a name.";
    }elseif (!filter_var(trim($_POST["name"]), FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z'.\s ]+$/")))){
        $name_err = 'Please enter a valid name';
    } else{
        $name=$input_name;
    }

    $input_phone = trim($_POST["phone number"]);
    if (empty($input_phone)){
        $phone_err = "Please enter your phone number";
    } else{
        $phone = $input_phone;
    }

    if (empty($name_err) && empty($phone_err)){
        $sql = "UPDATE contact SET `name`=?, `phone number`=? WHERE id=?";

        if ($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt,"sssi",$param_name, $param_phone, $param_id);

            $param_name=$name;
            $param_phone = $phone;
            $param_id = $id;

            if (mysqli_stmt_execute($stmt)){
                header("location:index.php");
                exit();
            }else{
                echo "Something went Wrong. Please try again later";
            }
        }

        mysqli_stmt_close($stmt);
    }
    mysqli_close($link);
} else{
    if (isset($_GET["id"])&& !empty(trim($_GET["id"]))){
        $id = trim($_GET["id"]);

        $sql = "SELECT * FROM contact WHERE id = ?";
        if ($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt, "i", $param_id);
            $param_id= $id;
            if (mysqli_stmt_execute($stmt)){
                $result = mysqli_stmt_get_result($stmt);

                if (mysqli_num_rows($result) ==1){
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                    $name = $row["name"];
                    $phone = $row["phone number"];
                } else{
                    header("location: error.php");
                    exit();
                }
            }else{
                echo "Oops!! Something went wrong, try again later.";
            }
        }
        mysqli_stmt_close($stmt);
        mysqli_close($link);
    }else{
        header("location : error.php");
        exit();
    }
}
?>
<!DOCTYPE  html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        .wrapper{
            width: 500px;
            margin: 0 auto;
        }
    </style>

</head>
<body>
<div class="wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="page-header">
                    <h2>Update Record</h2>
                </div>
                <p>Please edit the input values and submit to update the record</p>
                <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI']));?>" method="post">
                    <div class="form-group <?php echo (!empty($name_err)) ? 'has-error' : ''; ?>">
                        <label>Name</label>
                        <label>
                            <input type="text" name="name" class="form-control" value="<?php echo $name; ?>">
                        </label>
                        <span class="help-block"><?php echo $name_err?></span>
                    </div>
                    <div class="form-group <?php echo (!empty($phone_err))? 'has-error' : '';?>">
                        <label>Phone Number</label>
                        <label>
                            <textarea name="phone number" class="form-control"><?php echo $phone;?></textarea>
                        </label>
                        <span class="help-block"><?php echo $phone_err;?></span>
                    </div>
                    <input type="hidden" name="id" value="<?php echo $id;?>"/>
                    <input type="submit" class="btn btn-primary" value="Submit">
                    <a href="index.php" class="btn btn-default">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>