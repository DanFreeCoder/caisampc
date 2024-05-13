$(document).ready(() => {
    // $('#imagePreview').attr('hidden', true)
    $('.Tabledata').DataTable();
    $('.select2').select2();
    $('.picture').on('click', () => {
        $('#upload').click();
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
        };

        reader.readAsDataURL(imageInput.files[0]);
    } else {
        imagePreview.src = '';
    }
}

//edit
$('.edit').on('click', function () {
    const id = $(this).attr('value');

    $.ajax({
        type: 'POST',
        url: '../../controller/get_dist_detail.php',
        dataType: 'json',
        data: { id: id },
        success: function (data) {
            const image = data[0];
            const description = data[1];
            const id = data[2];
            const status = data[3];
            // check if post have an image
            if (image != null) {
                $('#imagePreview').attr('hidden', false)
                $('#imagePreview').attr("src", '../' + image)
            } else {
                $('#imagePreview').attr('hidden', true)

            }
            $('#description').text(description)
            $('#update').val(id)
            if (status != 1) {
                $('#update').attr('hidden', true)
            } else {
                $('#update').attr('hidden', false)
            }
        }
    })
});

//update
$('#update').on('click', function () {
    const id = $(this).val();
    const descriptions = $('#description').val();

    var mydata = `id=${id}&descriptions=${descriptions}`;

    var file_data = $('#upload').prop('files')[0];
    var form_data = new FormData();
    form_data.append('files', file_data);

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
                        url: '../../controller/upd_distribute.php',
                        data: mydata,
                        success: function (response) {
                            if (response > 0) {
                                // upload image after update details
                                $.ajax({
                                    type: 'POST',
                                    url: `../../controller/distribute_img.php?id=${id}`,//id of last distributed
                                    data: form_data,
                                    contentType: false,
                                    cache: true,
                                    processData: false,
                                    success: function (res) {
                                        if (res > 0) {
                                            toastr.success('Distribution successfully updated.')
                                            setTimeout(() => {
                                                location.reload(true)
                                            }, 2000);
                                        }
                                    }
                                })

                            }
                        }
                    })
                }
            }
        })
    } else {
        $.ajax({
            type: 'POST',
            url: '../../controller/upd_distribute.php',
            data: mydata,
            success: function (response) {
                if (response > 0) {
                    toastr.success('Distribution successfully updated.')
                    setTimeout(() => {
                        location.reload(true)
                    }, 2000);
                }
            }
        })
    }
});

//remove
$('.remove').on('click', function () {
    const id = $(this).attr('value');
    if (confirm(`You can't undo this action!`)) {
        $.ajax({
            type: 'POST',
            url: '../../controller/remove_distribute.php',
            data: { id: id },
            success: function (res) {
                if (res > 0) {
                    toastr.success('Distribution`s successfully removed!')
                    setTimeout(() => {
                        location.reload(true)
                    }, 1000);
                }
            }
        })
    }
});
