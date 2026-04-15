@extends('layouts.admin')
@section('title','Dashboard')
@section('content')
<div class="container">
    <div class="page-inner ms-lg-0">
       <!-- Welcome Wrap -->
       <div class="card mb-0">
          <div class="card-body d-flex align-items-center justify-content-between flex-wrap">
             <div class="d-flex align-items-center">
                <span class="avatar avatar-xl flex-shrink-0">
                <img src="{{ asset('admin') }}/assets/img/profile.jpg" class="rounded-circle" alt="img">
                </span>
                <div class="ms-3">
                   <h3 class="mb-2 project-details-card-header-title">Welcome Back, {{Auth::user()->name}} <a href="javascript:void(0);" class="edit-icon"><i class="ti ti-edit fs-14"></i></a></h3>
                </div>
             </div>
          </div>
       </div>

    </div>
 </div>
@endsection
