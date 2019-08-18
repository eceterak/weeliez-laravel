@extends('admin.layouts.app')

@section('content')

    <h4>Edit motorcycle</h4>

    <motorcycle-form 
        :motorcycle="{{ $motorcycle }}"
        :specifications="{{ $motorcycle->specs_grouped }}"
        :data="{{ $attributes }}">
    </motorcycle-form>


@endsection