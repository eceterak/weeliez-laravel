@extends('admin.layouts.app')

@section('content')
    <h4>Motorcycles<a href="{{ route('admin.motorcycles.create') }}" class="btn btn-sm btn-secondary ml-1">add new <i class="fas fa-plus-circle"></i></a></h4>

    @if($motorcycles->count())
        <table class="table table-sm bg-white">
            <thead>
                <th>#</th>
                <th>Name</th>
                <th>Brand</th>
                <th>Category</th>
                <th>Action</th>
            </thead>
            <tbody>
                @foreach($motorcycles as $key => $motorcycle)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td><a href="{{ route('admin.motorcycles.edit', $motorcycle->slug) }}">{{ $motorcycle->name }}</a></td>
                        <td><a href="{{ route('admin.brands.edit', $motorcycle->brand->slug) }}">{{ $motorcycle->brand->name }}</a></td>
                        <td><a href="{{ route('admin.categories.edit', $motorcycle->category->slug) }}">{{ $motorcycle->category->name }}</a></td>
                        <td>
                            <form action="{{ route('admin.motorcycles.destroy', $motorcycle->slug) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-link"><i class="fas fa-trash p-0"></i></button>
                            </form>
                        </td>
                    </tr>
                @endforeach        
            </tbody>
        </table>
    @else
        <p>There is no motorcycles to display.</p>
    @endif
@endsection