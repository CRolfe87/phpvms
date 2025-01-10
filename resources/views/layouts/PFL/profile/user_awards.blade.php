@if ($user->awards)
    <div class="mb-8">
        <h2 class="mb-2 lh-sm">
            Awards
        </h2>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th class="d-none d-xl-table-cell">Badge</th>
                    <th>Description</th>
                    <th>Earned</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($user->awards as $award)
                    <tr>
                        @if ($award->image_url)
                            <td class="d-none d-xl-table-cell">
                                <img style="max-height:75px;" src="{{ $award->image_url }}" alt="{{ $award->name }}" title="{{ $award->description }}">
                            </td>
                        @endif
                        <td>
                            {{ $award->name }}
                        </td>
                        <td>
                            {{ $award->pivot->created_at->format('M d, Y') }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endif
