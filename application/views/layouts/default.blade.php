<!DOCTYPE html>

<html>
<head>
	<title>{{ $title }}</title>
	{{ Asset::styles() }}
	{{ Asset::scripts() }}
</head>
<body>
	<!-- Navbar Start -->
	<div class="navbar navbar-fixed-top">
        <div class="navbar-inner">
            <div class="container">
                {{ HTML::link_to_route('home', 'Mayaten.com Blog', '' ,array('class' => 'brand')) }}
                <div class="nav-collapse">
                    <ul class="nav">
                        @section('navigation')
                        <li class="active">{{ HTML::link_to_route('home', 'Home') }}</li>
                        <li>{{ HTML::link_to_route('post_add', 'Add Post') }}</li>
                        @yield_section
                    </ul>
                </div><!--/.nav-collapse -->
            </div>
        </div>
    </div>

	<!-- Content Start -->
	<div class="container">
		@yield('content')
        <hr>
        <footer>
        <p>&copy; Mayaten.com Blog 2012</p>
        </footer>
	</div>
</body>
</html>