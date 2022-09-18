@forelse($data as $site)
    @if ($site['status'])
        <p>{{ hex2bin('E29C85') }}&ensp;{{ $site['name'] }}</p>
    @else
        <p>{{ hex2bin('E29C85') }}&ensp;{{ $site['name'] }}</p>
    @endif

@empty
    <p>Нет данных</p>
@endforelse
