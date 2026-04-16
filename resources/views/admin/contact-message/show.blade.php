@extends('layouts.admin')
@section('title','Message Details')
@section('content')
<div class="container">
    <div class="page-inner">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-round">
                    <div class="card-header project-details-card-header d-flex justify-content-between align-items-center">
                        <h4 class="project-details-card-header-title mb-0"><i class='bx bx-envelope-open'></i> Message Details</h4>
                        <a href="{{ route('contact.messages.read') }}" class="btn btn-sm btn-outline-primary">Back to Read Messages</a>
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="text-muted small">Name</label>
                                <div class="fw-semibold">{{ $message->name }}</div>
                            </div>
                            <div class="col-md-6">
                                <label class="text-muted small">Phone</label>
                                <div class="fw-semibold">{{ $message->phone ?: 'N/A' }}</div>
                            </div>
                            <div class="col-md-6">
                                <label class="text-muted small">Email</label>
                                <div class="fw-semibold">{{ $message->email ?: 'N/A' }}</div>
                            </div>
                            <div class="col-md-6">
                                <label class="text-muted small">Service</label>
                                <div class="fw-semibold">{{ optional($message->service)->service_name ?: 'N/A' }}</div>
                            </div>
                            <div class="col-md-6">
                                <label class="text-muted small">Subject</label>
                                <div class="fw-semibold">{{ $message->subject ?: 'N/A' }}</div>
                            </div>
                            <div class="col-md-6">
                                <label class="text-muted small">Status</label>
                                <div>
                                    <span class="badge bg-success">Read</span>
                                </div>
                            </div>
                            <div class="col-12">
                                <label class="text-muted small">Message</label>
                                <div class="border rounded p-3 bg-light" style="white-space: pre-wrap;">{{ $message->message }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
