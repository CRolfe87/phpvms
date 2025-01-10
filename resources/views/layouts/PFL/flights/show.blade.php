@extends('app')
@section('title', trans_choice('common.flight', 1) . ' ' . $flight->ident)
@include('theme_helpers')
@php
    $units = isset($units) ? $units : DT_GetUnits();
    $DBasic = isset($DBasic) ? $DBasic : DT_CheckModule('DisposableBasic');
    $DSpecial = isset($DSpecial) ? $DSpecial : DT_CheckModule('DisposableSpecial');
@endphp
@section('content')
    <div class="row g-2">
        <div class="col-xxl-6">
            <div class="row">
                <div class="col">
                    <div class="card mb-2">
                        <div class="card-header bg-body p-2">
                            <div class="row g-3 justify-content-between align-items-center">
                                <div class="col">
                                    <h5 class="pt-2 px-2">
                                        {{ optional($flight->airline)->code . ' ' . $flight->flight_number }}
                                        <span class="fw-normal d-block text-body-tertiary pt-1">
                                            @if (filled($flight->callsign))
                                                {{ optional($flight->airline)->icao . '#' . $flight->callsign }}
                                            @endif
                                        </span>
                                    </h5>
                                </div>
                                <div class="col-auto">
                                    {!! DT_FlightType($flight->flight_type, 'button') !!}
                                    {!! DT_RouteCode($flight->route_code, 'button') !!}
                                    {!! DT_RouteLeg($flight->route_leg, 'button') !!}
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h6 class="text-uppercase" style="letter-spacing: .1rem">@lang('common.departure')</h6>
                                    @if (filled($flight->dpt_time))
                                        <span class="fs-8">{{ DT_FormatScheduleTime($flight->dpt_time) }}</span>
                                    @endif
                                </div>
                                <div class="col text-center">
                                    <h6 class="text-uppercase" style="letter-spacing: .1rem">Enroute</h6>
                                    <span class="fs-8">{{ DT_ConvertMinutes($flight->flight_time, '%2dh %2dm') }}</span>
                                </div>
                                <div class="col text-end">
                                    <h6 class="text-uppercase" style="letter-spacing: .1rem">@lang('common.arrival')</h6>
                                    @if (filled($flight->arr_time))
                                        <span class="fs-8">{{ DT_FormatScheduleTime($flight->arr_time) }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-auto">
                                    <span>
                                        <a class="fs-4 lh-sm fw-bold text-decoration-none my-0" href="{{ route('frontend.airports.show', [$flight->dpt_airport_id]) }}">
                                            {{ $flight->dpt_airport->iata }}</a>
                                    </span>
                                </div>
                                <div class="col text-center">
                                    <h6 style="letter-spacing: .1rem"></h6>
                                    <span class="fs-8">{{ DT_ConvertDistance($flight->distance) }}</span>
                                </div>
                                <div class="col-auto text-end">
                                    <span>
                                        <a class="fs-4 lh-sm fw-bold text-decoration-none my-0" href="{{ route('frontend.airports.show', [$flight->arr_airport_id]) }}">
                                            {{ $flight->arr_airport->iata }}</a>
                                    </span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <span class="fs-8">{{ optional($flight->dpt_airport)->location . ', ' . optional($flight->dpt_airport)->country }}</span>
                                </div>
                                <div class="col text-end">
                                    <span class="fs-8">{{ optional($flight->arr_airport)->location . ', ' . optional($flight->arr_airport)->country }}</span>
                                </div>
                            </div>
                            {{-- <div class="col-lg text-end text-nowrap">
                                @if (filled($flight->alt_airport_id))
                                    <a href="{{ route('frontend.airports.show', [$flight->alt_airport_id]) }}">
                                        {{ optional($flight->alt_airport)->full_name }}
                                    </a>
                                    <i class="fas fa-map-marker-alt m-1" title="Preferred Alternate Aerodrome"></i>
                                @endif
                            </div> --}}
                            @if ($flight->subfleets->count() > 0)
                                <div class="border-top py-2">
                                    <h6 class="text-uppercase" style="letter-spacing: .1rem">Subfleets</h6>
                                    @foreach ($flight->subfleets->sortBy('name', SORT_NATURAL) as $sf)
                                        @if (!$loop->first)
                                            &bull;
                                        @endif
                                        @if ($DBasic)
                                            <a href="{{ route('DBasic.subfleet', [$sf->type]) }}">{{ $sf->name . ' (' . optional($sf->airline)->icao . ')' }}</a>
                                        @else
                                            {{ $sf->name . ' (' . optional($sf->airline)->icao . ')' }}
                                        @endif
                                    @endforeach
                                </div>
                            @endif
                            @if (filled($flight->start_date) || filled($flight->end_date) || filled($flight->days))
                                <div class="border-top py-2">
                                    <div class="row">
                                        <div class="col-auto">
                                            <h6 class="text-uppercase" style="letter-spacing: .1rem">Start Date</h6>
                                            @if ($flight->start_date)
                                                {{ $flight->start_date->format('d M Y') }}
                                            @endif
                                        </div>
                                        <div class="col text-center">
                                            <h6 class="text-uppercase text-center" style="letter-spacing: .1rem">Schedule</h6>
                                            {{ DT_FlightDays($flight->days) }}
                                        </div>
                                        <div class="col-auto text-end">
                                            <h6 class="text-uppercase text-end" style="letter-spacing: .1rem">End Date</h6>
                                            @if ($flight->end_date)
                                                {{ $flight->end_date->format('d M Y') }}
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endif
                            @if (filled($flight->notes))
                                <div class="border-top pt-2">
                                    <h6 class="text-uppercase" style="letter-spacing: .1rem">Remarks</h6>
                                    {!! $flight->notes !!}
                                </div>
                            @endif

                        </div>
                        <div class="text-end p-2">
                            @if ($DBasic && Theme::getSetting('flight_jumpseat'))
                                <div class="float-start">@widget('DBasic::JumpSeat', ['dest' => $flight->dpt_airport_id])</div>
                            @endif
                            @if (Theme::getSetting('flight_bid'))
                                @if (!setting('pilots.only_flights_from_current') || $flight->dpt_airport_id === Auth::user()->curr_airport_id)
                                    {{-- !!! IMPORTANT NOTE !!! Don't remove the "save_flight" class, It will break the AJAX to save/delete --}}
                                    <span class="btn btn-sm save_flight {{ isset($bid) ? 'btn-subtle-danger' : 'btn-subtle-success' }}" onclick="AddRemoveBid('{{ isset($bid) ? 'remove' : 'add' }}')">
                                        {{ isset($bid) ? __('disposable.bid_rem') : __('disposable.bid_add') }}
                                    </span>
                                @endif
                            @endif
                            @if (Theme::getSetting('flight_simbrief') && filled(setting('simbrief.api_key')))
                                @if (!setting('simbrief.only_bids') || (setting('simbrief.only_bids') && isset($bid)))
                                    @if ($flight->simbrief && $flight->simbrief->user_id == Auth::user()->id)
                                        <a id="mylink" href="{{ route('frontend.simbrief.briefing', $flight->simbrief->id) }}" class="btn btn-sm btn-subtle-secondary">
                                            @lang('disposable.sb_view')
                                        </a>
                                    @else
                                        <a id="mylink" href="{{ route('frontend.simbrief.generate') }}?flight_id={{ $flight->id }}" class="btn btn-sm btn-subtle-primary">
                                            @lang('disposable.sb_generate')
                                        </a>
                                    @endif
                                @endif
                            @endif
                            @if ($acars_plugin && isset($bid))
                                <a href="vmsacars:bid/{{ $bid->id }}" class="btn btn-sm btn-subtle-warning">
                                    @lang('disposable.load_acars')
                                </a>
                            @elseif($acars_plugin)
                                <a href="vmsacars:flight/{{ $flight->id }}" class="btn btn-sm btn-subtle-warning">
                                    @lang('disposable.load_acars')
                                </a>
                            @endif
                            @if (Theme::getSetting('pireps_manual'))
                                <a href="{{ route('frontend.pireps.create') }}?flight_id={{ $flight->id }}" class="btn btn-sm btn-subtle-info">
                                    @lang('disposable.new_pirep')
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">

                    <div class="card mb-2">
                        <div class="card-header p-1">
                            <h5 class="m-1">
                                @lang('disposable.map')
                                <i class="fas fa-map-marked float-end"></i>
                            </h5>
                        </div>
                        <div class="card-body p-0">
                            @include('flights.map')
                        </div>
                    </div>
                </div>
            </div>



        </div>
        <div class="col-xxl-6">
            <div class="row gx-2">
                <div class="col-xl-6 col-xxl-12">
                    @widget('Weather', ['icao' => $flight->dpt_airport_id, 'raw_only' => true])
                </div>
                <div class="col-xl-6 col-xxl-12">
                    @widget('Weather', ['icao' => $flight->arr_airport_id, 'raw_only' => true])
                    @if (filled($flight->alt_airport) && $flight->alt_airport_id != $flight->dpt_airport_id)
                        @widget('Weather', ['icao' => $flight->alt_airport_id, 'raw_only' => true])
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

{{-- DO NOT REMOVE THIS SCRIPT IT IS USED FOR BIDDING FROM FLIGHT DETAILS PAGE --}}
@if (Theme::getSetting('flight_bid'))
    @section('scripts')
        @parent
        <script type="text/javascript">
            async function AddRemoveBid(action) {

                const flight_id = "{{ $flight->id }}";

                if (action === "add") {
                    await phpvms.bids.addBid(flight_id);
                    console.log('successfully saved flight');
                    alert('@lang('flights.bidadded')');
                    location.reload();
                } else {
                    await phpvms.bids.removeBid(flight_id);
                    console.log('successfully removed flight');
                    alert('@lang('flights.bidremoved')');
                    location.reload();
                }
            }
        </script>
    @endsection
@endif
