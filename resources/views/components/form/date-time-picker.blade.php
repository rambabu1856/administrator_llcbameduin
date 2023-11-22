@props(['grid', 'lblClass', 'lblText', 'name', 'dateFormat'])

<div class="{{ $grid }}">
  <label class = "{{ $lblClass }}" for="{{ $name }}">{{ $lblText }}</label>
  <div class="input-group date" id="{{ $name }}" data-target-input="nearest">
    <input type="text" class="form-control form-control-sm datetimepicker-input" id="{{ $name }}_input"
      name="{{ $name }}" />
    <div class="input-group-append" data-target="#{{ $name }}" data-toggle="datetimepicker">
      <div class="input-group-text"><i class="fa fa-calendar"></i></div>
    </div>
  </div>
</div>



@once
  @push('scripts')
    <script>
      $(document).ready(function() {

        let $dateTimePicker = $('#{{ $name }}');

        $dateTimePicker.datetimepicker({
          format: '{{ $dateFormat }}',
          stepping: 1,
          sideBySide: true,
          useCurrent: false,
          allowInputToggle: false,
          icons: {
            time: 'fa-regular fa-clock',
            today: 'fas fa-calendar-check',
            clear: 'fas fa-trash',
            close: 'fa fa-times',
          },
          buttons: {
            showToday: true,
            showClose: true,
            showClear: true,
          }
        });

      });
    </script>
  @endpush

  @push('styles')
    <!-- Add your CSS styles for the datetime picker here -->
  @endpush
@endonce
