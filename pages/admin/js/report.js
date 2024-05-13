
$('#Tabledata1').DataTable({
    'autoWidth': true
});

$('#download1').on('click', function () {
    // $('#Tabledata1_wrapper .buttons-excel').click();
    const from = $('#from').val();
    const to = $('#to').val();
    if (from != '' && to != '') {
        const param = `from=${from}&to=${to}`;
        window.open(`../../print/examples/loan_report.php?${param}`, '_blank')
    } else {
        toastr.error('No date specified');
    }

});


//generate loan
$('#btnreport').on('click', () => {
    const from = $('#from').val();
    const to = $('#to').val();

    const mydata = `from=${from}&to=${to}`;
    $.ajax({
        type: 'POST',
        url: '../../controller/gen_report.php?action=Loan',
        data: mydata,
        success: function (html) {
            if (html !== '') {
                $('#loan_body').html(html);
                $('#download1').attr('hidden', false)
            } else {
                toastr.error('No data found');
            }
        }
    })

});

$('#Tabledata2').DataTable();

$('#download2').on('click', function () {
    // $('#Tabledata2_wrapper .buttons-excel').click();
    const from2 = $('#from2').val();
    const to2 = $('#to2').val();
    const param2 = `from2=${from2}&to2=${to2}`;
    window.open(`../../print/examples/distribute_report.php?${param2}`, '_blank');

});

//generate distribution
$('#btnreport2').on('click', () => {
    const from2 = $('#from2').val();
    const to2 = $('#to2').val();

    const mydata = `from2=${from2}&to2=${to2}`;
    $.ajax({
        type: 'POST',
        url: '../../controller/gen_report.php?action=distribution',
        data: mydata,
        success: function (html) {
            if (html !== '') {
                $('#distribution_body').html(html);
                $('#download2').attr('hidden', false)
            } else {
                toastr.error('No data found');
            }

        }
    })

});

$(document).on('click', '.distributed_to', function () {
    var id = $(this).attr('value');
    $.ajax({
        type: 'POST',
        url: '../../controller/get_distributer.php',
        data: { id: id },
        success: function (html) {
            $('#distributeTo').modal('show')
            $('#distributeBody').html(html)
        }
    })
})

//date picker
$('.mydatepicker').datepicker();
$('.datepicker-autoclose').datepicker({
    autoclose: true,
    todayHighlight: true
});