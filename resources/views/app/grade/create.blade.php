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

                    <label for="weighting">Gewichtung</label>
                    <div class="form-group">
                        <label class="radio-inline">
                            <input type="radio" name="weighting" value="2"> x2
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="weighting" value="1" checked="checked"> x1
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="weighting" value="0.5"> x0.5
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="weighting" value="0.25"> x0.25
                        </label>
                    </div>

                    <div class="form-group">
                        <label for="subject">Fach</label>
                        <select class="form-control" name="subject">
                            @foreach($subjects as $subject)
                                <option value="{{ $subject->id }}" {{ $subject->id == $selectedSubject->id ? 'selected' : '' }}>{{ $subject->name }}</option>
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
            $('#grade-icon-' + $("select[name='subject']").val()).click();
        });

        // Initially trigger a change which selects the icon for the selected subject
        $("select[name='subject']").change();

        $("input[name='grade']").focus();
    </script>
@stop