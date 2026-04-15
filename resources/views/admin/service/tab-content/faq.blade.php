<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">Manage FAQs for Service: <span class="text-primary">{{ $service->service_name }}</span></h2>
        <a href="{{ url('/dashboard/services') }}" class="btn btn-secondary">Back to Services</a>
    </div>

    <form id="faq-form" method="POST">
        @csrf

        {{-- Hidden input for service_id, crucial for linking FAQs on submission --}}
        <input type="hidden" name="service_id" value="{{ $service->id }}">

        <div id="faqs-wrapper">
            {{-- Existing and New FAQs will be loaded/added here by JavaScript --}}
            <p class="text-muted text-center" id="loading-message">Loading FAQs...</p>
        </div>

        <button type="button" class="btn btn-outline-primary mb-3 me-2" id="add-faq">
            <i class="fas fa-plus-circle me-1"></i> Add New FAQ
        </button>
        <button type="submit" class="btn btn-success mb-3">
            <i class="fas fa-save me-1"></i> Save All FAQs
        </button>
    </form>
</div>

{{-- FontAwesome for icons (optional, but good for style) --}}
<script src="https://kit.fontawesome.com/your-font-awesome-kit-code.js" crossorigin="anonymous"></script>
{{-- jQuery is typically needed for this dynamic approach --}}
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script>
    let newFaqIndex = 0; // To uniquely identify new FAQ input fields
    const serviceId = {{ $service->id }}; // Get service ID from Blade for AJAX calls

    /**
     * Generates HTML for a new FAQ group (for client-side additions).
     * @returns {string} HTML string for a new FAQ form group.
     */
    function generateNewFaqGroup() {
        return `
            <div class="faq-group new-faq" data-index="${newFaqIndex}">
                <button type="button" class="btn btn-danger remove-btn" title="Remove new FAQ">X</button>
                <div class="mb-3">
                    <label for="new_question_${newFaqIndex}" class="form-label">Question:</label>
                    <input type="text" id="new_question_${newFaqIndex}" name="new_faqs_questions[${newFaqIndex}]" class="form-control" placeholder="Enter question" required>
                </div>
                <div class="mb-3">
                    <label for="new_answer_${newFaqIndex}" class="form-label">Answer:</label>
                    <textarea id="new_answer_${newFaqIndex}" name="new_faqs_answers[${newFaqIndex}]" class="form-control" rows="3" placeholder="Enter answer" required></textarea>
                </div>
            </div>
        `;
    }

    /**
     * Generates HTML for an existing FAQ group (loaded from database).
     * @param {object} faq - The FAQ object from the server.
     * @returns {string} HTML string for an existing FAQ form group.
     */
    function generateExistingFaqGroup(faq) {
        // Ensure that question and answer are not null to prevent JS errors when setting value/content
        const question = faq.question || '';
        const answer = faq.answer || '';

        return `
            <div class="faq-group existing-faq" data-id="${faq.id}">
                <button type="button" class="btn btn-danger remove-existing-btn" data-id="${faq.id}" title="Delete this FAQ from database">X</button>
                <div class="mb-3">
                    <label for="existing_question_${faq.id}" class="form-label">Question:</label>
                    <input type="text" id="existing_question_${faq.id}" name="existing_faqs[${faq.id}][question]" class="form-control" value="${question}" placeholder="Enter question" required>
                </div>
                <div class="mb-3">
                    <label for="existing_answer_${faq.id}" class="form-label">Answer:</label>
                    <textarea id="existing_answer_${faq.id}" name="existing_faqs[${faq.id}][answer]" class="form-control" rows="3" placeholder="Enter answer" required>${answer}</textarea>
                </div>
                {{-- If you had a status field you wanted to edit: --}}
                {{-- <div class="form-check mb-3">
                    <input class="form-check-input" type="checkbox" name="existing_faqs[${faq.id}][status]" id="status_${faq.id}" ${faq.status ? 'checked' : ''}>
                    <label class="form-check-label" for="status_${faq.id}">
                        Active
                    </label>
                </div> --}}
            </div>
        `;
    }

    /**
     * Loads existing FAQs for the current service via AJAX and populates the form.
     */
    function loadFaqs() {
        $('#loading-message').show(); // Show loading message
        $.ajax({
            url: `/dashboard/api/services/${serviceId}`, // API endpoint to get service data including faqs
            method: 'GET',
            success: function (data) {
                $('#faqs-wrapper').empty(); // Clear existing content
                if (data.faqs && data.faqs.length > 0) {
                    data.faqs.forEach(function (faq) {
                        $('#faqs-wrapper').append(generateExistingFaqGroup(faq));
                    });
                } else {
                    $('#faqs-wrapper').append('<p class="text-muted text-center mt-3">No FAQs found for this service. Click "Add New FAQ" to start.</p>');
                }
            },
            error: function (xhr) {
                alert('Error loading FAQs: ' + (xhr.responseJSON ? xhr.responseJSON.message : xhr.responseText));
                $('#faqs-wrapper').append('<p class="text-danger text-center mt-3">Failed to load FAQs. Please try again.</p>');
            },
            complete: function() {
                $('#loading-message').hide(); // Hide loading message
            }
        });
    }

    // --- Event Listeners ---

    $(document).ready(function () {
        loadFaqs(); // Initial load of FAQs when the page is ready
    });

    // Add new FAQ group when "Add New FAQ" button is clicked
    $('#add-faq').on('click', function () {
        $('#faqs-wrapper').append(generateNewFaqGroup());
        newFaqIndex++; // Increment for the next new FAQ
    });

    // Remove a newly added FAQ group (client-side only, no database interaction)
    $(document).on('click', '.remove-btn', function () {
        if (confirm('Are you sure you want to remove this unsaved FAQ?')) {
            $(this).closest('.faq-group.new-faq').remove();
        }
    });

    // Remove an existing FAQ group (via AJAX, deletes from database)
    $(document).on('click', '.remove-existing-btn', function () {
        if (!confirm('Are you sure you want to permanently delete this FAQ from the database?')) {
            return;
        }

        let faqId = $(this).data('id');
        let $faqGroup = $(this).closest('.faq-group.existing-faq'); // Cache the element to remove later

        $.ajax({
            url: `/dashboard/services/${serviceId}/faqs/${faqId}`, // DELETE route
            method: 'DELETE',
            data: {
                _token: $('input[name="_token"]').val() // Get CSRF token
            },
            success: function (response) {
                if (response.success) {
                    $faqGroup.fadeOut(300, function() { // Fade out before removing
                        $(this).remove();
                        alert(response.message);
                        // If no FAQs left, update message
                        if ($('#faqs-wrapper').children().length === 0) {
                             $('#faqs-wrapper').append('<p class="text-muted text-center mt-3">No FAQs found for this service. Click "Add New FAQ" to start.</p>');
                        }
                    });
                } else {
                    alert('Failed to remove FAQ: ' + response.message);
                }
            },
            error: function (xhr) {
                let errorMessage = 'Error removing FAQ.';
                if (xhr.responseJSON && xhr.responseJSON.message) {
                    errorMessage = 'Error removing FAQ: ' + xhr.responseJSON.message;
                } else {
                    errorMessage += ': ' + xhr.responseText;
                }
                alert(errorMessage);
            }
        });
    });

    // Handle form submission (saving all changes) via AJAX
    $('#faq-form').on('submit', function (e) {
        e.preventDefault(); // Prevent default browser form submission

        let formData = new FormData(this); // Collects all form data, including new/existing FAQ inputs

        $.ajax({
            url: `/dashboard/services/${serviceId}/faqs`, // POST route for update/create
            method: 'POST',
            data: formData,
            processData: false, // Important: Don't process data, let FormData handle it
            contentType: false, // Important: Don't set content type, let FormData handle it
            success: function (response) {
                if (response.success) {
                    alert(response.message);
                    loadFaqs(); // Reload FAQs to show all updates and newly created items with their actual IDs
                } else {
                    alert('Error: ' + response.message);
                }
            },
            error: function (xhr) {
                let errorMessage = 'An unexpected error occurred.';
                if (xhr.responseJSON && xhr.responseJSON.errors) {
                    // Handle validation errors specifically
                    errorMessage = 'Validation Error:\n';
                    for (let key in xhr.responseJSON.errors) {
                        errorMessage += xhr.responseJSON.errors[key].join('\n') + '\n';
                    }
                } else if (xhr.responseJSON && xhr.responseJSON.message) {
                    // Handle other server-side errors
                    errorMessage = 'Server Error: ' + xhr.responseJSON.message;
                } else {
                    // Generic error for unexpected responses
                    errorMessage = 'Error saving FAQs: ' + xhr.responseText;
                }
                alert(errorMessage);
            }
        });
    });
</script>