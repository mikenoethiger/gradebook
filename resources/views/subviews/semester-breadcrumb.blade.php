<div class="row">
    <div class="col-xs-12">
        <ul class="breadcrumb">
            @if (!isset($schoolBreadcrumb) || $schoolBreadcrumb)
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        {{ $activeSchool->name }} <b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu">
                        @foreach ($allSchools as $school)
                            <li>
                                <a href="/school/change/{{ $school->id }}">{{ $school->name }}</a>
                            </li>
                        @endforeach
                    </ul>
                </li>
            @endif
            @if (!isset($semesterBreadcrumb) || $semesterBreadcrumb)
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        Semester {{ $activeSemester->semester_number }} <b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu">
                        @foreach ($allSchoolSemesters as $semester)
                            <li>
                                <a href="#" onclick="$('#change-active-semester-{{ $semester->id }}').submit(); return false;">Semester {{ $semester->semester_number }}</a>
                                <form id='change-active-semester-{{ $semester->id }}' method='POST' action='/semester/change/{{ $semester->id }}'>
                                    <input type='hidden' name='_method' value='PUT'>
                                    <input type='hidden' name='_token' value='{{ csrf_token() }}'>
                                </form>
                            </li>
                        @endforeach
                    </ul>
                </li>
            @endif
        </ul>
    </div>
</div>