<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>@yield('title') Koperasi Jasa Angkutan Putra Mandiri Sukses</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Coderthemes" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- App favicon -->
    @include('includes.style')

</head>

<body class="loading authentication-bg authentication-bg-pattern">

    <div class="account-pages mt-5 mb-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-4">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>

    <footer class="footer footer-alt text-white-50">
       <script>document.write(new Date().getFullYear())</script> &copy;Rental dan travel Koperasi Putra Mandiri Sukses</a> 
    </footer>

    @include('includes.script')

</body>

</html>
