$(document).ready(function () {
    $("#contact-form-form").validate({
        rules: {
            customer_name: "required",
            customer_email: {
                required: true,
                email: true
            },
            customer_phone: "required",
            customer_message: "required"
        },
        submitHandler: function (form) {
            form.submit();
        }
    });
});