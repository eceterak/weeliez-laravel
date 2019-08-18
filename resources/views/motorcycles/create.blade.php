@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
            <h4 class="mb-0">Add new motorcycle</h4>
        </div>
        <div class="card-body">
            <form action="">
                <section class="form-section">
                    <h5 class="form-title">Basic info</h5>
                    <div class="form-content">
                        <div class="form-group row">
                            <label for="name" class="col-3">Name</label>
                            <div class="col-9">
                                <input type="text" class="form-control" name="name" id="name">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="name" class="col-3">Brand</label>
                            <div class="col-9">
                                <select name="brand" id="brand">
                                    @foreach(App\Brand::all() as $brand)
                                        <option value="{{ $brand->id }}">{{ $brand->name }}</option>   
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </section>
                <button class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
@endsection