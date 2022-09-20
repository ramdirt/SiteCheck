<i>Отчет мониторинга</i>
@foreach ($data as $site)
    @if ($site['status'])
        {{ hex2bin('E29C85') }} {{ $site['name'] }}
    @else
        {{ hex2bin('E29D8C') }} {{ $site['name'] }}
    @endif
@endforeach
