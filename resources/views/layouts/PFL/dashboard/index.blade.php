@extends('app')
@section('title', __('common.dashboard'))
@include('theme_helpers')
@php
    $DBasic = isset($DBasic) ? $DBasic : DT_CheckModule('DisposableBasic');
    $DSpecial = isset($DSpecial) ? $DSpecial : DT_CheckModule('DisposableSpecial');
    $units = isset($units) ? $units : DT_GetUnits();
@endphp
@section('content')
    {{-- User State Warning --}}
    @if ($user->state === \App\Models\Enums\UserState::ON_LEAVE)
        <div class="row mb-1">
            <div class="col">
                <div class="alert alert-warning mb-1 p-1 px-2 fw-bold" role="alert">
                    @lang('disposable.user_on_leave')
                </div>
            </div>
        </div>
    @endif
    {{-- Full row with more icons --}}
    @include('dashboard.icons')

    @if ($DSpecial)
        @widget('DSpecial::Assignments')
        @widget('DSpecial::TourProgress')
    @endif
    @if ($DBasic)
    @endif

    <div class="row g-2 mx-lg-n5">
        <div class="col-xl-7">
            @if ($last_pirep !== null)
                @include('dashboard.pirep_card', ['pirep' => $last_pirep])
            @endif
        </div>
        <div class="col-xl-5">
            @if ($last_pirep !== null)
                @include('dashboard.pirep_comments', ['pirep' => $last_pirep])
            @endif
        </div>
    </div>

    {{-- Main Dashboard : LEFT --}}
    <div class="row g-2 mx-lg-n5">
        <div class="col-xl-7 pb-xl-2 d-flex flex-column gap-1">
            @widget('latestNews', ['count' => 3])
            @if ($DBasic)
                @widget('DBasic::ActiveBookings', ['source' => 'simbrief'])
                @widget('DBasic::RandomFlights')
            @endif
            <div class="flex-fill position-relative mt-n1 mx-n1">
                <div class="bg-holder" style="background-size:auto;
                background-position:top left;
                background-image:url({{ public_asset('/PFL/img/bg/bg-left-21.png') }})">
                </div>
                <div class="bg-holder" style="background-size:auto;
                background-position:top right;
                background-image:url({{ public_asset('/PFL/img/bg/bg-right-20.png') }})">
                </div>
            </div>
        </div>
        <div class="col-xl-5 d-flex flex-column">
            {{-- @if ($last_pirep !== null)
                @include('dashboard.pirep_card', ['pirep' => $last_pirep])
            @endif --}}
            @if ($DBasic)
                @widget('DBasic::JumpSeat')
                @widget('DBasic::TransferAircraft')
                @widget('DBasic::AirportInfo')
                @widget('DBasic::Discord')
            @endif
            <div class="flex-fill position-relative mx-n1">
                <div class="bg-holder" style="background-size:auto;
                background-position:top right;
                background-image:url({{ public_asset('/PFL/img/bg/bg-right-20.png') }})">
                </div>
                <div class="bg-holder" style="background-size:auto;
                background-position:top right;
                background-image:url({{ public_asset('/PFL/img/bg/bg-right-21.png') }})">
                </div>
            </div>
        </div>
    </div>
    @if ($DBasic)
        <div class="row g-2 mx-lg-n5 mb-2">
            <div class="col-xl-4">
                @widget('DBasic::LeaderBoard', ['source' => 'pilot', 'period' => 'lasty', 'count' => 5, 'type' => 'flights'])
            </div>
            <div class="col-xl-4">
                @widget('DBasic::LeaderBoard', ['source' => 'pilot', 'period' => 'lasty', 'count' => 5, 'type' => 'time'])
            </div>
            <div class="col-xl-4">
                @widget('DBasic::LeaderBoard', ['source' => 'pilot', 'period' => 'lasty', 'count' => 5, 'type' => 'lrate'])
            </div>
        </div>
    @endif
    {{-- Main Dashboard : RIGHT --}}

    @if (!$DBasic)
        @widget('latestPireps', ['count' => 5])
        @widget('latestPilots', ['count' => 5])
    @endif
    <div class="row g-2 mx-lg-n5">
        <div class="col">
            @if (Theme::getSetting('dash_embed_wx') && $current_airport)
                <div class="card p-0 mb-2 bg-transparent">
                    <div class="card-header ps-2 p-1 m-0">
                        <a href="https://metar-taf.com/{{ $current_airport }}" id="metartaf-DispoThM" style="font-size: 0.925rem; width:100%; height:255px; display:block; pointer-events: none">METAR
                            {{ $current_airport }}</a>
                    </div>
                    <div class="card-header px-1 p-0 m-0 small text-end">
                        <a class="float-start" href="https://metar-taf.com/live/{{ $current_airport }}" target="_blank">Livestream</a>
                        <a href="https://metar-taf.com/{{ $current_airport }}" target="_blank">Data provided by Metar-Taf.com</a>
                    </div>
                    <script async defer crossorigin="anonymous" src="https://metar-taf.com/embed-js/{{ $current_airport }}?bg_color=1f0dc0e6&layout=landscape&target=DispoThM"></script>
                </div>
            @elseif($current_airport)
                @widget('Weather', ['icao' => $current_airport, 'raw_only' => true])
            @endif
        </div>
    </div>

    <div class="mx-n4 mx-lg-n6 bg-body-emphasis border-top">
        <div class="pt-6 px-4 px-lg-6">
            <div class="card-title">
                <h4 class="text-body-emphasis">Maps</h4>
            </div>
            <ul class="nav nav-underline fs-9 text-uppercase " style="letter-spacing:.1rem;" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link active" id="live-map-tap" data-bs-toggle="tab" href="#tab-live-map" role="tab" aria-controls="tab-live-map" aria-selected="true">Live
                    </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="flights-tab" data-bs-toggle="tab" href="#tab-flights" role="tab" aria-controls="tab-flights" aria-selected="false" tabindex="-1"
                        onclick="genericExpandMap()">
                        Flights
                    </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="fleet-tab" data-bs-toggle="tab" href="#tab-fleet" role="tab" aria-controls="tab-fleet" aria-selected="false" tabindex="-1" onclick="fleetExpandMap()">
                        Fleet
                    </a>
                </li>
            </ul>
        </div>
        <div class="tab-content border-top" id="myTabContent">
            <div class="tab-pane fade active show" id="tab-live-map" role="tabpanel" aria-labelledby="live-map-tap">
                @if (Theme::getSetting('dash_livemap'))
                    @widget('liveMap', ['table' => false, 'width' => '100%', 'height' => '500px'])
                @elseif($DBasic)
                    @widget('DBasic::FlightBoard')
                @endif
            </div>

            <div class="tab-pane fade" id="tab-flights" role="tabpanel" aria-labelledby="flights-tab" style="height: 500px">
                @if ($DBasic && Theme::getSetting('gen_map_flight'))
                    @widget('DBasic::Map', ['embed' => true])
                @endif
            </div>
            <div class="tab-pane fade" id="tab-fleet" role="tabpanel" aria-labelledby="fleet-tab" style="height: 500px">
                @if ($DBasic && Theme::getSetting('gen_map_fleet'))
                    @widget('DBasic::Map', ['source' => 'fleet', 'embed' => true])
                @endif
            </div>
        </div>
    </div>
@endsection
