@extends('home')
@section('title')
Withdraws
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
          <div class="row no-gutters align-items-center table-responsive">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th class="align-middle text-center" scope="col">Player</th>
                  <th class="align-middle text-center" scope="col">Method</th>
                  <th class="align-middle text-center" scope="col">Payment Info</th>
                  <th class="align-middle text-center" scope="col">Amount</th>
                  <th class="align-middle text-center" scope="col">Status</th>
                  <th class="align-middle text-center" scope="col">Actions</th>
                </tr>
              </thead>
              <tbody>
                @foreach($withdraws as $withdraw)
                <tr>
                  @inject('player', 'App\Models\Player')
                  <td style="font-size: 13px !important; text-align: center !important;">{{App\Models\Player::find($withdraw->player_id)->username}}</td>
                  <td style="font-size: 13px !important; text-align: center !important;">{{$withdraw->payment_method}}</td>
                  <td style="font-size: 13px !important; text-align: center !important;">{{$withdraw->payment_info}}</td>
                  <td style="font-size: 13px !important; text-align: center !important;">{{$withdraw->amount}} {{$settings->currency}}</td>
                  <td style="font-size: 13px !important; text-align: center !important;">@if($withdraw->status=="paid")
                    <p class="btn-success text-center">{{$withdraw->status}}</p>
                    @elseif($withdraw->status=="pending")
                    <p class="btn-dark text-center">{{$withdraw->status}}</p>
                    @elseif($withdraw->status=="rejected")
                    <p class="btn-danger text-center">{{$withdraw->status}}</p>
                    @endif
                  </td>
                  <td style="font-size: 13px !important; text-align: center !important;">
                    @if($withdraw->status=="paid")
                    <p class="btn-success">{{$withdraw->status}}</p>
                    @elseif($withdraw->status=="rejected")
                    <p class="btn-danger">{{$withdraw->status}}</p>
                    @else
                    <a style="font-size: 12px !important;" class="btn btn-sm btn-primary" href="#" data-toggle="modal" data-target="#editModal{{$withdraw->id}}"><i class="fas fa-edit"></i></a>
                     <a style="font-size: 12px !important;" class="btn btn-sm btn-danger" href="{{ route('withdraw.delete', ['withdraw'=>$withdraw->id]) }}"><i class="fas fa-trash-alt"></i></a>
                    <div class="modal fade" id="editModal{{$withdraw->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Edit withdraw </h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <form method="POST" action="{{ route('withdraw.update', ['id'=>$withdraw->id]) }}" >
                              @csrf
                              <div class="form-group">
                                <select name ="status" class="custom-select">
                                  <option selected value="paid">Mark as Paid</option>
                                  <option value="rejected">Mark as Rejected</option>
                                </select>
                              </div>
                              <div class="text-right">
                                <button class="btn btn-sm btn-success" type="submit">Save Edition</button>
                              </div>
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>
                    @endif
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
            {{ $withdraws->links() }}
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection