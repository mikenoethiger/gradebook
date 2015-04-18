@extends('app')

@section('head')
    <link href="/css/thumbnail-icon.css" rel="stylesheet">
@stop

@section('title')
    Notenbuch - Schulfach erstellen
@stop

@section('header')
    Schulfach erstellen
@stop

@section('content')
    <form action="{{ url('/subject') }}" method="post">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        <div class="row">
            <div class="col-sm-12 col-md-6 col-lg-4">
                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-inbox"></i></span>
                        <input name="name" class="form-control" placeholder="Name">
                    </div>
                </div>
                <div class="form-group">
                        <textarea name="description" class="form-control"
                                  placeholder="Beschreibung (optional)"></textarea>
                </div>
                <input name="icon" type="hidden">
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12"><label>Icon für dieses Schulfach</label></div>
        </div>

        <div class="row">
            @foreach($icons as $icon)
            <div class="col-lg-2 col-md-3 col-sm-4 col-xs-6">
                <a href="#" class="thumbnail thumbnail-icon">
                    <span class="{{ $icon->class }} fa-5x" data-icon-name="{{ $icon->class }}"></span>
                </a>
            </div>
            @endforeach
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="form-group">
                    <button type="submit" class="btn btn-default">Erstellen</button>
                </div>
            </div>
        </div>
    </form>
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

            $("input[name='icon']").val(clickedIcon.find('span').attr('data-icon-class'));
        });
    </script>

@stop