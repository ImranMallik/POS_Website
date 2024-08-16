<style>
    .radio-group {
        display: flex;
        align-items: center;
        gap: 20px;
        padding: 10px;
        background-color: #f9f9f9;
        border: 1px solid #e0e0e0;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .radio-group label {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 15px;
        cursor: pointer;
        padding: 8px 12px;
        border-radius: 5px;
        transition: background-color 0.3s, color 0.3s;
        border: 1px solid #ddd;
    }

    .radio-group input[type="radio"] {
        margin-right: 5px;
    }

    .radio-group label:hover {
        background-color: #e6f7ff;
        border-color: #b3d8ff;
    }

    .radio-group input[type="radio"]:checked+span {
        font-weight: bold;
        color: #007bff;
    }

    .submit-btn {
        background-color: #28a745;
        color: #fff;
        border: none;
        padding: 8px 12px;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s, transform 0.3s;
    }

    .submit-btn:hover {
        background-color: #218838;
        transform: translateY(-2px);
    }

    .submit-btn:focus {
        outline: none;
        box-shadow: 0 0 0 3px rgba(40, 167, 69, 0.5);
    }

    .submit-btn i {
        margin-right: 5px;
    }
</style>

<div class="radio-group" data-employee-id="{{ $employee->id }}">
    <label>
        <input type="radio" name="attend_status[{{ $employee->id }}]" value="present"
            {{ $employee->status == 'present' ? 'checked' : '' }}>
        <span>Present</span>
    </label>
    <label>
        <input type="radio" name="attend_status[{{ $employee->id }}]" value="leave"
            {{ $employee->status == 'leave' ? 'checked' : '' }}>
        <span>Leave</span>
    </label>
    <label>
        <input type="radio" name="attend_status[{{ $employee->id }}]" value="absent"
            {{ $employee->status == 'absent' ? 'checked' : '' }}>
        <span>Absent</span>
    </label>
    <!-- Submit Button -->
    <button type="button" class="btn btn-primary submit-btn" data-employee-id="{{ $employee->id }}">
        <i class="fas fa-check"></i> Submit
    </button>
</div>
