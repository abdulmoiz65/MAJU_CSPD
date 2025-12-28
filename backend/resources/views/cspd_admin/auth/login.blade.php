<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>CSPD Admin Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Favicon -->
    <link href="{{ asset('images/favicon/favicon.ico') }}" rel="icon">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Bootstrap -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="{{ asset('css/adminstyle.css') }}" rel="stylesheet">
</head>

<body>
    <div class="container-xxl position-relative bg-white d-flex p-0">


        <!-- Sign In Start -->
        <div class="container-fluid">
            <div class="row h-100 align-items-center justify-content-center" style="min-height: 100vh;">
                <div class="col-12 col-sm-8 col-md-6 col-lg-5 col-xl-4">
                    <div class="bg-light rounded p-4 p-sm-5 my-4 mx-3">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <a href="{{ route('admin.login') }}" class="">
                                <h3 class="text-primary"><i class="fa fa-hashtag me-2"></i>MAJU</h3>
                            </a>
                            <h3>Sign In</h3>
                        </div>

                        @if(session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif

                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <i class="fas fa-check-circle me-2"></i>
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        <form action="{{ route('admin.login.submit') }}" method="POST">
                            @csrf

                            <div class="form-floating mb-3">
                                <input type="email" name="email" class="form-control" id="floatingInput"
                                    placeholder="name@example.com" value="{{ old('email') }}" required autofocus>
                                <label for="floatingInput">Email address</label>
                            </div>

                            <div class="form-floating mb-4">
                                <input type="password" name="password" class="form-control" id="floatingPassword"
                                    placeholder="Password" required>
                                <label for="floatingPassword">Password</label>
                            </div>

                            @error('email')
                                <div class="text-danger mb-2">{{ $message }}</div>
                            @enderror

                            <div class="d-flex align-items-center justify-content-between mb-4">
                                <a href="#">Forgot Password?</a>
                            </div>

                            <button type="submit" class="btn btn-primary py-3 w-100 mb-4">Sign In</button>

                            <p class="text-center mb-0">Don't have an Account? <a href="#">Sign Up</a></p>
                        </form>

                    </div>
                </div>
            </div>
        </div>
        <!-- Sign In End -->
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Custom JS -->
    <script src="{{ asset('js/main.js') }}"></script>
</body>
</html>