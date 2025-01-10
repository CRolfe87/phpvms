<nav class="navbar navbar-top fixed-top navbar-expand" id="navbarDefault">
    <div class="collapse navbar-collapse justify-content-between">
        <div class="navbar-logo">

            <button class="btn navbar-toggler navbar-toggler-humburger-icon hover-bg-transparent" type="button" data-bs-toggle="collapse" data-bs-target="#navbarVerticalCollapse"
                aria-controls="navbarVerticalCollapse" aria-expanded="false" aria-label="Toggle Navigation"><span class="navbar-toggle-icon"><span class="toggle-line"></span></span></button>
            <a class="navbar-brand me-1 me-sm-3" href="/">
                <div class="d-flex align-items-center">
                    <div class="d-flex align-bottom">
                        <img src="{{ public_asset('/PFL/img/icons/logo.png') }}" alt="phoenix" height="36" />
                        <p class="logo-text ms-2 d-none d-sm-block">{{ config('app.name') }}</p>
                    </div>
                </div>
            </a>
        </div>
        <ul class="navbar-nav navbar-nav-icons flex-row">
            <li class="nav-item">
                <div class="theme-control-toggle fa-icon-wait px-2">
                    <input class="form-check-input ms-0 theme-control-toggle-input" type="checkbox" data-theme-control="phoenixTheme" value="dark" id="themeControlToggle" />
                    <label class="mb-0 theme-control-toggle-label theme-control-toggle-light" for="themeControlToggle" data-bs-toggle="tooltip" data-bs-placement="left" title="Switch theme"><span
                            class="icon" data-feather="moon"></span></label>
                    <label class="mb-0 theme-control-toggle-label theme-control-toggle-dark" for="themeControlToggle" data-bs-toggle="tooltip" data-bs-placement="left" title="Switch theme"><span
                            class="icon" data-feather="sun"></span></label>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link" id="navbarDropdownNindeDots" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" data-bs-auto-close="outside" aria-expanded="false">
                    <svg width="16" height="16" viewbox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="2" cy="2" r="2" fill="currentColor"></circle>
                        <circle cx="2" cy="8" r="2" fill="currentColor"></circle>
                        <circle cx="2" cy="14" r="2" fill="currentColor"></circle>
                        <circle cx="8" cy="8" r="2" fill="currentColor"></circle>
                        <circle cx="8" cy="14" r="2" fill="currentColor"></circle>
                        <circle cx="14" cy="8" r="2" fill="currentColor"></circle>
                        <circle cx="14" cy="14" r="2" fill="currentColor"></circle>
                        <circle cx="8" cy="2" r="2" fill="currentColor"></circle>
                        <circle cx="14" cy="2" r="2" fill="currentColor"></circle>
                    </svg></a>

                <div class="dropdown-menu dropdown-menu-end navbar-dropdown-caret py-0 dropdown-nine-dots shadow border" aria-labelledby="navbarDropdownNindeDots">
                    <div class="card bg-body-emphasis position-relative border-0">
                        <div class="card-body pt-3 px-3 pb-0 overflow-auto scrollbar" style="height: 20rem;">
                            <div class="row text-center align-items-center gx-0 gy-0">
                                <div class="col-4"><a class="d-block bg-body-secondary-hover p-2 rounded-3 text-center text-decoration-none mb-3" href="#!"><img
                                            src="" alt="" width="30" />
                                        <p class="mb-0 text-body-emphasis text-truncate fs-10 mt-1 pt-1">Behance</p>
                                    </a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link lh-1 pe-0" id="navbarDropdownUser" href="#!" role="button" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-haspopup="true"
                    aria-expanded="false">
                    <div class="avatar avatar-l">
                        @if (Auth::check())
                            @if ($user->avatar == null)
                                <img class="rounded-circle " src="{{ $user->gravatar(512) }}" alt="" />
                            @else
                                <img class="rounded-circle " src="{{ $user->avatar->url }}" alt="" />
                            @endif
                        @else
                            <div class="avatar-name rounded-circle text-body-quaternary"><span class="mt-2 avatar-s" data-feather="user"></div>
                        @endif
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-end navbar-dropdown-caret py-0 dropdown-profile shadow border" aria-labelledby="navbarDropdownUser">
                    <div class="card position-relative border-0">
                        <div class="card-body p-0">
                            <div class="text-center pt-4 pb-3">
                                <div class="avatar avatar-xl">
                                    @if (Auth::check())
                                        @if ($user->avatar == null)
                                            <img class="rounded-circle " src="{{ $user->gravatar(512) }}" alt="" />
                                        @else
                                            <img class="rounded-circle " src="{{ $user->avatar->url }}" alt="" />
                                        @endif
                                </div>
                                <h6 class="mt-2 text-body-emphasis">{{ Auth::user()->name }}</h6>
                            @else
                                <div class="avatar-name rounded-circle text-body-quaternary"><span class="mt-2 avatar-m" data-feather="user"></div>
                            </div>
                            @endif

                        </div>
                    </div>
                    <div class="scrollbar">
                        <ul class="nav d-flex flex-column mb-2 pb-1">
                            @if (Auth::check())
                                <li class="nav-item"><a class="nav-link px-3" href="{{ route('frontend.profile.index') }}"> <span class="me-2 text-body"
                                            data-feather="user"></span><span>@lang('disposable.menu_profile')</span></a>
                                </li>
                                <li class="nav-item"><a class="nav-link px-3" href="{{ route('frontend.dashboard.index') }}"> <span class="me-2 text-body"
                                            data-feather="trello"></span><span>@lang('common.dashboard')</span></a>
                                </li>
                                @if ($DSpecial)
                                    <li class="nav-item"><a class="nav-link px-3" href="{{ route('DSpecial.market.show', [$user->id]) }}"> <span class="me-2 text-body"
                                                data-feather="shopping-cart"></span><span>@lang('disposable.menu_mymarket')</span></a>
                                    </li>
                                    <li class="nav-item"><a class="nav-link px-3" href="{{ route('DSpecial.assignments') }}"> <span class="me-2 text-body"
                                                data-feather="list"></span><span>@lang('disposable.menu_assign')</span></a>
                                    </li>
                                @endif
                                <li class="nav-item"><a class="nav-link px-3" href="{{ route('frontend.flights.bids') }}"> <span class="me-2 text-body"
                                            data-feather="bookmark"></span><span>@lang('disposable.menu_bids')</span></a>
                                </li>
                                <li class="nav-item"><a class="nav-link px-3" href="{{ route('frontend.pireps.index') }}"> <span class="me-2 text-body"
                                            data-feather="archive"></span><span>@lang('disposable.menu_pireps')</span></a>
                                </li>
                            @else
                                <li class="nav-item"><a class="nav-link px-3" href="{{ url('/register') }}"> <span class="me-2 text-body"
                                            data-feather="pen-tool"></span><span>@lang('common.register')</span></a>
                                </li>
                            @endif



                            {{-- Disabling for now
                            @if ($DBasic && $user)
                                    <li class="nav-item"><a class="nav-link px-3" href="{{ route('DBasic.myairline', [$user->airline_id]) }}"> <span class="me-2 text-body"
                                                data-feather="users"></span><span>@lang('disposable.menu_company')</span></a>
                                    </li>
                                    <li class="nav-item"><a class="nav-link px-3" href="{{ route('DBasic.hub', [$user->home_airport_id ?? '']) }}"> <span class="me-2 text-body"
                                                data-feather="home"></span><span>@lang('disposable.menu_base')</span></a>
                                    </li>
                                @endif
                            @if ($DBasic && Theme::getSetting('gen_stable_approach'))
                                <li class="nav-item"><a class="nav-link px-3" href="{{ route('DBasic.stable') }}"> <span class="me-2 text-body" data-feather="check-circle"></span><span>FDM
                                            Reports</span></a>
                                </li>
                            @endif --}}
                        </ul>
                    </div>
                    <div class="card-footer p-0 border-top border-translucent">
                        @ability('admin', 'admin-access')
                            <ul class="nav d-flex flex-column my-3">
                                <li class="nav-item"><a class="nav-link px-3" href="{{ url('/admin') }}"> <span class="me-2 text-body" data-feather="settings"></span>@lang('common.administration')</a>
                                </li>
                            </ul>
                            <hr class="mb-0" />
                        @endability
                        @if (Auth::check())
                            <div class="p-3"> <a class="btn btn-phoenix-secondary d-flex flex-center w-100" href="{{ url('/logout') }}"> <span class="me-2" data-feather="log-out">
                                    </span>@lang('common.logout')</a>
                            </div>
                        @else
                            <div class="p-3"> <a class="btn btn-primary d-flex flex-center w-100" href="{{ url('/login') }}"> <span class="me-2" data-feather="log-in">
                                    </span>@lang('common.login')</a>
                            </div>
                        @endif
                    </div>
                </div>
    </div>
    </li>
    </ul>
    </div>
</nav>
