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
                                        <th style="width: 7%;">Mark Read</th>
                                        <th style="width: 8%;">View</th>
                                    </tr>
                                  </thead>
                                  <tbody></tbody>
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





<!-- ... your table and scripts -->

@include('admin.contact-message.message-view-modal')



<link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>



 <!-- jQuery (one version only!) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Bootstrap 5 JS (after jQuery) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>


<!-- DataTables -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" />
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

<!-- SweetAlert2 CDN -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<!-- Your custom script that uses $('#messageTable').DataTable() -->
<script>
  $(document).ready(function () {
    $('#messageTable').DataTable();
  });
</script>


@endsection


@push('script')


<script>
$(document).ready(function () {
    function loadMessages() {
        $.ajax({
            url: '/dashboard/api/messages', // API endpoint
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
                            <td><input type="checkbox" class="status-toggle" data-id="${message.id}" ${message.status ? '' : 'checked'}></td>
                            <td>
                                <button class="btn btn-sm btn-info view-message"
                                    data-name="${message.name}"
                                    data-phone="${message.phone ?? ''}"
                                    data-email="${message.email}"
                                    data-service="${message.service?.service_name || ''}"
                                    data-subject="${message.subject ?? ''}"
                                    data-message="${message.message}">
                                    <i class='bx bx-show'></i>
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




    // Event delegation since checkboxes are loaded dynamically
    $(document).on('change', '.status-toggle', function () {
        const checkbox = $(this);
        const messageId = checkbox.data('id');
        const newStatus = checkbox.is(':checked') ? 0 : 1;

        // Revert toggle immediately
        checkbox.prop('checked', !checkbox.prop('checked'));

        Swal.fire({
            title: 'Are you sure?',
            text: newStatus === 0 ? 'Mark this message as unread?' : 'Mark this message as read?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Read it!'
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





    // show message in detail in the modal
    $(document).on('click', '.view-message', function () {
        const name = $(this).data('name');
        const phone = $(this).data('phone');
        const email = $(this).data('email');
        const service = $(this).data('service');
        const subject = $(this).data('subject');
        const message = $(this).data('message');

        // Fill modal
        $('#modalName').text(name);
        $('#modalPhone').text(phone);
        $('#modalEmail').text(email);
        $('#modalService').text(service);
        $('#modalSubject').text(subject);
        $('#modalMessage').text(message);

        // Show modal
        $('#messageModal').modal('show');
    });



    // Call it on page load
    loadMessages();
});
</script>

@endpush
