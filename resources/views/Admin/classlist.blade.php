
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

.select2-search__field { width: 100% !important; }

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
									<h4>Class Management</h4>
								</div>
								<nav aria-label="breadcrumb" role="navigation">
									<ol class="breadcrumb">
										<li class="breadcrumb-item">
											<a href="/classlist">Home</a>
										</li>
										<li class="breadcrumb-item active" aria-current="page">
                                        Class Management
										</li>
									</ol>
								</nav>
							</div>
                            <div class="col-md-6 col-sm-12 text-right">
								<div class="dropdown">
									<a
										class="btn btn-primary create"
										href="#"

										role="button"
								
									>
										Add New Class
									</a>
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
							<h4 class="text-blue h4">Class List</h4>
							
						</div>
						<div class="pb-20">
							<table class="data-table table stripe hover nowrap">
								<thead>
									<tr>
                                        <th>#</th>
										<th class="table-plus">Teacher Name</th>
										<th>Subject</th>
                                        <th>Class</th>
                                        <th>Time In</th>
                                        <th>Time Out</th>
                                        <th>Last Update</th>
										<th class="datatable-nosort">Action</th>
									</tr>
								</thead>
								<tbody>
                                    @foreach($classes as $key => $class)
									<tr>
										<td class="table-plus">{{++$key}}</td>
										<td>{{ $class->GETTEACHER->fullname }}</td>
                                        <td>{{ $class->subject }}</td>
										<td>{{ $class->class }}</td>
                                        <td>{{ $class->time_in }}</td>
                                        <td>{{ $class->time_out }}</td>
                                        <td>{{ $class->updated_at }}</td>
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
													data-id="{{ $class->classid }}"
                                                    data-teacher="{{ $class->teacher }}"
                                                    data-subject="{{ $class->subject }}"
                                                    data-classes="{{ $class->class }}"
                                                    data-timein="{{ $class->time_in }}"
                                                    data-timeout="{{ $class->time_out }}"
														><i class="dw dw-eye"></i> View</a>

													<a class="dropdown-item edit" href="#"
													data-id="{{ $class->classid }}"
                                                    data-teacher="{{ $class->teacher }}"
                                                    data-subject="{{ $class->subject }}"
                                                    data-classes="{{ $class->class }}"
                                                    data-timein="{{ $class->time_in }}"
                                                    data-timeout="{{ $class->time_out }}"
														><i class="dw dw-edit2"></i> Edit</a
													> 

                                                    <a class="dropdown-item delete"  onclick="return confirm('Are you sure you want delete this Class?');" href="deleteclass/{{ $class->classid }}"
														><i class="dw dw-trash1"></i> Delete</a
													> 
                                       
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


		@include('Admin.Modal.classmodal')
		@include('Navigation.footer')
		<script>
	$(document).ready(function(){ 
        var dropdownParentEl = $('#bd-example-modal-lg > .modal-dialog > .modal-content');


$('#teacher').select2({
            dropdownParent: dropdownParentEl,
        width: '350px',

});





	$(".view").click(function () {
	var id = $(this).data('id');
	var teacher = $(this).data('teacher');
	var subject = $(this).data('subject');
	var classes = $(this).data('classes');
    var timein = $(this).data('timein');
    var timeout = $(this).data('timeout');

	$('#id').val(id);
	$('#type').val('V');
	$('#teacher').val(teacher).prop('disabled',true).trigger('change');
	$('#class').val(classes).prop('readonly',true);
	$('#subject').val(subject).prop('disabled',true);
    $('#time_in').val(timein).prop('readonly',true);
    $('#time_out').val(timeout).prop('readonly',true);
    
	$('.submitbtn').hide();

	$('.modal-title').html('View Class');

	$('.bs-example-modal-lg').modal('show');

});



$(".edit").click(function () {
	var id = $(this).data('id');
	var teacher = $(this).data('teacher');
	var subject = $(this).data('subject');
	var classes = $(this).data('classes');
    var timein = $(this).data('timein');
    var timeout = $(this).data('timeout');

	$('#id').val(id);
	$('#type').val('E');
	$('#teacher').val(teacher).prop('disabled',false).trigger('change');
	$('#class').val(classes).prop('readonly',false);
	$('#subject').val(subject).prop('disabled',false);
    $('#time_in').val(timein).prop('readonly',false);
    $('#time_out').val(timeout).prop('readonly',false);

	$('.submitbtn').show();
	$('.submitbtn').html('Save Changes');

	$('.modal-title').html('Edit Class');

	$('.bs-example-modal-lg').modal('show');

});

$(".create").click(function () {

	$('#id').val('');
	$('#type').val('C');
	$('#teacher').val('').prop('disabled',false).trigger('change');
	$('#class').val('').prop('readonly',false);
	$('#subject').val('').prop('disabled',false);
    $('#time_in').val('').prop('readonly',false);
    $('#time_out').val('').prop('readonly',false);

	$('.submitbtn').show();
	$('.submitbtn').html('Submit');

	$('.modal-title').html('Add New Class');

	$('.bs-example-modal-lg').modal('show');

});

});
		</script>