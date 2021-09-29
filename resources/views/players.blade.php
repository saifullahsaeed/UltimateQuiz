@extends('home')
@section('title')
Players
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
              <a class="btn-success btn btn-block" href="#" data-toggle="modal" data-target="#addModal"><i class="fas fa-plus"></i> Add New Player</a>
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
                  <h5 class="modal-title" id="exampleModalLabel">Add New Player</h5>
                  <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span>
                  </button>
                </div>
                <div class="modal-body">
                  <form method="POST" action="{{ route('players.new') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group text-left">
                      <label>Player Username</label>
                      <input name="username" type="text" class="form-control" placeholder="Enter player username">
                    </div>
                    <div class="form-group text-left">
                      <label>Player Email</label>
                      <input name="email_or_phone" type="email" class="form-control" placeholder="Enter player email">
                    </div>
                    <div class="form-group text-left">
                      <label>Player Password</label>
                      <input name="password" type="password" class="form-control" placeholder="Enter password">
                    </div>
                    <div class="form-group text-left">
                      <label>Player Score</label>
                      <input name="actual_score" type="text" class="form-control" placeholder="Enter player score">
                    </div>
                    <div class="form-group text-left">
                      <label>Player Coins</label>
                      <input name="coins" type="text" class="form-control" placeholder="Enter player coins">
                    </div>
                    <div class="form-group text-left">
                      <label>Player Facebook Link</label>
                      <input name="facebook" type="text" class="form-control" placeholder="Enter player facebook link">
                    </div>
                    <div class="form-group text-left">
                      <label>Player Twitter Link</label>
                      <input name="twitter" type="text" class="form-control" placeholder="Enter player twitter link">
                    </div>
                    <div class="form-group text-left">
                      <label>Player Instagram Link</label>
                      <input name="instagram" type="text" class="form-control" placeholder="Enter player instagram link">
                    </div>
                    <div class="form-group text-left">
                      <label>Player Avatar</label>
                      <input name="image_url" accept="image/x-png,image/jpeg" type="file" class="form-control">
                    </div>
                    <div class="text-right">
                      <button class="btn btn-sm btn-success" type="submit">Save Player</button>
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
                  <th class="align-middle text-center" scope="col">Avatar</th>
                  <th class="align-middle text-center" scope="col">Username</th>
                  <th class="align-middle text-center" scope="col">Email/Phone</th>
                  <th class="align-middle text-center" scope="col">Register Method</th>
                  <th class="align-middle text-center" scope="col">Actions</th>
                </tr>
              </thead>
              <tbody>
                @foreach($players as $player)
                <tr>
                  <td class="align-middle text-center"><img src="{{ $player->image_url }}" height="40px" width="40px" class="rounded-circle"></td>
                  <td class="align-middle text-center">{{$player->username}}</td>
                  <td class="align-middle text-center">{{$player->email_or_phone}}</td>
                  <td class="align-middle text-center">
                    @if($player->login_method == "facebook")
                    <img src="{{ asset('img/facebook.png') }}" height="20px">
                    @endif
                    @if($player->login_method == "google")
                    <img src="{{ asset('img/google.png') }}" height="20px">
                    @endif
                    @if($player->login_method == "admin")
                    <span style="padding: 5px 10px 5px 10px !important; font-size: 12px !important;" class="badge badge-pill badge-danger">By Admin</span>
                    @endif
                    @if($player->login_method == "otp")
                    <img src="{{ asset('img/otp.png') }}" height="20px">
                    @endif
                    @if($player->login_method == "email")
                    <img src="{{ asset('img/mail.png') }}" height="20px">
                    @endif
                  </td>
                  <td class="align-middle text-center">
                    <a class="btn btn-sm btn-primary" href="{{ route('players.edit', ['id'=>$player->id]) }}"><i class="fas fa-edit"></i></a>
                    <!-- Edit Player Modal-->
                    <a class="btn btn-sm btn-danger" href="" data-toggle="modal" data-target="#deleteModal{{$player->id}}"><i class="fas fa-trash-alt"></i></a>
                  </td>
                  <!-- Delete Modal-->
                  <div class="modal fade" id="deleteModal{{$player->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Delete Player</h5>
                          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">×</span>
                          </button>
                        </div>
                        <div class="modal-body">Are You Sure To Delete This Player ?</div>
                        <div class="modal-footer">
                          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                          <a class="btn btn-info" href="{{ route('players.delete', ['id'=>$player->id]) }}">Delete</a>

                        </div>
                      </div>
                    </div>
                  </div>
                </tr>
                @endforeach
              </tbody>
            </table>
            {{ $players->links() }}
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection