<script src="{{ asset('ui/admin_assets/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('ui/admin_assets/js/jszip.min.js') }}"></script>
<script src="{{ asset('ui/admin_assets/js/pdfmake.min.js') }}"></script>
<script src="{{ asset('ui/admin_assets/js/vfs_fonts.js') }}"></script>
<script src="{{ asset('ui/admin_assets/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('ui/admin_assets/js/buttons.print.min.js') }}"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.colVis.min.js">
</script>
<script>
    $(document).ready(function() {
        $('.selectTo').select2();

        $(".datepicker").datepicker({
            dateFormat: 'yy-mm-dd',
            changeMonth: true,
            changeYear: true,
            yearRange: "-70:+50",
        });

        $('#table_id').DataTable({
            rowHeight: 20,
            searching: false,
            dom: 'Bfrtip',
            buttons: [{
                extend: 'pdfHtml5',
                exportOptions: {
                    columns: ':visible'
                }
            }, {
                extend: 'excelHtml5',
                exportOptions: {
                    columns: ':visible'
                }
            }, 'colvis']
        });
    });
</script>
