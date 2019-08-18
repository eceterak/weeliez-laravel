@extends('admin.layouts.app')

@section('content')

    <h4>Edit type</h4>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.types.update', $type->id) }}" method="POST">
                @csrf
                @method('PATCH')
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" class="form-control" value="{{ $type->name }}">
                </div>

                <button class="btn btn-primary">Submit</button>
            </form>
            @include('admin.layouts.components._errors')
        </div>
    </div>

    <h4>{{ ucfirst($type->name) }} attributes <a href="{{ route('admin.attributes.create', $type->id) }}" class="btn btn-sm btn-secondary ml-1">add new <i class="fas fa-plus-circle"></i></a></h4>

    @if($type->attributes->count())
        <table class="table bg-white">
            <thead>
                <th>#</th>
                <th>Name</th>
                <th>Action</th>
            </thead>
            <tbody>
                @foreach($type->attributes as $key => $attribute)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td><a href="{{ route('admin.attributes.edit', $attribute->id) }}">{{ $attribute->name }}</a></td>
                        <td>
                            <form action="{{ route('admin.attributes.destroy', $attribute->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-link"><i class="fas fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                @endforeach        
            </tbody>
        </table>
    @else
        <p>There is no attributes to display.</p>
    @endif

@endsection