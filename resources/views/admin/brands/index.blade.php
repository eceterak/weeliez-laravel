@extends('admin.layouts.app')

@section('content')
    <h4>Brands<a href="{{ route('admin.brands.create') }}" class="btn btn-sm btn-secondary ml-1">add new <i class="fas fa-plus-circle"></i></a></h4>

    @if($brands->count())
        <table class="table bg-white">
            <thead>
                <th>#</th>
                <th>Name</th>
                <th>Action</th>
            </thead>
            <tbody>
                @foreach($brands as $key => $brand)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td><a href="{{ route('admin.brands.edit', $brand->slug) }}">{{ $brand->name }}</a></td>
                        <td>
                            <form action="{{ route('admin.brands.destroy', $brand->slug) }}" method="POST">
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
        <p>There is no brands to display.</p>
    @endif
@endsection