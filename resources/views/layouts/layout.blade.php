<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="favicon.ico">
    <title>outilComptable</title>

    <!-- Simple bar CSS -->
    <link rel="stylesheet" href="{{asset('css/dashboard/css/simplebar.css')}}">
    <!-- Fonts CSS -->
    <link
        href="https://fonts.googleapis.com/css2?family=Overpass:ital,wght@0,100;0,200;0,300;0,400;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <!-- Icons CSS -->
    <link rel="stylesheet" href="{{asset('css/dashboard/css/feather.css') }}">
    <link rel="stylesheet" href="{{asset('css/dashboard/css/select2.css') }}">
    <link rel="stylesheet" href="{{asset('css/dashboard/css/dropzone.css') }}">
    <link rel="stylesheet" href="{{asset('css/dashboard/css/uppy.min.css') }}">
    <link rel="stylesheet" href="{{asset('css/dashboard/css/jquery.steps.css') }}">
    <link rel="stylesheet" href="{{asset('css/dashboard/css/jquery.timepicker.css') }}">
    <link rel="stylesheet" href="{{asset('css/dashboard/css/quill.snow.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.css"/>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"/>
    <!-- Date Range Picker CSS -->
    <link rel="stylesheet" href="{{asset('css/dashboard/css/daterangepicker.css') }}">
    <!-- App CSS -->
    <link rel="stylesheet" href="{{asset('css/dashboard/css/app-light.css') }}" id="lightTheme">
    <link rel="stylesheet" href="{{asset('css/dashboard/css/app-dark.css') }}" id="darkTheme" disabled>
    <style>
        .chat {
            list-style: none;
            margin: 0;
            padding: 0;
        }

        .chat li {
            margin-bottom: 10px;
            padding-bottom: 5px;
            border-bottom: 1px dotted #B3A9A9;
        }

        .chat li .chat-body p {
            margin: 0;
            color: #777777;
        }

        .panel-body {
            overflow-y: scroll;
            height: 350px;
        }

        ::-webkit-scrollbar-track {
            -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.3);
            background-color: #F5F5F5;
        }

        ::-webkit-scrollbar {
            width: 12px;
            background-color: #F5F5F5;
        }

        ::-webkit-scrollbar-thumb {
            -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, .3);
            background-color: #555;
        }
    </style>
    @livewireStyles
</head>
<body class="vertical  light">

<div id="app" class="wrapper">
    <nav class="topnav navbar navbar-light">
        <button type="button" class="navbar-toggler text-muted mt-2 p-0 mr-3 collapseSidebar">
            <i class="fe fe-menu navbar-toggler-icon"></i>
        </button>
        <ul class="nav">
            <li class="nav-item">
                <a class="nav-link text-muted my-2" href="#" id="modeSwitcher" data-mode="light">
                    <i class="fe fe-sun fe-16"></i>
                </a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle text-muted pr-0" href="#" id="navbarDropdownMenuLink" role="button"
                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <span class="avatar avatar-sm mt-2">
                <img src="{{asset(auth()->user()->profile_photo_url)}}" alt="..." class="avatar-img rounded-circle">
              </span>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                    <a class="dropdown-item" href="{{ route('profile.show') }}">Profile</a>
                    <a class="dropdown-item" href="#">Settings</a>
                    <a class="dropdown-item" href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">Logout</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </li>
        </ul>
    </nav>
    <aside class="sidebar-left border-right bg-white shadow" id="leftSidebar" data-simplebar>
        <a href="#" class="btn collapseSidebar toggle-btn d-lg-none text-muted ml-2 mt-3" data-toggle="toggle">
            <i class="fe fe-x"><span class="sr-only"></span></i>
        </a>
        <nav class="vertnav navbar navbar-light">
            <!-- nav bar -->
            <div class="w-100 mb-4 d-flex">
                <a class="navbar-brand mx-auto mt-2 flex-fill text-center" href="{{route('home')}}">
                    <img width="100" src="{{asset('assets/images/favicon.png')}}" alt="Logo">
                </a>
            </div>
            <p class="text-muted nav-heading mt-4 mb-1">
                <span>Dashboard</span>
            </p>
            <ul class="navbar-nav flex-fill w-100 mb-2">
                @include("layouts.menu")
            </ul>
        </nav>
    </aside>
    <main role="main" class="main-content">
        <div class="container-fluid">
            @yield('content')
        </div> <!-- .row -->
    </main>
