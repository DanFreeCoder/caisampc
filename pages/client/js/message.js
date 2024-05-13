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
        data: { id: id },
        success: function (res) {
            if (res > 0) console.log('message was seen');
        }
    })

    $('#creatNew').on('click', () => {
        $('#new_messageModal').modal('show');
    });
    // open conversation
    $(document).on('click', '.msg_id', (event) => {
        const message_id = $(event.currentTarget).attr('value');
        const reciever_id = $('#reciver_id').val();

        const mydata = `message_id=${message_id}&reciever_id=${reciever_id}`;
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

        $.ajax({
            type: 'POST',
            url: '../../controller/reply.php',
            data: mydata,

            success: function (res) {
                if (res > 0) alert('Sent');
            }
        })
    });

    // send
    $('#send').on('click', () => {
        const user_from = $('#user_from').val();
        const user_to = $('#user_to option:selected').val();
        const message = $('textarea.message').val();

        const mydata = `user_from=${user_from}&user_to=${user_to}&message=${message}`;

        $.ajax({
            type: 'POST',
            url: '../../controller/send_message.php',
            data: mydata,
            success: function (res) {
                if (res > 0) toastr.success('Successfully Send');
                $('#new_messageModal').modal('hide');
                $('textarea.message').val('');
                location.reload(true);
            }
        })
    });

});

// <!-- search chat participant -->

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
        });
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
