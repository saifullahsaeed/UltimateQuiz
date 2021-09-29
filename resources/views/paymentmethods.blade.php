@extends('home')
@section('title')
Payment Method
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
              <a class="btn-success btn btn-block" href="#" data-toggle="modal" data-target="#addModal"><i class="fas fa-plus"></i> Add New Payment Method</a>
            </div>
            <div class="col-lg-6 text-right">
              <a class="btn-dark btn" href="{{ route('home') }}"><i class="fas fa-arrow-left"></i> Back To Dashboard</a>
            </div>
          </div>
          <!-- Add Player Modal-->
          <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Add New Category</h5>
                  <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span>
                  </button>
                </div>
                <div class="modal-body">
                  <form method="POST" action="{{ route('paymentmethod.add') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group text-left">
                      <label>Payment Method</label>
                      <input name="method" type="text" class="form-control">
                    </div>
                    <div class="text-right">
                      <button class="btn btn-sm btn-success" type="submit">Save Method</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
          <br>
          <div class="row no-gutters align-items-center table-responsive">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th class="align-middle text-center" scope="col">Payment Method</th>
                  <th class="align-middle text-center" scope="col">Actions</th>
                </tr>
              </thead>
              <tbody>
                @foreach($paymentmethods as $paymentmethod)
                <tr>
                  <td style="text-align: center !important;">{{$paymentmethod->method}}</td>
                  <td style="text-align: center !important;"><a class="btn btn-sm btn-danger" href="{{ route('paymentmethod.delete', ['paymentmethod'=>$paymentmethod->id]) }}"><i class="fas fa-trash-alt"></i> Delete</a></td>      
                </tr>
                @endforeach
              </tbody>
            </table>
            {{ $paymentmethods->links() }}
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection