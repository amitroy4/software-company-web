@extends('layouts.admin')
@section('title','Dashboard')
@section('content')
<div class="container">
    <div class="page-inner ms-lg-0">
      <div class="card mb-4 border-0 shadow-sm">
         <div class="card-body d-flex align-items-center justify-content-between flex-wrap gap-3">
            <div class="d-flex align-items-center">
               <span class="avatar avatar-xl flex-shrink-0">
                  <img src="{{ asset('admin') }}/assets/img/profile.jpg" class="rounded-circle" alt="img">
               </span>
               <div class="ms-3">
                  <h3 class="mb-1 project-details-card-header-title">Welcome Back, {{ Auth::user()->name }}</h3>
                  <p class="mb-0 text-muted">Here is your live dashboard overview.</p>
               </div>
            </div>
            <div>
               <a href="{{ route('contact.messages.unread') }}" class="btn btn-primary btn-sm">
                  <i class='bx bx-envelope'></i> View Unread Messages
               </a>
            </div>
         </div>
      </div>

      <div class="row g-3 mb-3">
         <div class="col-md-6 col-xl-3">
            <div class="card border-0 shadow-sm h-100">
               <div class="card-body">
                  <p class="text-muted mb-1">Unread Messages</p>
                  <h2 class="mb-1">{{ $messagesUnread }}</h2>
                  <small class="text-muted">Read: {{ $messagesRead }} | Total: {{ $messagesTotal }}</small>
               </div>
            </div>
         </div>
         <div class="col-md-6 col-xl-3">
            <div class="card border-0 shadow-sm h-100">
               <div class="card-body">
                  <p class="text-muted mb-1">Messages This Month</p>
                  <h2 class="mb-1">{{ $messagesThisMonth }}</h2>
                  <small class="{{ $messageGrowthPercent >= 0 ? 'text-success' : 'text-danger' }}">
                     {{ $messageGrowthPercent >= 0 ? '+' : '' }}{{ $messageGrowthPercent }}% vs last month
                  </small>
               </div>
            </div>
         </div>
         <div class="col-md-6 col-xl-3">
            <div class="card border-0 shadow-sm h-100">
               <div class="card-body">
                  <p class="text-muted mb-1">Active Services</p>
                  <h2 class="mb-1">{{ $servicesActive }}</h2>
                  <small class="text-muted">Total services: {{ $servicesTotal }}</small>
               </div>
            </div>
         </div>
         <div class="col-md-6 col-xl-3">
            <div class="card border-0 shadow-sm h-100">
               <div class="card-body">
                  <p class="text-muted mb-1">Team Members</p>
                  <h2 class="mb-1">{{ $membersTotal }}</h2>
                  <small class="text-muted">Open careers: {{ $careersOpen }}</small>
               </div>
            </div>
         </div>
      </div>

      <div class="row g-3 mb-3">
         <div class="col-md-6 col-xl-3">
            <div class="card border-0 shadow-sm h-100">
               <div class="card-body">
                  <p class="text-muted mb-1">Users</p>
                  <h2 class="mb-1">{{ $usersTotal }}</h2>
                  <small class="text-muted">New this month: {{ $usersThisMonth }}</small>
               </div>
            </div>
         </div>
         <div class="col-md-6 col-xl-3">
            <div class="card border-0 shadow-sm h-100">
               <div class="card-body">
                  <p class="text-muted mb-1">Blog Posts</p>
                  <h2 class="mb-1">{{ $blogsTotal }}</h2>
                  <small class="text-muted">Published content overview</small>
               </div>
            </div>
         </div>
         <div class="col-md-6 col-xl-3">
            <div class="card border-0 shadow-sm h-100">
               <div class="card-body">
                  <p class="text-muted mb-1">Products</p>
                  <h2 class="mb-1">{{ $productsTotal }}</h2>
                  <small class="text-muted">Portfolio and product catalog</small>
               </div>
            </div>
         </div>
         <div class="col-md-6 col-xl-3">
            <div class="card border-0 shadow-sm h-100">
               <div class="card-body">
                  <p class="text-muted mb-1">Quick Actions</p>
                  <div class="d-grid gap-2">
                     <a href="{{ route('service.index') }}" class="btn btn-outline-primary btn-sm">Manage Services</a>
                     <a href="{{ route('blog.index') }}" class="btn btn-outline-primary btn-sm">Manage Blogs</a>
                     <a href="{{ route('contact.messages') }}" class="btn btn-outline-primary btn-sm">All Messages</a>
                  </div>
               </div>
            </div>
         </div>
      </div>

      <div class="card border-0 shadow-sm">
         <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Recent Unread Messages</h5>
            <a href="{{ route('contact.messages.unread') }}" class="btn btn-sm btn-outline-primary">See All</a>
         </div>
         <div class="card-body p-0">
            <div class="table-responsive">
               <table class="table table-hover mb-0">
                  <thead>
                     <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Subject</th>
                        <th>Time</th>
                        <th class="text-end pe-4">Action</th>
                     </tr>
                  </thead>
                  <tbody>
                     @forelse($recentUnreadMessages as $item)
                        <tr>
                           <td>{{ $item->name }}</td>
                           <td>{{ $item->email }}</td>
                           <td>{{ \Illuminate\Support\Str::limit($item->subject ?: $item->message, 50) }}</td>
                           <td>{{ optional($item->updated_at)->diffForHumans() }}</td>
                           <td class="text-end pe-4">
                              <a href="{{ route('contact.messages.show', $item->id) }}" class="btn btn-sm btn-primary">Open</a>
                           </td>
                        </tr>
                     @empty
                        <tr>
                           <td colspan="5" class="text-center text-muted py-4">No unread messages right now.</td>
                        </tr>
                     @endforelse
                  </tbody>
               </table>
            </div>
         </div>
      </div>

    </div>
 </div>
@endsection
