@extends('home')
@section('title')
Image Questions Quizzes
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
            <div class="col-lg-12 text-right">
              <a class="btn-dark btn" href="{{ route('home') }}"><i class="fas fa-arrow-left"></i> Back To Dashboard</a>
            </div>
          </div>
          <br>

          <div class="row">
            @foreach($quizzes as $quiz)
            <div class="col-lg-4 col-sm-6">
            <div class="card" style="margin: 5px;">
              <img style="height: 190px !important;"  src="{{ asset('uploads/quizzes/'.$quiz->image_url) }}" class="card-img-top" alt="{{$quiz->name}}">
              <div class="card-body">
                <h5 class="card-title">{{$quiz->name}}</h5>
                <a href="{{ route('imagequestions.questions', ['category'=>$quiz->category_id, 'subcategory'=>$quiz->subcategory_id, 'quiz'=>$quiz->id]) }}" class="btn btn-primary btn-sm"><i class="fas fa-eye"></i> Manage Text Questions</a>
              </div>
            </div>
            </div>
            @endforeach
          </div>
          <br>
          <div>
              {{ $quizzes->links() }}
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection