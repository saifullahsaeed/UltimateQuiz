@extends('home')
@section('title')
Ads Management
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
            <form method="POST" action="{{ route('ads.update') }}">
              @csrf
              <div class="form-group">
                <label style="font-weight:bold !important; color: black !important;">Admob App Id</label>
                <input name="admob_app_id" type="text" class="form-control" value="{{$ads->admob_app_id}}">
              </div>
              <div class="form-group">
                <label style="font-weight:bold !important; color: black !important;">Admob Banner Ad Id</label>
                <input name="admob_banner" type="text" class="form-control" value="{{$ads->admob_banner}}">
              </div>
              <div class="form-group">
                <label style="font-weight:bold !important; color: black !important;">Admob Interstitial Ad Id</label>
                <input name="admob_interstitial" type="text" class="form-control" value="{{$ads->admob_interstitial}}">
              </div>
              <div class="form-group">
                <label style="font-weight:bold !important; color: black !important;">Admob Native Ad Id</label>
                <input name="admob_native" type="text" class="form-control" value="{{$ads->admob_native}}">
              </div>
              <div class="form-group">
                <label style="font-weight:bold !important; color: black !important;">Admob Reward Video Ad Id</label>
                <input name="admob_reward" type="text" class="form-control" value="{{$ads->admob_reward}}">
              </div>
              <div class="form-group">
                <label style="font-weight:bold !important; color: black !important;">Facebook Banner Ad Id</label>
                <input name="facebook_banner" type="text" class="form-control" value="{{$ads->facebook_banner}}">
              </div>
              <div class="form-group">
                <label style="font-weight:bold !important; color: black !important;">Facebook Interstitial Ad Id</label>
                <input name="facebook_interstitial" type="text" class="form-control" value="{{$ads->facebook_interstitial}}">
              </div>
              <div class="form-group">
                <label style="font-weight:bold !important; color: black !important;">Facebook Native Banner Ad Id</label>
                <input name="facebook_native" type="text" class="form-control" value="{{$ads->facebook_native}}">
              </div>
              <div class="form-group">
                <label style="font-weight:bold !important; color: black !important;">Facebook Reward Video Ad Id</label>
                <input name="facebook_reward" type="text" class="form-control" value="{{$ads->facebook_reward}}">
              </div>
              <div class="form-group">
                <label style="font-weight:bold !important; color: black !important;">AdColony App Id</label>
                <input name="adcolony_app_id" type="text" class="form-control" value="{{$ads->adcolony_app_id}}">
              </div>
              <div class="form-group">
                <label style="font-weight:bold !important; color: black !important;">AdColony Banner Ad Id</label>
                <input name="adcolony_banner" type="text" class="form-control" value="{{$ads->adcolony_banner}}">
              </div>
              <div class="form-group">
                <label style="font-weight:bold !important; color: black !important;">AdColony Interstitial Ad Id</label>
                <input name="adcolony_interstitial" type="text" class="form-control" value="{{$ads->adcolony_interstitial}}">
              </div>
              <div class="form-group">
                <label style="font-weight:bold !important; color: black !important;">AdColony Reward Video Ad Id</label>
                <input name="adcolony_reward" type="text" class="form-control" value="{{$ads->adcolony_reward}}">
              </div>
              <div class="form-group">
                <label style="font-weight:bold !important; color: black !important;">StartApp App Id</label>
                <input name="startapp_app_id" type="text" class="form-control" value="{{$ads->startapp_app_id}}">
              </div>
              <hr>
              <div class="form-group">
                <label style="font-weight:bold !important; color: black !important;">Bottom Banner Type</label>
                <select name="banner_type" class="form-control">
                  <option @if($ads->banner_type=="admob") selected @endif value="admob">Admob</option>
                  <option @if($ads->banner_type=="facebook") selected @endif value="facebook">Facebook</option>
                  <option @if($ads->banner_type=="adcolony") selected @endif value="adcolony">Adcolony</option>
                  <option @if($ads->banner_type=="startapp") selected @endif value="startapp">Startapp</option>
                </select>
              </div>
              <div class="form-group">
                <label style="font-weight:bold !important; color: black !important;">Interstitial Ad Type</label>
                <select name="interstitial_type" class="form-control">
                  <option @if($ads->interstitial_type=="admob") selected @endif value="admob">Admob</option>
                  <option @if($ads->interstitial_type=="facebook") selected @endif value="facebook">Facebook</option>
                  <option @if($ads->interstitial_type=="adcolony") selected @endif value="adcolony">Adcolony</option>
                  <option @if($ads->interstitial_type=="startapp") selected @endif value="startapp">Startapp</option>
                </select>
              </div>
              <div class="form-group">
                <label style="font-weight:bold !important; color: black !important;">Reward Video Ad Type</label>
                <select name="video_type" class="form-control">
                  <option @if($ads->video_type=="admob") selected @endif value="admob">Admob</option>
                  <option @if($ads->video_type=="facebook") selected @endif value="facebook">Facebook</option>
                  <option @if($ads->video_type=="adcolony") selected @endif value="adcolony">Adcolony</option>
                  <option @if($ads->video_type=="startapp") selected @endif value="startapp">Startapp</option>
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