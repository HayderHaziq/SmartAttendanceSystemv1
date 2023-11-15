<!-- attendance-modal.blade.php -->

<div class="modal fade" id="attendanceModal" tabindex="-1" role="dialog" aria-labelledby="attendanceModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="attendanceModalLabel">Attendance Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Date</th>
                            <th>Time</th>
                            <th>Attendance</th>
                            <th>Action</th> <!-- New column for Edit button -->
                        </tr>
                    </thead>
                    <tbody id="attendanceTableBody">
                        <!-- Attendance rows will be added dynamically here -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
