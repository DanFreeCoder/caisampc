// enable datatable plugins
$('table').DataTable({
    'autoWidth': true
});

$('#edit_info').on('click', () => {
    $('#update_info').attr('hidden', false);
    $('.inputs').attr('disabled', false)
    $('#edit_info').hide()
});

// update account details
$('#update_info').on('click', () => {
    const id = $('#upd-id').val();
    const firstname = $('#upd-firstname').val();
    const middle_name = $('#upd-middle_name').val();
    const lastname = $('#upd-lastname').val();
    // const email = $('#upd-email').val();
    const username = $('#upd-username').val();
    const password = $('#upd-password').val();
    const contact_no = $('#upd-contact_num').val();
    const role = 2;

    var file_data = $('#upload').prop('files')[0];
    var form_data = new FormData();
    form_data.append('files', file_data);

    const mydata = `id=${id}&upd_firstname=${firstname}&upd_middle_name=${middle_name}&upd_lastname=${lastname}&upd_username=${username}&upd_password=${password}&upd_contact_no=${contact_no}&role=${role}`;
    if (file_data) {
        //this is to check if the image already exist        
        $.ajax({
            type: "POST",
            url: "../../controller/check_image.php",
            data: form_data,
            contentType: false,
            cache: false,
            processData: false,

            success: function (response) {
                if (response > 0) {
                    toastr.error('image already exist');
                } else {
                    //if image does not exist proceed for saving
                    if (password == "" || password == null) { //if without password 
                        $.ajax({
                            type: 'POST',
                            url: '../../controller/update_account.php?module=without_pass',
                            data: mydata,
                            success: function (res) {
                                //  alert('withoutpass')
                                if (res > 0) {
                                    //upload the image after saving the details 
                                    $.ajax({
                                        type: 'POST',
                                        url: `../../controller/upload.php?id=${id}`,
                                        data: form_data,
                                        contentType: false,
                                        cache: false,
                                        processData: false,
                                        success: function (res) {
                                            if (res > 0) {
                                                toastr.success('Account Successfully Updated!');
                                                setTimeout(() => {
                                                    location.reload(true)
                                                }, 2000)
                                            }
                                        }
                                    })
                                } else {
                                    toastr.error('ERROR! Please contact the system administrator')
                                }
                            }
                        });
                    } else { // if input the password
                        $.ajax({
                            type: 'POST',
                            url: '../../controller/update_account.php?module=with_pass',
                            data: mydata,
                            success: function (res) {
                                if (res > 0) {
                                    //upload the image after saving the details 
                                    $.ajax({
                                        type: 'POST',
                                        url: `../../controller/upload.php?id=${id}`,
                                        data: form_data,
                                        contentType: false,
                                        cache: false,
                                        processData: false,
                                        success: function (res) {
                                            if (res > 0) {
                                                toastr.success('Account Successfully Updated!');
                                                setTimeout(() => {
                                                    location.reload(true)
                                                }, 2000)
                                            }
                                        }
                                    })

                                }
                            }
                        });
                    }
                }
            }
        })
    } else { //update profile information without image attachment
        if (password == "" || password == null) { //if without password 
            $.ajax({
                type: 'POST',
                url: '../../controller/update_account.php?module=without_pass',
                data: mydata,
                success: function (res) {
                    if (res > 0) toastr.success('Account Successfully Updated!');
                    setTimeout(() => {
                        location.reload(true)
                    }, 2000)
                }
            });
        } else { // if input the password
            $.ajax({
                type: 'POST',
                url: '../../controller/update_account.php?module=with_pass',
                data: mydata,
                success: function (res) {
                    if (res > 0) toastr.success('Account Successfully Updated!');
                    setTimeout(() => {
                        location.reload(true)
                    }, 2000)
                }
            });
        }
    }
});