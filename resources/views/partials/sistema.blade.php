<div>
  @if ($sistema->url)
    <a href="{{ $sistema->url }}">{{ $sistema->nome }}</a>
  @else
    {{ $sistema->nome }}
  @endif
</div>
