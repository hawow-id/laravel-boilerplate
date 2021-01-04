<div class="mb-3">
  <label for="{{ $id = $name.'_'. \Illuminate\Support\Str::random(5) }}" class="form-label">
      {{ str_replace('_',' ', \Illuminate\Support\Str::ucfirst($name)) }}
  </label>
  <input type="{{$type}}"
         class="form-control"
         id="{{ $id }}"
         name="{{ $name }}"
         value="{{ $value ?? '' }}"
  >
</div>
