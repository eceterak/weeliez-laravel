@extends('admin.layouts.app')

@section('content')

    <h4>Edit brand</h4>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.brands.update', $brand->slug) }}" method="POST">
                @csrf
                @method('PATCH')
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" class="form-control" value="{{ $brand->name }}">
                </div>
                <button class="btn btn-primary">Save</button>
            </form>
        </div>
    </div>

@endsection