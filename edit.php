<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Information</title>
    <link rel="stylesheet" href="./library/bootstrap.css">
    <link rel="stylesheet" href="./css/formStyle.css">
</head>
<body>
<?php
//cau hinh db
$id = $_GET['id'];
$serverName = "localhost";
$userName = "root";
$password = "";
$dbName = "hanoistreet";
//tao ket noi
$conn = new mysqli($serverName, $userName, $password, $dbName);
//check connection
if ($conn->connect_errno) {
    die("Connection failed" . $conn->connect_error);
}
//make query
$query = "SELECT * FROM streets WHERE id =" . $id;
$result = $conn->query($query);
$rows = array();
$r = $result->fetch_assoc();
?>
<div class="bg"></div>
<div class="bg bg2"></div>
<div class="bg bg3"></div>
<div class="content">
    <h1>Edit Information</h1>
    <form class="mainForm" name="mainForm1" id="mainForm1">
        <div class="form-group">
            <!-- Full Name -->
            <label for="name" class="control-label">Street's Name</label>
            <input type="text" class="form-control" id="name" name="name" value="<?php echo $r["name"] ?>">
        </div>

        <div class="form-group">
            <label for="desciption" class="control-label">Desciption</label>
            <input type="text" class="form-control" id="desciption" name="desciption"
                   value="<?php echo $r["desciption"] ?>">
        </div>
        <div class="form-group">
            <label for="usingDate" class="control-label">Using Date</label>
            <input type="date" class="form-control" id="usingDate" name="usingDate"
                   value="<?php echo $r["usingDate"] ?>">
        </div>
        <div class="form-group">
            <!-- State Button -->
            <label for="state_id" class="control-label">District</label>
            <select class="form-control" id="district" name="district">
                <?php
                $query2 = "SELECT * FROM districts";
                $result2 = $conn->query($query2);
                while ($r2 = $result2->fetch_assoc()) {
                    if ($r2["id"] == $r["district"]) {
                        echo "<option value=" . $r2["id"] . " selected>" . $r2["name"] . "</option>";
                    } else {
                        echo "<option value=" . $r2["id"] . ">" . $r2["name"] . "</option>";
                    }
                }
                ?>
            </select>
        </div>
        <div class="form-group">
            <label for="zip_id" class="control-label">Status</label>
            <select class="form-control" id="status" name="status">
                <?php
                for ($x = 1; $x <= 3; $x++) {
                    if ($r["status"] == $x) {
                        echo "<option value=" . $x . " selected>" . convert($x) . "</option>";
                    } else {
                        echo "<option value=" . $x . ">" . convert($x) . "</option>";
                    }
                }
                function convert($y)
                {
                    if ($y == 1) {
                        return "Đang sử dụng";
                    }
                    if ($y == 2) {
                        return "Đang thi công";
                    }
                    if ($y == 3) {
                        return "Đang tu sửa";
                    }
                }

                ?>
            </select>
        </div>
        <div class="form-group">
            <!-- Submit Button -->
            <button type="submit" class="btn btn-success">Update</button>
            <a href="/Ki2_DW_Assignment_DistrictName/list.php">
                <button type="button" class="btn btn-primary">Cancel</button>
            </a>
        </div>
    </form>
</div>
<script src="./library/jquery-3.6.0.js"></script>
<script scr="./library/bootstrap.js"></script>
<script type="text/javascript"
        src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.13.1/jquery.validate.min.js"></script>
<script src="./js/form.js"></script>
<script>
    window.addEventListener('DOMContentLoaded', function () {
        const name = $('input[name=name]');
        const desciption = $('input[name=desciption]');
        const usingDate = $('input[name=usingDate]');
        const district = $('select[name=district]');
        const status = $('select[name=status]');
        $("#mainForm1").submit(function(e) {
            e.preventDefault();
            let data = {
                id:'<?php echo $r["id"] ?>',
                name: name.val(),
                desciption: desciption.val(),
                usingDate: usingDate.val(),
                district: district.val(),
                status: status.val()
            }
            if (name.val() != '' && desciption.val() != '' && usingDate.val() != '' && district.val() != '' && status.val() != '') {
                $.ajax({
                    url: '/Ki2_DW_Assignment_DistrictName/API_php/update.php',
                    method: 'POST',
                    data: JSON.stringify(data),

                    success: function() {
                        alert("update successs !!!");
                        window.location.href = '/Ki2_DW_Assignment_DistrictName/list.php';
                    },
                    error: function() {
                        alert("save fail !!!");
                    }
                })
                console.log(data);
            }

        })
    })
</script>
</body>

</html>