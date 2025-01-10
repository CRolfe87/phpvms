@if ($pirep->comments->count() > 0)
    <div class="card mb-2">
        <div class="card-header border-0">
            <div class="row g-3 justify-content-between align-items-center">
                <div class="flex-1 col">
                    <h5>Comments for Last Pirep</h5>

                </div>
                <div class="col-auto mx-0">
                    <a class="btn btn-sm btn-phoenix-primary preview-btn ms-2" data-bs-toggle="collapse" href="#comments" role="button" aria-expanded="false" aria-controls="comments">
                        Hide
                    </a>
                </div>
            </div>
        </div>
        <div class="collapse" id="comments">
            <div class="card-body">
                @foreach ($pirep->comments as $comment)
                    <div class="d-flex align-items-start"><a href="{{ route('frontend.users.show.public', [$user->id]) }}">
                            <div class="avatar avatar-m me-2">
                                @if ($comment->user->avatar == null)
                                    <img class="rounded-circle " src="{{ $comment->user->gravatar(512) }}" alt="" />
                                @else
                                    <img class="rounded-circle " src="{{ $comment->user->avatar->url }}" alt="" />
                                @endif
                            </div>
                        </a>
                        <div class="flex-1">
                            <div class="d-flex align-items-center"><a class="fw-bold mb-0 text-body-emphasis"
                                    href="{{ route('frontend.users.show.public', [$user->id]) }}">{{ $comment->user->name_private }}</a><span
                                    class="text-body-tertiary text-opacity-85 fw-semibold fs-10 ms-2">{{ show_datetime($comment->created_at) }}</span>
                            </div>
                            <p class="{{ !$loop->last === true ? 'mb-2' : 'mb-0' }}">{!! $comment->comment !!}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endif
