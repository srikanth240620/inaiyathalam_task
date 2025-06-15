
const token = localStorage.getItem('token');
if (!token) {
    window.location.href = '/login';
}


$('#logoutBtn').on('click', function () {
    const token = localStorage.getItem('token');
    $.ajax({
        url: '/api/logout',
        type: 'POST',
        headers: {
            'Authorization': 'Bearer ' + token
        },
        success: function (response) {
            localStorage.removeItem('token');
            window.location.href = '/login';
        },
        error: function (xhr) {
            alert('Logout failed');
        }
    });
});



$(document).ready(function () {
    $(".user_view_profile").show();
    const token = localStorage.getItem('token');
    $.ajax({
        url: '/api/user',
        method: 'GET',
        headers: {
            'Authorization': 'Bearer ' + token
        },
        success: function (data) {
            if (data.code == 200) {
                $('#user-name').text(data.user.name);
                $('#user-email').text(data.user.email);
                $('#user-type').text(data.user.type);


                $('.user_name').val(data.user.name);
                $('.user_email').val(data.user.email);


                if (data.user.type == 'admin') {
                    $("#admin_page").show();

                }

            } else {
                //   window.location.href = '/login';
            }
        },
        error: function () {

            // window.location.href = '/login';
        }
    });
    $(".update_profile").click(function () {
        $(".user_view_profile").hide();
        $(".user_update_profile").show();

    });
    $(".view_profile").click(function () {
        $(".user_view_profile").show();
        $(".user_update_profile").hide();
    });


    $('#updateForm').submit(function (e) {
        e.preventDefault();
        var token = localStorage.getItem('token');
        const formData = $(this).serialize();

        $.ajax({
            url: '/api/user/profile/',
            method: 'PUT',
            headers: {
                'Authorization': 'Bearer ' + token,
            },
            data: formData,
            success: function (data) {
                if (data.code == 200) {
                    $('#update-success').removeClass('d-none').text(data.message);

                    var user = $('.user_name').val();
                    var email = $('.user_email').val();
                    $('#user-name').text(user);
                    $('#user-email').text(email);
                } else {
                    $('#update-error').removeClass('d-none').text(data.message);
                }
            },
            error: function (xhr) {
                // window.location.href = '/login';
            }
        });
    });

});