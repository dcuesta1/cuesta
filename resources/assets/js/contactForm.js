$(function () {
    $("#contactForm").validate({
        rules: {
            senderName: "required",
            message: "required",
            senderPhone: "required",
            senderEmail: {
                required: true,
                email: true
            }
        },

        messages: {
            firstname: "Please enter your firstname",
            lastname: "Please enter your lastname",
            password: {
                required: "Please provide a password",
                minlength: "Your password must be at least 5 characters long"
            },
            email: "Please enter a valid email address"
        },
        submitHandler: function (form) {
            form.submit();
        }
    });
});