</div> <!-- .container-fluid -->
<div class="modal fade modal-notif modal-slide" tabindex="-1" role="dialog" aria-labelledby="defaultModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="defaultModalLabel">Notifications</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="list-group list-group-flush my-n3">
                    <div class="list-group-item bg-transparent">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <span class="fe fe-box fe-24"></span>
                            </div>
                            <div class="col">
                                <small><strong>Package has uploaded successfull</strong></small>
                                <div class="my-0 text-muted small">Package is zipped and uploaded</div>
                                <small class="badge badge-pill badge-light text-muted">1m ago</small>
                            </div>
                        </div>
                    </div>
                    <div class="list-group-item bg-transparent">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <span class="fe fe-download fe-24"></span>
                            </div>
                            <div class="col">
                                <small><strong>Widgets are updated successfull</strong></small>
                                <div class="my-0 text-muted small">Just create new layout Index, form, table</div>
                                <small class="badge badge-pill badge-light text-muted">2m ago</small>
                            </div>
                        </div>
                    </div>
                    <div class="list-group-item bg-transparent">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <span class="fe fe-inbox fe-24"></span>
                            </div>
                            <div class="col">
                                <small><strong>Notifications have been sent</strong></small>
                                <div class="my-0 text-muted small">Fusce dapibus, tellus ac cursus commodo</div>
                                <small class="badge badge-pill badge-light text-muted">30m ago</small>
                            </div>
                        </div> <!-- / .row -->
                    </div>
                    <div class="list-group-item bg-transparent">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <span class="fe fe-link fe-24"></span>
                            </div>
                            <div class="col">
                                <small><strong>Link was attached to menu</strong></small>
                                <div class="my-0 text-muted small">New layout has been attached to the menu</div>
                                <small class="badge badge-pill badge-light text-muted">1h ago</small>
                            </div>
                        </div>
                    </div> <!-- / .row -->
                </div> <!-- / .list-group -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-block" data-dismiss="modal">Clear All</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade modal-shortcut modal-slide" tabindex="-1" role="dialog" aria-labelledby="defaultModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="defaultModalLabel">Shortcuts</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body px-5">
                <div class="row align-items-center">
                    <div class="col-6 text-center">
                        <div class="squircle bg-success justify-content-center">
                            <i class="fe fe-cpu fe-32 align-self-center text-white"></i>
                        </div>
                        <p>Control area</p>
                    </div>
                    <div class="col-6 text-center">
                        <div class="squircle bg-primary justify-content-center">
                            <i class="fe fe-activity fe-32 align-self-center text-white"></i>
                        </div>
                        <p>Activity</p>
                    </div>
                </div>
                <div class="row align-items-center">
                    <div class="col-6 text-center">
                        <div class="squircle bg-primary justify-content-center">
                            <i class="fe fe-droplet fe-32 align-self-center text-white"></i>
                        </div>
                        <p>Droplet</p>
                    </div>
                    <div class="col-6 text-center">
                        <div class="squircle bg-primary justify-content-center">
                            <i class="fe fe-upload-cloud fe-32 align-self-center text-white"></i>
                        </div>
                        <p>Upload</p>
                    </div>
                </div>
                <div class="row align-items-center">
                    <div class="col-6 text-center">
                        <div class="squircle bg-primary justify-content-center">
                            <i class="fe fe-users fe-32 align-self-center text-white"></i>
                        </div>
                        <p>Users</p>
                    </div>
                    <div class="col-6 text-center">
                        <div class="squircle bg-primary justify-content-center">
                            <i class="fe fe-settings fe-32 align-self-center text-white"></i>
                        </div>
                        <p>Settings</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('js/jquery.min.js') }}"></script>
@livewireScripts
<script src="{{ asset('js/select2.min.js') }}"></script>
<script src="{{ mix('js/app.js') }}"></script>

<script src="{{ asset('js/apps.js') }}"></script>

