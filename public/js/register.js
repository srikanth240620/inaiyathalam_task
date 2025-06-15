const token = localStorage.getItem('token');
if (token) {
    window.location.href = '/home';
}

// Generate captcha numbers
const a = Math.floor(Math.random() * 9) + 1;
const b = Math.floor(Math.random() * 9) + 1;
document.getElementById('captcha-label').innerText = `What is ${a} + ${b}?`;
document.getElementById('captcha_result').value = a + b;

$('#registerForm').on('submit', function (e) {
    e.preventDefault();
    const formData = $(this).serialize();

    $.ajax({
        url: "/api/register",
        method: "POST",
        data: formData,
        success: function (data) {
            if (data.code == 200) {
                $('#register-success').removeClass('d-none').text(data.message);
                $('#registerForm')[0].reset();
                localStorage.setItem('token', data.token);

                if ($(".type").val() == 'admin') {
                    window.location.href = '/admin';
                } else {
                    window.location.href = '/home';

                }

            } else {
                $('#register-error').removeClass('d-none').text(data.message);
            }
        },
        error: function (xhr) {
            $('#register-success').addClass('d-none');
            let errorMsg = "Something went wrong!";
            $('#register-error').removeClass('d-none').text(errorMsg);
        }
    });
});