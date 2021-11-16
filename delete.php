<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete</title>
    <link rel="stylesheet" href="./library/bootstrap.css">
    <link rel="stylesheet" href="./css/formStyle.css">
</head>
<body>
    <div class="bg"></div>
    <div class="bg bg2"></div>
    <div class="bg bg3"></div>
    <div class="content">
        <h1 class="text-danger font-weight-bold">Are you sure you want to delete?</h1>
        <form class="mainForm" name="mainForm" id="mainForm">
            <div class="form-group">
                <!-- Full Name -->
                <label for="name" class="control-label">Street's Name</label>
                <h2 id="h2Name"></h2>
            </div>

            <div class="form-group">
                <label for="desciption" class="control-label">Desciption</label>
                <h2 id="h2Description"></h2>
            </div>
            <div class="form-group">
                <label for="usingDate" class="control-label">Using Date</label>
                <h2 id="h2Date"></h2>
            </div>
            <div class="form-group">
                <!-- State Button -->
                <label for="state_id" class="control-label">District</label>
                <h2 id="h2District"></h2>
            </div>
            <div class="form-group">
                <!-- Zip Code-->
                <label for="zip_id" class="control-label">Status</label>
                <h2 id="h2Status"></h2>
            </div>
            <div class="form-group">
                <!-- Submit Button -->
                <a href="/Ki2_DW_Assignment_DistrictName/list.php"><button type="button" class="btn btn-danger " id="btnComfirm">Confirm Delete</button></a>
                <a href="/Ki2_DW_Assignment_DistrictName/list.php"><button type="button" class="btn btn-primary " id="">Cancel</button></a>
            </div>
        </form>
    </div>
    <script src="./library/jquery-3.6.0.js"></script>
    <script scr="./library/bootstrap.js"></script>
    <script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.13.1/jquery.validate.min.js"></script>
    <script src="./js/form.js"></script>
    <script>
        window.addEventListener('DOMContentLoaded', function() {
            const id = getParameterByName('id');
            $(window).on('load', function() {
                let data ={
                    id:id
                }
                $.ajax({
                    url: '/Ki2_DW_Assignment_DistrictName/API_php/findByID.php',
                    method: 'POST',
                    data:JSON.stringify(data),
                    success: function(streets) {
                        $('#h2Name').text(streets[0].name);
                        $('#h2Description').text(streets[0].desciption);
                        $('#h2Date').text(streets[0].usingDate);
                        $('#h2District').text(convertDistrictName(streets[0].district));
                        $('#h2Status').text(convertStatus(streets[0].status));
                    }
                });
            })
            //confirm to delete
            $('#btnComfirm').click(function (){
                let data ={
                    id:id
                }
                $.ajax({
                    url: '/Ki2_DW_Assignment_DistrictName/API_php/deleteByID.php',
                    method: 'POST',
                    data:JSON.stringify(data),
                    success: function(response) {
                        alert(response.message);
                    }
                });
            })
            //lay thong tin tu url
            function getParameterByName(name, url = window.location.href) {
                name = name.replace(/[\[\]]/g, '\\$&');
                var regex = new RegExp('[?&]' + name + '(=([^&#]*)|&|#|$)'),
                    results = regex.exec(url);
                if (!results) return null;
                if (!results[2]) return '';
                return decodeURIComponent(results[2].replace(/\+/g, ' '));
            }

            //ham chuyen doi
            function convertStatus(status){
                var strStatus = "";
                if(status == 1){
                    strStatus = "Đang sử dụng";
                }
                if(status == 2){
                    strStatus = "Đang sửa chữa";
                }
                if(status == 3){
                    strStatus = "Đang thi công";
                }
                return strStatus;
            }

            function convertDistrictName(id){
                let data ={
                    id:id

                }
                console.log(data)
                $.ajax({
                    url: '/Ki2_DW_Assignment_DistrictName/API_php/findDistrictByID.php',
                    method: 'POST',
                    data:JSON.stringify(data),
                    success: function(items) {
                        $('#h2District').text(items[0].name);
                    }
                });
            }
        })
    </script>
</body>
</html>