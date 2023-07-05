var App = (function () {
  'use strict';
        //console.log("entro");
  App.dataTables = function( ){

    //We use this to apply style to certain elements
    $.extend( true, $.fn.dataTable.defaults, {
      dom:
        "<'row be-datatable-header'<'col-sm-6'l><'col-sm-6'f>>" +
        "<'row be-datatable-body'<'col-sm-12'tr>>" +
        "<'row be-datatable-footer'<'col-sm-5'i><'col-sm-7'p>>"
    } );

    $("#nso").dataTable({
        dom: 'Bfrtip',
        buttons: [
            'csv', 'excel', 'pdf'
        ],
        "lengthMenu": [[500, 1000, -1], [500, 1000, "All"]],
        columnDefs:[{
            targets: "_all",
            sortable: false
        }]
    });


    $("#table1").dataTable({
        destroy: true,
        dom: 'Bfrtip',
        buttons: [
            'csv', 'excel', 'pdf'
        ],
        "lengthMenu": [[500, 1000, -1], [500, 1000, "All"]],
        order : [[ 0, "asc" ]]
    });

    //Remove search & paging dropdown
    $("#table2").dataTable({
      pageLength: 6,
        destroy: true,
      dom:  "<'row be-datatable-body'<'col-sm-12'tr>>" +
            "<'row be-datatable-footer'<'col-sm-5'i><'col-sm-7'p>>"
    });

    //Enable toolbar button functions
    $("#table3").dataTable({
      buttons: [
        'copy', 'excel', 'pdf', 'print'
      ],
      "lengthMenu": [[6, 10, 25, 50, -1], [6, 10, 25, 50, "All"]],
      dom:  "<'row be-datatable-header'<'col-sm-6'l><'col-sm-6 text-right'B>>" +
            "<'row be-datatable-body'<'col-sm-12'tr>>" +
            "<'row be-datatable-footer'<'col-sm-5'i><'col-sm-7'p>>"
    });

    $("#tablainformacionfamiliar").dataTable({
        destroy: true,
        dom: 'Bfrtip',
        buttons: [
            'csv', 'excel', 'pdf'
        ],
        scrollX:"300px",
        // "autoWidth": true,
        "lengthMenu": [[50,100,500, 1000, -1], [50,100,500, 1000, "All"]],
        order : [[ 0, "asc" ]]
    });


    $("#tinformacionfamiliar").dataTable({
        destroy: true,
        dom: 'Bfrtip',
        scrollX:true,
        // width: '1000px',
        // height: '600px',
        buttons: [
            'csv', 'excel', 'pdf'
        ],
        // "info":     true,
        "lengthMenu": [[50,100,500, 1000, -1], [50,100,500, 1000, "All"]],
        order : [[ 0, "asc" ]],
        // columnDefs: [
        //     { responsivePriority: 10001, targets: -1 },
        //     { responsivePriority: 1, targets: -1},
        //     { width: 15, targets: 0 },
        //     { width: 150, targets: 1 },
        //     { width: 15, targets: 2 },
        //     { width: 100, targets: 3 },
        //     { width: 60, targets: 4 },
        //     { width: 15, targets: 5 },
        //     { width: 15, targets: 6 },
        //     { width: 15, targets: 7 }
        // ]
    });


  };

  return App;
})(App || {});
