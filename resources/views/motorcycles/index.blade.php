@extends('layouts.app')

@section('content')
    <div class="card d-flex justify-content-between card-special card-special-motorcycles mb-3">
        <div class="d-inline">
            <h3 class="mb-0">Motorcycles</h3>
            <p class="small text-muted mb-0">There is {{ $motorcycles->count() }} motorcycles in database</p>
        </div>
    </div>
    
    <div class="row">
        <div class="col-3"></div>
        <div class="col-9">
            @if($motorcycles->count())
                <table class="table table-sm bg-white">
                    <thead>
                        <th>Name</th>
                        <th>Brand</th>
                        <th>Category</th>
                    </thead>
                    <tbody>
                        @foreach($motorcycles as $key => $motorcycle)
                            <tr>
                                <td><a href="{{ route('motorcycles.show', $motorcycle->route_parameters) }}">{{ $motorcycle->name }}</a></td>
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
        </div>
    </div>
@endsection