<script src="{{ asset('js/popper.min.js') }}"></script>
<script src="{{ asset('js/moment.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/simplebar.min.js') }}"></script>
<script src="{{ asset('js/daterangepicker.js') }}"></script>
<script src="{{ asset('js/jquery.stickOnScroll.js') }}"></script>
<script src="{{ asset('js/tinycolor-min.js')}}"></script>
<script src="{{ asset('js/config.js') }}"></script>
<script src="{{ asset('js/d3.min.js') }}"></script>
<script src="{{ asset('js/topojson.min.js') }}"></script>
<script src="{{ asset('js/datamaps.all.min.js') }}"></script>
<script src="{{ asset('js/datamaps-zoomto.js') }}"></script>
<script src="{{ asset('js/datamaps.custom.js') }}"></script>
<script src="{{ asset('js/Chart.min.js') }}"></script>
<script>
    /* defind global options */
    Chart.defaults.global.defaultFontFamily = base.defaultFontFamily;
    Chart.defaults.global.defaultFontColor = colors.mutedColor;
</script>
<script src="{{ asset('js/gauge.min.js') }}"></script>
<script src="{{ asset('js/jquery.sparkline.min.js') }}"></script>
<script src="{{ asset('js/apexcharts.min.js') }}"></script>
<script src="{{ asset('js/apexcharts.custom.js') }}"></script>
<script src="{{ asset('js/jquery.mask.min.js') }}"></script>
<script src="{{ asset('js/jquery.steps.min.js') }}"></script>
<script src="{{ asset('js/jquery.validate.min.js') }}"></script>
<script src="{{ asset('js/jquery.timepicker.js') }}"></script>
<script src="{{ asset('js/dropzone.min.js') }}"></script>
<script src="{{ asset('js/uppy.min.js') }}"></script>
<script src="{{ asset('js/quill.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.js"></script>
<script>

    $(document).ready(function () {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var calendar = $('#calendar').fullCalendar({
            editable: true,

            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay'
            },
            events: '/dashboard/calendrier',
            eventBackgroundColor: '#1b68ff',
            eventTextColor: 'white',
            selectable: true,
            selectHelper: true,
            select: function (start, end, allDay) {

                var title = prompt('Event title:');

                if (title) {
                    var start = $.fullCalendar.formatDate(start, 'Y-MM-DD HH:mm:ss');

                    var end = $.fullCalendar.formatDate(end, 'Y-MM-DD HH:mm:ss');

                    $.ajax({
                        url: "/dashboard/calendrier/action",
                        type: "POST",

                        data: {
                            title: title,
                            start: start,
                            end: end,
                            type: 'add'
                        },
                        success: function (data) {
                            calendar.fullCalendar('refetchEvents');
                            alert('événement créé avec succès');
                        },
                        error: function (data) {
                            console.log(data);
                        }
                    })
                }
            },
            editable: true,
            eventResize: function (event, delta) {
                var start = $.fullCalendar.formatDate(event.start, 'Y-MM-DD HH:mm:ss');
                var end = $.fullCalendar.formatDate(event.end, 'Y-MM-DD HH:mm:ss');
                var title = event.title;
                var id = event.id;
                $.ajax({
                    url: "/dashboard/calendrier/action",
                    type: "POST",
                    data: {
                        title: title,
                        start: start,
                        end: end,
                        id: id,
                        type: 'update'
                    },
                    success: function (response) {
                        calendar.fullCalendar('refetchEvents');

                        alert("Événement mis à jour avec succès");
                    }
                })
            },
            eventDrop: function (event, delta) {
                var start = $.fullCalendar.formatDate(event.start, 'Y-MM-DD HH:mm:ss');
                var end = $.fullCalendar.formatDate(event.end, 'Y-MM-DD HH:mm:ss');
                var title = event.title;
                var id = event.id;
                $.ajax({
                    url: "/dashboard/calendrier/action",
                    type: "POST",
                    data: {
                        title: title,
                        start: start,
                        end: end,
                        id: id,
                        type: 'update'
                    },
                    success: function (response) {
                        calendar.fullCalendar('refetchEvents');
                        alert("Événement mis à jour avec succès");
                    }
                })
            },

            eventClick: function (event) {
                if (confirm("Voulez-vous vraiment le supprimer?")) {
                    var id = event.id;
                    $.ajax({
                        url: "/dashboard/calendrier/action",
                        type: "POST",
                        data: {
                            id: id,
                            type: "delete"
                        },
                        success: function (response) {
                            calendar.fullCalendar('refetchEvents');
                            alert("Événement supprimé avec succès");
                        }
                    })
                }
            }
        });

    });
