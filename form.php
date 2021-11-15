<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add new district</title>
    <link rel="stylesheet" href="./library/bootstrap.css">
    <link rel="stylesheet" href="./css/formStyle.css">
</head>

<body>
    <div class="bg"></div>
    <div class="bg bg2"></div>
    <div class="bg bg3"></div>
    <div class="content">
        <h1>Add new district</h1>
        <form class="mainForm" name="mainForm" id="mainForm">
            <div class="form-group">
                <!-- Full Name -->
                <label for="name" class="control-label">Street's Name</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Street's Name">
            </div>

            <div class="form-group">
                <label for="desciption" class="control-label">Desciption</label>
                <input type="text" class="form-control" id="desciption" name="desciption" placeholder="Desciption">
            </div>
            <div class="form-group">
                <label for="usingDate" class="control-label">Using Date</label>
                <input type="date" class="form-control" id="usingDate" name="usingDate" placeholder="Using Date">
            </div>
            <div class="form-group">
                <!-- State Button -->
                <label for="state_id" class="control-label">District</label>
                <select class="form-control" id="district" name="district">
                </select>
            </div>
            <div class="form-group">
                <!-- Zip Code-->
                <label for="zip_id" class="control-label">Status</label>
                <select class="form-control" id="status" name="status">
                    <option value="1" selected>Đang sử dụng</option>
                    <option value="2">Đang thi công</option>
                    <option value="3">Đang tu sửa</option>
                </select>
            </div>
            <div class="form-group">
                <!-- Submit Button -->
                <button type="submit" class="btn btn-success">Save</button>
                <a href="/Ki2_DW_Assignment_DistrictName/index.php"><button type="button" class="btn btn-default">Home</button></a>
                <a href="/Ki2_DW_Assignment_DistrictName/list.php"><button type="button" class="btn btn-default">View All Streets</button></a>
            </div>
        </form>
    </div>
    <script src="./library/jquery-3.6.0.js"></script>
    <script scr="./library/bootstrap.js"></script>
    <script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.13.1/jquery.validate.min.js"></script>
    <script src="./js/form.js"></script>
    <script>
        window.addEventListener('DOMContentLoaded', function() {
            const name = $('input[name=name]');
            const desciption = $('input[name=desciption]');
            const usingDate = $('input[name=usingDate]');
            const district = $('select[name=district]');
            const status = $('select[name=status]');
            //lay danh sach quan
            $(window).on('load', function() {
                $.ajax({
                    url: '/Ki2_DW_Assignment_DistrictName/API_php/getAllDistrict.php',
                    method: 'POST',
                    success: function(districts) {
                        var districtHTML = '';
                        districts.forEach(Element => {
                            districtHTML += `<option value="${Element.id}">${Element.name}</option>`
                        })
                        $("select[name=district]").html(districtHTML)
                    }
                })
            })
            //xu ly nut submit
            $('form[name=mainForm]').submit(function(e) {
                e.preventDefault();
                let data = {
                    name: name.val(),
                    desciption: desciption.val(),
                    usingDate: usingDate.val(),
                    district: district.val(),
                    status: status.val()
                }
                if (name.val() != '' && desciption.val() != '' && usingDate.val() != '' && district.val() != '' && status.val() != '') {
                    $.ajax({
                        url: '/Ki2_DW_Assignment_DistrictName/API_php/addNewStreet.php',
                        method: 'POST',
                        data: JSON.stringify(data),
                        success: function() {
                            alert("save successs !!!");
                            window.location.href = '/Ki2_DW_Assignment_DistrictName/list.php';
                        },
                        error: function() {
                            alert("save fail !!!");
                        }
                    })
                }

            })
        })
    </script>
</body>

</html>