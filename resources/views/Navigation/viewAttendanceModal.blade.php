<!-- View Attendance Modal -->

<!-- File path = resources\views\Navigation\viewAttendanceModal.blade.php -->

<!-- View Attendance Modal -->
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
                        <tbody id="attendanceRecordsBody">
                            <!-- Attendance records will be dynamically added here -->
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <!-- Keep the "Save" button -->
                <button type="button" class="btn btn-primary" id="saveStatusBtn">Save</button>
            </div>
        </div>
    </div>
</div>
