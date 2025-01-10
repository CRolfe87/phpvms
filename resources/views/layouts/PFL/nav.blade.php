{{-- Generic Style Settings For Navbar / SideBar --}}
@php
    // Check Disposable Module Presence
    $DBasic = isset($DBasic) ? $DBasic : DT_CheckModule('DisposableBasic');
    $DSpecial = isset($DSpecial) ? $DSpecial : DT_CheckModule('DisposableSpecial');
    // Style differences between navbar and sidebar
    if (Theme::getSetting('gen_sidebar')) {
    }
    // Get Authorized User
    $user = Auth::user();
@endphp
{{-- Include Either Sidebar or Classic Navbar --}}
@include('nav_side')
@include('nav_top')
