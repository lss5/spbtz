$(function() {
    $('input[name="date_birthday"]').daterangepicker({
        autoUpdateInput: false,
        startDate: moment().startOf('hour'),
        singleDatePicker: true,
        showDropdowns: true,
        minYear: 1901,
        maxYear: parseInt(moment().format('YYYY'), 10)
    });
});

$('input[name="date_birthday"]').on('apply.daterangepicker', function(ev, picker) {
    $(this).val(picker.startDate.format('MM/DD/YYYY'));
});