
$(document).ready(() => {
    // enable datatable plugins
    $('.TableData').DataTable({
        'autoWidth': true
    });

    // update status to 2 to seen messages
    const id = $('#session_id').val();
    $.ajax({
        type: 'POST',
        url: '../../controller/seen_msg.php',
        data: { id: id },
        success: function (res) {
            if (res > 0) console.log('message was seen');
        }
    })
})

var activeTab = 1;
$('#nav-pending-tab').on('click', () => activeTab = 1);//pending
$('#nav-pendingForApp-tab').on('click', () => activeTab = 2);//for approval
$('#nav-registered-tab').on('click', () => activeTab = 3);//approved
$('#nav-declined-tab').on('click', () => activeTab = 4);//declined
$('#nav-inactive-tab').on('click', () => activeTab = 0);//inactive

// pass id of clicked button in url
$('.btnView').on('click', function (e) {
    e.preventDefault();

    var id = $(this).attr('value');
    window.open('memberDetails.php?id=' + id, '_blank');
})

// btn approved event handler
$('.btnApprove').on('click', function (e) {
    e.preventDefault();

    var currentRow = $(this).closest("tr");
    var firstname = currentRow.find("td:eq(0)").text();
    var contact_no = currentRow.find("td:eq(4)").text();
    var message = `Dear ${firstname}, we are pleased to inform you that your membership form has been approved.`;
    var user_data = `user_number=${contact_no}&message=${message}`;

    var id = $(this).attr('value');
    var action = 1;

    $.ajax({
        type: 'POST',
        url: '../../controller/upd_member_stat.php',
        data: { id: id, action: action },
        success: function (response) {
            if (response > 0) {
                $.ajax({
                    type: 'POST',
                    url: '../../controller/send_sms.php',
                    data: user_data,
                    success: function (response) {
                        if (response > 0) {
                            toastr.success('Applicant successfully registered as cooperative member.');
                            setTimeout(() => {
                                location.reload(true);
                            }, 2000)
                        }
                    }
                })
            } else {
                toastr.error('Submit Failed. Unable to save in database. Please contact your system administrator for assistance.');
            }
        }
    })
})

var id = '';
$('.btnDecline').on('click', function (e) {
    e.preventDefault();
    $('#declinedModal').modal('show')
    id = $(this).attr('value');
});

$('#DeclineSubmit').on('click', function (e) {
    e.preventDefault();
    var action = 2;
    var reason = $('#reason').val();
    if (reason != '') {
        $.ajax({
            type: 'POST',
            url: '../../controller/upd_member_stat.php',
            data: { id: id, action: action, reason: reason },
            success: function (response) {
                if (response > 0) {
                    $.ajax({
                        type: 'POST',
                        url: '../../controller/get_client_num.php',
                        data: { client_id: id },
                        success: function (number) {
                            var user_number = number;
                            var message = `Hello, We are sorry to inform you that your membership form has declined`;
                            var mydata = `user_number=${user_number}&message=${message}`;
                            $.ajax({
                                type: "POST",
                                url: '../../controller/send_sms.php',
                                data: mydata,
                                success: function (response) {
                                    console.log(response)
                                    toastr.success('You have successfully declined the member application request.');
                                    setTimeout(() => {
                                        location.reload(true)
                                    }, 2000)
                                }
                            })
                        }
                    })
                } else {
                    toastr.error('Submit Failed. Unable to save in database. Please contact your system administrator for assistance.');
                }
            }
        })
    } else {
        toastr.error('Reason for for declining is required.');
    }

})

$('.btnApply').on('click', function (e) {
    e.preventDefault();

    var id = $(this).attr('value');
    var action = 3;
    $.ajax({
        type: 'POST',
        url: '../../controller/upd_member_stat.php',
        data: { id: id, action: action },
        success: function (response) {
            //  alert(response);
            if (response > 0) {
                toastr.success('You have successfully set the application in pending.');
                setTimeout(() => {
                    location.reload(true)
                }, 2000)
            } else {
                toastr.error('Submit Failed. Unable to save in database. Please contact your system administrator for assistance.');
            }
        }
    })
})

$('.btnInActive').on('click', function (e) {
    e.preventDefault();

    var id = $(this).attr('value');
    var action = 4;
    Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, Deactivate it!"
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: 'POST',
                url: '../../controller/upd_member_stat.php',
                data: { id: id, action: action },
                success: function (response) {
                    // alert(response);
                    if (response > 0) {
                        Swal.fire({
                            title: "Deactivate!",
                            text: "You have successfully deactivate the member application.",
                            icon: "success"
                        });
                        setTimeout(() => {
                            location.reload(true)
                        }, 2000);
                    } else {
                        toastr.error('Submit Failed. Unable to save in database. Please contact your system administrator for assistance.');
                    }
                }
            })

        }
    });
})

$('.btnActive').on('click', function (e) {
    e.preventDefault();

    var id = $(this).attr('value');
    var action = 5;

    Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, activate it!"
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: 'POST',
                url: '../../controller/upd_member_stat.php',
                data: { id: id, action: action },
                success: function (response) {
                    // alert(response);
                    if (response > 0) {
                        Swal.fire({
                            title: "Activated!",
                            text: "You have successfully activate the member application.",
                            icon: "success"
                        });
                        setTimeout(() => {
                            location.reload(true)
                        }, 2000);
                    } else {
                        toastr.error('Submit Failed. Unable to save in database. Please contact your system administrator for assistance.');
                    }
                }
            })

        }
    });
})


$('.btnRemove').on('click', function (e) {
    e.preventDefault();

    var id = $(this).attr('value');
    var action = 4;
    $.ajax({
        type: 'POST',
        url: '../../controller/upd_member_stat.php',
        data: { id: id, action: action },
        success: function (response) {
            // alert(response);
            if (response > 0) {
                toastr.success('You have successfully remove the member application request.');
                setTimeout(() => {
                    location.reload(true)
                }, 2000)
            } else {
                toastr.error('Submit Failed. Unable to save in database. Please contact your system administrator for assistance.');
            }
        }
    })
});
// print member
$('#print').on('click', () => {
    window.open(`../../print/examples/coop_member.php?status=${activeTab}`, '_blank')
});