<!DOCTYPE html>
<html lang="en-US">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Required meta tags -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>Codelynn - Yii+Laravel & React Bootstrap Admin Dashboard Template</title>

<!-- All Library CSS -->

<link href="css/bootstrap.min.css" rel="stylesheet" />
<link href="css/LineIcons.css" rel="stylesheet">
<link href="css/viewer.min.css" rel="stylesheet">
<link href="css/icofont.min.css" rel="stylesheet">
<link href="css/calendar.css" rel="stylesheet">
<!-- Custom CSS -->
<link href="css/styles.css" rel="stylesheet">
<link href="css/responsive.css" rel="stylesheet">
<!-- Favicon -->
<link rel="shortcut icon" href="favicon.ico">    <meta name="csrf-param" content="_csrf">
<meta name="csrf-token" content="XygOqr-6UHNrvS3Vte4vy8qf9-SS6V4cuYGQCqGGNk86enz6-cMEQBz_Ref5r0Sf_PbCovC8bkbaxuVf77d0Pg==">


@vite(['resources/sass/app.scss', 'resources/js/app.js'])

</head>

<body>
    
    <body>
					<nav class="navbar navbar-expand fixed-top top-menu">
    <a class="navbar-brand" href="index.html">
        <!-- Large logo -->
        <img class="large-logo" src="images/large-logo.png" alt="Logo">        <!-- Small logo -->
        <img class="small-logo" src="images/small-logo.png" alt="Logo">    </a>

    <!-- Burger menu -->
    <div class="burger-menu toggle-menu">
        <span class="top-bar"></span>
        <span class="middle-bar"></span>
        <span class="bottom-bar"></span>
    </div>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <!-- Mega Menu -->
      
        <!-- Search form -->
      
        <!-- Right nav -->
        <ul class="navbar-nav right-nav ml-auto">
            <!-- Email Notification dropdown -->
            <!-- Profile dropdown -->
            <li class="nav-item dropdown profile-nav-item">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <div class="menu-profile">
                        <span class="name">  {{ Auth::user()->name }}</span>
                </a>
                <div class="dropdown-menu">
                    <a class="dropdown-item"  href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                        <i data-feather="log-out" class="icon"></i>
                        {{ __('Logout') }}
                    </a>
                </div>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>

            </li>
        </ul>
    </div>
</nav>		
			<!-- Side Menu -->
			<div class="sidemenu-area sidemenu-toggle default">
    <nav class="sidemenu navbar navbar-expand navbar-light hide-nav-title">
        <div class="navbar-collapse collapse">
            <div class="navbar-nav">
                <div class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <div class="dropdown-title">
                            <i data-feather="grid" class="icon"></i>
                            <span class="title">
                                Dashboard
                                <i data-feather="chevron-right" class="icon fr"></i>
                            </span>
                        </div>
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="index.html">
                            <i data-feather="chevron-right" class="icon"></i>
                            Sales
                        </a>
                        <a class="dropdown-item" href="dashboard2.html">
                            <i data-feather="chevron-right" class="icon"></i>
                            eCommerce
                        </a>
                        <a class="dropdown-item" href="dashboard3.html">
                            <i data-feather="chevron-right" class="icon"></i>
                            Analytics
                        </a>
						<a class="dropdown-item" href="dashboard4.html">
                            <i data-feather="chevron-right" class="icon"></i>
                            CRM
                        </a>
						<a class="dropdown-item" href="dashboard5.html">
                            <i data-feather="chevron-right" class="icon"></i>
                            Project
                        </a>
                    </div>
                </div>

                <a class="nav-link" href="app/inbox.html">
                    <i data-feather="inbox" class="icon"></i>
                    <span class="title">Inbox</span>
                </a>
                <a class="nav-link" href="app/chat.html">
                    <i data-feather="message-square" class="icon"></i>
                    <span class="title">Chat</span>
                </a>
                <a class="nav-link" href="app/todos.html">
                    <i data-feather="check-square" class="icon"></i>
                    <span class="title">Todo List</span>
                </a>
                <a class="nav-link" href="app/notes.html">
                    <i data-feather="file-text" class="icon"></i>
                    <span class="title">Notes</span>
                </a>
                <a class="nav-link" href="app/calendar.html">
                    <i data-feather="calendar" class="icon"></i>
                    <span class="title">Calendar</span>
                </a>
                <a class="nav-link" href="page/search.html">
                    <i data-feather="search" class="icon"></i>
                    <span class="title">Search</span>
                </a>

                <div class="nav-item dropdown super-color">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <div class="dropdown-title">
                            <i data-feather="filter" class="icon"></i>
                            <span class="title">
                                UI Components
                                <i data-feather="chevron-right" class="icon fr"></i>
                            </span>
                        </div>
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="ui-component/alerts.html">
                            <i data-feather="bell" class="icon"></i>
                            Alerts
                        </a>
                        <a class="dropdown-item" href="ui-component/badges.html">
                            <i data-feather="award" class="icon"></i>
                            Badges
                        </a>
                        <a class="dropdown-item" href="ui-component/buttons.html">
                            <i data-feather="arrow-right-circle" class="icon"></i>
                            Buttons
                        </a>
                        <a class="dropdown-item" href="ui-component/cards.html">
                            <i data-feather="layers" class="icon"></i>
                            Cards
                        </a>
                        <a class="dropdown-item" href="ui-component/dropdowns.html">
                            <i data-feather="arrow-down-circle" class="icon"></i>
                            Dropdowns
                        </a>
                        <a class="dropdown-item" href="ui-component/forms.html">
                            <i data-feather="file-text" class="icon"></i>
                            Forms
                        </a>
                        <a class="dropdown-item" href="ui-component/list-groups.html">
                            <i data-feather="list" class="icon"></i>
                            List Groups
                        </a>
                        <a class="dropdown-item" href="ui-component/modals.html">
                            <i data-feather="airplay" class="icon"></i>
                            Modals
                        </a>
                        <a class="dropdown-item" href="ui-component/progress-bars.html">
                            <i data-feather="trending-up" class="icon"></i>
                            Progress Bars
                        </a>
                        <a class="dropdown-item" href="ui-component/tables.html">
                            <i data-feather="database" class="icon"></i>
                            Tables
                        </a>
                        <a class="dropdown-item" href="ui-component/tabs.html">
                            <i data-feather="triangle" class="icon"></i>
                            Tabs
                        </a>
                    </div>
                </div>

                <div class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <div class="dropdown-title">
                            <i data-feather="user" class="icon"></i>
                            <span class="title">
                                User
                                <i data-feather="chevron-right" class="icon fr"></i>
                            </span>
                        </div>
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="user/signup.html">
                            <i data-feather="user-plus" class="icon"></i>
                            Sign Up
                        </a>
                        <a class="dropdown-item" href="user/login.html">
                            <i data-feather="user-check" class="icon"></i>
                            Login
                        </a>
                        <a class="dropdown-item" href="user/forgot-password.html">
                            <i data-feather="unlock" class="icon"></i>
                            Forgot Password
                        </a>
                    </div>
                </div>

                <div class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <div class="dropdown-title">
                            <i data-feather="bar-chart-2" class="icon"></i>
                            <span class="title">
                                Charts
                                <i data-feather="chevron-right" class="icon fr"></i>
                            </span>
                        </div>
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="chart/line-chart.html">
                            <i data-feather="chevron-right" class="icon"></i>
                            Line Chart
                        </a>
                        <a class="dropdown-item" href="chart/area-chart.html">
                            <i data-feather="chevron-right" class="icon"></i>
                            Area Chart
                        </a>
                        <a class="dropdown-item" href="chart/column-chart.html">
                            <i data-feather="chevron-right" class="icon"></i>
                            Column Chart
                        </a>
                        <a class="dropdown-item" href="chart/bar-chart.html">
                            <i data-feather="chevron-right" class="icon"></i>
                            Bar Chart
                        </a>
                        <a class="dropdown-item" href="chart/mixed-chart.html">
                            <i data-feather="chevron-right" class="icon"></i>
                            Mixed Chart
                        </a>
                        <a class="dropdown-item" href="chart/pie-donuts-chart.html">
                            <i data-feather="chevron-right" class="icon"></i>
                            Pie and Donuts Chart
                        </a>
                    </div>
                </div>

                <div class="dropdown nav-item">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <div class="dropdown-title">
                            <i data-feather="heart" class="icon"></i>
                            <span class="title">
                                Icons
                                <i data-feather="chevron-right" class="icon fr"></i>
                            </span>
                        </div>
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="icon/feather-icons.html">
                            <i data-feather="chevron-right" class="icon"></i>
                            Feather Icons
                        </a>
                        <a class="dropdown-item" href="icon/line-icons.html">
                            <i data-feather="chevron-right" class="icon"></i>
                            Line Icons
                        </a>
                        <a class="dropdown-item" href="icon/icofont-icons.html">
                            <i data-feather="chevron-right" class="icon"></i>
                            Icofont Icons
                        </a>
                    </div>
                </div>

                <div class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <div class="dropdown-title">
                            <i data-feather="file-text" class="icon"></i>
                            <span class="title">
                                Pages
                                <i data-feather="chevron-right" class="icon fr"></i>
                            </span>
                        </div>
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="page/invoice.html">
                            <i data-feather="chevron-right" class="icon"></i>
                            Invoice
                        </a>
                        <a class="dropdown-item" href="page/users-card.html">
                            <i data-feather="chevron-right" class="icon"></i>
                            Users Card
                        </a> 
                        <a class="dropdown-item" href="page/notifications.html">
                            <i data-feather="chevron-right" class="icon"></i>
                            <span class="title">Notifications</span>
                        </a>
                        <a class="dropdown-item" href="page/timeline.html">
                            <i data-feather="chevron-right" class="icon"></i>
                            Timeline
                        </a>
                        <a class="dropdown-item" href="page/gallery.html">
                            <i data-feather="chevron-right" class="icon"></i>
                            Gallery
                        </a>
                        <a class="dropdown-item" href="page/faq.html">
                            <i data-feather="chevron-right" class="icon"></i>
                            FAQ
                        </a>
                        <a class="dropdown-item" href="page/pricing.html">
                            <i data-feather="chevron-right" class="icon"></i>
                            Pricing
                        </a>
                        <a class="dropdown-item" href="page/profile.html">
                            <i data-feather="chevron-right" class="icon"></i>
                            Profile
                        </a>
                        <a class="dropdown-item" href="page/profile-settings.html">
                            <i data-feather="chevron-right" class="icon"></i>
                            Profile Settings
                        </a>
                        <a class="dropdown-item" href="page/error-404.html">
                            <i data-feather="chevron-right" class="icon"></i>
                            Error 404
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </nav>
</div>

