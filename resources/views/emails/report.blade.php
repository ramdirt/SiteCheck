<div>
    <b>Отчет мониторинга</b>
    @forelse($data as $site)
        <i>{{ $site['name'] }}</i>
        @forelse($site['pages'] as $page)
            @if ($page['status'])
                <a href="{{ $site['url'] . $page['path'] }}">{{ $page['name'] }}{{ hex2bin('E29C85') }}</a>
            @else
                <a href="{{ $site['url'] . $page['path'] }}">{{ $page['name'] }}{{ hex2bin('E29D8C') }}</a>
            @endif
        @empty
            <p>Данных нет, проверьте сайт</p>
        @endforelse

    @empty
        <p>Данных нет, проверьте сайт</p>
    @endforelse
</div>
