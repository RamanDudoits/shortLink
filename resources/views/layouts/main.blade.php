<!DOCTYPE HTML>
<html>
<head>
    <title>@yield('title')</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="{{ asset("assets/css/main.css") }}" />
    <link rel="stylesheet" href="{{ asset("assets/css/bootstrap.css") }}" />
</head>
<body>
    <!-- Header -->
    <header id="header" class="">
        <div class="logo">Link shortenig<a href="{{route('login')}}"> Service</a></div>
    </header>
    <!-- Main -->
    <div id="main">
        <section class="wrapper style1">
            <div class="inner">
                @yield('content', 'content')
            </div>
        </section>
    </div>
    <!-- Footer -->
    <footer id="footer">
        <div class="copyright">
            <ul class="icons">
                <li><a href="https://twitter.com/Raman17046245" class="icon fa-twitter"><span class="label">Twitter</span></a></li>
                <li><a href="https://www.instagram.com/romandudoits/" class="icon fa-instagram"><span class="label">Instagram</span></a></li>
                <li><a href="https://www.linkedin.com/in/raman-dudoits-601b84217/" class="icon fa-linkedin"><span class="label">Linkedin</span></a></li>
                <li><a href="https://github.com/RamanDudoits/" class="icon fa-github"><span class="label">Linkedin</span></a></li>
            </ul>
            <p>&copy; Dudoits. All rights reserved.</p>
        </div>
    </footer>
    <!-- Scripts -->
    <script src="{{ asset("assets/js/jquery.min.js") }}"></script>
    <script src="{{ asset("assets/js/jquery.scrolly.min.js") }}"></script>
    <script src="{{ asset("assets/js/jquery.scrollex.min.js") }}"></script>
    <script src="{{ asset("assets/js/skel.min.js") }}"></script>
    <script src="{{ asset("assets/js/util.js") }}"></script>
    <script src="{{ asset("assets/js/main.js") }}"></script>
    @yield('customScript')
</body>
</html>
