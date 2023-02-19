<x-guest-layout :assets="$assets ?? []">
    <section class="login-content">
        <div class="row m-0 align-items-center bg-white vh-100">
            <div class="col-md-6">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="card card-transparent shadow-none d-flex justify-content-center mb-0 auth-card">
                        <div class="card-body">
                        <a href="{{route('dashboard')}}" class="navbar-brand d-flex align-items-center mb-3">
                            <svg width="30" class="text-primary" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <rect x="-0.757324" y="19.2427" width="28" height="4" rx="2" transform="rotate(-45 -0.757324 19.2427)" fill="currentColor"/>
                                <rect x="7.72803" y="27.728" width="28" height="4" rx="2" transform="rotate(-45 7.72803 27.728)" fill="currentColor"/>
                                <rect x="10.5366" y="16.3945" width="16" height="4" rx="2" transform="rotate(45 10.5366 16.3945)" fill="currentColor"/>
                                <rect x="10.5562" y="-0.556152" width="28" height="4" rx="2" transform="rotate(45 10.5562 -0.556152)" fill="currentColor"/>
                            </svg>
                        </a>
                        <h2 class="mb-2 text-center">Register</h2>
                        <x-auth-session-status class="mb-4" :status="session('status')" />

                        <!-- Validation Errors -->
                        <form method="POST" action="{{ route('register.post') }}" data-toggle="validator">
                            {{csrf_field()}}
                            <div class="row">
                                <div class="form-group col-md-6">
                                <label class="form-label" for="fname">Nama: <span class="text-danger">*</span></label>
                                {{ Form::text('name', old('name'), ['class' => 'form-control', 'placeholder' => 'Nama', 'required']) }}
                                </div>
                                <div class="form-group col-md-6">
                                <label class="form-label" for="lname">Alamat:</label>
                                {{ Form::text('address', old('address'), ['class' => 'form-control', 'placeholder' => 'Alamat']) }}
                                </div>
                                <div class="form-group col-md-6">
                                <label class="form-label" for="lname">No. HP:</label>
                                {{ Form::text('phone_number', old('phone_number'), ['class' => 'form-control', 'placeholder' => 'No. HP']) }}
                                </div>
                            </div>
                            <hr>
                            <h5 class="mb-3">Security</h5>
                            <div class="row">
                                <div class="form-group col-md-6">
                                <label class="form-label" for="uname">Username: <span class="text-danger">*</span></label>
                                {{ Form::text('username', old('username'), ['class' => 'form-control', 'placeholder' => 'Username', 'required']) }}
                                </div>
                                <div class="form-group col-md-6">
                                <label class="form-label" for="pass">Password: <span class="text-danger">*</span></label>
                                {{ Form::password('password', ['class' => 'form-control', 'placeholder' => 'Password', 'required']) }}
                                </div>
                            </div>
                            <div class="d-flex justify-content-center">
                                <button type="submit" class="btn btn-primary">Register</button>
                            </div>
                            <p class="mt-3 text-center">
                                Don’t have an account? <a href="{{route('login')}}" class="text-underline">Click here to login.</a>
                            </p>
                        </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="sign-bg">
                <svg width="280" height="230" viewBox="0 0 431 398" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <g opacity="0.05">
                    <rect x="-157.085" y="193.773" width="543" height="77.5714" rx="38.7857" transform="rotate(-45 -157.085 193.773)" fill="#3B8AFF"/>
                    <rect x="7.46875" y="358.327" width="543" height="77.5714" rx="38.7857" transform="rotate(-45 7.46875 358.327)" fill="#3B8AFF"/>
                    <rect x="61.9355" y="138.545" width="310.286" height="77.5714" rx="38.7857" transform="rotate(45 61.9355 138.545)" fill="#3B8AFF"/>
                    <rect x="62.3154" y="-190.173" width="543" height="77.5714" rx="38.7857" transform="rotate(45 62.3154 -190.173)" fill="#3B8AFF"/>
                    </g>
                </svg>
            </div>
            </div>
            <div class="col-md-6 d-md-block d-none bg-primary p-0 mt-n1 vh-100 overflow-hidden">
            <img src="{{asset('images/auth/01.png')}}" class="img-fluid gradient-main animated-scaleX" alt="images">
            </div>
        </div>
    </section>
</x-guest-layout>