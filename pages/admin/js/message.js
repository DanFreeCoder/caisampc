$(document).ready(() => {
    // load the message
    $.ajax({
        type: "GET",
        url: '../../controller/messageList.php',
        success: function (data) {
            $('#messageList').html(data)
        }
    });

    // activate select2
    $('.select2').select2({
        dropdownParent: $('#new_messageModal')
    });

    // update status to 2 to seen messages
    const id = $('#session_id').val();
    $.ajax({
        type: 'POST',
        url: '../../controller/seen_msg.php',
        data: {
            id: id
        },
        success: function (res) {
            if (res > 0) console.log('message was seen');
        }
    })
    // open modal for new message
    $('#creatNew').on('click', () => {
        $('#new_messageModal').modal('show');
    });

    // open conversation
    $(document).on('click', '.msg_id', (event) => {
        const message_id = $(event.currentTarget).attr('value');

        const mydata = `message_id=${message_id}`;
        $.ajax({
            type: 'POST',
            url: '../../controller/get_convoBy_id.php',
            dataType: 'json',
            data: mydata,
            success: function (data) {
                $('#convoModal').modal('show');
                $('#messageBody').html(data[0])
                $('#name').text(data[1])
            }
        })
    });

    // reply convo
    $(document).on('click', '#send_new_msg', () => {
        const message_id = $('#msg_id').val();
        const msg = $('textarea#msg').val();
        const sender_id = $('#sndr_id').val();
        const reciever_id = $('#rsvr_id').val();

        const mydata = `message_id=${message_id}&message=${msg}&sender_id=${sender_id}&reciever_id=${reciever_id}`;

        if (msg.length != 0) {
            $.ajax({
                type: 'POST',
                url: '../../controller/reply.php',
                data: mydata,

                success: function (res) {
                    if (res > 0) console.log('Sent');
                    setTimeout(() => {
                        location.reload(true);
                    }, 2000)
                }
            })
        }
    });
});


// send messages
$('#send').on('click', () => {
    const user_from = $('#user_from').val();
    const message = $('textarea.message').val();
    const user_to = $('.user_to option:selected').val();
    // var user_to = [];
    // $('.user_to :selected').each(function () {
    //     user_to.push($(this).val());
    // });

    const mydata = `user_from=${user_from}&user_to=${user_to}&message=${message}`;

    if (message.length > 0) {
        // if (user_to.includes('All')) {
        //     $.ajax({
        //         type: 'POST',
        //         url: '../../controller/SendToAll.php',
        //         data: {
        //             message: message
        //         },
        //         success: function (res) {
        //             if (res > 0) {
        //                 $('#new_messageModal').modal('hide');
        //                 $('textarea.message').val('');
        //                 console.log('sms sent')
        //                 location.reload(true);
        //             }
        //         }
        //     })
        // } else {
        if (user_to > 0) {
            $.ajax({
                type: 'POST',
                url: '../../controller/send_message.php',
                data: mydata,
                success: function (res) {
                    if (res > 0) toastr.success('Successfully Send');
                    $.ajax({
                        type: 'POST',
                        url: '../../controller/get_client_num.php',
                        data: {
                            client_id: user_to
                        },
                        success: function (res2) {
                            $('#new_messageModal').modal('hide');
                            $('textarea.message').val('');
                            var user_data = `user_number=${res2}&message=${message}`;
                            $.ajax({
                                type: 'POST',
                                url: '../../controller/send_sms.php',
                                data: user_data,
                                success: function (response) {
                                    if (response > 0) {
                                        console.log('sms sent')
                                        setTimeout(() => {
                                            location.reload(true);
                                        }, 2000)
                                    }
                                }
                            })

                        }
                    })
                }
            })
        } else {
            toastr.error('Please select your receiver')
        }
        // }
    } else {
        toastr.warning('Please input your message')
    }

})

//search chat participant
$('#search').on('input', function () {
    const search = $(this).val();

    if (search.length > 0) {
        // load the message when data found while searching
        $.ajax({
            type: 'POST',
            url: '../../controller/search_chat.php',
            data: {
                search
            },
            success: function (html) {
                $('#messageList').html(html);
                if (html == '') {
                    // append message when no data found
                    $('#messageList').html('<h1>No message found!</h1>')
                }
            }
        })
    } else {
        // load message when search field has no text
        $.ajax({
            type: "GET",
            url: '../../controller/messageList.php',
            success: function (data) {
                $('#messageList').html(data)
            }
        });
    }

});
