@if ($item->url)
  <a href="{{ $item->url }}">{{ $item->nome }}</a>
@else
  {{ $item->nome }}
@endif
