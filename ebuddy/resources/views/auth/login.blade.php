@extends('layouts.base2')

{{-- <link href="css/signin.css" rel="stylesheet"> --}}
<style>
    html,
    body {
        height: 100%;
    }

    .form-signin {
        max-width: 330px;
        padding: 1rem;
    }

    .form-signin .form-floating:focus-within {
        z-index: 2;
    }

    .form-signin input[type="email"] {
        margin-bottom: -1px;
        border-bottom-right-radius: 0;
        border-bottom-left-radius: 0;
    }

    .form-signin input[type="password"] {
        margin-bottom: 10px;
        border-top-left-radius: 0;
        border-top-right-radius: 0;
    }
</style>

@section('base')
    <div class="d-flex align-items-center justify-content-center min-vh-100 py-4">
        <main class="form-signin w-100 m-auto">
            <form id="form-login">
                @csrf
                <h1 class="h3 mb-3 fw-normal text-center">Please sign in</h1>

                <div class="form-floating">
                    <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com"
                        name="email">
                    <label for="floatingInput">Email address</label>
                </div>
                <div class="form-floating">
                    <input type="password" class="form-control" id="floatingPassword" placeholder="Password"
                        name="password">
                    <label for="floatingPassword">Password</label>
                </div>

                <div class="form-check text-start my-3">
                    <input class="form-check-input" type="checkbox" value="remember-me" id="flexCheckDefault">
                    <label class="form-check-label" for="flexCheckDefault">
                        Remember me
                    </label>
                </div>
                <button class="btn btn-dark w-100 py-2" type="submit">Sign in</button>
                <p class="mt-5 mb-3 text-body-secondary text-center">Ebuddy 2024</p>
            </form>
        </main>
    </div>
    @push('script')
        <script>
            toastr.options.progressBar = true;

            $(document).ready(function() {
                $('#form-login').submit(function(e) {
                    e.preventDefault();
                    var formData = $(this).serialize();
                    $.ajax({
                        url: "{{ route('auth.login') }}",
                        type: "POST",
                        data: formData,
                        dataType: 'json',
                        success: function(response) {
                            toastr.success(response
                            .message); // Tampilkan toast dengan pesan dari backend
                            toastr.options.progressBar = true;
                            // Redirect berdasarkan role_id setelah delay
                            setTimeout(function() {
                                if (response.role_id === 1) {
                                    window.location.href = "{{ route('dashboard.admin') }}";
                                } else if (response.role_id === 2 || response.role_id ===
                                    3) {
                                    window.location.href = "{{ route('dashboard.user') }}";
                                } else {
                                    toastr.error('Role not recognized');
                                }
                            },
                            1500); // Delay 3 detik sebelum redirect (sesuaikan durasi sesuai kebutuhan)
                        },
                        error: function(xhr, status, error) {
                            toastr.error(xhr.responseJSON
                            .message); // Tampilkan toast error jika login gagal
                        }
                    });
                });
            });

            @if (session()->has('success'))
                toastr.success("{{ session('success') }}");
            @endif
        </script>
    @endpush
@endsection
