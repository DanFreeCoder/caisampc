
$(document).ready(() => {
    $('[data-toggle="tooltip"]').tooltip({
        html: true
    });
    $('#imagePreview').attr('hidden', true)
    $('.select2').select2();
    $('.picture').on('click', () => {
        $('#upload').click();
    });

    $('#description').on('input', () => {
        var desc = $('#description').val();
        if (desc.length > 0) {
            $('#post').prop('disabled', false)
        } else {
            $('#post').prop('disabled', true)
        }
    });

});

//preview image before upload
function previewImage() {
    var imageInput = document.getElementById('upload');
    var imagePreview = document.getElementById('imagePreview');
    if (imageInput.files && imageInput.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#imagePreview').attr('hidden', false)
            imagePreview.src = e.target.result;
            $('#post').prop('disabled', false)
        };

        reader.readAsDataURL(imageInput.files[0]);
    } else {
        imagePreview.src = '';
        $('#post').prop('disabled', true)
    }
}

// enable button


// post
$('#post').on('click', (e) => {
    e.preventDefault();
    var checked = $('#annoucement').is(':checked');
    var user_to = [];
    var user_id = $('#session_id').val();
    var desc = $('#description').val();
    var type = (checked) ? 1 : 2;//1 announcement: 2 distribute

    $('.to :selected').each(function () {
        user_to.push($(this).val());
    });


    var file_data = $('#upload').prop('files')[0];
    var form_data = new FormData();
    form_data.append('files', file_data);
    var mydata = `user_id=${user_id}&desc=${desc}&type=${type}`;

    if (user_to.includes('All')) {//check if all option is selected
        if (file_data) {
            //this is to check if the image already exist
            $.ajax({
                type: 'POST',
                url: '../../controller/check_img_distribute.php',
                data: form_data,
                contentType: false,
                cache: true,
                processData: false,
                success: function (res) {
                    if (res > 0) {
                        alert('image already exist');
                    } else {
                        $.ajax({
                            type: 'POST',
                            url: `../../controller/distribute_all.php`,
                            data: mydata,
                            beforeSend: function () {
                                ShowToast('Saving')
                            },
                            success: function (data) {
                                var id = data;
                                // upload image after distribute details
                                $.ajax({
                                    type: 'POST',
                                    url: `../../controller/distribute_img.php?id=${id}`,//id of last distributed
                                    data: form_data,
                                    contentType: false,
                                    cache: true,
                                    processData: false,
                                    success: function (res) {
                                        if (res > 0) {
                                            toastr.success("Successfully Distributed.")
                                        }
                                    }
                                })
                                setTimeout(() => {
                                    location.reload(true); //relaod page
                                }, 2000)
                            }
                        })
                    }
                }
            })
        } else { // no picture
            $.ajax({
                type: 'POST',
                url: `../../controller/distribute_all.php`,
                dataType: 'json',
                data: mydata,
                beforeSend: function () {
                    ShowToast('Saving')
                },
                success: function (data) {
                    console.log(data)
                    toastr.success("Successfully Distributed.")
                    setTimeout(() => {
                        location.reload(true); //relaod page
                    }, 2000)
                }
            })
        }
    } else {
        if (user_to.length > 0) { // make sure that the user is selected
            if (file_data) {
                //this is to check if the image already exist
                $.ajax({
                    type: 'POST',
                    url: '../../controller/check_img_distribute.php',
                    data: form_data,
                    contentType: false,
                    cache: true,
                    processData: false,
                    success: function (res) {
                        if (res > 0) {
                            alert('image already exist');
                        } else {
                            $.ajax({
                                type: 'POST',
                                url: `../../controller/distribute.php`,
                                data: mydata,
                                success: function (response) {
                                    var lastId = response;
                                    for (var id of user_to) {
                                        var items = `lastId=${lastId}&user_to=${id}`;
                                        $.ajax({
                                            type: 'POST',
                                            url: '../../controller/save_item.php',
                                            dataType: 'json',
                                            data: items,
                                            beforeSend: function () {
                                                ShowToast('Saving')
                                            },
                                            success: function (data) {
                                                var contact_no = data[0];
                                                var firstname = data[1];
                                                var message = `Dear ${firstname}, We wanted to inform you that our administrator has just distributed a new update or information. Please take a moment to review the details as it may contain important announcements, documents, or other relevant information.
                                                    Best Regards,
                                                    CIACO`;
                                                var user_data = `user_number=${contact_no}&message=${message}`;
                                                if (data.length > 0) {
                                                    //send sms
                                                    $.ajax({
                                                        type: 'POST',
                                                        url: '../../controller/send_sms.php',
                                                        data: user_data,
                                                        success: function (response) {
                                                            if (response > 0) {
                                                                console.log('sms sent')
                                                            }
                                                        }
                                                    })
                                                }
                                            }
                                        });
                                    }
                                    // upload image after distribute details
                                    $.ajax({
                                        type: 'POST',
                                        url: `../../controller/distribute_img.php?id=${lastId}`,//id of last distributed
                                        data: form_data,
                                        contentType: false,
                                        cache: true,
                                        processData: false,
                                        success: function (res) {
                                            if (res > 0) {
                                                toastr.success("Successfully Distributed.");
                                                setTimeout(() => {
                                                    location.reload(true); //relaod page
                                                }, 2000)
                                            }
                                        }
                                    })
                                }
                            })
                        }
                    }
                })
            } else { // no picture
                $.ajax({
                    type: 'POST',
                    url: `../../controller/distribute.php`,
                    data: mydata,
                    success: function (response) {
                        var lastId = response;
                        for (var id of user_to) {
                            var items = `lastId=${lastId}&user_to=${id}`;
                            $.ajax({
                                type: 'POST',
                                url: '../../controller/save_item.php',
                                dataType: 'json',
                                data: items,
                                beforeSend: function () {
                                    ShowToast('Saving')
                                },
                                success: function (data) {

                                    var contact_no = data[0];
                                    var firstname = data[1];
                                    var message = `CIACO: Dear ${firstname}, We wanted to inform you that our administrator has just distributed a new update or information. Please take a moment to review the details as it may contain important announcements, documents, or other relevant information.
                                                    Best Regards,
                                                    CIACO`;
                                    var user_data = `user_number=${contact_no}&message=${message}`;
                                    if (data.length > 0) {
                                        //send sms
                                        $.ajax({
                                            type: 'POST',
                                            url: '../../controller/send_sms.php',
                                            data: user_data,
                                            success: function (response) {
                                                if (response > 0) {
                                                    console.log('sms sent')
                                                }
                                            }
                                        })
                                    }
                                }
                            });
                        }
                        toastr.success("Successfully Distributed.");
                        setTimeout(() => {
                            location.reload(true); //relaod page
                        }, 2000)
                    }
                })
            }
        } else {
            toastr.warning('Please select members')
        }
    }



});
