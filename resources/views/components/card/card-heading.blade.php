@props(['name'])

<div class="card card-pink card-outline mb-1 pb-0">
  <div class="card-header bg-info h6">
    <h3 class="card-title" id="{{ $name }}">{{ $heading }}</h3>

    <div class="card-tools">
      <button type="button" class="btn btn-tool btn-xs" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
        <i class="fas fa-minus"></i></button>
    </div>
  </div>

  {{ $slot }}

</div>