</script>
<script>
    $('.select2').select2(
        {
            theme: 'bootstrap4',
        });
    $('.select2-multi').select2(
        {
            multiple: true,
            theme: 'bootstrap4',
        });
    $('.drgpicker').daterangepicker(
        {
            singleDatePicker: true,
            timePicker: false,
            showDropdowns: true,
            locale:
                {
                    format: 'MM/DD/YYYY'
                }
        });
    $('.time-input').timepicker(
        {
            'scrollDefault': 'now',
            'zindex': '9999' /* fix modal open */
        });
    /** date range picker */
    if ($('.datetimes').length) {
        $('.datetimes').daterangepicker(
            {
                timePicker: true,
                startDate: moment().startOf('hour'),
                endDate: moment().startOf('hour').add(32, 'hour'),
                locale:
                    {
                        format: 'M/DD hh:mm A'
                    }
            });
    }
    var start = moment().subtract(29, 'days');
    var end = moment();

    function cb(start, end) {
        $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
    }

    $('#reportrange').daterangepicker(
        {
            startDate: start,
            endDate: end,
            ranges:
                {
                    'Today': [moment(), moment()],
                    'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                    'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                    'This Month': [moment().startOf('month'), moment().endOf('month')],
                    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                }
        }, cb);
    cb(start, end);
    $('.input-placeholder').mask("00/00/0000",
        {
            placeholder: "__/__/____"
        });
    $('.input-zip').mask('00000-000',
        {
            placeholder: "____-___"
        });
    $('.input-money').mask("#.##0,00",
        {
            reverse: true
        });
    $('.input-phoneus').mask('(000) 000-0000');
    $('.input-mixed').mask('AAA 000-S0S');
    $('.input-ip').mask('0ZZ.0ZZ.0ZZ.0ZZ',
        {
            translation:
                {
                    'Z':
                        {
                            pattern: /[0-9]/,
                            optional: true
                        }
                },
            placeholder: "___.___.___.___"
        });
    // editor
    var editor = document.getElementById('editor');
    if (editor) {
        var toolbarOptions = [
            [
                {
                    'font': []
                }],
            [
                {
                    'header': [1, 2, 3, 4, 5, 6, false]
                }],
            ['bold', 'italic', 'underline', 'strike'],
            ['blockquote', 'code-block'],
            [
                {
                    'header': 1
                },
                {
                    'header': 2
                }],
            [
                {
                    'list': 'ordered'
                },
                {
                    'list': 'bullet'
                }],
            [
                {
                    'script': 'sub'
                },
                {
                    'script': 'super'
                }],
            [
                {
                    'indent': '-1'
                },
                {
                    'indent': '+1'
                }], // outdent/indent
            [
                {
                    'direction': 'rtl'
                }], // text direction
            [
                {
                    'color': []
                },
                {
                    'background': []
                }], // dropdown with defaults from theme
            [
                {
                    'align': []
                }],
            ['clean'] // remove formatting button
        ];
        var quill = new Quill(editor,
            {
                modules:
                    {
                        toolbar: toolbarOptions
                    },
                theme: 'snow'
            });
    }
    // Example starter JavaScript for disabling form submissions if there are invalid fields
    (function () {
        'use strict';
        window.addEventListener('load', function () {
            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.getElementsByClassName('needs-validation');
            // Loop over them and prevent submission
            var validation = Array.prototype.filter.call(forms, function (form) {
                form.addEventListener('submit', function (event) {
                    if (form.checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        }, false);
    })();
</script>
<script>
    var uptarg = document.getElementById('drag-drop-area');
    if (uptarg) {
        var uppy = Uppy.Core().use(Uppy.Dashboard,
            {
                inline: true,
                target: uptarg,
                proudlyDisplayPoweredByUppy: false,
                theme: 'dark',
                width: 770,
                height: 210,
                plugins: ['Webcam']
            }).use(Uppy.Tus,
            {
                endpoint: 'https://master.tus.io/files/'
            });
        uppy.on('complete', (result) => {
            console.log('Upload complete! We’ve uploaded these files:', result.successful)
        });
    }
</script>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-56159088-1"></script>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
@yield('scriptJs')

@if(auth()->user())
    <script>
        window.user =@json(
    [
        "user"=>auth()->user(),
    ]
    );
    </script>
@endif

<script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
        dataLayer.push(arguments);
    }

    gtag('js', new Date());
    gtag('config', 'UA-56159088-1');
</script>
</body>
</html>
