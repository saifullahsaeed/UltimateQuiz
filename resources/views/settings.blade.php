@extends('home')
@section('title')
Settings
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
          <div class="row no-gutters align-items-center">
            <div class="col-lg-10 offset-lg-1 col-md-12">
            <form method="POST" action="{{ route('settings.update') }}">
              @csrf
              <div class="form-group">
                <label style="font-weight:bold !important; color: black !important;">currency</label>
                <input name="currency" type="text" class="form-control" value="{{$settings->currency}}">
              </div>
              <div class="form-group">
                <label style="font-weight:bold !important; color: black !important;">api_secret_key</label>
                <input name="api_secret_key" type="text" class="form-control" value="{{$settings->api_secret_key}}">
              </div>
              <div class="form-group">
                <label style="font-weight:bold !important; color: black !important;">min_to_withdraw</label>
                <input name="min_to_withdraw" type="text" class="form-control" value="{{$settings->min_to_withdraw}}">
              </div>
              <div class="form-group">
                <label style="font-weight:bold !important; color: black !important;">conversion_rate</label>
                <input name="conversion_rate" type="text" class="form-control" value="{{$settings->conversion_rate}}">
              </div>
              <div class="form-group">
                <label style="font-weight:bold !important; color: black !important;">hint_coins</label>
                <input name="hint_coins" type="text" class="form-control" value="{{$settings->hint_coins}}">
              </div>
              <div class="form-group">
                <label style="font-weight:bold !important; color: black !important;">referral_register_points</label>
                <input name="referral_register_points" type="text" class="form-control" value="{{$settings->referral_register_points}}">
              </div>
              <div class="form-group">
                <label style="font-weight:bold !important; color: black !important;">video_ad_coins</label>
                <input name="video_ad_coins" type="text" class="form-control" value="{{$settings->video_ad_coins}}">
              </div>
              <div class="form-group">
                <label style="font-weight:bold !important; color: black !important;">daily_reward</label>
                <input name="daily_reward" type="text" class="form-control" value="{{$settings->daily_reward}}">
              </div>
              <hr>
              <div class="form-group">
                <label style="font-weight:bold !important; color: black !important;">App Language</label>
                <select name="lang" class="form-control">
                  <option @if($settings->lang=="en") selected @endif value="en">English</option>
                  <option @if($settings->lang=="es") selected @endif value="es">Spanish</option>
                  <option @if($settings->lang=="tr") selected @endif value="tr">Turkish</option>
                  <option @if($settings->lang=="hi") selected @endif value="hi">Hindi</option>
                </select>
              </div>
              <div class="form-group">
                <label style="font-weight:bold !important; color: black !important;">Completed Question Option</label>
                <select name="completed_option" class="form-control">
                  <option @if($settings->completed_option=="yes") selected @endif value="yes">Yes</option>
                  <option @if($settings->completed_option=="no") selected @endif value="no">No</option>
                </select>
              </div>
              <div class="form-group">
                <label style="font-weight:bold !important; color: black !important;">Fifty Fifty (50/50) Option</label>
                <select name="fifty_fifty" class="form-control">
                  <option @if($settings->fifty_fifty=="yes") selected @endif value="yes">Yes</option>
                  <option @if($settings->fifty_fifty=="no") selected @endif value="no">No</option>
                </select>
              </div>
              <div class="form-group">
                <label style="font-weight:bold !important; color: black !important;">One user per device Option</label>
                <select name="one_device" class="form-control">
                  <option @if($settings->one_device=="yes") selected @endif value="yes">Yes</option>
                  <option @if($settings->one_device=="no") selected @endif value="no">No</option>
                </select>
              </div>
              <button type="submit" class="btn btn-block btn-success">Update</button>
            </form>
            </div>
            <div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection