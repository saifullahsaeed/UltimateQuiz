@extends('home')
@section('title')
Edit Player
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
              <a class="btn-dark btn" href="{{ route('players') }}"><i class="fas fa-arrow-left"></i> Back To Players List</a>
            </div>
          </div>
          <br>
          <!-- Add Player Modal-->
          <div class="row">
            <div class="col-lg-10 offset-lg-1 col-md-12">
              <form method="POST" action="{{ route('players.update', ['player'=>$player->id]) }}" enctype="multipart/form-data">
                @csrf
                <center>
                      <div style="width:75%; height:300px; background: url('{{$player->image_url}}'); background-repeat: no-repeat;background-position: center;background-size: cover;">
                      </div>
                  </center>
                  <br>
                    <div class="form-group text-left">
                      <label>Change Player Image</label>
                      <input name="image_url" type="file" class="form-control">
                    </div>
                <div class="form-group">
                  <label>Username</label>
                  <input name="username" type="text" class="form-control" value="{{$player->username}}">
                </div>
                <div class="form-group">
                  <label>Email or Phone</label>
                  <input name="email_or_phone" type="text" class="form-control" value="{{$player->email_or_phone}}">
                </div>
                <div class="form-group">
                  <label>Actual Score</label>
                  <input name="actual_score" type="text" class="form-control" value="{{$player->actual_score}}">
                </div>
                <div class="form-group">
                  <label>Total Score</label>
                  <input name="total_score" type="text" class="form-control" value="{{$player->total_score}}">
                </div>
                <div class="form-group">
                  <label>Referral Code</label>
                  <input name="referral_code" type="text" class="form-control" value="{{$player->referral_code}}">
                </div>
                <div class="form-group">
                  <label>Coins</label>
                  <input name="coins" type="text" class="form-control" value="{{$player->coins}}">
                </div>
                <div class="form-group">
                  <label>Facebook</label>
                  <input name="facebook" type="text" class="form-control" value="{{$player->facebook}}">
                </div>
                <div class="form-group">
                  <label>Twitter</label>
                  <input name="twitter" type="text" class="form-control" value="{{$player->twitter}}">
                </div>
                <div class="form-group">
                  <label>Instagram</label>
                  <input name="instagram" type="text" class="form-control" value="{{$player->instagram}}">
                </div>
                <div>
                  <button class="btn btn-success btn-block" type="submit">Save Infos</button>
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