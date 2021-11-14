window.addEventListener('DOMContentLoaded', (event) => {

    $("#mainForm").validate({
        rules: {
            name: {
                required: true,
                maxlength: 50
            },
            desciption: "required",
            usingDate: "required",
            district: "required",
            status: "required",
            desciption: {
                required: true,
                minlength: 2
            }
        }
    });
    
    });