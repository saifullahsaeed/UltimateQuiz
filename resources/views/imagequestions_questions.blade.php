@extends('home')
@section('title')
Image Questions
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
              <a class="btn-success btn btn-block" href="#" data-toggle="modal" data-target="#addModal"><i class="fas fa-plus"></i> Add New Question</a>
            </div>
            <div class="col-lg-6">
              <a class="btn-dark btn btn-block" href="{{ route('home') }}"><i class="fas fa-arrow-left"></i> Back To Dashboard</a>
            </div>
          </div>
          <br>
          <!-- Add Player Modal-->
          <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Add New Question</h5>
                  <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span>
                  </button>
                </div>
                <div class="modal-body">
                  <form enctype="multipart/form-data" method="POST" action="{{ route('imagequestions.questions.add') }}">
                    @csrf
                    <input type="hidden" name="category_id" value="{{$category}}">
                    <input type="hidden" name="subcategory_id" value="{{$subcategory}}">
                    <input type="hidden" name="quiz_id" value="{{$quiz}}">
                    <div class="form-group text-left">
                      <label>Question Image</label>
                      <input name="question_image_url" accept="image/x-png,image/jpeg" type="file" class="form-control">
                    </div>
                    <div class="form-group text-left">
                      <label>Question Points</label>
                      <input name="points" type="text" class="form-control">
                    </div>
                    <div class="form-group text-left">
                      <label>Question Time in seconds</label>
                      <input name="seconds" type="text" class="form-control">
                    </div>
                    <div class="form-group text-left">
                      <label>Question Hint</label>
                      <input name="hint" type="text" class="form-control">
                    </div>
                    <div class="form-group text-left">
                      <label>True answer</label>
                      <input name="true_answer" type="text" class="form-control">
                    </div>
                    <div class="form-group text-left">
                      <label>False answer 1</label>
                      <input name="false1" type="text" class="form-control">
                    </div>
                    <div class="form-group text-left">
                      <label>False answer 2</label>
                      <input name="false2" type="text" class="form-control">
                    </div>
                    <div class="form-group text-left">
                      <label>False answer 3</label>
                      <input name="false3" type="text" class="form-control">
                    </div>
                    <div class="text-right">
                      <button class="btn btn-sm btn-success" type="submit">Save Question</button>
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
                  <th class="align-middle text-center" scope="col">Question Image</th>
                  <th class="align-middle text-center" scope="col">True Answer</th>
                  <th class="align-middle text-center" scope="col">Actions</th>
                </tr>
              </thead>
              <tbody>
                @foreach($questions as $question)
                <tr><td class="align-middle text-center"><img src="{{ asset('uploads/questions/'.$question->question_image_url) }}" height="200px" width="200px"></td>
                  <td class="align-middle text-center">{{$question->true_answer}}</td>
                  <td class="align-middle text-center">
                    <a class="btn btn-sm btn-primary" href="" data-toggle="modal" data-target="#editModal{{$question->id}}"><i class="fas fa-edit"></i></a>
                    <!-- Delete Player Modal-->
                    <form enctype="multipart/form-data" method="POST" action="{{ route('imagequestions.question.delete', ['question'=>$question->id]) }}">
                      @csrf
                      <button class="btn btn-sm btn-danger" type="submit"><i class="fas fa-trash-alt"></i></button>
                    </form>
                  </td>
                  <div class="modal fade" id="editModal{{$question->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Edit Your Question</h5>
                          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">×</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <form method="POST" enctype="multipart/form-data" action="{{ route('imagequestions.questions.update', ['id'=>$question->id]) }}">
                            @csrf
                            <div class="form-group text-left">
                                <label>Category Image</label>
                                <br>
                                <img height="180px" src="{{ asset('uploads/questions/'.$question->question_image_url) }}">
                                <br><br>
                                <input name="question_image_url" type="file" class="form-control">
                              </div>
                            <div class="form-group text-left">
                              <label>Question Points</label>
                              <input name="points" type="text" value="{{$question->points}}" class="form-control">
                            </div>
                            <div class="form-group text-left">
                              <label>Question Time in seconds</label>
                              <input name="seconds" type="text" value="{{$question->seconds}}" class="form-control">
                            </div>
                            <div class="form-group text-left">
                              <label>Question Hint</label>
                              <input name="hint" type="text" value="{{$question->hint}}" class="form-control">
                            </div>
                            <div class="form-group text-left">
                              <label>True answer</label>
                              <input name="true_answer" type="text" value="{{$question->true_answer}}" class="form-control">
                            </div>
                            <div class="form-group text-left">
                              <label>False answer 1</label>
                              <input name="false1" type="text" value="{{$question->false1}}" class="form-control">
                            </div>
                            <div class="form-group text-left">
                              <label>False answer 2</label>
                              <input name="false2" type="text" value="{{$question->false2}}" class="form-control">
                            </div>
                            <div class="form-group text-left">
                              <label>False answer 3</label>
                              <input name="false3" type="text" value="{{$question->false3}}" class="form-control">
                            </div>
                            <div class="text-right">
                              <button class="btn btn-sm btn-success" type="submit">Save Question</button>
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
                </tr>
                @endforeach
              </tbody>
            </table>
            {{ $questions->links() }}
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection