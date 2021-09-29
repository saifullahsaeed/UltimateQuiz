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
            <div class="col-lg-12 text-right">
              <a class="btn-dark btn" href="{{ route('dailyquiz') }}"><i class="fas fa-arrow-left"></i> Back To Dashboard</a>
            </div>
          </div>
          <br>
          <div class="row no-gutters align-items-center table-responsive">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th class="align-middle text-center" scope="col">Question Type</th>
                  <th class="align-middle text-center" scope="col">Question</th>
                  <th class="align-middle text-center" scope="col">Actions</th>
                </tr>
              </thead>
              <tbody>
                @foreach($questionsText as $questionText)
                <tr>
                  <td class="align-middle text-center">Text Question</td>
                  <td class="align-middle text-center">{{$questionText->question_text}}</td>
                  <td class="align-middle text-center">
                    <a class="btn btn-sm btn-primary" href="{{ route('dailyquiz.questions.edit.view',['id'=>$questionText->id, 'type'=>"text"]) }}"><i class="fas fa-edit"></i></a>
                    <!-- Delete Player Modal-->
                    <a class="btn btn-sm btn-danger" href="{{ route('dailyquiz.questions.delete',['id'=>$questionText->id, 'type'=>"text"]) }}"><i class="fas fa-trash-alt"></i></a>
                  </td>
                </tr>
                @endforeach
                @foreach($questionsImages as $questionsImage)
                <tr>
                  <td class="align-middle text-center">Image Question</td>
                  <td class="align-middle text-center"><img src="{{ asset('uploads/questions/'.$questionsImage->question_image_url) }}" height="120px" width="120px"></td>
                  <td class="align-middle text-center">
                    <a class="btn btn-sm btn-primary" href="{{ route('dailyquiz.questions.edit.view',['id'=>$questionsImage->id, 'type'=>"image"]) }}"><i class="fas fa-edit"></i></a>
                    <!-- Delete Player Modal-->
                    <a class="btn btn-sm btn-danger" href="{{ route('dailyquiz.questions.delete',['id'=>$questionsImage->id, 'type'=>"image"]) }}"><i class="fas fa-trash-alt"></i></a>
                  </td>
                </tr>
                @endforeach
                @foreach($questionsAudio as $questionAudio)
                <tr>
                  <td class="align-middle text-center">Audio Question</td>
                  <td class="align-middle text-center">{{$questionAudio->question_audio_url}}</td>
                  <td class="align-middle text-center">
                    <a class="btn btn-sm btn-primary" href="{{ route('dailyquiz.questions.edit.view',['id'=>$questionAudio->id, 'type'=>"audio"]) }}"><i class="fas fa-edit"></i></a>
                    <!-- Delete Player Modal-->
                    <a class="btn btn-sm btn-danger" href="{{ route('dailyquiz.questions.delete',['id'=>$questionAudio->id, 'type'=>"audio"]) }}"><i class="fas fa-trash-alt"></i></a>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection