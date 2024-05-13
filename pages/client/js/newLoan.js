$(document).ready(function () {
    $('.select2').select2();
    $('.datepicker').datepicker();
    $('#mode-option').hide();
});
//mode of payment event handler
$('#mode').on('change', function () {
    var value = $(this).val();

    if (value == 'Others, Specify') {
        $('#mode-option').show();
    } else {
        $('#mode-option').hide();
    }
});

function save_loan() {
    $.ajax({
        type: 'POST',
        url: '../../controller/check_num_of_loans.php',
        success: function (response) {
            var numofloans = response;
            if (numofloans < 10) {
                var remainingDays = 10 - numofloans;
                toastr.error(`Please wait for ${remainingDays} more days to apply for a new loan.`);
            } else {
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
                var co_maker1 = $('#co-maker1 :selected').val();
                var stock1 = $('#stock1').val();
                var co_maker2 = $('#co-maker2 :selected').val();
                var stock2 = $('#stock2').val();
                var myData = 'name=' + name + '&gender=' + gender + '&occupation=' + occupation + '&date_of_birth=' + date_of_birth + '&status=' + civil_status + '&dependents=' + dependents + '&address=' + address + '&contact=' + contact + '&spouse=' + spouse + '&spouse_occu=' + spouse_occu + '&gross=' + gross + '&expenses=' + expenses + '&net=' + net + '&date_applied=' + date_applied + '&date_needed=' + date_needed + '&amount_applied=' + amount_applied + '&purpose=' + purpose + '&type=' + type + '&mode=' + mode + '&others=' + others + '&kind=' + kind + '&tct=' + tct + '&area=' + area + '&co_maker1=' + co_maker1 + '&stock1=' + stock1 + '&co_maker2=' + co_maker2 + '&stock2=' + stock2;

                //restrictions
                if (name != '' && gender != 0 && occupation != '' && date_of_birth != '' && civil_status != 0 && dependents != '' && address != '' && contact != '' && spouse != '' && spouse_occu != '' && gross != '' && expenses != '' && net != '' && date_applied != '' && date_needed != '' && amount_applied != '' && purpose != '' && type != '' && mode != '' && kind != '' && tct != '' && area != '' && co_maker1 != 0 && stock1 != '' && co_maker2 != 0 && stock2 != '') {
                    $.ajax({
                        type: 'POST',
                        url: '../../controller/check_loan.php',
                        data: myData,
                        success: function (response) {
                            if (response > 0) {
                                toastr.error('Form duplication is not valid.')
                            } else {
                                $.ajax({
                                    type: 'POST',
                                    url: '../../controller/save_loan.php',
                                    data: myData,
                                    success: function (response) {
                                        if (response > 0) {
                                            toastr.success('Loan Application is successfully Save.');
                                            setTimeout(() => {
                                                window.location.href = `loan.php`;
                                            }, 2000)
                                        } else {
                                            toastr.error('Submit Failed. Unable to save in database. Please contact your system administrator for assistance.');
                                        }

                                    }
                                })
                            }
                        }
                    })

                } else {
                    toastr.error('Submit Failed. Please fill-out all the details needed.');
                }
            }
        }
    })

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
