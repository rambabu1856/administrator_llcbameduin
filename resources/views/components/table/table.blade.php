<div class="table-responsive mt-2 p-0 text-nowrap" style="max-height: 350px;">
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
