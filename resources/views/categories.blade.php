@extends('home')
@section('title')
Categories
@endsection
@section('content')
<div class="container">
  <div class="row">
    <!-- Earnings (Monthly) Card Example -->
    <div class="col-lg-12">
      <div class="card border-left-dark shadow h-100 py-2">
        <div class="card-body col-lg-12">
          @if(Session::has('success'))
          <div class="row">
            <div class="col-lg-8 offset-lg-2 col-md-12">
              <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ Session::get('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
              </div>
            </div>
          </div>
          <br>
          @endif
          @if(Session::has('error'))
          <div class="row">
            <div class="col-lg-8 offset-lg-2 col-md-12">
              <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ Session::get('error') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
              </div>
            </div>
          </div>
          <br>
          @endif
          <div class="row">
            <div class="col-lg-6">
              <a class="btn-success btn btn-block" href="#" data-toggle="modal" data-target="#addModal"><i class="fas fa-plus"></i> Add New Category</a>
            </div>
            <div class="col-lg-6 text-right">
              <a class="btn-dark btn" href="{{ route('home') }}"><i class="fas fa-arrow-left"></i> Back To Dashboard</a>
            </div>
          </div>
          <br>
          <!-- Add Player Modal-->
          <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Add New Category</h5>
                  <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span>
                  </button>
                </div>
                <div class="modal-body">
                  <form method="POST" action="{{ route('categories.new') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group text-left">
                      <label>Category Name</label>
                      <input name="category_name" type="text" class="form-control" placeholder="Enter category name">
                    </div>
                    
                    <div class="form-group text-left">
                      <label>Category Image</label>
                      <input name="category_img" accept="image/x-png,image/jpeg" type="file" class="form-control">
                    </div>
                    <div class="form-check">
                      <input name="popular_or_not" style="margin-top: 5px !important;" class="form-check-input" type="checkbox" value="yes" id="defaultCheck5">
                      <label class="form-check-label" for="defaultCheck5">
                        Popular category (Show it in Home Page)
                      </label>
                    </div>
                    <div class="text-right">
                      <button class="btn btn-sm btn-success" type="submit">Save Category</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
          <div class="row no-gutters align-items-center table-responsive">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th class="align-middle text-center" scope="col">Category Image</th>
                  <th class="align-middle text-center" scope="col">Category Name</th>
                  <th class="align-middle text-center" scope="col">Actions</th>
                </tr>
              </thead>
              <tbody>
                @foreach($categories as $category)
                <tr>
                  <td class="align-middle text-center"><img src="{{ asset('uploads/categories/'.$category->category_img) }}" height="120px" width="120px"></td>
                  <td class="align-middle text-center">{{$category->category_name}} @if($category->popular_or_not=="yes")<small class="text-danger">(popular)</small>@endif</td>
                  <td class="align-middle text-center">
                    <a class="btn btn-sm btn-primary" href="" data-toggle="modal" data-target="#editModal{{$category->id}}"><i class="fas fa-edit"></i></a>
                    <!-- Delete Player Modal-->
                    <a class="btn btn-sm btn-danger" href="" data-toggle="modal" data-target="#deleteModal{{$category->id}}"><i class="fas fa-trash-alt"></i></a>
                  </td>
                  <div class="modal fade" id="editModal{{$category->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Edit Your Category</h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <form method="POST" action="{{ route('category.update', ['id'=>$category->id]) }}" enctype="multipart/form-data">
                              @csrf
                              <div class="form-group text-left">
                                <label>Category Name</label>
                                <input name="category_name" type="text" class="form-control" value="{{$category->category_name}}">
                              </div>
                              <div class="form-group text-left">
                                <label>Category Image</label>
                                <br>
                                <img height="180px" src="{{ asset('uploads/categories/'.$category->category_img) }}">
                                <br><br>
                                <input name="category_img" type="file" class="form-control">
                              </div>
                              <div class="form-check text-left">
                                <input name="popular_or_not" style="margin-top: 5px !important;" class="form-check-input" type="checkbox" value="yes" id="defaultCheck1"
                                @if($category->popular_or_not == 'yes') checked @endif>
                                <label class="form-check-label" for="defaultCheck1">
                                  Popular Category
                                </label>
                              </div>
                              <div class="text-right">
                                <button class="btn btn-sm btn-success" type="submit">Save Edition</button>
                              </div>
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>
                  <!-- Delete Modal-->
                  <div class="modal fade" id="deleteModal{{$category->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Delete Category</h5>
                          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">×</span>
                          </button>
                        </div>
                        <div class="modal-body">Are You Sure To Delete This Category ?</div>
                        <div class="modal-footer">
                          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                          <a class="btn btn-info" href="{{ route('categories.delete', ['id'=>$category->id]) }}">Delete</a>
                        </div>
                      </div>
                    </div>
                  </div>
                </tr>
                @endforeach
              </tbody>
            </table>
            {{ $categories->links() }}
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection