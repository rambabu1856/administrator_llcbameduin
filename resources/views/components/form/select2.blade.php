<div class="{{ $grid }}">
  <div class="form-group">
    <label class="{{ $lblClass }}" for="{{ $name }}">{{ $lblText }}</label>
    <select class="select2 form-control" name="{{ $name }}" id="{{ $name }}" style="width:100%"
      data-dropdown-css-class="select2-cyan">
     
      @foreach ($options as $value)
        <option value="{{ $value->id }}">
          {{ $value->title != null ? $value->title : $value->slug }}
        </option>
      @endforeach
    </select>
  </div>
</div>

@once
  @push('scripts')
    <script>
      $(document).ready(function() {
        $('#{{ $name }}').val(null).trigger("change")
      });
    </script>
  @endpush

@endonce
