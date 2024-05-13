// enable datatable plugins
$('.TableData').DataTable({
    autoWidth: true,
});

// add user open modal
$('#add_user').on('click', () => {
    $('#new_userModal').modal('show');
});

// save user
$('#btnAdd').on('click', () => {
    const firstname = $('#firstname').val();
    const middle_name = $('#middle_name').val();
    const lastname = $('#lastname').val();
    const email = $('#email').val();
    const username = $('#username').val();
    const password = $('#password').val();
    const cnum = $('#cnum').val();
    const role = $('#role option:selected').val();

    const mydata = `firstname=${firstname}&middle_name=${middle_name}&lastname=${lastname}&email=${email}&username=${username}&password=${password}&cnum=${cnum}&role=${role}`;
    //  alert(mydata)
    if (firstname != '' && lastname != '' && email != '' && username != '' && password != '' && role != '') {
        $.ajax({
            type: 'POST',
            url: '../../controller/registerAdd.php',
            data: mydata,
            success: function (res) {
                if (res > 0) { //if result is 1
                    toastr.success('Successfully Added');
                    $('#new_userModal').modal('hide');
                    setTimeout(() => {
                        location.reload(true); //relaod page
                    }, 2000)
                }
            }
        })
    } else {
        toastr.error(`Do not skip require fields.`)
    }
})
//edit user
$(document).on('click', '.edit', function () {
    var id = $(this).attr('value');

    $.ajax({
        type: 'POST',
        url: '../../controller/edit_user.php',
        data: {
            id: id
        },

        success: function (html) {
            $('#edit_userModal').modal('show');
            $('#edit_body').html(html);
        }
    })
});
//udpate user
$('#btnUpdate').on('click', () => {
    const upd_id = $('#upd_id').val();
    const upd_fname = $('#upd_fname').val();
    const upd_mname = $('#upd_mname').val();
    const upd_lname = $('#upd_lname').val();
    const upd_email = $('#upd_email').val();
    const upd_uname = $('#upd_uname').val();
    const upd_cnum = $('#upd_cnum').val();
    const upd_role = $('#upd_role option:selected').val();

    const mydata = `id=${upd_id}&upd_firstname=${upd_fname}&upd_middle_name=${upd_mname}&upd_lastname=${upd_lname}&upd_email=${upd_email}&upd_username=${upd_uname}&upd_contact_no=${upd_cnum}&role=${upd_role}`;

    $.ajax({
        type: 'POST',
        url: '../../controller/update_account.php?module=without_pass',
        data: mydata,
        success: function (res) {
            if (res > 0) {
                toastr.success('Users successfully updated');
                setTimeout(() => {
                    window.location = "manage_user.php";
                }, 2000)
            }
        }
    })
})
//remove user
$(document).on('click', '.remove', function () {
    var id = $(this).attr('value'); //id of clicked button user
    Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!"
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: 'POST',
                url: '../../controller/remove_user.php',
                data: {
                    id: id
                },
                success: function (res) {
                    if (res > 0) {
                        Swal.fire({
                            title: "Deleted!",
                            text: "Your file has been deleted.",
                            icon: "success"
                        });
                        setTimeout(() => {
                            window.location = "manage_user.php";
                        }, 2000)
                    }

                }
            })

        }
    });
});