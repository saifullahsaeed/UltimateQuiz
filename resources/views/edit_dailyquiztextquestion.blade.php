@extends('home')
@section('title')
Edit Daily Quiz Question
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
            <div class="col-lg-5">
              <a class="btn-dark btn-block btn" href="{{ route('dailyquiz') }}"><i class="fas fa-arrow-left"></i> Back To Dashboard</a>
            </div>
          </div>
          <br>
          <div class="row">
            <div class="col-lg-10 offset-lg-1">
            <form method="POST" action="{{ route('dailyquiz.text.question.update', ['id'=>$question->id]) }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group text-left">
                      <label>Question Text</label>
                      <textarea name="question_text" class="form-control">{{$question->question_text}}</textarea>
                    </div>
                    <div class="row">
                    <div class="col-lg-4">
                      <div class="form-group">
                      <label>Category</label>
                      <select name="category_id" class="custom-select">
                          <option value="{{$question->category_id}}">{{$category_name}}</option>
                      </select>
                    </div>
                    </div>
                    <div class="col-lg-4">
                      <div class="form-group">
                      <label>Subcategory</label>
                      <select name="subcategory_id" class="custom-select">
                      <option value="{{$question->subcategory_id}}">{{$subcategory_name}}</option>
                    </select>
                    </div>
                    </div>
                    <div class="col-lg-4">
                      <div class="form-group">
                      <label>Quiz</label>
                      <select name="quiz_id" class="custom-select">
                      <option value="{{$question->quiz_id}}">{{$quiz_name}}</option>
                    </select>
                    </div>
                    </div>  
                    </div>
                    <div class="row">
                      <div class="col-lg-6">
                        <div class="form-group text-left">
                      <label>Question Points</label>
                      <input name="points" value="{{$question->points}}" type="text" class="form-control">
                    </div>
                      </div>
                      <div class="col-lg-6">
                        <div class="form-group text-left">
                      <label>Question time in seconds</label>
                      <input name="seconds" value="{{$question->seconds}}" type="text" class="form-control">
                    </div>
                      </div>
                    </div>
                    <div class="form-group text-left">
                      <label>Question Hint</label>
                      <input name="hint" value="{{$question->hint}}" type="text" class="form-control">
                    </div>
                    <div class="form-group text-left">
                      <label>True answer text</label>
                      <input name="true_answer"type="text" value="{{$question->true_answer}}" class="form-control">
                    </div>
                    <div class="form-group text-left">
                      <label>False answer text 1</label>
                      <input name="false1"type="text" value="{{$question->false1}}" class="form-control">
                    </div>
                    <div class="form-group text-left">
                      <label>False answer text 2</label>
                      <input name="false2"type="text" value="{{$question->false2}}" class="form-control">
                    </div>
                    <div class="form-group text-left">
                      <label>False answer text 3</label>
                      <input name="false3"type="text" value="{{$question->false3}}" class="form-control">
                    </div>
                    <div>
                      <button class="btn btn-block btn-success" type="submit">Save Question</button>
                    </div>
                  </form>
                  </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection