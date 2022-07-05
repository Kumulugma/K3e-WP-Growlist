jQuery(document).ready(function () {
    var table = jQuery('#growlist').DataTable(
            {
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.11.5/i18n/pl.json"
                },
                "columnDefs": [{
                        "targets": 1,
                        "orderable": false
                    }],
                order: [[2, 'desc']]
            });

});