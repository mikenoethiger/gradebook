@extends('app')

@section('title')
    Notenbuch - Note erfassen
@stop

@section('head')
    <link href="/css/thumbnail-icon.css" rel="stylesheet">
@stop

@section('header')
    Note erfassen
@stop

@section('content')
    @include('subviews.semester-breadcrumb')
    @if(count($subjects) == 0)
        <div class="row">
            <div class="col-sm-12">
                <div class="well well-lg">Um eine Note zu erfassen musst du zuerst Schulfächer erstellen. <a
                            href="/subject/create">Jetzt Schulfach erstellen.</a></div>
            </div>
        </div>
    @else
        <form method="post" action="{{ $basePath . '/grade' }}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">

            <div class="row">
                <div class="col-sm-12 col-md-6 col-lg-4">
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-tags"></i></span>
                            <input class="form-control" name="grade" placeholder="Note" type="number" step="any">
                            <span class="input-group-btn">
                                <button type="submit" class="btn btn-default" type="button">Erfassen</button>
                            </span>
                        </div>
                    </div>

                    <div class="form-group">

                        <select class="form-control" name="subject">
                            @foreach($subjects as $subject)
                                <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div class="row">
                @foreach($subjects as $subject)
                    <div class="col-lg-2 col-md-3 col-sm-4 col-xs-6">
                        <a id="grade-icon-{{ $subject->id }}" href="#" class="thumbnail thumbnail-icon">
                            <span class="{{ $subject->icon }} fa-5x" data-subject-id="{{ $subject->id }}"></span>

                            <p>{{ $subject->name }}</p>
                        </a>
                    </div>
                @endforeach
            </div>
        </form>
    @endif
@stop

@section('scripts')
    @parent
            <!-- jQuery UI -->
    <script src="/js/jquery-ui.js"></script>

    <script type="text/javascript">
        var clickedIcon;

        $(".thumbnail-icon").click(function (e) {
            e.preventDefault();
            if (clickedIcon != null) {
                clickedIcon.toggleClass("focused");
            }
            clickedIcon = $(this);
            clickedIcon.toggleClass("focused");

            $("select[name='subject']").val(clickedIcon.find('span').attr('data-subject-id'));
        });

        $("select[name='subject']").change(function () {
            refreshClickedSubjectIcon();
        });

        function refreshClickedSubjectIcon() {
            $('#grade-icon-' + $("select[name='subject']").val()).click();
        }

        // Initially trigger this function to select the first subject icon
        refreshClickedSubjectIcon();
    </script>
@stop