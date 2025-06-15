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

    const token = localStorage.getItem('token');
    $.ajax({
        url: '/api/user',
        method: 'GET',
        headers: {
            'Authorization': 'Bearer ' + token
        },
        success: function (data) {
            if (data.code == 200 && data.user.type != 'admin') {
                window.location.href = '/home';


            }
        },
        error: function () {

            window.location.href = '/login';
        }
    });


    $('#example tbody').on('click', '.edit-btn', function () {

        var rowIndex = $(this).data('row');
        var rowData = table.row(rowIndex).data();

        $(".edit_id").val(rowData.id);
        $(".user_name").val(rowData.name);
        $(".user_email").val(rowData.email);
        $(".user_type").val(rowData.type);
        $('.password').removeAttr('required');
        $("#EditModalLabel").text('Update User');
        $("#EditModal").modal('show');



    });


    $('#updateForm').submit(function (e) {
        e.preventDefault();
        var token = localStorage.getItem('token');
        const formData = $(this).serialize();
        const editId = $(".edit_id").val();
        let url_val = '/api/admin/user';
        let method = 'POST';

        if (editId > 0) {
            url_val += '/' + editId;
            method = 'PUT';
        }

        $.ajax({
            url: url_val,
            method: method,
            headers: {
                'Authorization': 'Bearer ' + token,
            },
            data: formData,
            success: function (data) {
                if (data.code == 200) {
                    $('#update-success').removeClass('d-none').text(data.message);
                    $("#EditModal").modal('hide');
                    table.ajax.reload(null, false);

                } else {
                    $('#update-error').removeClass('d-none').text(data.message);
                    $("#EditModal").modal('hide');

                }
            },
            error: function (xhr) {
                window.location.href = '/home';
            }
        });
    });

    $('#example tbody').on('click', '.delete-btn', function () {

        var rowIndex = $(this).data('row');
        var rowData = table.row(rowIndex).data();
        $('input[name="_method"]').val('PUT');
        $(".delete_id").val(rowData.id);
        $("#DeleteModal").modal('show');
    });



    $('#deleteForm').submit(function (e) {
        e.preventDefault();
        var token = localStorage.getItem('token');
        // const formData = $(this).serialize();
        const delete_id = $(".delete_id").val();


        $.ajax({
            url: '/api/admin/user/' + delete_id,
            method: 'DELETE',
            headers: {
                'Authorization': 'Bearer ' + token,
            },
            success: function (data) {
                if (data.code == 200) {
                    $('#update-success').removeClass('d-none').text(data.message);
                    $("#DeleteModal").modal('hide');
                    table.ajax.reload(null, false);

                } else {
                    $('#update-error').removeClass('d-none').text(data.message);
                    $("#DeleteModal").modal('hide');

                }
            },
            error: function (xhr) {
                window.location.href = '/home';
            }
        });
    });





});


var table = $('#example').DataTable({
    processing: true,
    serverSide: true,
    ajax: {
        url: '/api/admin/user',
        headers: {
            'Authorization': 'Bearer ' + localStorage.getItem('token'),
        }
    },
    columns: [
        {
            data: null,
            render: function (data, type, row, meta) {
                return meta.row + meta.settings._iDisplayStart + 1;
            },
            name: 'id',
        },
        { data: 'name', name: 'name' },
        { data: 'email', name: 'email' },
        { data: 'type', name: 'type' },
        {
            data: null,
            render: function (data, type, row, meta) {

                return '<button type="button" class="edit-btn btn btn-sm btn-success mr-2" data-row="' + meta.row + '">Edit</button><button type="button" class="delete-btn btn btn-sm btn-danger" data-row="' + meta.row + '">Delete</button>';
            },
            orderable: false,
            searchable: false,
        }
    ],
    pageLength: 10,
});


function create() {
    $("#EditModal").modal('show');
    $("#EditModalLabel").text('Create User');
    $('.password').attr('required', true);
    $('input[name="_method"]').val('POST');
    $(".edit_id").val('');
    $('#updateForm')[0].reset();


}
