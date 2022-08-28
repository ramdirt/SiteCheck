<b>Отчет мониторинга</b>
@forelse($data as $site)
    <a href="{{ $site['url'] }}">{{ $site['name'] }}</a>
    @forelse($site['pages'] as $page)
        @if ($page['status'])
            {{ $page['name'] }}{{ hex2bin('E29C85') }}
        @else
            {{ $page['name'] }}{{ hex2bin('E29D8C') }}
        @endif
    @empty
        <p>Данных нет, проверьте сайт</p>
    @endforelse

@empty
    <p>Данных нет, проверьте сайт</p>
@endforelse
