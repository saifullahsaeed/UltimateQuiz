@extends('home')
@section('title')
Dashboard
@endsection
@section('content')
<div class="container">
    <div class="row">
        <!-- Dashboard Card -->
        <div class="col-lg-6 col-md-6 col-sm-12 mb-25" style="margin-top: 20px;">
            <div class="card border-left-dark shadow h-100 py-2">
                <div class="card-body">
                    <div class="panel-card row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="font-weight-bold text-smaller text-dark text-uppercase mb-1 cards-title">Dashboard</div>
                            <div class="h5 mb-0 text-gray-800">
                                <a href="{{ route('home') }}" class="edit-section badge badge-dark">Manage</a>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-tachometer-alt fa-3x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Admins Card -->
        <div class="col-lg-6 col-md-6 col-sm-12 mb-25" style="margin-top: 20px;">
            <div class="card border-left-dark shadow h-100 py-2">
                <div class="card-body">
                    <div class="panel-card row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="font-weight-bold text-smaller text-dark text-uppercase mb-1 cards-title">Admins</div>
                            <div class="h5 mb-0 text-gray-800">
                                <a href="{{ route('admins') }}" class="edit-section badge badge-dark">Manage</a>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user-lock fa-3x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Players Card -->
        <div class="col-lg-6 col-md-6 col-sm-12 mb-25" style="margin-top: 20px;">
            <div class="card border-left-dark shadow h-100 py-2">
                <div class="card-body">
                    <div class="panel-card row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="font-weight-bold text-smaller text-dark text-uppercase mb-1 cards-title">Players</div>
                            <div class="h5 mb-0 text-gray-800">
                                <a href="{{ route('players') }}" class="edit-section badge badge-dark">Manage</a>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-3x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Players Card -->
        <div class="col-lg-6 col-md-6 col-sm-12 mb-25" style="margin-top: 20px;">
            <div class="card border-left-dark shadow h-100 py-2">
                <div class="card-body">
                    <div class="panel-card row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="font-weight-bold text-smaller text-dark text-uppercase mb-1 cards-title">Categories</div>
                            <div class="h5 mb-0 text-gray-800">
                                <a href="{{ route('categories') }}" class="edit-section badge badge-dark">Manage</a>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-bars fa-3x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Subcategories Card -->
        <div class="col-lg-6 col-md-6 col-sm-12 mb-25" style="margin-top: 20px;">
            <div class="card border-left-dark shadow h-100 py-2">
                <div class="card-body">
                    <div class="panel-card row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="font-weight-bold text-smaller text-dark text-uppercase mb-1 cards-title">Subcategories</div>
                            <div class="h5 mb-0 text-gray-800">
                                <a href="{{ route('subcategories') }}" class="edit-section badge badge-dark">Manage</a>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-database fa-3x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Quizzes Card -->
        <div class="col-lg-6 col-md-6 col-sm-12 mb-25" style="margin-top: 20px;">
            <div class="card border-left-dark shadow h-100 py-2">
                <div class="card-body">
                    <div class="panel-card row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="font-weight-bold text-smaller text-dark text-uppercase mb-1 cards-title">Quizzes</div>
                            <div class="h5 mb-0 text-gray-800">
                                <a href="{{ route('quizzes') }}" class="edit-section badge badge-dark">Manage</a>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-cubes fa-3x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Quizzes Card -->
        <div class="col-lg-6 col-md-6 col-sm-12 mb-25" style="margin-top: 20px;">
            <div class="card border-left-dark shadow h-100 py-2">
                <div class="card-body">
                    <div class="panel-card row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="font-weight-bold text-smaller text-dark text-uppercase mb-1 cards-title">Text Questions</div>
                            <div class="h5 mb-0 text-gray-800">
                                <a href="{{ route('textquestions.categories') }}" class="edit-section badge badge-dark">Manage</a>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-text-width fa-3x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Quizzes Card -->
        <div class="col-lg-6 col-md-6 col-sm-12 mb-25" style="margin-top: 20px;">
            <div class="card border-left-dark shadow h-100 py-2">
                <div class="card-body">
                    <div class="panel-card row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="font-weight-bold text-smaller text-dark text-uppercase mb-1 cards-title">Image Questions</div>
                            <div class="h5 mb-0 text-gray-800">
                                <a href="{{ route('imagequestions.categories') }}" class="edit-section badge badge-dark">Manage</a>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-images fa-3x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Quizzes Card -->
        <div class="col-lg-6 col-md-6 col-sm-12 mb-25" style="margin-top: 20px;">
            <div class="card border-left-dark shadow h-100 py-2">
                <div class="card-body">
                    <div class="panel-card row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="font-weight-bold text-smaller text-dark text-uppercase mb-1 cards-title">Audio Questions</div>
                            <div class="h5 mb-0 text-gray-800">
                                <a href="{{ route('audioquestions.categories') }}" class="edit-section badge badge-dark">Manage</a>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-volume-up fa-3x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Daily Quiz Card -->
        <div class="col-lg-6 col-md-6 col-sm-12 mb-25" style="margin-top: 20px;">
            <div class="card border-left-dark shadow h-100 py-2">
                <div class="card-body">
                    <div class="panel-card row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="font-weight-bold text-smaller text-dark text-uppercase mb-1 cards-title">Daily Quiz</div>
                            <div class="h5 mb-0 text-gray-800">
                                <a href="{{ route('dailyquiz') }}" class="edit-section badge badge-dark">Manage</a>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-hourglass-half fa-3x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Withdraws Card -->
        <div class="col-lg-6 col-md-6 col-sm-12 mb-25" style="margin-top: 20px;">
            <div class="card border-left-dark shadow h-100 py-2">
                <div class="card-body">
                    <div class="panel-card row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="font-weight-bold text-smaller text-dark text-uppercase mb-1 cards-title">Withdraws</div>
                            <div class="h5 mb-0 text-gray-800">
                                <a href="{{ route('withdraws') }}" class="edit-section badge badge-dark">Manage</a>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-money-bill-wave fa-3x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Payment Methods Card -->
        <div class="col-lg-6 col-md-6 col-sm-12 mb-25" style="margin-top: 20px;">
            <div class="card border-left-dark shadow h-100 py-2">
                <div class="card-body">
                    <div class="panel-card row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="font-weight-bold text-smaller text-dark text-uppercase mb-1 cards-title">Payment Methods</div>
                            <div class="h5 mb-0 text-gray-800">
                                <a href="{{ route('paymentmethods') }}" class="edit-section badge badge-dark">Manage</a>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fab fa-cc-visa fa-3x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Ads Management Card -->
        <div class="col-lg-6 col-md-6 col-sm-12 mb-25" style="margin-top: 20px;">
            <div class="card border-left-dark shadow h-100 py-2">
                <div class="card-body">
                    <div class="panel-card row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="font-weight-bold text-smaller text-dark text-uppercase mb-1 cards-title">Ads Management</div>
                            <div class="h5 mb-0 text-gray-800">
                                <a href="{{ route('ads') }}" class="edit-section badge badge-dark">Manage</a>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fab fa-buysellads fa-3x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Admins Card -->
        <div class="col-lg-6 col-md-6 col-sm-12 mb-25" style="margin-top: 20px;">
            <div class="card border-left-dark shadow h-100 py-2">
                <div class="card-body">
                    <div class="panel-card row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="font-weight-bold text-smaller text-dark text-uppercase mb-1 cards-title">Settings</div>
                            <div class="h5 mb-0 text-gray-800">
                                <a href="{{ route('settings') }}" class="edit-section badge badge-dark">Manage</a>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-cogs fa-3x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
