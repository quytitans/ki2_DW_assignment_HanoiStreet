<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HaNoi's Streets</title>
    <link rel="stylesheet" href="./library/bootstrap.css">
    <link rel="stylesheet" href="./css/formStyle.css">
</head>
<body>
<?php
//cau hinh db
$serverName = "localhost";
$userName = "root";
$password = "";
$dbName = "hanoistreet";
$conn = new mysqli($serverName, $userName, $password, $dbName);
//check connection
if ($conn->connect_errno) {
    die("Connection failed" . $conn->connect_error);
}
//tinh tong so record
$result = mysqli_query($conn, 'select count(id) as total from streets');
$row = mysqli_fetch_assoc($result);
$total_records = $row['total'];
//tim limit va current page
$current_page = isset($_GET['page']) ? $_GET['page'] : 1;
$limit = 5;
//tinh totalpage
$total_page = ceil($total_records / $limit);
// Giới hạn current_page trong khoảng 1 đến total_page
if ($current_page > $total_page) {
    $current_page = $total_page;
} else if ($current_page < 1) {
    $current_page = 1;
}
// Tìm Start
$start = ($current_page - 1) * $limit;
// Truy van lay danh sach items
$result = mysqli_query($conn, "SELECT * FROM streets LIMIT $start, $limit");
?>
<div class="bg"></div>
<div class="bg bg2"></div>
<div class="bg bg3"></div>
<div class="container">
    <div class="row mt-4">
        <div class="col-12">
            <h1 class="h1all">HaNoi's Streets</h1>
            <form action="" class="form-inline" name="searchForm1">
                <div class="form-group mb-2" id="district">
                    <!-- State Button -->
                    <select class="form-control" id="districtSearch" name="districtSearch">
                    </select>
                </div>
                <div class="form-group mx-sm-3 mb-2">
                    <input type="text" class="form-control" placeholder="enter keyword" name="keyword">
                </div>
                <button type="submit" name="btnSubmit" class="btn btn-primary mb-2">Search</button>
                <a href="/Ki2_DW_Assignment_DistrictName/demoPaginate.php">
                    <button type="button" name="btnReset" class="btn btn-dark mb-2 ml-2">Reset</button>
                </a>

                <a href="/Ki2_DW_Assignment_DistrictName/form.php">
                    <button type="button" name="btnSubmit" class="btn btn-default mb-2 ml-2">Add new street</button>
                </a>
            </form>
            <table class="table table-striped table-dark">
                <thead>
                <tr>
                    <th scope="col">Number</th>
                    <th scope="col">Name</th>
                    <th scope="col">Description</th>
                    <th scope="col">District</th>
                    <th scope="col">Using-Date</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
                </tr>
                </thead>
                <?php
                //show items list
                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<tr>' .
                        '<td>' . $row['id'] . '</td>
                                <td>' . $row['name'] . '</td>
                                <td>' . $row['desciption'] . '</td>
                                <td>' . $row['district'] . '</td>
                                <td>' . $row['usingDate'] . '</td>
                                <td>' . $row['status'] . '</td>
                                <td>Action updating ...</td>
                        </tr>';
                }
                ?>
            </table>
            <!--            PHAN TRANG START HERE-->
            <div class="pagination">
                <?php
                // nếu current_page > 1 và total_page > 1 mới hiển thị nút prev
                if ($current_page > 1 && $total_page > 1) {
                    echo '<a href="/Ki2_DW_Assignment_DistrictName/demoPaginate.php?page=' . ($current_page - 1) . '">Prev</a>';
                }
                // Lặp khoảng giữa
                for ($i = 1; $i <= $total_page; $i++) {
                    // Nếu là trang hiện tại thì hiển thị thẻ span
                    // ngược lại hiển thị thẻ a
                    if ($i == $current_page) {
                        echo '<span>' . $i . '</span>';
                    } else {
                        echo '<a href="/Ki2_DW_Assignment_DistrictName/demoPaginate.php?page=' . $i . '">' . $i . '</a>';
                    }
                }
                // nếu current_page < $total_page và total_page > 1 mới hiển thị nút prev
                if ($current_page < $total_page && $total_page > 1) {
                    echo '<a href="/Ki2_DW_Assignment_DistrictName/demoPaginate.php?page=' . ($current_page + 1) . '">Next</a>';
                }
                ?>
            </div>
            <!--            PHAN TRANG END HERE-->
        </div>
    </div>
</div>
<div>
</div>
<script src="./library/jquery-3.6.0.js"></script>
<script scr="./library/bootstrap.js"></script>
<script type="text/javascript"
        src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.13.1/jquery.validate.min.js"></script>
<script src="./js/form.js"></script>
<script>
    window.addEventListener('DOMContentLoaded', function () {
        $(window).on('load', function () {
            $.ajax({
                url: '/Ki2_DW_Assignment_DistrictName/API_php/getAllDistrict.php',
                method: 'POST',
                success: function (districts) {
                    var districtHTML = '';
                    districts.forEach(Element => {
                        districtHTML += `<option value="${Element.id}">${Element.name}</option>`
                    })
                    $("select[name=districtSearch]").html(districtHTML)
                }
            });
        })
    })
</script>
</body>
</html>