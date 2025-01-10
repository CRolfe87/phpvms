@extends('app')
@section('title', trans_choice('common.flight', 2))
@include('theme_helpers')
@php
    $units = isset($units) ? $units : DT_GetUnits();
    $DBasic = isset($DBasic) ? $DBasic : DT_CheckModule('DisposableBasic');
    $DSpecial = isset($DSpecial) ? $DSpecial : DT_CheckModule('DisposableSpecial');
    $tour_codes = $DSpecial ? DS_GetTourCodes() : [];
@endphp
@section('content')
    @if (!$flights->count())
        <div class="alert alert-info mb-1 p-1 px-2 fw-bold">No flights found !</div>
    @else
        <div class="row">
            <div class="col-lg-9">
                @if (Theme::getSetting('flights_table'))
                    <h2 class="mb-2 lh-sm">
                        {{ trans_choice('common.flight', 2) }}
                    </h2>
                    <div class="table-responsive scrollbar">
                        @include('flights.table')
                    </div>

                    @if ($flights->count())
                        @lang('disposable.pagination', ['first' => $flights->firstItem(), 'last' => $flights->lastItem(), 'total' => $flights->total()])
                    @endif
                @else
                    @include('flights.card')
                @endif
                {{ $flights->withQueryString()->links('pagination.auto') }}
            </div>
            <div class="col-lg-3">
                @include('flights.search')
                @include('flights.nav')
                @if ($DBasic && Theme::getSetting('gen_map_flight'))
                    <div class="mb-2">
                        @widget('DBasic::Map')
                    </div>
                @endif
                @if ($DBasic && Theme::getSetting('gen_map_fleet'))
                    <div class="mb-2">
                        @widget('DBasic::Map', ['source' => 'fleet'])
                    </div>
                @endif
            </div>
        </div>
        @if (setting('bids.block_aircraft', false))
            @include('flights.bids_aircraft')
        @endif
    @endif
@endsection

@include('flights.scripts')
