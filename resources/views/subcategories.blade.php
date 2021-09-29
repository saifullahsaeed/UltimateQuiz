@extends('home')
@section('title')
SubCategories
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
            @foreach($categories as $category)
            <div class="col-lg-4 col-sm-6">
            <div class="card" style="margin: 5px;">
              <img style="height: 190px !important;"  src="{{ asset('uploads/categories/'.$category->category_img) }}" class="card-img-top" alt="{{$category->category_name}}">
              <div class="card-body">
                <h5 class="card-title">{{$category->category_name}}</h5>
                <a href="{{ route('subcategories.get', ['id'=>$category->id]) }}" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i> Manage Subcategories</a>
              </div>
            </div>
            </div>
            @endforeach
          </div>
          <br>
          <div>
              {{ $categories->links() }}
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection