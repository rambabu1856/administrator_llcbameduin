<div class="table-responsive mt-2 p-0" style="max-height: 400px;">
  <table id="{{ $id }}" class="table-head-fixed table-striped table">
    <thead>
      <tr>

        @foreach ($tableHeaders as $header)
          <th class="align-top">{!! $header !!}</th>
        @endforeach

      </tr>
    </thead>
    {{ $slot }}
  </table>
</div>
