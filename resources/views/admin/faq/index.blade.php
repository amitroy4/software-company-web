@extends('layouts.admin')
@section('title','FAQs')
@section('content')
<div class="container">
    <div class="page-inner">
       <div class="row">
          <div class="col-md-12">
             <div class="card card-round">
                <div class="card-header project-details-card-header">
                   <div class="d-flex align-items-center">
                      <h4 class="project-details-card-header-title"><i class='bx bx-question-mark bx-tada' ></i> FAQs</h4>
                      <a href="#" class="purchase-button ms-auto" data-bs-toggle="modal" data-bs-target="#create-slider-modal"><i class='bx bx-message-square-add bx-tada' ></i> Add New FAQ</a>
                   </div>
                </div>
                <!--create slider modal-->
                @include('admin.faq.create-faq-modal')
                <!--create slider modal-->
                <div class="card-body">
                   <div class="table-responsive">
                      <div id="add-row_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4">
                         <div class="row">
                            <div class="col-sm-12">
                               <table id="add-row" class="display table table-striped table-hover basic-datatables" role="grid" aria-describedby="add-row_info">
                                  <thead class="">
                                     <tr role="row">
                                        <th>Sl</th>
                                        <th>Question</th>
                                        <th>Answer</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                     </tr>
                                  </thead>
                                  <tbody>
                                    @foreach($faqs as $faq)
                                    <tr role="row" class="odd">
                                        <td class="sorting_1">0{{ $loop->iteration }}</td>
                                        <td>{{ $faq->question }}</td>
                                        <td>{{ $faq->answer }}</td>
                                        <td>
                                            @if($faq->status)
                                            <a href="{{ route('faq.toggle-status', $faq->id) }}"
                                                class="badge badge-success">Active</a>
                                            @else
                                            <a href="{{ route('faq.toggle-status', $faq->id) }}"
                                                class="badge badge-danger">Inactive</a>
                                            @endif
                                        <td>
                                            <div class="form-button-action">
                                                <a href="#" data-bs-toggle="modal"
                                                    data-bs-target="#edit_faq_{{ $faq->id }}"
                                                    title="edit" class="btn btn-link btn-success btn-lg">
                                                    <i class='bx bxs-edit'></i>
                                                </a>
                                                <a href="#" id="delete-faq-link"
                                                    data-faq-id="{{ $faq->id }}" title="delete"
                                                    class="btn btn-link btn-danger btn-lg"
                                                    data-original-title="Remove">
                                                    <i class='bx bx-trash-alt'></i> </a>
                                                <form id="delete-faq-form-{{ $faq->id }}"
                                                    action="{{ route('faq.destroy', $faq->id) }}"
                                                    method="POST" style="display: none;">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                            </div>

                                        </td>
                                    </tr>
                                    @include('admin.faq.edit-faq-modal')

                                    @endforeach
                                  </tbody>
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
        const deleteLinks = document.querySelectorAll('[id^="delete-faq-link"]');

        deleteLinks.forEach(function(deleteLink) {
            deleteLink.addEventListener('click', function(e) {
                e.preventDefault();
                const faqId = this.getAttribute('data-faq-id');
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
                        document.getElementById('delete-faq-form-' + faqId).submit();
                    }
                });
            });
        });
    });
</script>
@endpush
