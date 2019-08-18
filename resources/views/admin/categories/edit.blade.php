@extends('admin.layouts.app')

@section('content')

    <h4>Edit category</h4>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.categories.update', $category->slug) }}" method="POST">
                @csrf
                @method('PATCH')
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" class="form-control" value="{{ $category->name }}">
                </div>
                <button class="btn btn-primary">Save</button>
            </form>
        </div>
    </div>

@endsection