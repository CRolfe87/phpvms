<div class="card overflow-hidden mb-2">
    <div class="bg-holder d-dark-none z-1" style="background-image:url({{ public_asset('/PFL/img/bg/8.png') }});
    background-position:bottom left;background-size:auto;transform: rotate(180deg);">
    </div>
    <div class="bg-holder d-light-none z-1"
        style="background-image:url({{ public_asset('/PFL/img/bg/8-dark.png') }});
    background-position:bottom left;background-size:auto;transform: rotate(180deg);">
    </div>
    <div class="card-body d-flex flex-column justify-content-between position-relative z-2">
        <div class="card-title mb-4">
            <h4 class="text-body-emphasis">@lang('disposable.lpirep')</h4>
        </div>
        <div class="d-flex gap-2">
            <h4 class="fw-bolder text-nowrap"><a href="{{ route('frontend.pireps.show', [$pirep->id]) }}">{{ optional($pirep->airline)->code . ' ' . $pirep->flight_number }}</a></h4>
            <div class="text-body-tertiary">
                @if (filled($pirep->submitted_at))
                    {{ $pirep->submitted_at->diffForHumans() }}
                @endif
                @if ($pirep->read_only && Theme::getSetting('gen_ivao_vaid') && Theme::getSetting('gen_ivao_icao'))
                    @include('pireps.ivao_vasys')
                @endif
                {!! DT_PirepState($pirep, 'badge') !!}
            </div>
        </div>
        <hr />
        <div class="row text-uppercase">
            <div class="col">
                <h6 style="letter-spacing: .1rem">@lang('common.departure')</h6>
                <span class="fs-8">{{ $pirep->block_off_time->format('H:i') }}Z</span>
            </div>
            <div class="col text-end">
                <h6 style="letter-spacing: .1rem">@lang('common.arrival')</h6>
                <span class="fs-8">{{ $pirep->block_on_time->format('H:i') }}Z</span>
            </div>
        </div>
        <div class="row">
            <div class="col-auto">
                <span>
                    <a class="fs-4 lh-sm fw-bold text-decoration-none my-0" href="{{ route('frontend.airports.show', [$pirep->dpt_airport_id]) }}">
                        {{ $pirep->dpt_airport->iata }}</a>
                </span>
            </div>
            <div class="col text-center">
                <span class="fs-9 fw-bold">{{ DT_ConvertMinutes($pirep->flight_time, '%2dh %2dm') }}</span>
            </div>
            <div class="col-auto text-end">
                <span>
                    <a class="fs-4 lh-sm fw-bold text-decoration-none my-0" href="{{ route('frontend.airports.show', [$pirep->arr_airport_id]) }}">
                        {{ $pirep->arr_airport->iata }}</a>
                </span>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <span class="fs-8">{{ optional($pirep->dpt_airport)->location . ', ' . optional($pirep->dpt_airport)->country }}</span>
            </div>
            <div class="col text-end">
                <span class="fs-8">{{ optional($pirep->arr_airport)->location . ', ' . optional($pirep->arr_airport)->country }}</span>
            </div>
        </div>
        <hr>
        <div class="row g-4 g-xl-1 g-xxl-3 justify-content-between">
            @if (filled($pirep->score))
                <div class="col-sm">
                    <div class="d-block d-inline-flex align-items-center">
                        <div class="d-flex bg-info-subtle rounded flex-center me-3" style="width:32px; height:32px">
                            <span class="uil uil-percentage fs-7 text-info"></span>
                        </div>
                        <div>
                            <p class="fw-bold mb-1">@lang('disposable.score')</p>
                            <h5 class="fw-bolder text-nowrap">{{ $pirep->score }}</h5>
                        </div>
                    </div>
                </div>
            @endif
            @if (filled($pirep->landing_rate))
                <div class="col-sm">
                    <div class="d-block d-inline-flex align-items-center border-start-sm ps-sm-2 ps-xxl-5 border-translucent">
                        <div class="d-flex bg-success-subtle rounded flex-center me-3" style="width:32px; height:32px">
                            <span class="uil uil-plane-arrival fs-7 text-success"></span>
                        </div>
                        <div>
                            <p class="fw-bold mb-1">@lang('disposable.lrate')</p>
                            <h5 class="fw-bolder text-nowrap">
                                {{ $pirep->landing_rate . ' ft/min' }}
                            </h5>
                        </div>
                    </div>
                </div>
            @endif
        </div>
        <hr>
        <div class="d-flex gap-2">
            <p class="fw-bold mb-0">@lang('common.aircraft')</p>
            <p class="fw-bolder text-nowrap mb-0">
                @if ($DBasic)
                    <a href=" {{ route('DBasic.aircraft', [optional($pirep->aircraft)->registration ?? '']) }}">
                @endif
                {{ optional($pirep->aircraft)->ident }}
                @if ($DBasic)
                    </a>
                @endif
            </p>
        </div>
    </div>
</div>
