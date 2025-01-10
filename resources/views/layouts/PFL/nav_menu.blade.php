@if (Auth::check())
    {{-- Menu Items For Users --}}

    @if (Theme::getSetting('gen_utc_clock') && !Theme::getSetting('gen_sidebar'))
        <li class="nav-item">

            <div class="nav-item-wrapper"><a class="nav-link label-1" data-bs-toggle="" aria-expanded="false">
                    <div class="d-flex align-items-center">
                        <span class="nav-link-icon">
                            <span data-feather="clock">
                            </span>
                        </span>
                        <span class="nav-link-text-wrapper">
                            <span class="nav-link-text" id="utc_clock">
                            </span>
                        </span>
                    </div>
                </a>
            </div>
    @endif

    <li class="nav-item">
        <p class="navbar-vertical-label">Airline
        </p>
        <hr class="navbar-vertical-line" />
        <div class="nav-item-wrapper">
            <a class="nav-link label-1" href="{{ route('frontend.dashboard.index') }}" role="button" data-bs-toggle="" aria-expanded="false">
                <div class="d-flex align-items-center">
                    <span class="nav-link-icon"><span data-feather="trello"></span></span>
                    <span class="nav-link-text-wrapper"><span class="nav-link-text">@lang('common.dashboard')</span></span>
                </div>
            </a>
        </div>
        <div class="nav-item-wrapper">
            <a class="nav-link label-1" href="{{ route('frontend.pilots.index') }}" role="button" data-bs-toggle="" aria-expanded="false">
                <div class="d-flex align-items-center">
                    <span class="nav-link-icon"><span data-feather="users"></span></span>
                    <span class="nav-link-text-wrapper"><span class="nav-link-text">@lang('disposable.menu_roster')</span></span>
                </div>
            </a>
        </div>
        @if ($DBasic)
            <div class="nav-item-wrapper">
                <a class="nav-link label-1" href="{{ route('DBasic.airlines') }}" role="button" data-bs-toggle="" aria-expanded="false">
                    <div class="d-flex align-items-center">
                        <span class="nav-link-icon"><span data-feather="globe"></span></span>
                        <span class="nav-link-text-wrapper"><span class="nav-link-text">Overview</span></span>
                    </div>
                </a>
            </div>
            <div class="nav-item-wrapper">
                <a class="nav-link label-1" href="{{ route('DBasic.fleet') }}" role="button" data-bs-toggle="" aria-expanded="false">
                    <div class="d-flex align-items-center">
                        <span class="nav-link-icon uil uil-plane fs-8"></span>
                        <span class="nav-link-text-wrapper"><span class="nav-link-text">@lang('disposable.menu_fleet')</span></span>
                    </div>
                </a>
            </div>
            <div class="nav-item-wrapper">
                <a class="nav-link label-1" href="{{ route('DBasic.hubs') }}" role="button" data-bs-toggle="" aria-expanded="false">
                    <div class="d-flex align-items-center">
                        <span class="nav-link-icon"><span data-feather="share-2"></span></span>
                        <span class="nav-link-text-wrapper"><span class="nav-link-text">@lang('disposable.menu_hubs')</span></span>
                    </div>
                </a>
            </div>
            <div class="nav-item-wrapper"><a class="nav-link dropdown-indicator label-1" href="#nv-Analytics" role="button" data-bs-toggle="collapse" aria-expanded="false"
                    aria-controls="nv-Analytics">
                    <div class="d-flex align-items-center">
                        <div class="dropdown-indicator-icon"><span class="fas fa-caret-right"></span></div><span class="nav-link-icon"><span data-feather="trending-up"></span></span><span
                            class="nav-link-text">Analytics</span></span>
                    </div>
                </a>
                <div class="parent-wrapper label-1">
                    <ul class="nav collapse parent" data-bs-parent="#navbarVerticalCollapse" id="nv-Analytics">
                        <li class="collapsed-nav-item-title d-none">Analytics
                        </li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('DBasic.ranks') }}" data-bs-toggle="" aria-expanded="false">
                                <div class="d-flex align-items-center">
                                    <span class="nav-link-icon"><span data-feather="bar-chart-2"></span></span>
                                    <span class="nav-link-text">@lang('disposable.menu_ranks')</span>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('DBasic.awards') }}" data-bs-toggle="" aria-expanded="false">
                                <div class="d-flex align-items-center">
                                    <span class="nav-link-icon"><span data-feather="award"></span></span>
                                    <span class="nav-link-text">@lang('disposable.menu_awards')</span>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('DBasic.stats') }}" data-bs-toggle="" aria-expanded="false">
                                <div class="d-flex align-items-center">
                                    <span class="nav-link-icon"><span data-feather="bar-chart-2"></span></span>
                                    <span class="nav-link-text">@lang('disposable.menu_stats')</span>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        @endif
        @if ($DSpecial)
            <div class="nav-item-wrapper">
                <a class="nav-link label-1" href="{{ route('DSpecial.market') }}" role="button" data-bs-toggle="" aria-expanded="false">
                    <div class="d-flex align-items-center">
                        <span class="nav-link-icon"><span data-feather="shopping-cart"></span></span>
                        <span class="nav-link-text-wrapper"><span class="nav-link-text">@lang('disposable.menu_market')</span></span>
                    </div>
                </a>
            </div>
        @endif
    </li>

    <li class="nav-item">
        <p class="navbar-vertical-label">@lang('disposable.menu_fltops')
        </p>
        <hr class="navbar-vertical-line" />
        <div class="nav-item-wrapper">
            <a class="nav-link label-1" href="{{ route('frontend.flights.index') }}" role="button" data-bs-toggle="" aria-expanded="false">
                <div class="d-flex align-items-center">
                    <span class="nav-link-icon"><span data-feather="navigation-2"></span></span>
                    <span class="nav-link-text-wrapper"><span class="nav-link-text">@lang('disposable.menu_flights')</span></span>
                </div>
            </a>
        </div>
        @if ($DSpecial)
            <div class="nav-item-wrapper">
                <a class="nav-link label-1" href="{{ route('DSpecial.freeflight') }}" role="button" data-bs-toggle="" aria-expanded="false">
                    <div class="d-flex align-items-center">
                        <span class="nav-link-icon"><span data-feather="navigation"></span></span>
                        <span class="nav-link-text-wrapper"><span class="nav-link-text">@lang('disposable.menu_myflight')</span></span>
                    </div>
                </a>
            </div>
            <div class="nav-item-wrapper">
                <a class="nav-link label-1" href="{{ route('DSpecial.tours') }}" role="button" data-bs-toggle="" aria-expanded="false">
                    <div class="d-flex align-items-center">
                        <span class="nav-link-icon"><span data-feather="map-pin"></span></span>
                        <span class="nav-link-text-wrapper"><span class="nav-link-text"> @lang('disposable.menu_tours')</span></span>
                    </div>
                </a>
            </div>
        @endif
        @if ($DBasic)
            <div class="nav-item-wrapper">
                <a class="nav-link label-1" href="{{ route('DBasic.pireps') }}" role="button" data-bs-toggle="" aria-expanded="false">
                    <div class="d-flex align-items-center">
                        <span class="nav-link-icon"><span data-feather="archive"></span></span>
                        <span class="nav-link-text-wrapper"><span class="nav-link-text">@lang('disposable.menu_reports')</span></span>
                    </div>
                </a>
            </div>
        @endif
        <div class="nav-item-wrapper">
            <a class="nav-link label-1" href="{{ route('frontend.livemap.index') }}" role="button" data-bs-toggle="" aria-expanded="false">
                <div class="d-flex align-items-center">
                    <span class="nav-link-icon"><span data-feather="map"></span></span>
                    <span class="nav-link-text-wrapper"><span class="nav-link-text">@lang('disposable.menu_mapflt')</span></span>
                </div>
            </a>
        </div>
        @if ($DBasic)
            <div class="nav-item-wrapper">
                <a class="nav-link label-1" href="{{ route('DBasic.livewx') }}" role="button" data-bs-toggle="" aria-expanded="false">
                    <div class="d-flex align-items-center">
                        <span class="nav-link-icon"><span data-feather="cloud"></span></span>
                        <span class="nav-link-text-wrapper"><span class="nav-link-text">@lang('disposable.menu_mapwx')</span></span>
                    </div>
                </a>
            </div>
        @endif
    </li>

    <li class="nav-item">
        <p class="navbar-vertical-label">@lang('disposable.menu_docs')
        </p>
        <hr class="navbar-vertical-line" />
        <div class="nav-item-wrapper">
            <a class="nav-link label-1" href="{{ route('frontend.downloads.index') }}" role="button" data-bs-toggle="" aria-expanded="false">
                <div class="d-flex align-items-center">
                    <span class="nav-link-icon"><span data-feather="download"></span></span>
                    <span class="nav-link-text-wrapper"><span class="nav-link-text">{{ trans_choice('common.download', 2) }}</span></span>
                </div>
            </a>
        </div>
        @if ($DBasic)
            <div class="nav-item-wrapper">
                <a class="nav-link label-1" href="{{ route('DBasic.news') }}" role="button" data-bs-toggle="" aria-expanded="false">
                    <div class="d-flex align-items-center">
                        <span class="nav-link-icon"><span data-feather="rss"></span></span>
                        <span class="nav-link-text-wrapper"><span class="nav-link-text">@lang('disposable.menu_news')</span></span>
                    </div>
                </a>
            </div>
        @endif
        @if ($DSpecial)
            <div class="nav-item-wrapper">
                <a class="nav-link label-1" href="{{ route('DSpecial.notams') }}" role="button" data-bs-toggle="" aria-expanded="false">
                    <div class="d-flex align-items-center">
                        <span class="nav-link-icon"><span data-feather="file-text"></span></span>
                        <span class="nav-link-text-wrapper"><span class="nav-link-text">@lang('disposable.menu_notams')</span></span>
                    </div>
                </a>
            </div>
            <div class="nav-item-wrapper">
                <a class="nav-link label-1" href="{{ route('DSpecial.ops_manual') }}" role="button" data-bs-toggle="" aria-expanded="false">
                    <div class="d-flex align-items-center">
                        <span class="nav-link-icon"><span data-feather="book-open"></span></span>
                        <span class="nav-link-text-wrapper"><span class="nav-link-text">@lang('disposable.menu_opsman')</span></span>
                    </div>
                </a>
            </div>
        @endif
        @foreach ($page_links->sortBy('name', SORT_NATURAL) as $page)
            <div class="nav-item-wrapper">
                <a class="nav-link label-1" href="{{ $page->url }}" target="{{ $page->new_window ? '_blank' : '_self' }}" role="button" data-bs-toggle="" aria-expanded="false">
                    <div class="d-flex align-items-center">
                        <span class="nav-link-icon {{ $page['icon'] ?? 'fas fa-file-alt' }}"></span>
                        <span class="nav-link-text-wrapper"><span class="nav-link-text">{{ $page['name'] }}</span></span>
                    </div>
                </a>
            </div>
        @endforeach
        @foreach ($moduleSvc->getFrontendLinks($logged_in = true) as &$link)
            <div class="nav-item-wrapper">
                <a class="nav-link label-1" href="{{ url($link['url']) }}" role="button" data-bs-toggle="" aria-expanded="false">
                    <div class="d-flex align-items-center">
                        <span class="nav-link-icon {{ $link['icon'] ?? 'fas fa-boxes' }}"></span>
                        <span class="nav-link-text-wrapper"><span class="nav-link-text">{{ $link['title'] }}</span></span>
                    </div>
                </a>
            </div>
        @endforeach
        @foreach ($moduleSvc->getFrontendLinks($logged_in = false) as &$link)
            <div class="nav-item-wrapper">
                <a class="nav-link label-1" href="{{ url($link['url']) }}" role="button" data-bs-toggle="" aria-expanded="false">
                    <div class="d-flex align-items-center">
                        <span class="nav-link-icon {{ $link['icon'] ?? 'fas fa-boxes' }}"></span>
                        <span class="nav-link-text-wrapper"><span class="nav-link-text">{{ $link['title'] }}</span></span>
                    </div>
                </a>
            </div>
        @endforeach
    </li>

    <li class="nav-item">
        <p class="navbar-vertical-label">Settings
        </p>
        <hr class="navbar-vertical-line" />
        <div class="nav-item-wrapper"><a class="nav-link dropdown-indicator label-1" href="#nv-Languages" role="button" data-bs-toggle="collapse" aria-expanded="false"
                aria-controls="nv-Languages">
                <div class="d-flex align-items-center">
                    <div class="dropdown-indicator-icon"><span class="fas fa-caret-right"></span></div><span class="nav-link-icon"><span
                            class="flag-icon flag-icon-{{ $languages[$locale]['flag-icon'] }}"></span></span><span class="nav-link-text">{{ $languages[$locale]['display'] }}</span></span>
                </div>
            </a>
            <div class="parent-wrapper label-1">
                <ul class="nav collapse parent" data-bs-parent="#navbarVerticalCollapse" id="nv-Languages">
                    <li class="collapsed-nav-item-title d-none">{{ $languages[$locale]['display'] }}
                    </li>
                    @foreach ($languages as $lang => $language)
                        @if ($lang != $locale)
                            <li class="nav-item"><a class="nav-link" href="{{ route('frontend.lang.switch', $lang) }}" data-bs-toggle="" aria-expanded="false">
                                    <div class="d-flex align-items-center">
                                        <span class="nav-link-icon flag-icon flag-icon-{{ $language['flag-icon'] }}"></span>
                                        <span class="nav-link-text">{{ $language['display'] }}</span>
                                    </div>
                                </a>
                            </li>
                        @endif
                    @endforeach
                </ul>
            </div>
        </div>
    @else
        {{-- Menu Items For Guests --}}
    <li class="nav-item">
        <p class="navbar-vertical-label">Airline
        </p>
        <hr class="navbar-vertical-line" />
        <div class="nav-item-wrapper">
            <a class="nav-link label-1" href="{{ route('frontend.pilots.index') }}" role="button" data-bs-toggle="" aria-expanded="false">
                <div class="d-flex align-items-center">
                    <span class="nav-link-icon"><span data-feather="users"></span></span>
                    <span class="nav-link-text-wrapper"><span class="nav-link-text">@lang('disposable.menu_roster')</span></span>
                </div>
            </a>
        </div>
        @if ($DBasic)
            <div class="nav-item-wrapper">
                <a class="nav-link label-1" href="{{ route('DBasic.reports') }}" role="button" data-bs-toggle="" aria-expanded="false">
                    <div class="d-flex align-items-center">
                        <span class="nav-link-icon"><span data-feather="archive"></span></span>
                        <span class="nav-link-text-wrapper"><span class="nav-link-text">@lang('disposable.menu_reports')</span></span>
                    </div>
                </a>
            </div>
        @endif
        <div class="nav-item-wrapper">
            <a class="nav-link label-1" href="{{ route('frontend.livemap.index') }}" role="button" data-bs-toggle="" aria-expanded="false">
                <div class="d-flex align-items-center">
                    <span class="nav-link-icon"><span data-feather="map"></span></span>
                    <span class="nav-link-text-wrapper"><span class="nav-link-text">@lang('disposable.menu_mapflt')</span></span>
                </div>
            </a>
        </div>
        @foreach ($page_links->sortBy('name', SORT_NATURAL) as $page)
            <div class="nav-item-wrapper">
                <a class="nav-link label-1" href="{{ $page->url }}" target="{{ $page->new_window ? '_blank' : '_self' }}" role="button" data-bs-toggle="" aria-expanded="false">
                    <div class="d-flex align-items-center">
                        <span class="nav-link-icon {{ $page['icon'] ?? 'fas fa-file-alt' }}"></span>
                        <span class="nav-link-text-wrapper"><span class="nav-link-text">{{ $page['name'] }}</span></span>
                    </div>
                </a>
            </div>
        @endforeach
@endif
