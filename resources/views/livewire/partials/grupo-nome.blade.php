@if ($grupo->exibir)
  {{ $grupo->nome }}
@else
  <span class="badge text-warning"><i class="fas fa-eye-slash"></i></span>
  <span class="">{{ $grupo->nome }}</span>
@endif
