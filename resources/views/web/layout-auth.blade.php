<head>
    @include('web.layout.head')
</head>
<body class="rbt-elements-area bg-color-white">
    <div class="wrapper w-100 h-100 d-flex align-items-center">
        <div class="container">
            <div class="row g-5 justify-content-between align-items-center">
                <div class="col-lg-6 order-1 order-lg-1">
                    <img src="{{ asset('images/banner/auth-image.svg') }}" alt=""> 
                </div>
                <div class="col-lg-6 order-2 order-lg-2">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>
       
 
    @include('web.layout.js')
    <script>
        document.getElementById('togglePassword').addEventListener('click', function (e) {
            // toggle the type attribute
            const password = document.getElementById('password');
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            
            // toggle the icon
            this.classList.toggle('feather-eye');
            this.classList.toggle('feather-eye-off');
        });

        document.getElementById('toggleConfirmationPassword').addEventListener('click', function (e) {
            // toggle the type attribute
            const passwordConfirmation = document.getElementById('password_confirmation');
            const type = passwordConfirmation.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordConfirmation.setAttribute('type', type);
            
            // toggle the icon
            this.classList.toggle('feather-eye');
            this.classList.toggle('feather-eye-off');
        });
    </script>
</body>