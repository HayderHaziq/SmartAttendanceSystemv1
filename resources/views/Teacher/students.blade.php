
@include('Navigation.app')
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
													<a class="dropdown-item view" 
													href="#"
													data-id="{{ $student->id }}"
                                                    data-studentname="{{ $student->student_name }}"
                                                    data-studentid="{{ $student->student_id }}"
                                                    data-classes="{{ $student->class_id }}"
														><i class="dw dw-eye"></i> View</a>

                                                        <a class="dropdown-item" 
													href="#"
													data-id="{{ $student->id }}"
                                                    data-studentname="{{ $student->student_name }}"
                                                    data-studentid="{{ $student->student_id }}"
                                                    data-classes="{{ $student->class_id }}"
														><i class="dw dw-user"></i> Attendance</a>

												
                                       
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
		<script>
	$(document).ready(function(){ 
        var dropdownParentEl = $('#bd-example-modal-lg > .modal-dialog > .modal-content');


$('#class_id').select2({
            dropdownParent: dropdownParentEl,
        width: '350px',

});

$('#class_id').change(function() {

var teacher = $(this).find('option:selected').attr("name");

$('#teachers').val(teacher);

});



	$(".view").click(function () {
	var id = $(this).data('id');
	var studentname = $(this).data('studentname');
	var studentid = $(this).data('studentid');
	var classes = $(this).data('classes');

	$('#id').val(id);
	$('#type').val('V');
	$('#student_name').val(studentname).prop('readonly',true);
	$('#student_id').val(studentid).prop('readonly',true);
	$('#class_id').val(classes).prop('disabled',true).trigger('change');
    
	$('.submitbtn').hide();

	$('.modal-title').html('View Student');

	$('.bs-example-modal-lg').modal('show');

});




});
		</script>