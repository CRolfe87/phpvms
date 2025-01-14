<!DOCTYPE html>
<html data-navigation-type="default" data-navbar-horizontal-shape="default" lang="en-US" dir="ltr">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />

    <title>@yield('title') | {{ config('app.name') }}</title>

    {{-- Start of required lines block. DON'T REMOVE THESE LINES! They're required or might break things --}}
    <meta name="base-url" content="{!! url('') !!}">
    <meta name="api-key" content="{!! Auth::check() ? Auth::user()->api_key : '' !!}">
    <meta name="csrf-token" content="{!! csrf_token() !!}">

    <link href="{{ public_asset('/assets/global/css/vendor.css') }}" rel="stylesheet" />
    {{--  Scripts --}}
    <script src="{{ public_asset('/assets/vendor/phoenix/imagesloaded/imagesloaded.pkgd.min.js') }}"></script>
    <script src="{{ public_asset('/assets/vendor/phoenix/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ public_asset('/PFL/js/config.js') }}"></script>
    <script src="{{ public_asset('/assets/vendor/phoenix/echarts/echarts.min.js') }}"></script>
    @yield('scripts_head')
    {{-- CSS --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="">
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@300;400;600;700;800;900&amp;display=swap" rel="stylesheet">
    <link href="{{ public_asset('/assets/vendor/phoenix/simplebar/simplebar.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
    <link href="{{ public_asset('/PFL/css/theme.min.css') }}" type="text/css" rel="stylesheet" id="style-default">
    <link href="{{ public_asset('/PFL/css/user.css') }}" type="text/css" rel="stylesheet" id="user-style-default">
    @yield('css')
    {{-- End of the required stuff in the head block --}}
</head>

<body>
    {{-- Theme Helpers --}}
    @include('theme_helpers')
    @php
        $DBasic = isset($DBasic) ? $DBasic : DT_CheckModule('DisposableBasic');
        $DSpecial = isset($DSpecial) ? $DSpecial : DT_CheckModule('DisposableSpecial');
    @endphp
    <main id="top">
        {{-- Navigation --}}
        @if (empty($disable_nav))
            @include('nav')
        @endif
        {{-- Page Contents --}}
        <div class="content">
            {{-- <div class="w-100" style="max-width:2160px"> --}}
            @include('flash.message')
            @yield('content')
            {{-- Footer --}}
            <footer class="footer position-absolute">
                <div class="row g-0 justify-content-between align-items-center h-100">
                    <div class="col-12 col-sm-auto text-center">
                        <p class="mb-0 mt-2 mt-sm-0 text-body">
                            &copy; @if (setting('general.start_date')->format('Y') != date('Y'))
                                {{ setting('general.start_date')->format('Y') }} -
                            @endif {{ date('Y') . ' ' . config('app.name') }}
                            @if (Theme::getSetting('gen_discord_invite') != '')
                                &nbsp;|&nbsp;<a href="https://discord.gg/{{ Theme::getSetting('gen_discord_invite') }}" target="_blank"><i class="fab fa-discord mx-1"></i>Join Our Discord
                                    Server</a>
                            @endif
                        </p>
                    </div>
                    <div class="col-12 col-sm-auto text-center">
                        <p class="mb-0 mt-2 mt-sm-0 text-body">
                            {{-- This "Disposable Theme" must be kept visible as-per theme license. If you want to remove the attribution send an email for details --}}
                            @include('theme_version')
                        </p>
                    </div>
                    <div class="col-12 col-sm-auto text-center">
                        <p class="mb-0 text-body-tertiary text-opacity-85">
                            {{-- This "Powered by phpVMS" must be kept visible as-per phpVMS license. If you want to remove the attribution, a license can be purchased https://docs.phpvms.net/#license --}}
                            Powered by <a href="http://www.phpvms.net" target="_blank">phpVMS v7</a>
                        </p>
                    </div>
                </div>
            </footer>
            {{-- </div> --}}
        </div>
    </main>

    <script>
        var navbarTopStyle = window.config.config.phoenixNavbarTopStyle;
        var navbarTop = document.querySelector('.navbar-top');
        if (navbarTopStyle === 'darker') {
            navbarTop.setAttribute('data-navbar-appearance', 'darker');
        }

        var navbarVerticalStyle = window.config.config.phoenixNavbarVerticalStyle;
        var navbarVertical = document.querySelector('.navbar-vertical');
        if (navbarVertical && navbarVerticalStyle === 'darker') {
            navbarVertical.setAttribute('data-navbar-appearance', 'darker');
        }
    </script>

    {{-- Start of the required tags block. Don't remove these or things will break!! --}}
    <script src="{{ public_asset('/assets/global/js/vendor.js') }}"></script>
    <script src="{{ public_asset('/assets/frontend/js/vendor.js') }}"></script>
    <script src="{{ public_asset('/assets/frontend/js/app.js') }}"></script>
    @yield('scripts')
    @if (empty($plain))
        {{-- EU Privacy Laws Requirements --}}
        {{-- https://privacypolicies.com/blog/eu-cookie-law --}}
        <script>
            window.addEventListener("load", function() {
                window.cookieconsent.initialise({
                    palette: {
                        popup: {
                            background: "#edeff5",
                            text: "#838391"
                        },
                        button: {
                            "background": "#067ec1"
                        }
                    },
                    position: "top",
                })
            });
        </script>
    @endif
    <script>
        $(document).ready(function() {
            $("select.select2").select2({
                width: '100%'
            });
        });
    </script>
    {{-- End the required tags block --}}
    {{--
    Google Analytics tracking code. Only active if an ID has been entered
    You can modify to any tracking code and re-use that settings field, or
    just remove it completely. Only added as a convenience factor
    --}}
    @php $gtag = setting('general.google_analytics_id', null); @endphp
    @if (filled($gtag))
        {{-- Global site tag (gtag.js) - Google Analytics --}}
        <script async src="https://www.googletagmanager.com/gtag/js?id={{ $gtag }}"></script>
        <script>
            window.dataLayer = window.dataLayer || [];

            function gtag() {
                dataLayer.push(arguments);
            }
            gtag('js', new Date());
            gtag('config', '{{ $gtag }}');
        </script>
    @endif
    {{-- End of the Google Analytics code --}}
    {{-- UTC Clock --}}
    @if (Theme::getSetting('gen_utc_clock') && Auth::check())
        <script type="text/javascript">
            var timeInterval = setInterval(display_ct, 500);

            function display_ct() {
                var Now = new Date();
                var UTC_Clock = ('0' + Now.getUTCHours()).slice(-2) + ':' + ("0" + Now.getUTCMinutes()).slice(-2);
                // var Local_Clock = ('0' + Now.getHours()).slice(-2) + ':' +  ("0" + Now.getMinutes()).slice(-2) + ':' +  ('0' + Now.getSeconds()).slice(-2);
                // var UTC_Clock = ('0' + Now.getUTCHours()).slice(-2) + ':' +  ("0" + Now.getUTCMinutes()).slice(-2) + ':' +  ('0' + Now.getUTCSeconds()).slice(-2);
                document.getElementById('utc_clock').innerHTML = UTC_Clock + 'Z';
            }
        </script>
    @endif
    {{-- JavaScripts --}}
    <script src="{{ public_asset('/assets/vendor/phoenix/popper/popper.min.js') }}"></script>
    <script src="{{ public_asset('/assets/vendor/phoenix/bootstrap/bootstrap.min.js') }}"></script>
    <script src="{{ public_asset('/assets/vendor/phoenix/anchorjs/anchor.min.js') }}"></script>
    <script src="{{ public_asset('/assets/vendor/phoenix/is/is.min.js') }}"></script>
    <script src="{{ public_asset('/assets/vendor/phoenix/fontawesome/all.min.js') }}"></script>
    <script src="{{ public_asset('/assets/vendor/phoenix/lodash/lodash.min.js') }}"></script>
    <script src="{{ public_asset('/assets/vendor/phoenix/list.js/list.min.js') }}"></script>
    <script src="{{ public_asset('/assets/vendor/phoenix/feather-icons/feather.min.js') }}"></script>
    <script src="{{ public_asset('/assets/vendor/phoenix/dayjs/dayjs.min.js') }}"></script>
    <script src="{{ public_asset('/assets/vendor/phoenix/lottie/lottie.min.js') }}"></script>
    <script src="{{ public_asset('/PFL/js/phoenix.js') }}"></script>
    <script src="{{ public_asset('/PFL/js/echarts-example.js') }}"></script>
</body>

</html>
