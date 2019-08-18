@extends('admin.layouts.app')

@section('content')

    <h4>New category</h4>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.categories.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" class="form-control">
                </div>

                <button class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>

@endsection