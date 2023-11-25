
@include('Navigation.app')

{{-- path = C:\laragon\www\SmartAttendanceSystemv1\resources\views\Admin\reports.blade.php --}}


<style>
    


.select2-selection__rendered {
    line-height: 50px !important;
  }

  .select2-container .select2-selection--single {
    height: 50px !important;
  }

  .select2-default {
color: #999 !important;
width: auto !important;
}

.select2-search__field {
	 width: 100% !important; 
}

  .select2-selection__arrow {
    height: 50px !important;
  }

  .select2-container--default .select2-selection--multiple .select2-selection__choice {
    background-color: blue !important;
    border-color: white !important;
}
.select2-container .select2-selection--single .select2-selection__rendered {
   z-index:1;
}

</style>

		<div class="main-container">
			<div class="pd-ltr-20 xs-pd-20-10">
				<div class="min-height-200px">
					<div class="page-header">
						<div class="row">
							<div class="col-md-6 col-sm-12">
								<div class="title">
									<h4>Reports</h4>
								</div>
								<nav aria-label="breadcrumb" role="navigation">
									<ol class="breadcrumb">
										<li class="breadcrumb-item">
											<a href="/studentlist">Home</a>
										</li>
										<li class="breadcrumb-item active" aria-current="page">
                                            Reports
										</li>
									</ol>
								</nav>
							</div>
						</div>
					</div>

					@if($message = Session::get('error'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
<strong>Whoops !</strong> {{ session()->get('error') }}
    
</div>
@endif

@if($message = Session::get('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
<strong>Success !</strong> {{ session()->get('success') }}
</div>
@endif
					<!-- Simple Datatable start -->
					<div class="card-box mb-30">
						<div class="pd-20">
							<h4 class="text-blue h4">View Student Attendance</h4>
							
						</div>
						<div class="pb-20">
							<table class="data-table table stripe hover nowrap">
								<thead>
									<tr>
                                        <th>#</th>
										<th class="table-plus">Student Name</th>
										<th>Student ID</th>
                                        <th>Class</th>
										<th>Last Update</th>
										<th class="datatable-nosort">Action</th>
									</tr>
								</thead>
								<tbody>
                                    @foreach($students as $key => $student)
									<tr>
										<td class="table-plus">{{++$key}}</td>
										<td>{{ $student->student_name }}</td>
                                        <td>{{ $student->student_id }}</td>
										<td>
											@if($student->GETCLASS)
												{{ $student->GETCLASS->class }}
											@else
												Class is not available anymore
											@endif
										</td>
										<td>{{ $student->updated_at }}</td>
										<td>
                                            <div class="dropdown">
                                                <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                                                    <i class="dw dw-more"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                                    <a class="dropdown-item view_attendance" href="#" data-id="{{ $student->id }}">
                                                        <i class="dw dw-user"></i> View Attendance
                                                    </a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
								</tbody>
							</table>
						</div>
					</div>
					<!-- Simple Datatable End -->
				
				
				</div>
			</div>
		</div>


		@include('Admin.Modal.studentmodal')
		@include('Navigation.footer')
        @include('Navigation.viewAttendanceModal')

        <script>
            $(".view_attendance").click(function () {
                var studentId = $(this).data('id');
                console.log('Clicked button for student ID:', studentId);
            
                $.ajax({
                    url: '/attendance/' + studentId,
                    method: 'GET',
                    dataType: 'json',
                    success: function (attendanceData) {
                        console.log('Attendance Data:', attendanceData);
            
                        if (attendanceData && attendanceData.data && attendanceData.data.length > 0) {
                            var records = attendanceData.data;
            
                            // Clear previous content in the modal body
                            $('#attendanceRecordsBody').empty();
            
                            // Populate modal body with attendance records
                            records.forEach(function (record) {
                                var row = '<tr>' +
                                    '<td>' + record.time + '</td>' +
                                    '<td>' + record.date + '</td>' +
                                    '<td>' + record.status + '</td>' +
                                    '<td>' +
                                    '<select class="changeStatusDropdown">' +
                                    '<option value="Present">Present</option>' +
                                    '<option value="Absent">Absent</option>' +
                                    '</select>' +
                                    '</td>' +
                                    '</tr>';
            
                                $('#attendanceRecordsBody').append(row);
                            });
            
                            // Show the modal
                            $('#viewAttendanceModal').modal('show');
            
                            // Event listener for the "Save" button within the modal
                            $("#saveStatusBtn").off('click').on('click', function () {
                                var newStatus = $('#attendanceRecordsBody .changeStatusDropdown').val();
            
                                // Show a confirmation dialog
                                if (confirm('Are you sure you want to update the status to ' + newStatus + '?')) {
                                    // Call the function to save the attendance status for each record
                                    records.forEach(function (record) {
                                        saveAttendanceStatus(record.id, newStatus);
                                    });
                                }
                            });
                        } else {
                            $('#attendanceRecordsBody').html('<tr><td colspan="4">No attendance data available.</td></tr>');
                            $('#viewAttendanceModal').modal('show');
                        }
                    },
                    error: function (xhr, status, error) {
                        console.error('Error fetching attendance data:', error);
                        $('#attendanceRecordsBody').html('<tr><td colspan="4">Error fetching attendance data.</td></tr>');
                        $('#viewAttendanceModal').modal('show');
                    }
                });
            });
            </script>
            