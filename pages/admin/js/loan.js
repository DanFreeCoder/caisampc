$('.TableData').DataTable();

//pass in the url of the id of clicked view loan
$('.btnView').on('click', function (e) {
    e.preventDefault();

    var id = $(this).attr('value');
    window.open('viewLoanDetails.php?id=' + id, '_blank');
})


// print member
$('#print').on('click', () => {
    window.open('../../print/examples/approved_loan.php', '_blank')
});