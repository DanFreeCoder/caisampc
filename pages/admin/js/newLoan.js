$(document).ready(function () {
    $('.select2').select2();
    // enable datepicker plugins once the page load
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
})

function save_loan() {
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
    var myData = 'name=' + name + '&gender=' + gender + '&occupation=' + occupation + '&date_of_birth=' + date_of_birth + '&status=' + civil_status + '&dependents=' + dependents + '&address=' + address + '&contact=' + contact + '&spouse=' + spouse + '&spouse_occu=' + spouse_occu + '&gross=' + gross + '&expenses=' + expenses + '&net=' + net + '&date_applied=' + date_applied + '&date_needed=' + date_needed + '&amount_applied=' + amount_applied + '&purpose=' + purpose + '&type=' + type + '&mode=' + mode + '&others=' + others + '&kind=' + kind + '&tct=' + tct + '&area=' + area + '&co_maker1=' + co_maker1 + '&stock1=' + stock1 + '&co_maker2=' + co_maker2 + '&stock2=' + stock2;

    //restrictions
    if (name != '' && gender != 0 && occupation != '' && date_of_birth != '' && civil_status != 0 && dependents != '' && address != '' && contact != '' && spouse != '' && spouse_occu != '' && gross != '' && expenses != '' && net != '' && date_applied != '' && date_needed != '' && amount_applied != '' && purpose != '' && type != '' && mode != '' && kind != '' && tct != '' && co_maker1 != '' && stock1 != '' && co_maker2 != '' && stock2 != '') {
        $.ajax({
            type: 'POST',
            url: '../../controller/save_loan.php',
            data: myData,
            success: function (response) {
                if (response > 0) {
                    toastr.success('Loan Application is successfully Save.');
                } else {
                    toastr.error('Submit Failed. Unable to save in database. Please contact your system administrator for assistance.');
                }
            }
        })
    } else {
        toastr.error('Submit Failed. Please fill-out all the data needed.');
    }
}

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
    var reasons = $('textarea#reasons').val();
    var myData = 'id=' + id + '&name=' + name + '&gender=' + gender + '&occupation=' + occupation + '&date_of_birth=' + date_of_birth + '&status=' + civil_status + '&dependents=' + dependents + '&address=' + address + '&contact=' + contact + '&spouse=' + spouse + '&spouse_occu=' + spouse_occu + '&gross=' + gross + '&expenses=' + expenses + '&net=' + net + '&date_applied=' + date_applied + '&date_needed=' + date_needed + '&amount_applied=' + amount_applied + '&purpose=' + purpose + '&type=' + type + '&mode=' + mode + '&others=' + others + '&kind=' + kind + '&tct=' + tct + '&area=' + area + '&co_maker1=' + co_maker1 + '&stock1=' + stock1 + '&co_maker2=' + co_maker2 + '&stock2=' + stock2 + '&reason=' + reasons;

    //restrictions
    if (name != '' && gender != 0 && occupation != '' && date_of_birth != '' && civil_status != 0 && dependents != '' && address != '' && contact != '' && spouse != '' && spouse_occu != '' && gross != '' && expenses != '' && net != '' && date_applied != '' && date_needed != '' && amount_applied != '' && purpose != '' && type != '' && mode != '' && kind != '' && tct != '' && area != '' && co_maker1 != '' && stock1 != '' && co_maker2 != '' && stock2 != '') {
        $.ajax({
            type: 'POST',
            url: '../../controller/upd_loan.php',
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
//btnApprove event handler
$('#btnApprove').on('click', function (e) {
    e.preventDefault();

    var action = 1;
    update_loan_status(action);
})
//btnDecline event handler
$('#btnDecline').on('click', function (e) {
    e.preventDefault();
    $('#reasonModal').modal('show');
})

$('#declineSubmit').on('click', function () {
    var action = 2;
    var reason = $('#reasonModal #reason').val();
    if (reason != '') {
        update_loan_status(action);
    } else {
        toastr.error('Reason for declining is required.')
    }

});

function update_loan_status(action) {

    var id = $('#id').val();
    var reason = $('#reasonModal #reason').val();
    var myData = 'id=' + id + '&action=' + action + '&reason=' + reason;

    $.ajax({
        type: 'POST',
        url: '../../controller/upd_loan_stat.php',
        data: myData,
        success: function (response) {
            if (response > 0) {
                if (response == 1) {
                    var contact = $('#contact-no').val();
                    var name = $('#name').val();
                    var message = `CIACO: Dear ${name}, we are pleased to inform you that your loan application has been approved.`;
                    var user_data = `user_number=${contact}&message=${message}`;
                    $.ajax({
                        type: 'POST',
                        url: '../../controller/send_sms.php',
                        data: user_data,
                        success: function (res) {
                            if (res > 0) {
                                toastr.success('Loan Application is successfully approved.');
                                setTimeout(() => {
                                    location.reload(true)
                                }, 2000)
                            }
                        }
                    })
                } else {
                    var contact = $('#contact-no').val();
                    var name = $('#name').val();
                    var message = `CIACO: Dear ${name}, we are sorry to inform you that your loan application has been declined.`;
                    var user_data = `user_number=${contact}&message=${message}`;
                    $.ajax({
                        type: 'POST',
                        url: '../../controller/send_sms.php',
                        data: user_data,
                        success: function (res) {
                            if (res > 0) {
                                toastr.warning('Loan Application has been declined.');
                                setTimeout(() => {
                                    location.reload(true)
                                }, 2000)
                            }
                        }
                    })

                }
            } else {
                toastr.error('Submit Failed. Unable to save in database. Please contact your system administrator for assistance.');
            }
        }
    })
}
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
    $('textarea').prop('disabled', false)
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

function clearData() {
    //clear all input fields
    var inputs = document.getElementsByTagName("input");
    for (var i = 0; i < inputs.length; i++)
        inputs[i].value = '';
    //reset select option
    $('.select').prop('selectedIndex', 0);
    //clear datepicker 
    $('.datepicker').val();
}