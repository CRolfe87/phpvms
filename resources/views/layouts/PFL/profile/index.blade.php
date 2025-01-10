@extends('app')
@section('title', __('common.profile'))
@include('theme_helpers')
@php
    $units = isset($units) ? $units : DT_GetUnits();
    $DBasic = isset($DBasic) ? $DBasic : DT_CheckModule('DisposableBasic');
    $DSpecial = isset($DSpecial) ? $DSpecial : DT_CheckModule('DisposableSpecial');
    $Auth_ID = Auth::id();
    $ivao_id = optional($user->fields->firstWhere('name', Theme::getSetting('gen_ivao_field')))->value;
    $vatsim_id = optional($user->fields->firstWhere('name', Theme::getSetting('gen_vatsim_field')))->value;
    $AdminCheck = false;
@endphp
@ability('admin', 'admin-access')
    @php $AdminCheck = true; @endphp
@endability
@section('content')

    <div class="mx-n2 mx-lg-n4 pb-4">
        <div class="row">
            <div class="col-md-auto">
                <div class="card mb-2">
                    <div class="card-body">
                        <div class="row align-items-center g-3 text-center">
                            <div class="col-12">
                                @if ($user->avatar == null)
                                    <div class="avatar avatar-5xl"><img class="rounded-circle" src="{{ $user->gravatar(512) }}" alt=""></div>
                                @else
                                    <div class="avatar avatar-5xl"><img class="rounded-circle" src="{{ $user->avatar->url }}" alt=""></div>
                                @endif
                            </div>
                            <div class="col-12 flex-1">
                                <h3 class="fw-bolder mb-2">
                                    @if (Theme::getSetting('roster_ident'))
                                        {{ $user->ident }}
                                    @endif
                                </h3>
                                <p class="mb-0">
                                    {{ $user->name_private }}
                                </p>
                                <p>{{ optional($user->rank)->name }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- Pilot details --}}
                <div class="card mb-2">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between mb-5">
                            <h3 class="mb-0">Pilot Details</h3>
                            <a href="{{ route('frontend.profile.edit', [$user->id]) }}" class="btn btn-sm btn-subtle-primary">
                                @lang('common.edit')
                            </a>
                        </div>
                        <div class="mb-4">
                            <div class="d-flex align-items-center mb-1">
                                <span class="me-2" data-feather="home"></span>
                                <h5 class="text-body-highlight mb-0">{{ __('airports.home') }}</h5>
                            </div>
                            @if ($DBasic)
                                <a href="{{ route('DBasic.hub', [$user->home_airport_id ?? '']) }}">
                                @else
                                    <a href="{{ route('frontend.airports.show', [$user->home_airport_id ?? '']) }}">
                            @endif
                            {{ $user->home_airport_id ?? '---' }}
                            </a>
                        </div>
                        @if (filled($user->timezone))
                            <div class="mb-4">
                                <div class="d-flex align-items-center mb-1">
                                    <span class="me-2" data-feather="clock"></span>
                                    <h5 class="text-body-highlight mb-0">@lang('common.timezone')</h5>
                                </div>
                                {{ $user->timezone }}
                            </div>
                        @endif
                        @foreach ($userFields->where('active', 1) as $field)
                            @if (!$field->private && $field->name != Theme::getSetting('gen_ivao_field') && $field->name != Theme::getSetting('gen_vatsim_field'))
                                <div class="mb-4">
                                    <div class="d-flex align-items-center mb-1">
                                        @if (filled($field->description))
                                            <span class="me-2" data-feather="info" title="{{ $field->description }}"></span>
                                        @endif
                                        <h5 class="text-body-highlight mb-0">{{ $field->name }}</h5>
                                    </div>
                                    {{ $field->value ?? '--' }}
                                </div>
                            @endif
                        @endforeach
                        @if (filled($user->discord_id))
                            <div class="mb-4">
                                <div class="d-flex align-items-center mb-1">
                                    <i class="uil uil-discord me-2" @ability('admin', 'admin-access') @endability></i>
                                    <h5 class="text-body-highlight mb-0">Discord ID</h5>
                                </div>
                                {{ $user->discord_id }}
                            </div>
                        @endif
                        @if (setting('pilots.allow_transfer_hours') === true || filled($user->transfer_time))
                            <div class="mb-4">
                                <div class="d-flex align-items-center mb-1">
                                    <span class="uil uil-exchange me-2"></span>
                                    <h5 class="text-body-highlight mb-0">Transfer Time</h5>
                                </div>
                                @minutestohours($user->transfer_time) hr
                            </div>
                        @endif
                        @if ($user->id === $Auth_ID)
                            <div class="mb-4">
                                <span id="email_show" style="display: none;">
                                    <div class="d-flex align-items-center mb-1">
                                        <span class="me-2" data-feather="mail"></span>
                                        <h5 class="text-body-highlight mb-0 me-2">E-mail</h5>
                                        <i class="fas fa-eye-slash me-1" onclick="emailHide()"></i>
                                    </div>
                                    {{ $user->email }}
                                </span>
                                <span id="email_hide">
                                    <div class="d-flex align-items-center mb-1">
                                        <span class="me-2" data-feather="mail"></span>
                                        <h5 class="text-body-highlight mb-0 me-2">E-mail</h5>
                                        <i class="fas fa-eye me-1" onclick="emailShow()"></i>
                                    </div>
                                    <span class="fs-9 text-body-quaternary">{!! str_repeat('&#9679', strlen($user->email)) !!}</span>
                                </span>
                            </div>
                        @endif
                        <div class="mb-4">
                            <div class="d-flex align-items-center mb-1">
                                <span class="me-2" data-feather="user-plus"></span>
                                <h5 class="text-body-highlight mb-0">Member Since</h5>
                            </div>
                            {{ $user->created_at->format('l d M Y') }}<br />
                            ({{ $user->created_at->diffForHumans() }})
                        </div>
                    </div>
                </div>

                <div class="card mb-2">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-5">
                            <h3 class="mb-0">Activity</h3>
                        </div>
                        @if (filled($user->curr_airport_id) || filled($user->home_airport_id))
                            <div class="mb-4">
                                <div class="d-flex align-items-center mb-1">
                                    <span class="me-2" data-feather="map-pin"></span>
                                    <h5 class="text-body-highlight mb-0">Current Location</h5>
                                </div>
                                @if ($DBasic)
                                    <a href="{{ route('DBasic.hub', [$user->curr_airport_id ?? $user->home_airport_id]) }}">
                                    @else
                                        <a href="{{ route('frontend.airports.show', [$user->curr_airport_id ?? $user->home_airport_id]) }}">
                                @endif
                                {{ $user->curr_airport_id ?? $user->home_airport_id }}
                                </a>
                            </div>
                        @endif
                        @if ($user->last_pirep)
                            <div class="mb-4">
                                <div class="d-flex align-items-center mb-1">
                                    <span class="me-2" data-feather="activity"></span>
                                    <h5 class="text-body-highlight mb-0">Last Flight</h5>
                                </div>
                                {{ $user->last_pirep->submitted_at->diffForHumans() }}
                            </div>
                        @endif
                        <div>
                            <div class="d-flex align-items-center mb-1">
                                <span class="me-2" data-feather="check-circle"></span>
                                <h5 class="text-body-highlight mb-0">@lang('common.state')</h5>
                            </div>
                            {!! DT_UserState($user) !!}
                        </div>
                    </div>
                </div>
                {{-- End Pilot Details --}}
                <div class="card mb-2">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-5">
                            <h3>Toolbox</h3>
                        </div>

                        @if ($user->id === $Auth_ID)
                            <div class="mb-4">
                                <div>
                                    <span id="apiKey_show" style="display: none;">
                                        <div class="d-flex align-items-center mb-1">
                                            <span class="me-2" data-feather="key"></span>
                                            <h5 class="text-body-highlight mb-0 me-2">@lang('profile.apikey')</h5>
                                            <i class="fas fa-eye-slash me-1" onclick="apiKeyHide()"></i>
                                        </div>
                                        {{ $user->api_key }}
                                    </span>
                                    <span id="apiKey_hide">
                                        <div class="d-flex align-items-center mb-1">
                                            <span class="me-2" data-feather="key"></span>
                                            <h5 class="text-body-highlight mb-0 me-2">@lang('profile.apikey')</h5>
                                            <i class="fas fa-eye me-1" onclick="apiKeyShow()"></i>
                                        </div>
                                        <span class="fs-9 text-body-quaternary">{!! str_repeat('&#9679', strlen($user->api_key)) !!}</span>
                                    </span>
                                </div>
                            </div>
                        @endif

                        <div class="d-grid gap-2">
                            @if ($user->id === $Auth_ID)
                                <a href="{{ route('frontend.profile.regen_apikey') }}" class="btn btn-subtle-warning" onclick="return confirm('Are you sure? This will reset your API key!')">
                                    @lang('profile.newapikey')
                                </a>
                                {{-- @if (isset($acars) && $acars === true) --}}
                                <a href="{{ route('frontend.profile.acars') }}" class="btn btn-subtle-success" onclick="alert('Copy or Save to \'My Documents/phpVMS\'')">
                                    Download vmsAcars Config
                                </a>
                                {{-- @endif --}}
                            @endif
                            @if ($DBasic && $user->flights > 0)
                                @widget('DBasic::Map', ['source' => 'user', 'user_id' => $user->id])
                            @endif
                            @if ($DSpecial)
                                @ability('admin', 'admin-user')
                                    {{ Form::open(['route' => 'DSpecial.assignments_manual', 'method' => 'post']) }}
                                    <input type="hidden" name="curr_page" value="{{ url()->full() }}">
                                    <input type="hidden" name="userid" value="{{ $user->id }}">
                                    <input type="hidden" name="resetmonth" value="true">
                                    <button class="btn btn-subtle-danger w-100" type="submit" onclick="return confirm('Are you REALLY sure ? This will DELETE and re-assign flights !')">
                                        Re-Assign Current Month
                                    </button>
                                    {{ Form::close() }}
                                @endability
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md">
                <div class="lead-details-container">
                    @if ($DBasic && $user->flights > 0)
                        @include('profile.user_stats')
                    @endif
                    @if (filled($user->awards))
                        @include('profile.user_awards')
                    @endif
                    @if ($DBasic && $user->flights > 0)
                        @if ($Auth_ID || $AdminCheck)
                            @widget('DBasic::JournalDetails', ['user' => $user->id, 'card' => true, 'limit' => 20])
                        @endif
                    @endif
                    @if ($user->typeratings->count() > 0)
                        <div class="tab-pane fade" id="typeratings" role="tabpanel" aria-labelledby="typeratings-tab">
                            @include('profile.user_typeratings')
                        </div>
                    @endif
                </div>
            </div>
        </div>
        @ability('admin', 'admin-access')
            @if ($DSpecial)
                @widget('DSpecial::Assignments', ['user' => $user->id, 'hide' => false])
                @widget('DSpecial::TourProgress', ['user' => $user->id])
            @endif
        @endability
        <div class="row">
            <div class="col">
                @if ($DBasic && $user->flights > 0)
                    @widget('DBasic::UserPireps', ['user' => $user->id, 'limit' => 50])
                @endif
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    @parent
    <script>
        function apiKeyShow() {
            document.getElementById("apiKey_show").style = "display:block";
            document.getElementById("apiKey_hide").style = "display:none";
        }

        function apiKeyHide() {
            document.getElementById("apiKey_show").style = "display:none";
            document.getElementById("apiKey_hide").style = "display:block";
        }

        function emailShow() {
            document.getElementById("email_show").style = "display:block";
            document.getElementById("email_hide").style = "display:none";
        }

        function emailHide() {
            document.getElementById("email_show").style = "display:none";
            document.getElementById("email_hide").style = "display:block";
        }
    </script>
@endsection
