{{-- ROW WITH ICONS --}}
<div class="px-3 mb-4">
    <div class="row justify-content-between">
        <div class="col-6 col-md-3 col-xxl text-center border-translucent border-start-xxl border-end-xxl-0 border-bottom-xxl-0 border-end border-bottom pb-4 pb-xxl-0">
            <span class="uil fs-5 lh-1 uil-plane text-primary"></span>
            <h1 class="fs-8 pt-3">{{ $user->flights }}</h1>
            <p class="fs-9 mb-0">{{ trans_choice('common.flight', $user->flights) }}</p>
        </div>
        <div class="col-6 col-md-3 col-xxl text-center border-translucent border-start-xxl border-end-xxl-0 border-bottom-xxl-0 border-end-md border-bottom pb-4 pb-xxl-0">
            <span class="uil fs-5 lh-1 uil-clock text-info"></span>
            <h1 class="fs-8 pt-3">@minutestotime($user->flight_time)</h1>
            <p class="fs-9 mb-0">@lang('pireps.flighttime')</p>
        </div>
        <div class="col-6 col-md-3 col-xxl text-center border-translucent border-start-xxl border-end border-end-xxl-0 border-bottom-xxl-0 border-bottom pb-4 pb-xxl-0 pt-4 pt-md-0">
            <span class="uil fs-5 lh-1 uil-location-pin-alt text-danger"></span>
            <h1 class="fs-8 pt-3">{{ $current_airport ?? '--' }}</h1>
            <p class="fs-9 mb-0">@lang('airports.current')</p>
        </div>
        <div class="col-6 col-md-3 col-xxl text-center border-translucent border-start-xxl border-bottom-xxl-0 border-bottom border-end-xxl pb-4 pb-xxl-0 pt-4 pt-md-0">
            <span class="uil fs-5 lh-1 uil-dollar-alt text-success"></span>
            <h1 class="fs-8 pt-3">{{ optional($user->journal)->balance }}</h1>
            <p class="fs-9 mb-0">@lang('dashboard.yourbalance')</p>
        </div>
        @if ($DBasic)
            <div class="col-6 col-md-3 col-xxl text-center border-translucent border-start-xxl border-end border-end-xxl-0 border-bottom border-bottom-md-0 pb-4 pb-xxl-0 pt-4 pt-xxl-0">
                <span class="uil fs-5 lh-1 uil-percentage text-primary"></span>
                <h1 class="fs-8 pt-3">@widget('DBasic::PersonalStats', ['user' => $user->id, 'type' => 'avgscore'])</h1>
                <p class="fs-9 mb-0">@lang('disposable.avg_score')</p>
            </div>
            <div class="col-6 col-md-3 col-xxl text-center text-center border-translucent border-start-xxl border-end-md border-bottom border-bottom-md-0 pb-md-4 pb-xxl-0 pt-4 pt-xxl-0">
                <span class="uil fs-5 lh-1 uil-stopwatch text-info"></span>
                <h1 class="fs-8 pt-3">@widget('DBasic::PersonalStats', ['user' => $user->id, 'type' => 'avgtime'])</h1>
                <p class="fs-9 mb-0">@lang('disposable.avg_ftime')</p>
            </div>
            <div class="col-6 col-md-3 col-xxl text-center text-center border-translucent border-start-xxl border-end border-end-xxl-0 pb-md-4 pb-xxl-0 pt-4 pt-xxl-0">
                <span class="uil fs-5 lh-1 uil-pump text-warning"></span>
                <h1 class="fs-8 pt-3">@widget('DBasic::PersonalStats', ['user' => $user->id, 'type' => 'avgfuel'])</h1>
                <p class="fs-9 mb-0">@lang('disposable.avg_fused')</p>

            </div>
            <div class="col-6 col-md-3 col-xxl text-center border-translucent border-start-xxl border-end-xxl pb-md-4 pb-xxl-0 pt-4 pt-xxl-0">
                <span class="uil fs-5 lh-1 uil-plane-arrival text-success"></span>
                <h1 class="fs-8 pt-3">@widget('DBasic::PersonalStats', ['user' => $user->id, 'type' => 'avglanding'])</h1>
                <p class="fs-9 mb-0">@lang('disposable.avg_lrate')</p>
            </div>
        @endif
    </div>
</div>
