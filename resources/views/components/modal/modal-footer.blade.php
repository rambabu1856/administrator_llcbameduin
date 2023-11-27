@props(['name'])

<div class="modal-footer">
  <button type="button" class="btn elevation-1 bg-pink" name="{{ $name }}" id="{{ $name }}"><i
      class="fas fa-save mr-2"></i>Save</button>
  <button type="button" class="btn elevation-1 bg-dark" data-dismiss="modal"><i
      class="fa-solid fa-xmark mr-2"></i>Close</button>
</div>
