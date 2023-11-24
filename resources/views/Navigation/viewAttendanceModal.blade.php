<!-- View Attendance Modal -->

<!-- File path = resources\views\Navigation\viewAttendanceModal.blade.php -->

<div class="modal fade" id="viewAttendanceModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">View Attendance</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Time</th>
                                <th>Date</th>
                                <th>Status</th>
                                <!-- Add a new header for the dropdown (optional) -->
                                <th>Change Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td id="attendance_time"></td>
                                <td id="attendance_date"></td>
                                <!-- Display the current status -->
                                <td id="attendance_status"></td>
                                <!-- Add a new cell for the dropdown -->
                                <td>
                                    <!-- Dropdown for changing status -->
                                    <select id="changeStatusDropdown">
                                        <option value="Present">Present</option>
                                        <option value="Absent">Absent</option>
                                    </select>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <!-- Add a new button to save the changed status -->
                <button type="button" class="btn btn-primary" id="saveStatusBtn">Save</button>
            </div>
        </div>
    </div>
</div>