<div class="main-content d-flex flex-column hide-sidemenu">
            @yield('content')
</div>
KHAID


<div class="flex-grow-1"></div>
<footer class="footer mt-1">
    <p>Copyright © 2019 Codelynn. All rights reserved</p>
</footer>			</div>
			<!-- End Main Content Wrapper -->
		
        <!-- Theme Color customizer Right Modal -->
        <div class="customizer-toggle" data-toggle="modal" data-target="#ThemeColorCustomizer">
    <i data-feather="settings" class="spin icon mt-minus-2"></i>
</div>

<div class="modal right color-customizer-modal fade" id="ThemeColorCustomizer">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel2">Theme Color Customizer</h4>
            </div>

            <div class="modal-body">
                <!-- Left SideMenu Color Switcher -->
                <div class="color-content">
                    <h5>Left SideMenu Color</h5>
                    <p class="mb-2">Change SideMenu background color</p>
                    <ul class="customize-sidemenu">
                        <li id="BGPrimary" class="bg_primary"></li>
                        <li id="BGPurpleIndigo" class="purple_indigo"></li>
                        <li id="BGPink" class="bg_pink"></li>
                        <li id="BGnNightBlue" class="bg_night_blue"></li>
                        <li id="BGIndigo" class="bg_indigo"></li>
                        <li id="BGSuccess" class="bg_success"></li>
                        <li id="BGSecondary" class="bg_secondary"></li>
                        <li id="BGPurple" class="bg_purple"></li>
                        <li id="BGGray" class="bg_gray"></li>
                        <li id="BGDanger" class="bg_danger"></li>
                        <li id="BGGrayBlue" class="bg_gray_blue"></li>
                        <li id="BGGreen" class="bg_green"></li>
                        <li id="BGWarning" class="bg_warning"></li>
                        <li id="BGDeepPurple" class="bg_deep_purple"></li>
                    </ul>
                </div>

                <!-- Left SideMenu Folded Menu -->
                <div class="color-content">
                    <h5>Folded Menu</h5>
                    <p>Toggle Folded Menu</p>

                    <div class="side-menu-switch">
                        <label class="switch">
                            <input type="checkbox" class="light">
                            <span class="slider round folded-menu"></span>
                        </label>
                    </div>
                </div>

                <!-- Card Shadow Show & hide -->
                <div class="color-content">
                    <h5>Card Shadow</h5>
                    <p>Show & Hide Card Shadow</p>

                    <div class="side-menu-switch">
                        <label class="switch">
                            <input type="checkbox" class="light">
                            <span class="slider round card-shadow"></span>
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
        <!-- Footer Scripts -->
        <!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="js/jquery.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>

<!-- Feather Icon JS -->
<script src="js/feather.min.js"></script>
<!-- Gllery viewer JS -->
<script src="js/viewer.min.js"></script>

<!-- ApexCharts JS -->
<script src="js/apex-charts/apexcharts.min.js"></script>
<script src="js/apex-charts/apexcharts-stock-prices.js"></script>
<script src="js/apex-charts/apex-line-charts.js"></script>
<script src="js/apex-charts/apex-area-charts.js"></script>
<script src="js/apex-charts/apex-bar-charts.js"></script>
<script src="js/apex-charts/apex-mixed-charts.js"></script>
<script src="js/apex-charts/apex-pie-donuts-charts.js"></script>
<script src="js/apex-charts/sales-by-countries.js"></script>
<script src="js/apex-charts/product-trends-by-month.js"></script>
<script src="js/apex-charts/month-sales-statistics.js"></script>
<script src="js/apex-charts/order-summary.js"></script>
<script src="js/apex-charts/visitors-overview.js"></script>
<script src="js/apex-charts/leads-stats.js"></script>
<script src="js/apex-charts/apex-column-charts.js"></script>
<script src="js/custom-chart.js"></script>

<!-- Custom JS -->
<script src="js/custom.js"></script>


<script src="https://code.jquery.com/jquery-3.5.1.js"></script>

<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap4.min.js"></script>

<script>
 $(document).ready(function () {
$('#example').DataTable();
});


</script>



            </body>
</html>
