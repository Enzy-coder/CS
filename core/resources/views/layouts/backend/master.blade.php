<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> SafeCart - eCommerce HTML Template </title>
    <!-- favicon -->
    <link rel=icon href="{{ asset('assets/favicon-dashboard.png') }}" sizes="16x16" type="icon/png">
    <!-- bootstrap -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap5.min.css') }}">
    <!-- animate -->
    <link rel="stylesheet" href="{{ asset('assets/css/animate.css') }}">
    <!-- slick carousel  -->
    <link rel="stylesheet" href="{{ asset('assets/css/slick.css') }}">
    <!-- LineAwesome -->
    <link rel="stylesheet" href="{{ asset('assets/css/line-awesome.min.css') }}">
    <!-- Plugins css -->
    <link rel="stylesheet" href="{{ asset('assets/css/plugins.css') }}">
    <!-- Main Stylesheet -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
</head>

<body>
    <!-- Dashboard area Starts -->
    <div class="body-overlay"></div>

    <div class="dashboard-area dashboard-padding">
        <div class="container-fluid p-0">
            <div class="dashboard-contents-wrapper">
                <div class="dashboard-icon">
                    <div class="sidebar-icon">
                        <i class="las la-bars"></i>
                    </div>
                </div>
                @include('layouts.backend.sidebar')
                <div class="dashboard-right-contents mt-4 mt-lg-0">
                    @include('layouts.backend.top-header')
                    <div class="wrapper-container">
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Dashboard area end -->


    <!-- jquery -->
    <script src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script>
    <!-- jquery Migrate -->
    <script src="{{ asset('assets/js/jquery-migrate.min.js') }}"></script>
    <!-- bootstrap -->
    <script src="{{ asset('assets/js/bootstrap5.bundle.min.js') }}"></script>
    <!-- Lazy Load Js -->
    <script src="{{ asset('assets/js/jquery.lazy.min.js') }}"></script>
    <!-- Slick Slider -->
    <script src="{{ asset('assets/js/slick.js') }}"></script>
    <!-- All Plugins js -->
    <script src="{{ asset('assets/js/plugins.js') }}"></script>
    <!-- Range Slider -->
    <script src="{{ asset('assets/js/nouislider-8.5.1.min.js') }}"></script>
    <!-- All Plugins two js -->
    <script src="{{ asset('assets/js/plugin-two.js') }}"></script>
    <!-- Nice Scroll -->
    <script src="{{ asset('assets/js/jquery.nicescroll.min.js') }}"></script>
    <!-- Calendar js -->
    <script src="{{ asset('assets/js/calendar-bundle.js') }}"></script>
    <!-- Chart Js -->
    <script src="{{ asset('assets/js/chart.js') }}"></script>
    {{-- Sweetalert --}}
    <script src="{{ asset('assets/backend/js/sweetalert2.js') }}"></script>
    <!-- main js -->
    <script src="{{ asset('assets/js/main.js') }}"></script>
    <script>
        $(document).on('click', '.swal_delete_button', function(e) {
            e.preventDefault();
            Swal.fire({
                title: '{{ __('Are you sure?') }}',
                text: '{{ __('You would not be able to revert this item!') }}',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $(this).next().find('.swal_form_submit_btn').trigger('click');
                }
            });
        });

        // Calendar js
        // https://www.cssscript.com/demo/event-calendar-color

        new Calendar({
            id: '#custom-color-calendar',
        })

        /* Line Charts */
        new Chart(document.getElementById("line-chart"), {
            type: 'line',
            data: {
                labels: ['Sun', 'Mon', "Tue", 'Wed', 'Thu', "Fri", "Sat"],
                datasets: [{
                    data: [265, 270, 268, 272, 270, 267, 270],
                    label: "Earnings",
                    borderColor: "#05cd99",
                    borderWidth: 2,
                    fill: true,
                    backgroundColor: 'rgba(5, 205, 153,.08)',
                    fillBackgroundColor: "#f9503e",
                    pointBorderWidth: 2,
                    pointBackgroundColor: '#fff',
                    pointRadius: 3,
                    pointHoverRadius: 3,
                    pointHoverBackgroundColor: "#05cd99",
                }, ]
            },
        });

        /* Line Chart Two */
        new Chart(document.getElementById("line-chart-two"), {
            type: 'line',
            data: {
                labels: ['Sun', 'Mon', "Tue", 'Wed', 'Thu', "Fri", "Sat"],
                datasets: [{
                    data: [368, 371, 369, 371, 370, 369, 370],
                    label: "Show Data",
                    borderColor: "#05cd99",
                    borderWidth: 2,
                    fill: false,
                    fillBackgroundColor: "#000",
                    pointBorderWidth: 2,
                    pointBackgroundColor: '#fff',
                    pointRadius: 3,
                    pointHoverRadius: 3,
                    pointHoverBackgroundColor: "#05cd99",
                }, ]
            },
        });

        /* Line Chart Three */
        new Chart(document.getElementById("line-chart-three"), {
            type: 'line',
            data: {
                labels: ['Sun', 'Mon', "Tue", 'Wed', 'Thu', "Fri", "Sat"],
                datasets: [{
                    data: [366, 365, 368, 371, 370, 369, 370],
                    label: "Show Data",
                    borderColor: "#05cd99",
                    borderWidth: 2,
                    fill: false,
                    fillBackgroundColor: "#000",
                    pointBorderWidth: 2,
                    pointBackgroundColor: '#fff',
                    pointRadius: 3,
                    pointHoverRadius: 3,
                    pointHoverBackgroundColor: "#05cd99",
                }, ]
            },
        });



        /*  Bar Charts */
        new Chart(document.getElementById("bar-chart"), {
            type: 'bar',
            data: {
                labels: ['Jan', 'Feb', "Mar", 'Apr', 'May', "Jun", "July", 'Aug', "Sep", 'Oct', 'Nov', 'Dec'],
                datasets: [{
                    label: "Statement",
                    backgroundColor: "#e9edf7",
                    data: [100, 200, 150, 180, 130, 250, 120, 200, 70, 160, 100, 170],
                    barThickness: 15,
                    hoverBackgroundColor: '#05cd99',
                    hoverBorderColor: '#05cd99',
                    borderRadius: 5,
                    minBarLength: 50,
                    indexAxis: "x",
                    pointStyle: 'star',
                }, ]
            },
        });

        /*  Bar Charts Two */
        new Chart(document.getElementById("bar-chart-two"), {
            type: 'bar',
            data: {
                labels: ['Sun', 'Mon', "Tue", 'Wed', 'Thu', "Fri", "Sat"],
                datasets: [{
                    label: "On track",
                    backgroundColor: "#e9edf7",
                    data: [120, 270, 100, 310, 80, 200, 270],
                    barThickness: 15,
                    hoverBackgroundColor: '#05cd99',
                    hoverBorderColor: '#05cd99',
                    borderRadius: 5,
                    indexAxis: "x",
                    pointStyle: 'star',
                }, ]
            },
        });
    </script>
    @include('frontend.partials.scripts.footer-scripts')

</body>

</html>
