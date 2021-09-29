@extends('home')
@section('title')
Daily Quiz
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
            </div>
            <div class="col-lg-6 text-right">
              <a class="btn-dark btn" href="{{ route('home') }}"><i class="fas fa-arrow-left"></i> Back To Dashboard</a>
            </div>
          </div>
          <br>
          @if($exist=="0")
          <div class="row">
            <div class="col-lg-6 offset-lg-3">
              <button class="btn btn-success btn-block" href="#" data-toggle="modal" data-target="#addModal">Add Daily Quiz</button>
            </div>
          </div>
          <!-- Add Player Modal-->
          <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Add Daily Quiz</h5>
                  <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span>
                  </button>
                </div>
                <div class="modal-body">
                  <form method="POST" action="{{ route('dailyquiz.add') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group text-left">
                      <label>Daily Quiz Name</label>
                      <input name="name" type="text" class="form-control">
                    </div>
                    
                    <div class="form-group text-left">
                      <label>Daily Quiz Image</label>
                      <input name="image_url" accept="image/x-png,image/jpeg" type="file" class="form-control">
                    </div>
                    <div class="form-group text-left">
                      <label>Category</label>
                      <select name="category_id" class="custom-select">
                        @foreach($categories as $category)
                          <option value="{{$category->id}}">{{$category->category_name}}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="form-group text-left">
                      <label>Subcategory</label>
                      <select name="subcategory_id" class="custom-select">
                        @foreach($subcategories as $subcategory)
                          <option value="{{$subcategory->id}}">{{$subcategory->name}}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="text-right">
                      <button class="btn btn-sm btn-success" type="submit">Save Daily Quiz</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
          @else
          <div class="col-lg-6 offset-lg-3">
              <a class="btn btn-success btn-block" href="" data-toggle="modal" data-target="#addQuestionModal">Add Question to Daily Quiz</a>
              <!-- Delete Modal-->
                  <div style="margin-top: 90px !important;" class="modal fade" id="addQuestionModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Choose Question Type</h5>
                          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">×</span>
                          </button>
                        </div>
                        <div style="padding:20px !important;">
                          <a class="btn btn-primary btn-block" href="{{ route('dailyquiz.textquestion.add') }}">Add Text Question</a>
                          <a class="btn btn-info btn-block" href="{{ route('dailyquiz.imagequestion.add') }}">Add Image Question</a>
                          <a class="btn btn-warning btn-block" href="{{ route('dailyquiz.audioquestion.add') }}">Add Audio Question</a>
                          </div>
                        </div>
                      </div>
                    </div>
            </div>
            <br><br>
          <div class="row no-gutters align-items-center table-responsive">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th class="align-middle text-center" scope="col">Daily Quiz Image</th>
                  <th class="align-middle text-center" scope="col">Daily Quiz Name</th>
                  <th class="align-middle text-center" scope="col">Questions Number</th>
                  <th class="align-middle text-center" scope="col">Actions</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td class="align-middle text-center"><img src="{{ asset('uploads/quizzes/'.$dailyquiz->image_url) }}" height="120px" width="120px"></td>
                  <td class="align-middle text-center">{{$dailyquiz->name}}</td>
                  <td class="align-middle text-center">{{$number_questions}} Questions</td>
                  <td class="align-middle text-center">
                    <!-- Delete Player Modal-->
                    <a class="btn btn-sm btn-danger" href="" data-toggle="modal" data-target="#deleteModal"><i class="fas fa-exchange-alt"></i> Change Daily Quiz</a>
                    <a href="{{ route('dailyquiz.questions', ['quiz'=>$quizz]) }}" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i> Manage Questions</a>
                  </td>
                  <!-- Delete Modal-->
                  <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Change Daily Quiz</h5>
                          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">×</span>
                          </button>
                        </div>
                        <div class="modal-body">If you want to change your daily quiz, delete this one and add new one!</div>
                        <div class="modal-footer">
                          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                          <a class="btn btn-info" href="{{ route('dailyquiz.delete', ['image'=>$dailyquiz->image_url]) }}">Delete</a>
                        </div>
                      </div>
                    </div>
                  </div>
                </tr>
              </tbody>
            </table>
          </div>
          @endif
        </div>
      </div>
    </div>
  </div>
</div>
@endsection