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
            order: [0, 'desc'],
            rowHeight: 20,
            searching: false,
            dom: 'Bfrtip',
             buttons: [{
                extend: 'print',
                customize: function(win) {
                    var body = $(win.document.body).find('table').first();
                    body.find('td:last-child(), th:last-child()').hide();
                }
            }, {
                extend: 'pdfHtml5',
                customize: function(doc) {
                    // Hide last column in the PDF
                    doc.content[1].table.body.forEach(function(row) {
                        row.splice(-1, 1);
                    });
                }
            }, {
                extend: 'excelHtml5',
                customizeData: function(excelData) {
                    var header = excelData.header;
                    header.pop();
                }
            }]
        });
    });
</script>
