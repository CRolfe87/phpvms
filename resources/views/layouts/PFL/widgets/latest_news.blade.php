@if ($news->count() > 0)
    @php
        $DBasic = isset($DBasic) ? $DBasic : DT_CheckModule('DisposableBasic');
    @endphp
        <div class="card">
            <div class="card-header">
                <div class="row g-3 justify-content-between align-items-center">
                    <div class="flex-1 col">
                        <h4>
                            @lang('widgets.latestnews.news')
                        </h4>
                        <p class="fs-9 text-body-secondary text-uppercase fw-bold mb-0">
                            @lang('disposable.latest') {{ $news->count() }}
                        </p>
                    </div>
                    <div class="col-auto mx-0">
                        @if ($DBasic)
                            <a class="btn btn-sm btn-phoenix-primary preview-btn ms-2" href="{{ route('DBasic.news') }}">@lang('disposable.all')</a>
                        @endif
                    </div>
                </div>
            </div>
            <div class="card-body p-2 px-xxl-4">
                <div class="accordion" id="newsAccordion">
                    @foreach ($news as $item)
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="heading{{ $loop->iteration }}">
                                <button class="accordion-button mb-0 {{ $loop->first ? '' : 'collapsed' }} d-flex" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapse{{ $loop->iteration }}" {{ $loop->first ? 'aria-expanded="true"' : 'aria-expanded="false"' }}
                                    aria-controls="collapse{{ $loop->iteration }}">
                                    <div class="d-flex flex-column">
                                        <span class="fs-9 fw-normal m-0">{{ $item->created_at->format('d M Y H:i') }}</span>
                                        <span class="mt-1 mb-2">{{ $item->subject }}</span>
                                    </div>
                                </button>
                            </h2>
                            <div class="accordion-collapse collapse {{ $loop->first ? 'show' : '' }}" id="collapse{{ $loop->iteration }}" aria-labelledby="heading{{ $loop->iteration }}"
                                data-bs-parent="#newsAccordion">
                                <div class="accordion-body">
                                    <div class="d-flex align-items-center">
                                        <div class="avatar avatar-l me-2">
                                            @if ($item->user->avatar == null)
                                                <img class="rounded-circle " src="{{ $item->user->gravatar(512) }}" alt="" />
                                            @else
                                                <img class="rounded-circle " src="{{ $item->user->avatar->url }}" alt="" />
                                            @endif
                                        </div>
                                        <div class="flex-1">
                                            <h5 class="text-body-highlight mb-0">{{ optional($item->user)->name_private }}</h5>
                                            <p class="fs-10 mb-0 text-body-secondary fw-semibold">{{ optional($item->user)->ident }}</p>
                                        </div>
                                    </div>
                                    <div class="text-body-highlight fs-9 mt-4 w-100 scrollbar" style="min-height:150px">
                                        {!! $item->body !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
@endif
