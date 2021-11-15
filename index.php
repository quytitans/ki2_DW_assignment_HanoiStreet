<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HaNoi's Streets</title>
    <link rel="stylesheet" href="./library/bootstrap.css">
    <link rel="stylesheet" href="./css/formStyle.css">
    <style>
        .topleft {
            position: absolute;
            top: 0;
            left: 16px;
        }

        .bottomleft {
            position: absolute;
            bottom: 0;
            left: 16px;
        }

        .middle {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
        }
        hr {
            margin: auto;
            width: 40%;
        }
    </style>
</head>
<body>
<div class="bg"></div>
<div class="bg bg2"></div>
<div class="bg bg3"></div>
<div class="container">
    <div class="bgimg">
        <div class="topleft">
            <p>Logo</p>
        </div>
        <div class="middle">
            <h1>WELCOM TO HANOI'S STREET INFO PAGE</h1>
            <hr>
            <p>slect you choice</p>
            <a href="/Ki2_DW_Assignment_DistrictName/list.php"><button class="btn btn-primary">View & Search Street Info</button></a>
            <a href="/Ki2_DW_Assignment_DistrictName/form.php"><button class="btn btn-primary">Add New Street</button></a>
        </div>
    </div>
</div>
<script src="./library/jquery-3.6.0.js"></script>
<script scr="./library/bootstrap.js"></script>
<script src="./js/form.js"></script>
</body>

</html>