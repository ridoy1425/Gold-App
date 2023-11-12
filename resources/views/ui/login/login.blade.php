<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    {{-- select2  --}}
    {{-- <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" /> --}}
    <link rel="stylesheet" href="{{ asset('ui/login_assets/css/select2.min.css') }}">
    <!-- Bootstrap CSS -->
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous"> --}}
    <link rel="stylesheet" href="{{ asset('ui/login_assets/css/bootstrap.min.css') }}">
    <!-- custom css -->
    <link rel="stylesheet" href="{{ asset('ui/login_assets/css/style.css') }}">
    <!-- Title and favicon -->
    <title>Gold App-login</title>
    <link rel="icon" type="image/png" href="{{ asset('images/ywca.png') }}" />
</head>

<body>
    <div class="alert_message">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul style="margin-bottom: 0rem;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if (Session::has('success'))
            <div class="alert alert-success" role="success">
                {{ Session::get('success') }}
            </div>
        @endif
        @if (Session::has('error'))
            <div class="alert alert-danger" role="success">
                {{ Session::get('error') }}
            </div>
        @endif
    </div>
    <div class="login_page">

        <div class="login_form">
            <div class="login_title text-center">
                <h3>Employee Login</h3>
            </div>
            <div class="tab-content">
                <div class="tab-pane active" id="login_page">
                    <form action="{{ url('login') }}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">User Name</label>
                            <input type="text" class="form-control" id="name" name="name"
                                value="{{ old('name') }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <div class="d-grid gap-2 col-6 mx-auto">
                            <button type="submit" class="btn btn-block btn-warning">Login</button>
                        </div>
                    </form>
                    <div id="signUp" class=" mt-4 signUp d-flex justify-content-center">
                        <p>Create New Account</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Input Modal -->
    <div id="myModal" class="modal">
        <div class="modal-content">
            <div>
                <span class="close">&times;</span>
            </div>
            <div>
                <h4 class=" mb-3">Employee Registration</h4>
                <form action="{{ url('registration') }}" method="post">
                    @csrf
                    <div class="mb-1">
                        <label for="full_name" class="col-form-label col-form-label-sm">Full
                            Name (English)</label>
                        <input type="text" class="form-control form-control-sm" id="full_name" name="full_name"
                            required>
                    </div>

                    <div class="mb-1">
                        <label for="name" class="col-form-label col-form-label-sm">Login User
                            Name (Nickname)</label>
                        <input type="text" class="form-control form-control-sm" id="name" name="name"
                            required>
                    </div>
                    <div class="mb-1">
                        <label for="password" class=" col-form-label col-form-label-sm">Password (at least 4 c)</label>
                        <input type="password" class="form-control form-control-sm" id="password" name="password"
                            value="" required>
                    </div>
                    <div class="mb-3">
                        <label for="password_confirmation" class="col-form-label col-form-label-sm">Confirm
                            Password</label>
                        <input type="password" class="form-control form-control-sm" id="password_confirmation"
                            name="password_confirmation" value="" required>
                    </div>

                    <div class="d-grid gap-2 col-6 mx-auto">
                        <button type="submit" class="btn btn-warning">Register</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="{{ asset('ui/admin_assets/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="{{ asset('ui/login_assets/js/bootstrap.bundle.min.js') }}"></script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"> --}}
    {{-- </script> --}}
    <script src="{{ asset('ui/login_assets/js/select2.min.js') }}"></script>
    {{-- select2  --}}
    {{-- <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script> --}}
    <script src="{{ asset('ui/login_assets/js/custom.js') }}"></script>
</body>

</html>
