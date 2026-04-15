

@extends('layouts.admin')
@section('title','Contact Messages')
@section('content')
<div class="container">
    <div class="page-inner">
       <div class="row">
          <div class="col-md-12">
             <div class="card card-round">
                <div class="card-header project-details-card-header">
                   <div class="d-flex align-items-center">
                      <h4 class="project-details-card-header-title"><i class='bx bxs-carousel bx-tada' ></i> Messages</h4>
                   </div>
                </div>



                <div class="card-body">
                   <div class="table-responsive">
                      <div id="add-row_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4">
                         <div class="row">
                            <div class="col-sm-12">
                               <table id="messageTable" class="display table table-striped table-hover basic-datatables" role="grid" aria-describedby="add-row_info">
                                  <thead class="">
                                     <tr role="row">
                                        <th style="width: 5%;">Sl</th>
                                        <th style="width: 15%;">Name</th>
                                        <th style="width: 10%;">Phone</th>
                                        <th style="width: 10%;">Email</th>
                                        <th style="width: 15%;">Subject</th>
                                        <th style="width: 30%;">Message</th>
                                        <th style="width: 7%;">Make Unread</th>
                                        <th style="width: 8%;">Delete</th>
                                     </tr>
                                  </thead>
                                  <tbody>



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







 <!-- jQuery (one version only!) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- DataTables -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" />
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

<!-- Your custom script that uses $('#messageTable').DataTable() -->
<script>
  $(document).ready(function () {
    $('#messageTable').DataTable();
  });
</script>


@endsection
@push('script')

<!-- SweetAlert2 CDN -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<script>
$(document).ready(function () {
    function loadMessages() {
        $.ajax({
            url: '/dashboard/api/read/messages', // API endpoint
            type: 'GET',
            success: function (data) {
                let tbody = $('#messageTable tbody');
                tbody.empty(); // Clear existing rows

                if (data.length === 0) {
                    tbody.append('<tr><td colspan="6" class="text-center">No messages found</td></tr>');
                    return;
                }

                $.each(data, function (index, message) {
                    let row = `
                        <tr>
                            <td>${index + 1}</td>
                            <td>${message.name}</td>
                            <td>${message.phone?? ''}</td>
                            <td>${message.email}</td>
                            <td>
                                ${message.service ? `<b>Service: ${message.service.service_name}</b><br> ` : ''}
                                ${message.subject ?? ''}
                            </td>
                            <td>${message.message}</td>
                            <td><input type="checkbox" class="status-toggle" data-id="${message.id}" ${message.status ? 'checked' : '' }></td>
                            <td>
                                <button class="btn btn-sm btn-danger delete-message" data-id="${message.id}">
                                    <i class='bx bx-trash'></i>
                                </button>
                            </td>
                        </tr>
                    `;
                    tbody.append(row);
                });
            },
            error: function () {
                alert('Failed to load messages.');
            }
        });
    }



    $(document).on('click', '.delete-message', function () {
        const button = $(this);
        const messageId = button.data('id');

        Swal.fire({
            title: 'Are you sure?',
            text: 'This message will be permanently deleted!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#e3342f',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: `/dashboard/api/messages/${messageId}`,
                    type: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (response) {
                        // Remove the row
                        // button.closest('tr').remove();

                        Swal.fire({
                            icon: 'success',
                            title: 'Deleted!',
                            text: response.message,
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 2000
                        });
                        // load messages
                        loadMessages();
                    },
                    error: function () {
                        Swal.fire('Error', 'Failed to delete the message.', 'error');
                    }
                });
            }
        });
    });



    // make unread
    $(document).on('change', '.status-toggle', function () {
        const checkbox = $(this);
        const messageId = checkbox.data('id');
        const newStatus = checkbox.is(':checked') ? 1 : 0;

        // Revert toggle immediately
        checkbox.prop('checked', !checkbox.prop('checked'));

        Swal.fire({
            title: 'Are you sure?',
            text: newStatus === 0 ? 'Mark this message as unread?' : 'Mark this message as read?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Unread it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: `/dashboard/api/messages/${messageId}/status`,
                    type: 'POST',
                    data: {
                        status: newStatus
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (response) {
                        Swal.fire({
                            toast: true,
                            position: 'top-end',
                            icon: 'success',
                            title: response.message,
                            showConfirmButton: false,
                            timer: 2000,
                            timerProgressBar: true
                        });
                        loadMessages();
                    },
                    error: function () {
                        Swal.fire('Error', 'Failed to update status.', 'error');
                    }
                });
            }
        });
    });





    // Call it on page load
    loadMessages();
});
</script>

@endpush


