<!DOCTYPE html>
<html lang="uz">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dars jadvali</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{secure_asset('site/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{secure_asset('site/select2.min.css')}}">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{secure_asset('site/font-awesome-4.7.0/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Custom CSS -->
    <style>
        .schedule-card {
            background-color: #f8f9fa;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease-in-out;
        }

        .schedule-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 12px rgba(0, 0, 0, 0.2);
        }

        .schedule-card .card-body {
            padding: 20px;
        }

        .schedule-card .subject-icon {
            font-size: 24px;
            margin-right: 10px;
        }

        @media (max-width: 767.98px) {
            .schedule-card .subject-icon {
                font-size: 18px;
            }

            .schedule-card .card-body {
                padding: 15px;
            }
        }
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">
        <img src="{{secure_asset('site/timetable.png')}}" width="30" height="30" class="d-inline-block align-top" alt="Timetable">
        Dars jadvali
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <!-- Navbar items -->
    </div>
</nav>

<div class="container-fluid mt-5 pl-3">
    <div class="row">
        <!-- Left Card -->
        <div class="col-lg-3 col-md-4 col-sm-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Filtr</h5>
                    <form action="/" method="GET">
                        <div class="form-row">
                            <div class="col">
                                <label for="start" class="small">Dan</label>
                                <input class="form-control form-control-sm" type="date" id="start" value="{{$startDate}}" name="start_date">
                            </div>
                            <div class="col">
                                <label for="end" class="small">Gacha</label>
                                <input class="form-control form-control-sm" id="end" type="date" value="{{$endDate}}" name="end_date">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="group_select" class="small">Guruh tanlang</label>
                            <select class="form-control form-control-sm" name="group_id" id="group_select">
                                <option value="0">Barchasi</option>
                                @foreach($groups as $group)
                                    <option
                                        @if($group->id == $selectedGroup)
                                            selected
                                        @endif
                                        value="{{$group->id}}">{{$group->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="auditory_select" class="small">Auditoriya tanlang</label>
                            <select class="form-control form-control-sm" name="auditorium_id" id="auditory_select">
                                <option value="0">Barchasi</option>
                                @foreach($auditoriums as $auditorium)
                                    <option
                                        @if($auditorium->id == $selectedAuditorium)
                                            selected
                                        @endif
                                        value="{{$auditorium->id}}">{{$auditorium->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="teacher_select" class="small">Kafedra tanlang</label>
                                <select class="form-control form-control-sm" name="department_id" id="department_select">
                                <option value="0">Barchasi</option>
                                @foreach($departments as $department)
                                    <option
                                        @if($department->id == $selectedDepartment)
                                            selected
                                        @endif
                                        value="{{$department->id}}">{{$department->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="teacher_select" class="small">O'qituvchi tanlang</label>
                            <select class="form-control form-control-sm" name="teacher_id" id="teacher_select">
                                <option value="0">Barchasi</option>
                                @foreach($teachers as $teacher)
                                    <option
                                        @if($teacher->id == $selectedTeacher)
                                            selected
                                        @endif
                                        value="{{$teacher->id}}">{{$teacher->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="subject_select" class="small">Fan tanlang</label>
                            <select class="form-control form-control-sm" name="subject_id" id="subject_select">
                                <option value="0">Barchasi</option>
                                @foreach($subjects as $subject)
                                    <option
                                        @if($subject->id == $selectedSubject)
                                            selected
                                        @endif
                                        value="{{$subject->id}}">{{$subject->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
{{--                            lesson pair--}}
                            <label for="lesson_pair" class="small">Dars vaqti tanlang</label>
                            <select class="form-control form-control-sm" name="lesson_pair" id="lesson_pair">
                                <option value="0">Barchasi</option>
                                @foreach($lessonPairs as $lessonPair)
                                    <option
                                        @if($lessonPair->id == $selectedLessonPair)
                                            selected
                                        @endif
                                        value="{{$lessonPair->id}}">{{$lessonPair->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary btn-sm btn-block">Filtrlash</button>
                    </form>
                </div>
            </div>
        </div>
        <!-- Right Card -->
        <div class="col-lg-9 col-md-8 col-sm-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Dars Jadvali</h5>
                    <div class="row row-cols-lg-3 row-cols-md-2 row-cols-1">
                        @foreach($items as $item)
                            <div class="col mb-4">
                                <div class="card schedule-card">
                                    <div class="card-body">
                                        <h6 class="card-title d-flex align-items-center">
                                            <i class="subject-icon fas fa-book"></i>
                                            {{$item->subject->name}}
                                        </h6>
                                        <p class="card-text"><i class="fas fa-users"></i> {{$item->group->name}}</p>
                                        <p class="card-text"><i class="fas fa-chalkboard-teacher"></i> {{$item->employee->name}}</p>
                                        <p class="card-text"><i class="fas fa-building"></i> {{$item->auditorium->name}}</p>
                                        <p class="card-text"><i class="fas fa-graduation-cap"></i> {{$item->trainingType->name}}</p>
                                        <p class="card-text"><i class="fas fa-clock"></i> {{$item->lessonPair->start_time}} - {{$item->lessonPair->end_time}}</p>
                                        <p class="card-text"><i class="fas fa-calendar-alt"></i> {{date("Y-m-d",$item->lesson_date)}}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="{{secure_asset('site/jquery-3.5.1.slim.min.js')}}"></script>
<script src="{{secure_asset('site/popper.min.js')}}"></script>
<script src="{{secure_asset('site/bootstrap.min.js')}}"></script>
<script src="{{secure_asset('site/select2.min.js')}}"></script>
<script>
    $(document).ready(function() {
        $('#group_select').select2();
        $('#auditory_select').select2();
        $('#teacher_select').select2();
        $('#subject_select').select2();
        $('#department_select').select2();
    });
</script>
<script>
    $(document).ready(function() {
        var teachers = @JSON($teachers);
        $('#department_select').change(function() {
            var selectedDepartmentId = $(this).val();
            var selectedTeacherId = @JSON($selectedTeacher);
            // Clear the teacher select box
            $('#teacher_select').empty();

            // Add the default option
            $('#teacher_select').append(new Option('Barchasi', '0'));

            // Loop through the teachers array
            $.each(teachers, function(teacherId, teacher) {
                // Check if the department id matches the selected department id
                if (teacher.department_id == selectedDepartmentId || selectedDepartmentId == 0) {
                    // If it matches, create a new option and append it to the teacher select box
                    if (teacherId == selectedTeacherId) {
                        $('#teacher_select').append(new Option(teacher.name, teacherId, true, true));
                    } else {
                        $('#teacher_select').append(new Option(teacher.name, teacherId));
                    }
                }
            });
        }).change();
    });
</script>
</body>
</html>
