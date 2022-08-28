<div>
    <b>Отчет мониторинга</b>
    @forelse($data as $site)
        <i>{{ $site['name'] }}</i>
        <br>
        @forelse($site['pages'] as $page)
            @if ($page['status'])
                <p>{{ $page['name'] }}{{ hex2bin('E29C85') }}</p>
            @else
                <p>{{ $page['name'] }}{{ hex2bin('E29D8C') }}</p>
            @endif
        @empty
            <p>Данных нет, проверьте сайт</p>
        @endforelse

    @empty
        <p>Данных нет, проверьте сайт</p>
    @endforelse
</div>
