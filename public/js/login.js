const token = localStorage.getItem('token');
if (token) {
    window.location.href = '/home';
}

const a = Math.floor(Math.random() * 9) + 1;
const b = Math.floor(Math.random() * 9) + 1;
document.getElementById('captcha-label').innerText = `What is ${a} + ${b}?`;
document.getElementById('captcha_result').value = a + b;


$('#loginForm').on('submit', function (e) {
    e.preventDefault();
    const formData = $(this).serialize();

    $.ajax({
        url: "/api/login",
        method: "POST",
        data: formData,
        success: function (data) {
            if (data.code == 200) {
                $('#login-success').removeClass('d-none').text(data.message);
                $('#loginForm')[0].reset();
                localStorage.setItem('token', data.token);

                if (data.type == 'admin') {
                    window.location.href = '/admin';
                } else {
                    window.location.href = '/home';
                }

            } else {
                $('#login-error').removeClass('d-none').text(data.message);
            }
        },
        error: function (xhr) {
            $('#login-success').addClass('d-none');
            let errorMsg = "Something went wrong!";
            $('#login-error').removeClass('d-none').text(errorMsg);
        }
    });
});