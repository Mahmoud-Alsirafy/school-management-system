<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="HTML5 Template" />
    <meta name="description" content="Webmin - Bootstrap 4 & Angular 5 Admin Dashboard Template" />
    <meta name="author" content="potenzaglobalsolutions.com" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">    `
    @include('layouts.head')
    <style>
        .language-switcher {
            font-family: 'Cairo', sans-serif;
        }
        .lang-toggle {
            background-color: #f4f4f4;
            color: #333;
            border: none;
            padding: 8px 14px;
            border-radius: 8px;
            cursor: pointer;
            font-weight: bold;
            transition: 0.3s;
        }
        .lang-toggle:hover {
            background-color: #e0e0e0;
        }
        .lang-menu {
            display: none;
            position: absolute;
            top: 50%;
            left: 0;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            list-style: none;
            padding: 0;
            margin: 5px 0 0 0;
            z-index: 999;
            min-width: 120px;
        }
        .lang-menu li a {
            display: block;
            padding: 10px;
            color: #333;
            text-decoration: none;
            font-weight: 500;
            transition: 0.3s;
        }
        .lang-menu li a:hover {
            background-color: #f0f0f0;
        }
        .language-switcher:hover .lang-menu {
            display: block;
        }
    </style>
</head>

<body>

    <div class="wrapper">

        <!--=================================
 preloader -->

        <div id="pre-loader">
            <img src="assets/images/pre-loader/loader-01.svg" alt="">
        </div>

        <!--=================================
 preloader -->

        @include('layouts.main-header')

        @include('layouts.main-sidebar')

        <!--=================================
 Main content -->
        <!-- main-content -->
        <div class="content-wrapper">

            @yield('page-header')

            @yield('content')

            <!--=================================
 wrapper -->

            <!--=================================
 footer -->

            @include('layouts.footer')
        </div><!-- main content wrapper end-->
    </div>
    </div>
    </div>

    <!--=================================
 footer -->

    @include('layouts.footer-scripts')

</body>

</html>
