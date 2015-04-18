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
            <table class="table table-striped table-bordered table-hover" id="grades-table">
                <thead>
                <tr>
                    <th><i class="fa fa-tags fa-fw"></i> Note</th>
                    <th><i class="fa fa-inbox fa-fw"></i> Fach</th>
                    <th>Aktionen</th>
                </tr>
                </thead>
                <tbody>
                @foreach($grades as $grade)
                    <tr>
                        <td>{{ $grade->grade }}</td>
                        <td><span class="{{ $grade->subject->icon }} fa-2x"></span> {{ $grade->subject->name }}</td>
                        <td>
                            <form id="delete-grade-{{ $grade->id }}" method="post"
                                  action="/grade/{{ $grade->id }}">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="_method" value="delete">
                            </form>
                            <div class="btn-group" role="group">
                                <a href="#" class="btn btn-danger"
                                   onclick="$('#delete-grade-{{ $grade->id }}').submit();return false;">
                                    <i class="fa fa-trash-o fa-lg"></i> <span class="hidden-xs">Löschen</span>
                                </a>
                            </div>
                        </td>
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
            $('#grades-table').DataTable({
                responsive: true,
                paging:   false,
                info: false,
                "dom": '<"toolbar">frtip',
                language: {
                    "lengthMenu": "Zeige _MENU_ Einträge pro Seite",
                    "zeroRecords": "Keine Noten vorhanden",
                    "info": "Seite _PAGE_ von _PAGES_",
                    "infoEmpty": "Keine Noten vorhanden",
                    "infoFiltered": ""
                }
            });
            $("div.toolbar").html('<a href="/grade/create" class="btn btn-default"><i class="fa fa-plus fa-fw"></i> <span class="hidden-xs">Note erfassen</span></a>');
        });
    </script>
@stop