
    <head>
        @include('web.layout.head')
    </head>
    <body class="rbt-header-sticky">     
        <div class="rbt-elements-area bg-color-white d-flex align-content-center flex-wrap justify-content-center" style="height: 100%">
            <div class="course-sidebar sticky-top rbt-shadow-box">
                @yield('content')
            </div>
        </div>
        @include('web.layout.js')
    </body>
