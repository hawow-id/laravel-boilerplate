<div class="mb-3">
    <label for="{{ $id = $name.'_'. \Illuminate\Support\Str::random(5) }}" class="form-label">
        {{ str_replace('_',' ', \Illuminate\Support\Str::ucfirst($name)) }}
    </label>
  <textarea class="form-control" id="{{ $id }}" rows="3" name="{{ $name }}">
      {{ $value ?? '' }}
  </textarea>
</div>
