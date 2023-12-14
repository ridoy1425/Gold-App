$(function () {
   $( '#filter' ).submit(function() {
        this.reset();
    });

    function initializeDatepicker() {
        $(".datepicker").datepicker({
            dateFormat: 'yy-mm-dd',
            changeMonth: true,
            changeYear: true,
            yearRange: "-70:+50",
        });
    }

});
