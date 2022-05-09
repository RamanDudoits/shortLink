<!DOCTYPE HTML>

<html>

<head>
    <title>@yield('title')</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="{{ asset("assets/css/main.css") }}" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>

<body>

    <!-- Header -->
    <header id="header" class="">
        <div class="logo">Link shortenig<a href="{{route('login')}}"> Service</a></div>
    </header>



    <!-- Main -->
    @yield('content', 'content')

    <!-- Footer -->
    <footer id="footer">
        <div class="copyright">
            <ul class="icons">
                <li><a href="#" class="icon fa-twitter"><span class="label">Twitter</span></a></li>
                <li><a href="#" class="icon fa-facebook"><span class="label">Facebook</span></a></li>
                <li><a href="#" class="icon fa-instagram"><span class="label">Instagram</span></a></li>
                <li><a href="#" class="icon fa-snapchat"><span class="label">Snapchat</span></a></li>
            </ul>
            <p>&copy; Untitled. All rights reserved. Design: <a href="https://templated.co">TEMPLATED</a>. Images: <a href="https://unsplash.com">Unsplash</a>.</p>
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