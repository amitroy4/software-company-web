@extends('layouts.admin')
@section('title','System Maintenance')
@section('content')
<div class="container">
   <div class="page-inner">
      <div class="row">
         <div class="col-md-12">
            <div class="card card-round">
               <div class="card-header project-details-card-header">
                  <div class="d-flex align-items-center pb-2">
                     <h4 class="project-details-card-header-title"><i class='bx bxs-wrench bx-tada'></i>System Maintenance</h4>
                  </div>
               </div>
               <div class="card-body">
                  <a href="{{ route('cache-clear') }}" class="btn btn-round btn-dark" ><i class='bx bxs-eraser'></i>Cache Clear</a>
                  <a href="{{ route('storage-link') }}" class="btn btn-round btn-primary" ><i class='bx bx-link'></i>Storage Link</a>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection
