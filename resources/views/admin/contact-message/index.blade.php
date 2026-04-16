@extends('layouts.admin')
@section('title','Contact Messages')
@section('content')
<div class="container">
    <div class="page-inner">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-round">
                    <div class="card-header project-details-card-header d-flex justify-content-between align-items-center flex-wrap gap-2">
                        <h4 class="project-details-card-header-title mb-0"><i class='bx bxs-envelope bx-tada'></i> Contact Messages</h4>

                        <div class="btn-group" role="group" aria-label="Message filters">
                            <a href="{{ route('contact.messages') }}" class="btn btn-sm {{ ($activeFilter ?? 'all') === 'all' ? 'btn-primary' : 'btn-outline-primary' }}">All</a>
                            <a href="{{ route('contact.messages.unread') }}" class="btn btn-sm {{ ($activeFilter ?? '') === 'unread' ? 'btn-primary' : 'btn-outline-primary' }}">Unread</a>
                            <a href="{{ route('contact.messages.read') }}" class="btn btn-sm {{ ($activeFilter ?? '') === 'read' ? 'btn-primary' : 'btn-outline-primary' }}">Read</a>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="messageTable" class="display table table-striped table-hover basic-datatables">
                                <thead>
                                    <tr>
                                        <th style="width: 5%;">Sl</th>
                                        <th style="width: 14%;">Name</th>
                                        <th style="width: 11%;">Phone</th>
                                        <th style="width: 15%;">Email</th>
                                        <th style="width: 14%;">Subject</th>
                                        <th style="width: 24%;">Message</th>
                                        <th style="width: 8%;">Status</th>
                                        <th style="width: 9%;">Actions</th>
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

@endsection

@push('script')
<script>
$(document).ready(function () {
    const activeFilter = @json($activeFilter ?? 'all');
    const table = $('#messageTable').DataTable({
        pageLength: 10,
        order: [[0, 'desc']],
        destroy: true,
        data: [],
        columns: [
            { data: 'sl' },
            { data: 'name' },
            { data: 'phone' },
            { data: 'email' },
            { data: 'subject' },
            { data: 'message' },
            { data: 'status' },
            { data: 'actions', orderable: false, searchable: false }
        ]
    });

    function safeText(value) {
        return $('<div>').text(value ?? '').html();
    }

    function truncateText(value, length) {
        const text = String(value ?? '');
        if (text.length <= length) {
            return text;
        }
        return text.substring(0, length) + '...';
    }

    function getStatusBadge(isUnread) {
        if (isUnread) {
            return '<span class="badge bg-warning text-dark">Unread</span>';
        }
        return '<span class="badge bg-success">Read</span>';
    }

    function loadMessages() {
        $.ajax({
            url: '/dashboard/api/messages',
            type: 'GET',
            data: { filter: activeFilter },
            success: function (data) {
                const rows = (data || []).map(function (message, index) {
                    const serviceName = message.service && message.service.service_name ? message.service.service_name : '';
                    const subject = serviceName ? ('Service: ' + serviceName + (message.subject ? ' | ' + message.subject : '')) : (message.subject || 'N/A');
                    const isUnread = !!message.status;
                    const nextStatus = 0;
                    const toggleTitle = isUnread ? 'Mark as Read' : 'Already Read';
                    const toggleClass = isUnread ? 'btn-success' : 'btn-secondary disabled';
                    const showUrl = `/dashboard/messages/${message.id}`;

                    return {
                        sl: index + 1,
                        name: safeText(message.name),
                        phone: safeText(message.phone || 'N/A'),
                        email: safeText(message.email || 'N/A'),
                        subject: safeText(subject),
                        message: safeText(truncateText(message.message, 100)),
                        status: getStatusBadge(isUnread),
                        actions: `
                            <div class="btn-group btn-group-sm" role="group">
                                <a class="btn btn-info" href="${showUrl}" title="View message">
                                    <i class='bx bx-show'></i>
                                </a>
                                <button class="btn ${toggleClass} status-toggle" data-id="${message.id}" data-status="${nextStatus}" title="${toggleTitle}" ${isUnread ? '' : 'disabled'}>
                                    <i class='bx ${isUnread ? 'bx-check-circle' : 'bx-lock-alt'}'></i>
                                </button>
                                <button class="btn btn-danger delete-message" data-id="${message.id}" title="Delete">
                                    <i class='bx bx-trash'></i>
                                </button>
                            </div>
                        `
                    };
                });

                table.clear().rows.add(rows).draw();
            },
            error: function () {
                Swal.fire('Error', 'Failed to load messages.', 'error');
            }
        });
    }

    $(document).on('click', '.status-toggle', function () {
        const button = $(this);
        if (button.is(':disabled')) {
            return;
        }
        const messageId = button.data('id');
        const newStatus = Number(button.data('status'));
        const actionLabel = 'mark this message as read';

        Swal.fire({
            title: 'Are you sure?',
            text: `Do you want to ${actionLabel}?`,
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes'
        }).then((result) => {
            if (!result.isConfirmed) {
                return;
            }

            $.ajax({
                url: `/dashboard/api/messages/${messageId}/status`,
                type: 'POST',
                data: { status: newStatus },
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
                        timer: 1800
                    });
                    loadMessages();
                },
                error: function () {
                    Swal.fire('Error', 'Failed to update status.', 'error');
                }
            });
        });
    });

    $(document).on('click', '.delete-message', function () {
        const messageId = $(this).data('id');

        Swal.fire({
            title: 'Are you sure?',
            text: 'This message will be permanently deleted.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#e3342f',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Yes, delete it'
        }).then((result) => {
            if (!result.isConfirmed) {
                return;
            }

            $.ajax({
                url: `/dashboard/api/messages/${messageId}`,
                type: 'DELETE',
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
                        timer: 1800
                    });
                    loadMessages();
                },
                error: function () {
                    Swal.fire('Error', 'Failed to delete message.', 'error');
                }
            });
        });
    });

    loadMessages();
});
</script>
@endpush
