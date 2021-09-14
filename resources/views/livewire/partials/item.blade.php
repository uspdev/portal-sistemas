<div class="to-hover hover-bg">
  <span class="">
    @include('livewire.partials.item-exibir')
  </span>
  @includeWhen(Gate::allows('gerente'), 'livewire.partials.item-gerente-menu')
</div>
