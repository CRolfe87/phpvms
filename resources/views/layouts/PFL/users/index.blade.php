@extends('app')
@section('title', trans_choice('common.pilot', 2))
@include('theme_helpers')
@php
    $units = isset($units) ? $units : DT_GetUnits();
    $DBasic = isset($DBasic) ? $DBasic : DT_CheckModule('DisposableBasic');
@endphp
@section('content')
    <h2 class="mb-2 lh-sm">
        {{ trans_choice('common.pilot', 2) }}
    </h2>
    <div class="table-responsive scrollbar">
        @include('users.table')
    </div>
    {{-- <div class="card-footer p-0 px-1 small text-center fw-bold">
                    @if (setting('pilots.hide_inactive'))
                        @if ($DBasic)
                            <a class="mx-1 float-start" href="{{ route('DBasic.roster') }}">Full Roster</a>
                        @endif
                        <span class="mx-1 float-start">
                            @lang('disposable.only_active', ['days' => setting('pilots.auto_leave_days')])
                        </span>
                    @endif
                    @if ($users->hasPages())
                        <span class="float-end">
                            @lang('disposable.pagination', ['first' => $users->firstItem(), 'last' => $users->lastItem(), 'total' => $users->total()])
                        </span>
                    @endif
                </div> --}}
    {{ $users->withQueryString()->links('pagination.auto') }}
@endsection
