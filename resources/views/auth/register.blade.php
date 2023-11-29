@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Registrati') }}</div>
                    <div class="m-3 text-danger">* Questi campi sono obbligatori</div>
                    <div class="card-body">

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <div class="mb-4 row">
                                <label for="name"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Nome') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text"
                                        class="form-control @error('name') is-invalid @enderror" name="name"
                                        value="{{ old('name') }}" autocomplete="name" autofocus>

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-4 row">
                                <label for="lastname"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Cognome') }}</label>

                                <div class="col-md-6">
                                    <input id="lastname" type="text"
                                        class="form-control @error('lastname') is-invalid @enderror" name="lastname"
                                        value="{{ old('lastname') }}" autocomplete="lastname" autofocus>

                                    @error('lastname')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-4 row">
                                <label for="email"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Indirizzo e-mail') }} *</label>

                                <div class="col-md-6">
                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" required autocomplete="email">

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-4 row">
                                <label for="vat" class="col-md-4 col-form-label text-md-right">{{ __('Partita IVA') }}
                                    *</label>

                                <div class="col-md-6">
                                    <input id="vat" type="text"
                                        class="form-control @error('vat') is-invalid @enderror" name="vat"
                                        value="{{ old('vat') }}" required autocomplete="vat">

                                    @error('vat')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-4 row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}
                                    *</label>

                                <div class="col-md-6">
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="new-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-4 row">
                                <label for="password-confirm"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Conferma Password') }}
                                    *</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password"
                                        class="form-control @error('vat') is-invalid @enderror" name="password_confirmation"
                                        required autocomplete="new-password">
                                </div>
                            </div>

                            <div class="mb-4 row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="button" class="btn btn-primary" id="register-button" @click="submitForm">
                                        {{ __('Registrati') }}
                                    </button>



                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        const password = document.getElementById('password');
        const passwordConfirm = document.getElementById('password-confirm');
        const vat = document.getElementById('vat'); // Aggiunto il riferimento alla partita IVA
        const form = document.querySelector('form'); // Dichiarato a livello globale

        passwordConfirm.addEventListener('keyup', function() {
            if (password.value !== passwordConfirm.value) {
                passwordConfirm.classList.remove('is-valid');
                passwordConfirm.classList.add('is-invalid');
            } else {
                passwordConfirm.classList.remove('is-invalid');
                passwordConfirm.classList.add('is-valid');
            }
        });

        const isValidVAT = (inputVAT) => {
            // Personalizza la regular expression per la validazione della partita IVA
            const vatRegex = /^0?\d{11}$/;
            return vatRegex.test(inputVAT);
        };

        const submitForm = () => {
            // Aggiungi qui la tua logica di validazione del form
            if (password.value !== passwordConfirm.value) {
                alert('Le password non corrispondono');
                return;
            }

            // Utilizza la tua funzione di validazione personalizzata per la partita IVA
            if (!isValidVAT(vat.value)) {
                alert('La partita IVA non è valida'); // Personalizza il messaggio di errore
                return;
            }

            // Se il form è valido, invia la richiesta al backend
            form.submit();
        };

        // Assegna il metodo al click del pulsante
        document.getElementById('register-button').addEventListener('click', submitForm);
    </script>
@endsection
