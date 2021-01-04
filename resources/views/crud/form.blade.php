@extends('layouts.app')
@section('body')
<h1>
    {{ $title }} Form
</h1>

@isset($model)
    Details of : {{ $model->id }}
@endisset

@empty($model)
    Create new {{ $title }}
@endempty

<form action="#">
    @foreach($fields as $field)
        <x-dynamic-component component="{{ $field->component }}"
                             type="{{$field->type}}"
                             name="{{$field->field}}"
                             title="{{$field->field}}"
                             value="{{ $model->{$field->field} ?? null }}"
        />
    @endforeach
        <input type="submit" value="Save">
</form>
@endsection
