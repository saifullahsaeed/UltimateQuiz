@extends('home')
@section('title')
Quizzes {{$subcategoryId}}
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
              <a class="btn-success btn btn-block" href="#" data-toggle="modal" data-target="#addModal"><i class="fas fa-plus"></i> Add New Quiz</a>
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
                  <h5 class="modal-title" id="exampleModalLabel">Add New Quiz</h5>
                  <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span>
                  </button>
                </div>
                <div class="modal-body">
                  <form method="POST" action="{{ route('quizzes.new', ['category'=>$categoryId, 'id'=>$subcategoryId]) }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group text-left">
                      <label>quiz Name</label>
                      <input name="name" type="text" class="form-control" placeholder="Enter quiz name">
                    </div>
                    
                    <div class="form-group text-left">
                      <label>quiz Image</label>
                      <input name="image_url" accept="image/x-png,image/jpeg" type="file" class="form-control">
                    </div>
                    <div class="text-right">
                      <button class="btn btn-sm btn-success" type="submit">Save quiz</button>
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
                  <th class="align-middle text-center" scope="col">Quiz Image</th>
                  <th class="align-middle text-center" scope="col">Quiz Name</th>
                  <th class="align-middle text-center" scope="col">Actions</th>
                </tr>
              </thead>
              <tbody>
                @foreach($quizzes as $quiz)
                <tr>
                  <td class="align-middle text-center"><img src="{{ asset('uploads/quizzes/'.$quiz->image_url) }}" height="120px" width="120px"></td>
                  <td class="align-middle text-center">{{$quiz->name}}</td>
                  <td class="align-middle text-center">
                    <a class="btn btn-sm btn-primary" href="" data-toggle="modal" data-target="#editModal{{$quiz->id}}"><i class="fas fa-edit"></i></a>
                    <!-- Delete Player Modal-->
                    <a class="btn btn-sm btn-danger" href="" data-toggle="modal" data-target="#deleteModal{{$quiz->id}}"><i class="fas fa-trash-alt"></i></a>
                  </td>
                  <div class="modal fade" id="editModal{{$quiz->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Edit Your Quiz</h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <form method="POST" action="{{ route('quizzes.update', ['id'=>$quiz->id]) }}" enctype="multipart/form-data">
                              @csrf
                              <div class="form-group text-left">
                                <label>quiz Name</label>
                                <input name="name" type="text" class="form-control" value="{{$quiz->name}}">
                              </div>
                              <div class="form-group text-left">
                                <label>quiz Image</label>
                                <br>
                                <img height="180px" src="{{ asset('uploads/quizzes/'.$quiz->image_url) }}">
                                <br><br>
                                <input name="image_url" type="file" class="form-control">
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
                  <div class="modal fade" id="deleteModal{{$quiz->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Delete quiz</h5>
                          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">×</span>
                          </button>
                        </div>
                        <div class="modal-body">Are You Sure To Delete This quiz ?</div>
                        <div class="modal-footer">
                          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                          <a class="btn btn-info" href="{{ route('quizzes.delete', ['id'=>$quiz->id]) }}">Delete</a>
                        </div>
                      </div>
                    </div>
                  </div>
                </tr>
                @endforeach
              </tbody>
            </table>
            {{ $quizzes->links() }}
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection