$(document).ready(() => {
    // datatable
    $('#loanTable').dataTable();
})
$('.btnView').on('click', function (e) {
    e.preventDefault();

    var id = $(this).attr('value');
    window.open('viewLoanDetails.php?id=' + id, '_blank');
})