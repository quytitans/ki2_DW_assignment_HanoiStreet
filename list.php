<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HaNoi's Streets</title>
    <link rel="stylesheet" href="./library/bootstrap.css">
    <link rel="stylesheet" href="./css/formStyle.css">
</head>

<body>
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
                <button type="button" name="btnReset" class="btn btn-dark mb-2 ml-2">Reset</button>
                <a href="/Ki2_DW_Assignment_DistrictName/form.php">
                    <button type="button" name="btnSubmit" class="btn btn-default mb-2 ml-2">Add new street</button>
                </a>
                <a href="/Ki2_DW_Assignment_DistrictName/index.php">
                    <button type="button" name="btnSubmit" class="btn btn-default mb-2 ml-2">Home Page</button>
                </a>
            </form>
            <table class="table table-striped table-dark">
            </table>
        </div>
    </div>
</div>
<script src="./library/jquery-3.6.0.js"></script>
<script scr="./library/bootstrap.js"></script>
<script type="text/javascript"
        src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.13.1/jquery.validate.min.js"></script>
<script src="./js/form.js"></script>
<script>
    window.addEventListener("DOMContentLoaded", function () {
        const keyword = $('input[name=keyword]');
        const district = $('#districtSearch');
        //lay thong khi sau khi window load page
        $(window).on('load', function () {
            $.ajax({
                url: '/Ki2_DW_Assignment_DistrictName/API_php/getAllDistrict.php',
                method: 'POST',
                success: function (districts) {
                    var districtHTML = '<option value="" selected>---select---</option>';
                    districts.forEach(Element => {
                        districtHTML += `<option value="${Element.id}">${Element.name}</option>`
                    })
                    $("select[name=districtSearch]").html(districtHTML)
                }
            });

            getStreet();
        })
        //btn reset page
        $('button[name=btnReset]').on('click', function () {
            getStreet();
        })
        //xu ly bo loc
        $('form[name=searchForm1]').submit(function (event) {
            event.preventDefault();
            let data = {
                keyword: keyword.val(),
                district: district.val(),
            };
            console.log(data);
            $.ajax({
                url: '/Ki2_DW_Assignment_DistrictName/API_php/search.php',
                method: 'POST',
                data: JSON.stringify(data),
                success: function (streets) {
                    $('table').html(renderTable(streets));
                },
                error: function () {
                    alert('search fail, please try again');
                }
            })
        });

        //loc theo quan on change
        $('#districtSearch').change(function () {
            let data = {
                keyword: keyword.val(),
                district: district.val(),
            };
            console.log(data);
            $.ajax({
                url: '/Ki2_DW_Assignment_DistrictName/API_php/search.php',
                method: 'POST',
                data: JSON.stringify(data),
                success: function (streets) {
                    $('table').html(renderTable(streets));
                },
                error: function () {
                    alert('search fail, please try again');
                }
            })
        })

        //function
        function renderTable(Elements) {
            var contentHTML =
                `<thead>
                            <tr>
                                <th scope="col">Number</th>
                                <th scope="col">Name</th>
                                <th scope="col">Description</th>
                                <th scope="col">District</th>
                                <th scope="col">Using-Date</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>`;
            Elements.forEach(Element => {
                let strStatus = "";
                if (Element.status == 1) {
                    strStatus = "Đang sử dụng";
                }
                if (Element.status == 2) {
                    strStatus = "Đang sửa chữa";
                }
                if (Element.status == 3) {
                    strStatus = "Đang thi công";
                }
                contentHTML +=
                    `<tr>
                                <td>${Element.id}</td>
                                <td>${Element.name}</td>
                                <td>${Element.desciption}</td>
                                <td>${Element.district}</td>
                                <td>${Element.usingDate}</td>
                                <td>${strStatus}</td>
                                <td>
                                    <a href='/Ki2_DW_Assignment_DistrictName/detail.php?id=${Element.id}'>Detail</a>
                                    <a href='/Ki2_DW_Assignment_DistrictName/edit.php?id=${Element.id}'>Edit</a>
                                    <a href='/Ki2_DW_Assignment_DistrictName/delete.php?id=${Element.id}'>Delete</a>
                                </td>
                            </tr>`
            })
            return contentHTML;
        }

        function getStreet() {
            $.ajax({
                url: '/Ki2_DW_Assignment_DistrictName/API_php/getAllStreet.php',
                method: 'POST',
                success: function (streets) {
                    $('table').html(renderTable(streets));
                }
            });
        }
    })
</script>
</body>

</html>