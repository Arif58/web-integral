
    <head>
        @include('web.layout.head')
    </head>
    <body class="rbt-header-sticky">     
        <div class="rbt-elements-area bg-color-white d-flex align-content-center flex-wrap justify-content-center" style="height: 100%">
            @yield('content')
            @include('web.layout.js')
        </div>
    </body>
