<div class="dropdown">
  <button class="{{ $btnClass }}" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
    aria-expanded="false">
    Dropdown Links
  </button>
  <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
    @foreach ($links as $link)
      <a class="dropdown-item" href="{{ $link['url'] }}">{{ $link['text'] }}</a>
    @endforeach
  </div>
</div>
