<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>News</title>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" />
    <!-- Font Awesome Icon -->
    <link rel="stylesheet" href="{{ asset('css/font-awesome.css') }}">
    <!-- Custom stlylesheet -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>
    <!-- HEADER -->
    <div id="header">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <!-- LOGO -->
                <div class=" col-md-offset-4 col-md-4">
                    <a href="index.php" id="logo"><img src="{{ asset('images/news.jpg') }}"></a>
                </div>
                <!-- /LOGO -->
            </div>
        </div>
    </div>
    <!-- /HEADER -->
    <!-- Menu Bar -->
    <div id="menu-bar">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <ul class='menu'>
                        <li><a href="{{ route('home') }}">Home</a></li>
                        @foreach ($allCategory as $allCategories)
                            <li><a
                                    href='{{ route('allcategory', $allCategories->category_id) }}'>{{ $allCategories->category_name }}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- /Menu Bar -->


    @hasSection('content')
        @yield('content')
    @else
        {!! "<h2 style='text-align: center' class='mt-5 mb-5'>No Content Found</h2>" !!}
    @endif





    <div id ="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <span>© Copyright 2019 News | Powered by <a href="https:muhammadrafayshaikh.github.io/Monument/"
                            target="_blank">Muhammad Rafay Shaikh</a></span>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
