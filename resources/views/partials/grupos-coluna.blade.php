{{-- Mostra os grupos de uma mesma coluna --}}

@foreach ($grupos->where('coluna', $col) as $grupo)
  <div class="card mb-3">
    <div class="card-header">
      <span class="h4 align-middle">{{ $grupo->nome }}</span>
      @includeWhen('gerente', 'partials.badge-grupo-sem-coluna')
    </div>
    <div class="card-body">
      @foreach ($grupo->sistemas as $sistema)
        @include('partials.sistema')
      @endforeach
    </div>
  </div>
@endforeach
