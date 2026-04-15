@extends('layouts.admin')
@section('title','Counter')
@section('content')
<div class="container">
    <div class="page-inner">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-round">
                    <div class="card-header project-details-card-header">
                        <div class="d-flex align-items-center">
                            <a href="#" class="purchase-button ms-auto" data-bs-toggle="modal"
                                data-bs-target="#create-counter"><i class='bx bx-money bx-tada'></i> Add
                                New Counter</a>
                        </div>
                    </div>
                    <!--create counter modal-->
                    @include('admin.counter.partial.create-counter')
                    <!--create counter modal-->

                    <div class="card-body">
                        <div class="table-responsive">
                            <div id="add-row_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <table id="add-row"
                                            class="display table table-striped table-hover basic-datatables" role="grid"
                                            aria-describedby="add-row_info">
                                            <thead class="">
                                                <tr role="row">
                                                    <th>SL</th>
                                                    <th>Counter</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($counters as $counter)
                                                <tr role="row" class="odd">
                                                    <td class="sorting_1">0{{ $loop->iteration }}</td>
                                                    <td>
                                                        <div style="font-size: 20px; font-weight: bold; ">
                                                            {{$counter->data_count}}{{$counter->counter_symbol}}
                                                        </div>
                                                        <div style="font-size: 16px; color: margin-top: 8px;">
                                                            {{$counter->counter_title}}
                                                        </div>

                                                        @if($counter->counter_icon)
                                                        <div style="margin-top: 15px;">
                                                            <img src="{{ asset('storage/' . $counter->counter_icon) }}"
                                                                width="60" height="60" alt="icon"
                                                                style="border-radius: 8px;">
                                                        </div>
                                                        @endif
                                                    </td>

                                                    <td>
                                                        @if($counter->status)
                                                        <a href="{{ route('counter.toggle-status', $counter->id) }}"
                                                            class="badge badge-success">Active</a>
                                                        @else
                                                        <a href="{{ route('counter.toggle-status', $counter->id) }}"
                                                            class="badge badge-danger">Inactive</a>
                                                        @endif
                                                    <td>
                                                        <div class="form-button-action">
                                                            <a href="#" data-bs-toggle="modal"
                                                                data-bs-target="#edit-counter_{{ $counter->id }}"
                                                                title="edit" class="btn btn-link btn-success btn-lg">
                                                                <i class='bx bxs-edit '></i>
                                                            </a>
                                                            <a href="#" id="delete-counter-link"
                                                                data-counter-id="{{ $counter->id }}" title="delete"
                                                                class="btn btn-link btn-danger btn-lg"
                                                                data-original-title="Remove">
                                                                <i class='bx bx-trash-alt'></i> </a>
                                                            <form id="delete-counter-form-{{ $counter->id }}"
                                                                action="{{ route('counter.destroy', $counter->id) }}"
                                                                method="POST" style="display: none;">
                                                                @csrf
                                                                @method('DELETE')
                                                            </form>
                                                        </div>

                                                    </td>
                                                </tr>
                                                @include('admin.counter.partial.edit-counter')
                                                @endforeach
                                            </tbody>
                                        </table>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('script')
<script>
    // Use event delegation to handle click events for all delete buttons
    document.addEventListener('DOMContentLoaded', function() {
        const deleteLinks = document.querySelectorAll('[id^="delete-counter-link"]');

        deleteLinks.forEach(function(deleteLink) {
            deleteLink.addEventListener('click', function(e) {
                e.preventDefault();
                const counterId = this.getAttribute('data-counter-id');
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this action!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'No, cancel!',
                    customClass: {
                        confirmButton: 'btn btn-danger',
                        cancelButton: 'btn btn-secondary'
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        // If confirmed, find the form and submit it
                        document.getElementById('delete-counter-form-' + counterId).submit();
                    }
                });
            });
        });
    });
</script>
@endpush
