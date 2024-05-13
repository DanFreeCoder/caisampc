$(document).ready(function () {
    $('.select2').select2()
    $('.datepicker').datepicker();
    $('#mode-option').hide();
})
//mode of payment event handler
$('#mode').on('change', function () {
    var value = $(this).val();

    if (value == 'Others, Specify') {
        $('#mode-option').show();
    } else {
        $('#mode-option').hide();
    }
});


function update_loan() {
    var id = $('#id').val();
    var name = $('#name').val();
    var gender = $('#gender :selected').text();
    var occupation = $('#occupation').val();
    var date_of_birth = $('#date-of-birth').val();
    var civil_status = $('#status').val();
    var dependents = $('#dependents').val();
    var address = $('#address').val();
    var contact = $('#contact-no').val();
    var spouse = $('#spouse').val();
    var spouse_occu = $('#spouse-occu').val();
    var gross = $('#gross').val();
    var expenses = $('#expenses').val();
    var net = $('#net').val();
    var date_applied = $('#date-applied').val();
    var date_needed = $('#date-needed').val();
    var amount_applied = $('#amount-applied').val();
    var purpose = $('#purpose').val();
    var type = $('#loan-type').val();
    var mode = $('#mode').val();
    var others = $('#others').val();
    var kind = $('#kind').val();
    var tct = $('#tct-no').val();
    var area = $('#area').val();
    var co_maker1 = $('#co-maker1').val();
    var stock1 = $('#stock1').val();
    var co_maker2 = $('#co-maker2').val();
    var stock2 = $('#stock2').val();
    var myData = 'id=' + id + '&name=' + name + '&gender=' + gender + '&occupation=' + occupation + '&date_of_birth=' + date_of_birth + '&status=' + civil_status + '&dependents=' + dependents + '&address=' + address + '&contact=' + contact + '&spouse=' + spouse + '&spouse_occu=' + spouse_occu + '&gross=' + gross + '&expenses=' + expenses + '&net=' + net + '&date_applied=' + date_applied + '&date_needed=' + date_needed + '&amount_applied=' + amount_applied + '&purpose=' + purpose + '&type=' + type + '&mode=' + mode + '&others=' + others + '&kind=' + kind + '&tct=' + tct + '&area=' + area + '&co_maker1=' + co_maker1 + '&stock1=' + stock1 + '&co_maker2=' + co_maker2 + '&stock2=' + stock2;

    //restrictions
    if (name != '' && gender != 0 && occupation != '' && date_of_birth != '' && civil_status != 0 && dependents != '' && address != '' && contact != '' && spouse != '' && spouse_occu != '' && gross != '' && expenses != '' && net != '' && date_applied != '' && date_needed != '' && amount_applied != '' && purpose != '' && type != '' && mode != '' && kind != '' && tct != '' && area != '' && co_maker1 != '' && stock1 != '' && co_maker2 != '' && stock2 != '') {
        $.ajax({
            type: 'POST',
            url: '../../controller/update_loan_client.php',
            data: myData,
            success: function (response) {
                if (response > 0) {
                    toastr.success('Loan Application is successfully up to date.');
                    setTimeout(() => {
                        location.reload(true)
                    }, 2000)
                } else {
                    toastr.error('Submit Failed. Unable to save in database. Please contact your system administrator for assistance.');
                }
            }
        })
    } else {
        toastr.error('Submit Failed. Please fill-out all the data needed.');
    }
}

// print aprroved loan
$('#btnPrint').on('click', function () {
    const id = $(this).val();
    window.open("../../print/forms/Approved_Loan.php?id=" + id, "_blank");
});

function cancel() {
    //disabled all input
    $('input[type=text]').prop('disabled', true);
    //disabled all select box
    $('select').prop('disabled', true);
    //display & hide btn
    $('#btnEdit').show();
    $('#btnApprove').show();
    $('#btnDecline').show();
    $('#btnClear').show();
    $('#btnUpdate').hide();
    $('#btnCancel').hide();
}

function edit_details() {
    //disabled all input
    $('input[type=text]').prop('disabled', false);
    //disabled all select box
    $('select').prop('disabled', false);
    //display & hide btn
    $('#btnEdit').hide();
    $('#btnApprove').hide();
    $('#btnDecline').hide();
    $('#btnClear').hide();
    $('#btnUpdate').show();
    $('#btnCancel').show();
}