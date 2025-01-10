<table class="table table-sm align-middle text-center text-nowrap mb-0" id="users-table">
    <thead>
        @if (Theme::getSetting('roster_userimage'))
            <th class="text-start" style="width: 50px;">@sortablelink('id', 'ID')</th>
        @endif
        @if (Theme::getSetting('roster_ident'))
            <th class="text-start">@sortablelink('pilot_id', 'IDENT')</th>
        @endif
        <th class="text-start">@sortablelink('name', __('common.name'))</th>
        <th>@sortablelink('home_airport_id', __('airports.home'))</th>
        @if (Theme::getSetting('roster_airline'))
            <th>@sortablelink('airline_id', __('common.airline'))</th>
        @endif
        <th>@sortablelink('curr_airport_id', __('airports.current'))</th>
        <th>@sortablelink('rank_id', __('disposable.rank'))</th>
        <th>@sortablelink('flights', trans_choice('common.flight', 2))</th>
        <th>@sortablelink('flight_time', trans_choice('common.hour', 2))</th>
        <th>@sortablelink('awards_count', __('disposable.awards'))</th>
        @if (Theme::getSetting('roster_ivao'))
            <th>IVAO</th>
        @endif
        @if (Theme::getSetting('roster_vatsim'))
            <th>VATSIM</th>
        @endif
    </thead>
    <tbody>
        @foreach ($users as $user)
            <tr @if ($user->state != 1) {!! DT_UserState($user, 'row') !!} @endif>
                @if (Theme::getSetting('roster_userimage'))
                    <td class="text-start p-2">
                        <div class="avatar avatar-xl">
                            @if ($user->avatar == null)
                                <img class="rounded-soft" src="{{ $user->gravatar(256) }}" alt="" />
                            @else
                                <img class="rounded-soft" src="{{ $user->avatar->url }}" alt="" />
                            @endif
                        </div>
                    </td>
                @endif
                @if (Theme::getSetting('roster_ident'))
                    <td class="text-start">
                        <a href="{{ route('frontend.users.show.public', [$user->id]) }}">{{ $user->ident }}</a>
                    </td>
                @endif
                <td>
                    <div class="hstack">
                        <a class="me-2" href="{{ route('frontend.users.show.public', [$user->id]) }}">{{ $user->name_private }}</a>
                        @if (filled($user->country) && strlen($user->country) === 2 && Theme::getSetting('roster_flags'))
                            <span class="ms-auto flag-icon flag-icon-{{ $user->country }}" title="{{ $country->alpha2($user->country)['name'] }}" style="font-size: 1.2rem;"></span>
                        @endif
                    </div>
                </td>
                <td>
                    @if (filled($user->home_airport_id))
                        @if ($DBasic)
                            <a href="{{ route('DBasic.hub', [$user->home_airport_id ?? '']) }}">
                            @else
                                <a href="{{ route('frontend.airports.show', [$user->home_airport_id ?? '']) }}">
                        @endif
                        {{ $user->home_airport_id }}
                        </a>
                    @endif
                </td>
                @if (Theme::getSetting('roster_airline'))
                    <td>
                        @if ($DBasic)
                            <a href="{{ route('DBasic.airline', [optional($user->airline)->icao ?? '']) }}">
                        @endif
                        @if ($user->airline && filled($user->airline->logo))
                            <img class="rounded img-mh40" src="{{ $user->airline->logo }}" title="{{ $user->airline->name }}" alt="" />
                        @else
                            {{ optional($user->airline)->name }}
                        @endif
                        @if ($DBasic)
                            </a>
                        @endif
                    </td>
                @endif
                <td>
                    @if (filled($user->curr_airport_id))
                        <a href="{{ route('frontend.airports.show', [$user->curr_airport_id ?? '']) }}">
                            {{ $user->curr_airport_id }}
                        </a>
                    @endif
                </td>
                <td>
                    <div class="avatar avatar-xl">
                        @if ($user->rank && filled($user->rank->image_url))
                            <img style="height: 36px" src="{{ $user->rank->image_url }}" title="{{ $user->rank->name }}" alt="" />
                        @else
                            {{ optional($user->rank)->name }}
                        @endif
                    </div>
                </td>
                <td>
                    @if ($user->flights > 0)
                        {{ number_format($user->flights) }}
                    @endif
                </td>
                <td>
                    @if (Theme::getSetting('roster_combinetimes'))
                        {{ DT_ConvertMinutes($user->flight_time + $user->transfer_time, '%2dh %02dm') }}
                    @else
                        {{ DT_ConvertMinutes($user->flight_time, '%2dh %02dm') }}
                    @endif
                </td>
                <td>
                    @if ($user->awards_count > 0)
                        <span class="text-warning" data-feather="award" style="height:48px width:48px"></span>
                        {{ $user->awards_count }}
                    @endif
                </td>
                @if (Theme::getSetting('roster_ivao'))
                    <td>
                        @php $ivao_id = optional($user->fields->firstWhere('name', Theme::getSetting('gen_ivao_field')))->value; @endphp
                        <a href='https://www.ivao.aero/member.aspx?id={{ $ivao_id }}' target='_blank'>{{ $ivao_id }}</a>
                    </td>
                @endif
                @if (Theme::getSetting('roster_vatsim'))
                    <td>
                        @php $vatsim_id = optional($user->fields->firstWhere('name', Theme::getSetting('gen_vatsim_field')))->value; @endphp
                        <a href='https://stats.vatsim.net/search_id.php?id={{ $vatsim_id }}' target='_blank'>{{ $vatsim_id }}</a>
                    </td>
                @endif
            </tr>
        @endforeach
    </tbody>
</table>
