<nav class="navbar navbar-expand-sm navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="{{ route('guest.home') }}">
            <img class="me-1" class="favicon" src="/img/favicon.png" alt="icon">
            Deliveboo
        </a>
        <button class="navbar-toggler d-lg-none" type="button" data-bs-toggle="collapse"
            data-bs-target="#collapsibleNavId" aria-controls="collapsibleNavId" aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="collapsibleNavId">
            <ul class="navbar-nav me-auto mt-2 mt-lg-0">
                <li class="nav-item">
                    <a class="nav-link {{ Route::currentRouteName() == 'guest.home' ? 'active' : '' }}"
                        href="{{ route('guest.home') }}" aria-current="page">Home<span
                            class="visually-hidden">(current)</span></a>
                </li>
                @auth

                    @if (auth()->user()->restaurant)
                        <li class="nav-item">
                            <a class="nav-link"
                                href="{{ route('admin.restaurants.index') }}">{{ __('Il tuo ristorante') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.plates.index') }}">{{ __('Menù') }}</a>
                        </li>
                    @endif

                    @if (!auth()->user()->restaurant)
                        <!-- Verifica se l'utente non ha già registrato un ristorante -->
                        {{-- <li class="nav-item">
                            <a class="nav-link"
                                href="{{ route('admin.restaurants.create') }}">{{ __('Registra il tuo ristorante') }}</a>
                        </li> --}}
                    @endif
                @endauth

                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Accedi') }}</a>
                    </li>
                    <!--
                                     <li class="nav-item">
                                        <a class="nav-link" href="{{ route('guest.orders.index') }}">{{ __('Fai un ordine') }}</a>
                                    </li>
                                -->
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Registrati') }}</a>
                        </li>
                    @endif
                @else
                    {{-- ! QUI METTIAMO IL LINK ALL'INDEX CHE CI SERVE SOLO PER GLI UTENTI LOGGATI --}}

                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('admin.home') }}">{{ __('Benvenuto') }}</a>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                                       document.getElementById('logout-form').submit();">
                                {{ __('Disconnetiti') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
            {{-- <form class="d-flex my-2 my-lg-0">
          <input class="form-control me-sm-2" type="text" placeholder="Search">
          <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form> --}}
        </div>
    </div>
</nav>
