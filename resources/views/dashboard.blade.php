@extends('layouts.app')

@section('content')
<div class="container-fluid my-3 p-5">
    <div class="container-fluid d-flex justify-content-end text-end mb-2">
        <button type="button" data-toggle="modal" data-target="#exampleModalCenter" class="btn btn-outline-info  ">
            Add Category
        </button>
    </div>




    <div class="card">
        <div class="card-header">
            <h3 class="card-title">DataTable Of Categories</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Slug</th>
                        <th>Thumbnail</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($get as $cat)
                    <tr>
                        <td>{{$cat->name}}</td>
                        <td>{{$cat->slug}}</td>
                        <td><img class="rounded-circle" height="40px" width="40px"
                                src="{{ Storage::url('public/images/'.$cat->thumbnail) }}">
                        </td>
                        <td>{{$cat->status}}</td>
                        <td>
                            <a type="button" data-toggle="modal" data-target="#exampleModalCenter{{$cat->id}}"
                                class="btn btn-warning">
                                Edit</a>
                            <a type="button" href="{{route('del-category',$cat->id)}}" class="btn btn-danger">Delete</a>
                        </td>

                    </tr>
                    <!-- Modal -->
                    <div class="modal fade" id="exampleModalCenter{{$cat->id}}" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalCenterTitle">Add Category</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="card my-2 border-2">
                                        <div class="card-body">
                                            <form action="{{route('update-category',$cat->id)}}" method="POST"
                                                enctype="multipart/form-data">
                                                @csrf
                                                <div class="container">
                                                    <div class="mb-3 row">
                                                        <input type="hidden" class="form-control" name="id" id="id" />
                                                        <div class="col-6">
                                                            <label for="name" class="col-form-label">Name</label>
                                                            <input type="text"
                                                                class="form-control  @error('name') is-invalid @enderror"
                                                                name="name" id="name" value="{{$cat->name}}"
                                                                placeholder="First Name" />
                                                            @error('name')
                                                            <span class="invalid-feedback">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                        <div class="col-6">
                                                            <label for="thumbnail"
                                                                class=" col-form-label">Thumbnail</label>
                                                            <input type="file"
                                                                class="form-control  @error('thumbnail') is-invalid @enderror"
                                                                name="thumbnail" value="{{$cat->thumbnail}}"
                                                                id="thumbnail" />
                                                            @error('thumbnail')
                                                            <span class="invalid-feedback">{{ $message }}</span>
                                                            @enderror
                                                        </div>

                                                    </div>
                                                    <div class="container d-flex justify-content-end">
                                                        <button type="submit" class="btn btn-primary ">Add
                                                            Details</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    @endforeach

                </tbody>

            </table>
        </div>
        <!-- /.card-body -->
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Add Category</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card my-2 border-2">
                    <div class="card-body">
                        <form action="{{route('add-category')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="container">
                                <div class="mb-3 row">
                                    <input type="hidden" class="form-control" name="id" id="id" />
                                    <div class="col-6">
                                        <label for="name" class="col-form-label">Name</label>
                                        <input type="text" class="form-control  @error('name') is-invalid @enderror"
                                            name="name" id="name" placeholder="First Name" />
                                        @error('name')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-6">
                                        <label for="thumbnail" class=" col-form-label">Thumbnail</label>
                                        <input type="file"
                                            class="form-control  @error('thumbnail') is-invalid @enderror"
                                            name="thumbnail" id="thumbnail" placeholder="@gmail.com" />
                                        @error('thumbnail')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>

                                </div>
                                <div class="container d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary ">Add Details</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection