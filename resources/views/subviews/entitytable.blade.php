@section('head')
    @parent
            <!-- DataTables CSS -->
    <link href="/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css" rel="stylesheet">
    <!-- DataTables Responsive CSS -->
    <link href="/bower_components/datatables-responsive/css/dataTables.responsive.css" rel="stylesheet">

    <!-- Custom Datatable Theme -->
    <link href="/css/datatable.css" rel="stylesheet">
@stop

<div class="row">
    <div class="col-sm-12">
        <div class="dataTable_wrapper">
            <table class="table table-striped table-bordered table-hover" id="entity-table">
                <thead>
                <tr>
                    @foreach($headerColumns as $headerColumn)
                        <th>{!! $headerColumn !!}</th>
                    @endforeach
                </tr>
                </thead>
                <tbody>
                @foreach($rows as $row)
                    <tr>
                        @foreach($row as $column)
                            <td>{!! $column !!}</td>
                        @endforeach
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@section('scripts')
    @parent
            <!-- DataTables JavaScript -->
    <script src="/bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
    <script src="/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#entity-table').DataTable({
                responsive: true,
                paging: false,
                info: false,
                "dom": '<"toolbar">frtip',
                language: {
                    "lengthMenu": "Zeige _MENU_ Einträge pro Seite",
                    "zeroRecords": "Keine {{ $entityNamePlural }} vorhanden",
                    "info": "Seite _PAGE_ von _PAGES_",
                    "infoEmpty": "Keine {{ $entityNamePlural }} vorhanden",
                    "infoFiltered": ""
                }
            });
            $("div.toolbar").html('<a href="{{ $createEntityUrl }}" class="btn btn-default"><i class="fa fa-plus fa-fw"></i> <span class="hidden-xs">{{ $entityName }} erfassen</span></a>');
        });
    </script>
@stop