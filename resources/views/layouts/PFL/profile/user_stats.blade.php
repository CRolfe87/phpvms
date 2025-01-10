<div class="mb-8">
    <h2 class="mb-2 lh-sm">
        Statistics
    </h2>
    @php
        $stats_list = [
            ['type' => 'totflight', 'icon' => 'plane', 'color' => 'primary'],
            ['type' => 'tottime', 'icon' => 'clock', 'color' => 'info'],
            ['type' => 'avgtime', 'icon' => 'clock', 'color' => 'info'],
            ['type' => 'totdistance', 'icon' => 'ruler', 'color' => 'danger'],
            ['type' => 'avgdistance', 'icon' => 'ruler', 'color' => 'danger'],
            ['type' => 'totfuel', 'icon' => 'pump', 'color' => 'warning'],
            ['type' => 'avgfuel', 'icon' => 'pump', 'color' => 'warning'],
            ['type' => 'avglanding', 'icon' => 'plane-arrival', 'color' => 'success'],
            ['type' => 'avgscore', 'icon' => 'percentage', 'color' => 'primary'],
        ];
        if ($DSpecial) {
            array_push($stats_list, ['type' => 'assignment', 'icon' => 'list-ul', 'color' => 'primary']);
        }
        if (Theme::getSetting('gen_stable_approach') && DB_SapReports($user->id)) {
            array_push($stats_list, ['type' => 'fdm', 'icon' => 'plane-arrival', 'color' => 'success']);
        }

    @endphp
    @foreach ($stats_list as $stat)
        <div class="border-bottom pt-1 pb-0 py-xl-3 row gx-0 justify-content-between">
            <div class="col-xl-5 d-flex gap-2">
                <span class="uil uil-{{ $stat['icon'] }} text-{{ $stat['color'] }} mt-n1"></span>
                <div>
                    <h5 class="mb-0 text-body fw-semibold mb-2">{{ __('DBasic::widgets.' . $stat['type']) }}</h5>
                    <h5 class="mb-0">@widget('DBasic::PersonalStats', ['user' => $user->id, 'type' => $stat['type']])</h5>
                </div>
            </div>
            <div class="col-xl-7 ps-4 ps-xl-0 d-flex gap-6 gap-md-4 gap-xl-6 gap-xxl-10 align-items-center justify-content-end">
                @widget('DBasic::PersonalStats', ['disp' => 'full', 'user' => $user->id, 'type' => $stat['type'], 'period' => 'prevm'])
                @widget('DBasic::PersonalStats', ['disp' => 'full', 'user' => $user->id, 'type' => $stat['type'], 'period' => 'lastm'])
                @widget('DBasic::PersonalStats', ['disp' => 'full', 'user' => $user->id, 'type' => $stat['type'], 'period' => 'currentm'])
            </div>
        </div>
    @endforeach
</div>
