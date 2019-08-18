@extends('admin.layouts.app')

@section('content')
    <h4>Types<a href="{{ route('admin.types.create') }}" class="btn btn-sm btn-secondary ml-1">add new <i class="fas fa-plus-circle"></i></a></h4>

    @if($types->count())
        <table class="table bg-white">
            <thead>
                <th>#</th>
                <th>Name</th>
                <th>Action</th>
            </thead>
            <tbody>
                @foreach($types as $key => $type)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td><a href="{{ route('admin.types.edit', $type->id) }}">{{ $type->name }}</a></td>
                        <td>
                            <form action="{{ route('admin.types.destroy', $type->id) }}" method="POST">
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
        <p>There is no types to display.</p>
    @endif
@endsection