<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Child Protection System</title>
    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .card {
            margin-top: 50px;
            box-shadow: 0 0.125rem 0.25rem rgba(0,0,0,.075);
        }
    </style>
</head>
<body>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="municipality" class="col-md-4 col-form-label text-md-end">{{ __('Municipality') }}</label>

                            <div class="col-md-6">
                                <select id="municipality" class="form-control @error('municipality') is-invalid @enderror" name="municipality" required>
                                    <option value="">Select Municipality</option>
                                    <option value="Cebu City" {{ old('municipality') == 'Cebu City' ? 'selected' : '' }}>Cebu City</option>
                                    <option value="Mandaue City" {{ old('municipality') == 'Mandaue City' ? 'selected' : '' }}>Mandaue City</option>
                                    <option value="Lapu-Lapu City" {{ old('municipality') == 'Lapu-Lapu City' ? 'selected' : '' }}>Lapu-Lapu City</option>
                                    <option value="Talisay City" {{ old('municipality') == 'Talisay City' ? 'selected' : '' }}>Talisay City</option>
                                    <option value="Danao City" {{ old('municipality') == 'Danao City' ? 'selected' : '' }}>Danao City</option>
                                    <option value="Bogo City" {{ old('municipality') == 'Bogo City' ? 'selected' : '' }}>Bogo City</option>
                                    <option value="Carcar City" {{ old('municipality') == 'Carcar City' ? 'selected' : '' }}>Carcar City</option>
                                    <option value="Naga City" {{ old('municipality') == 'Naga City' ? 'selected' : '' }}>Naga City</option>
                                    <option value="Alcantara" {{ old('municipality') == 'Alcantara' ? 'selected' : '' }}>Alcantara</option>
                                    <option value="Alcoy" {{ old('municipality') == 'Alcoy' ? 'selected' : '' }}>Alcoy</option>
                                    <option value="Alegria" {{ old('municipality') == 'Alegria' ? 'selected' : '' }}>Alegria</option>
                                    <option value="Aloguinsan" {{ old('municipality') == 'Aloguinsan' ? 'selected' : '' }}>Aloguinsan</option>
                                    <option value="Argao" {{ old('municipality') == 'Argao' ? 'selected' : '' }}>Argao</option>
                                    <option value="Asturias" {{ old('municipality') == 'Asturias' ? 'selected' : '' }}>Asturias</option>
                                    <option value="Badian" {{ old('municipality') == 'Badian' ? 'selected' : '' }}>Badian</option>
                                    <option value="Balamban" {{ old('municipality') == 'Balamban' ? 'selected' : '' }}>Balamban</option>
                                    <option value="Bantayan" {{ old('municipality') == 'Bantayan' ? 'selected' : '' }}>Bantayan</option>
                                    <option value="Barili" {{ old('municipality') == 'Barili' ? 'selected' : '' }}>Barili</option>
                                    <option value="Boljoon" {{ old('municipality') == 'Boljoon' ? 'selected' : '' }}>Boljoon</option>
                                    <option value="Borbon" {{ old('municipality') == 'Borbon' ? 'selected' : '' }}>Borbon</option>
                                    <option value="Carmen" {{ old('municipality') == 'Carmen' ? 'selected' : '' }}>Carmen</option>
                                    <option value="Catmon" {{ old('municipality') == 'Catmon' ? 'selected' : '' }}>Catmon</option>
                                    <option value="Compostela" {{ old('municipality') == 'Compostela' ? 'selected' : '' }}>Compostela</option>
                                    <option value="Consolacion" {{ old('municipality') == 'Consolacion' ? 'selected' : '' }}>Consolacion</option>
                                    <option value="Cordova" {{ old('municipality') == 'Cordova' ? 'selected' : '' }}>Cordova</option>
                                    <option value="Daanbantayan" {{ old('municipality') == 'Daanbantayan' ? 'selected' : '' }}>Daanbantayan</option>
                                    <option value="Dalaguete" {{ old('municipality') == 'Dalaguete' ? 'selected' : '' }}>Dalaguete</option>
                                    <option value="Dumanjug" {{ old('municipality') == 'Dumanjug' ? 'selected' : '' }}>Dumanjug</option>
                                    <option value="Ginatilan" {{ old('municipality') == 'Ginatilan' ? 'selected' : '' }}>Ginatilan</option>
                                    <option value="Liloan" {{ old('municipality') == 'Liloan' ? 'selected' : '' }}>Liloan</option>
                                    <option value="Madridejos" {{ old('municipality') == 'Madridejos' ? 'selected' : '' }}>Madridejos</option>
                                    <option value="Malabuyoc" {{ old('municipality') == 'Malabuyoc' ? 'selected' : '' }}>Malabuyoc</option>
                                    <option value="Medellin" {{ old('municipality') == 'Medellin' ? 'selected' : '' }}>Medellin</option>
                                    <option value="Minglanilla" {{ old('municipality') == 'Minglanilla' ? 'selected' : '' }}>Minglanilla</option>
                                    <option value="Moalboal" {{ old('municipality') == 'Moalboal' ? 'selected' : '' }}>Moalboal</option>
                                    <option value="Oslob" {{ old('municipality') == 'Oslob' ? 'selected' : '' }}>Oslob</option>
                                    <option value="Pilar" {{ old('municipality') == 'Pilar' ? 'selected' : '' }}>Pilar</option>
                                    <option value="Pinamungajan" {{ old('municipality') == 'Pinamungajan' ? 'selected' : '' }}>Pinamungajan</option>
                                    <option value="Poro" {{ old('municipality') == 'Poro' ? 'selected' : '' }}>Poro</option>
                                    <option value="Ronda" {{ old('municipality') == 'Ronda' ? 'selected' : '' }}>Ronda</option>
                                    <option value="Samboan" {{ old('municipality') == 'Samboan' ? 'selected' : '' }}>Samboan</option>
                                    <option value="San Fernando" {{ old('municipality') == 'San Fernando' ? 'selected' : '' }}>San Fernando</option>
                                    <option value="San Francisco" {{ old('municipality') == 'San Francisco' ? 'selected' : '' }}>San Francisco</option>
                                    <option value="San Remigio" {{ old('municipality') == 'San Remigio' ? 'selected' : '' }}>San Remigio</option>
                                    <option value="Santa Fe" {{ old('municipality') == 'Santa Fe' ? 'selected' : '' }}>Santa Fe</option>
                                    <option value="Santander" {{ old('municipality') == 'Santander' ? 'selected' : '' }}>Santander</option>
                                    <option value="Sibonga" {{ old('municipality') == 'Sibonga' ? 'selected' : '' }}>Sibonga</option>
                                    <option value="Sogod" {{ old('municipality') == 'Sogod' ? 'selected' : '' }}>Sogod</option>
                                    <option value="Tabogon" {{ old('municipality') == 'Tabogon' ? 'selected' : '' }}>Tabogon</option>
                                    <option value="Tabuelan" {{ old('municipality') == 'Tabuelan' ? 'selected' : '' }}>Tabuelan</option>
                                    <option value="Tuburan" {{ old('municipality') == 'Tuburan' ? 'selected' : '' }}>Tuburan</option>
                                    <option value="Tudela" {{ old('municipality') == 'Tudela' ? 'selected' : '' }}>Tudela</option>
                                </select>

                                @error('municipality')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="role" class="col-md-4 col-form-label text-md-end">{{ __('Role') }}</label>

                            <div class="col-md-6">
                                <select id="role" class="form-control @error('role') is-invalid @enderror" name="role" required>
                                    <option value="">Select Role</option>
                                    <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>User</option>
                                    <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                                </select>

                                @error('role')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
