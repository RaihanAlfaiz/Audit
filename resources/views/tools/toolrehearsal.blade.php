@extends('layouts.master')
@section('breadcrumb-items')
<span class="text-muted fw-light">Tools / Checklist Rehearsals</span>
@endsection
@section('content')
<div class="card">
    <div class="card-header">
        <h3>Checklist Alat untuk {{ $event->tenant_name }} (Gladi Resik)</h3>
    </div>
    <div class="card-body">
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

        <form id="checklistForm" action="{{ route('tools.submit.rehearsal', $event->id) }}" method="POST">
            @csrf
            <!-- Input tersembunyi untuk menyimpan status acara -->
            <input type="hidden" name="status" id="status" value="{{ $event->status }}">
            <div class="table-responsive">
                <table id="tbl_list" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th scope="col">Deskripsi Alat</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Checklist</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($items as $item)
                            <tr>
                                <td>{!! $item->description !!}</td>
                                <td>{!! $item->quantity !!}</td>
                                <td>
                                    <div class="form-check">
                                        <input class="form-check-input checklist-item" type="checkbox" id="item_{{ $loop->index }}" name="item_{{ $loop->index }}" data-item-id="item_{{ $loop->index }}" data-event-id="{{ $event->id }}" {{ $item->status ? 'checked' : '' }}>
                                        <label class="form-check-label" for="item_{{ $loop->index }}"></label>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <button type="submit" class="btn btn-primary mt-3" id="submitButton" style="display: none;">Submit</button>
        </form>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        var checkboxes = document.querySelectorAll('.checklist-item');
        var eventId = "{{ $event->id }}";
        var checkboxStatus = JSON.parse(localStorage.getItem('checkboxStatus_' + eventId)) || {};
        var submitButton = document.getElementById('submitButton');
        var statusInput = document.getElementById('status');

        // Restore checkbox statuses from localStorage
        checkboxes.forEach(function(checkbox) {
            var itemId = checkbox.getAttribute('data-item-id');
            checkbox.checked = checkboxStatus[itemId] || false;

            // Update localStorage when a checkbox is changed
            checkbox.addEventListener('change', function() {
                var itemId = checkbox.getAttribute('data-item-id');
                checkboxStatus[itemId] = checkbox.checked;
                localStorage.setItem('checkboxStatus_' + eventId, JSON.stringify(checkboxStatus));
                toggleSubmitButton();
            });
        });

        // Calculate event status and toggle submit button visibility
        function toggleSubmitButton() {
            var allChecked = true;
            checkboxes.forEach(function(checkbox) {
                if (!checkbox.checked) {
                    allChecked = false;
                }
            });

            submitButton.style.display = allChecked ? 'block' : 'none';
            statusInput.value = allChecked ? 'rehearsal' : 'pending';
        }

        // Initial check to set the submit button visibility on page load
        toggleSubmitButton();
    });
</script>

@endsection
