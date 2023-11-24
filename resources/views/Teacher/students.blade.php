@include('Navigation.app')
<meta name="csrf-token" content="{{ csrf_token() }}">


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
									<h4>Student List</h4>
								</div>
								<nav aria-label="breadcrumb" role="navigation">
									<ol class="breadcrumb">
										<li class="breadcrumb-item">
											<a href="/studentlist">Home</a>
										</li>
										<li class="breadcrumb-item active" aria-current="page">
                                        Student List
										</li>
									</ol>
								</nav>
							</div>
                            <div class="col-md-6 col-sm-12 text-right">
								<div class="dropdown">
							
								</div>
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
							<h4 class="text-blue h4">Student List</h4>
							
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
                                        <td>{{ $student->GETCLASS->class }}</td>
										<td>{{ $student->updated_at }}</td>
										<td>
											<div class="dropdown">
												<a
													class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle"
													href="#"
													role="button"
													data-toggle="dropdown"
												>
													<i class="dw dw-more"></i>
												</a>
												<div
													class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list"
												>
												<a class="dropdown-item view_info" 
												href="#"
												data-id="{{ $student->id }}"
                                                data-studentname="{{ $student->student_name }}"
                                                data-studentid="{{ $student->student_id }}"
                                                data-classes="{{ $student->class_id }}"
												><i class="dw dw-eye"></i> View Info</a>

												<a class="dropdown-item attendance" 
												href="#"
												data-id="{{ $justIds[$key] }}"
												data-studentname="{{ $student->student_name }}"
												data-studentid="{{ $student->student_id }}"
												data-classes="{{ $student->class_id }}"
												><i class="dw dw-user"></i> View Attendance</a>
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


		@include('Navigation.info')
		@include('Navigation.footer')
        @include('Navigation.viewAttendanceModal')


<script>
$(document).ready(function () {
    $('.select2').select2({
        dropdownParent: $('body')
    });

    $('#class_id').on('change', function () {
        var teacher = $(this).find('option:selected').attr("name");
        $('#teachers').val(teacher);
    });

    $(".view_info").click(function () {
        var id = $(this).data('id');
        var studentname = $(this).data('studentname');
        var studentid = $(this).data('studentid');
        var classes = $(this).data('classes');

        $('#id').val(id);
        $('#type').val('V');
        $('#student_name').val(studentname).prop('readonly', true);
        $('#student_id').val(studentid).prop('readonly', true);
        $('#class_id').val(classes).prop('disabled', true).trigger('change');

        $('.submitbtn').hide();

        $('.modal-title').html('View Student');

        $('#viewInfoModal').modal('show');
    });

    $(".attendance").click(function () {
        var studentId = $(this).data('id');
        console.log('Clicked button for student ID:', studentId);

        $.ajax({
            url: '/attendance/' + studentId,
            method: 'GET',
            dataType: 'json',
            success: function (attendanceData) {
                console.log('Attendance Data:', attendanceData);
                if (attendanceData && attendanceData.attendance) {
                    var data = attendanceData.attendance;
                    $('#attendance_time').text(data.time);
                    $('#attendance_date').text(data.date);
                    $('#attendance_status').text(data.status);

                    // Show the modal
                    $('#viewAttendanceModal').modal('show');

                    // Event listener for the "Save" button within the modal
                    $("#saveStatusBtn").off('click').on('click', function () {
                        var newStatus = $('#changeStatusDropdown').val();

                        // Show a confirmation dialog
                        if (confirm('Are you sure you want to update the status to ' + newStatus + '?')) {
                            // Call the function to save the attendance status
                            saveAttendanceStatus(studentId, newStatus);
                        }
                    });

                } else {
                    $('#attendance_time').text('');
                    $('#attendance_date').text('');
                    $('#attendance_status').text('No attendance data available.');
                    $('#viewAttendanceModal').modal('show');
                }
            },
            error: function (xhr, status, error) {
                console.error('Error fetching attendance data:', error);
                $('#attendance_time').text('');
                $('#attendance_date').text('');
                $('#attendance_status').text('Error fetching attendance data.');
                $('#viewAttendanceModal').modal('show');
            }
        });
    });

    function saveAttendanceStatus(studentId, newStatus) {
        var csrfToken = $('meta[name="csrf-token"]').attr('content');  // Get the CSRF token from the meta tag

        $.ajax({
            url: '/update-attendance-status/' + studentId,
            method: 'POST',
            data: {
                status: newStatus,
                _token: csrfToken  // Include the CSRF token in the data
            },
            success: function (response) {
                console.log(response);  // Log the response for debugging

                // Check if the response contains a 'message' key
                if (response && response.message) {
                    alert('Status updated successfully: ' + response.message);
                } else {
                    alert('Status update failed. Please try again.');
                }

                // You can also update the UI or perform additional actions based on the response
            },
            error: function (error) {
                console.error(error);  // Log the error for debugging

                // Display an error message to the user
                alert('An error occurred while updating the status. Please try again.');

                // You can handle errors based on the specific error response from the server
            }
        });
    }
});

</script>