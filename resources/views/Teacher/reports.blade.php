@include('Navigation.app')     

<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

<div class="main-container">
			<div class="pd-ltr-20 xs-pd-20-10">
            <form action="printAttendanceReport" method="POST">
                @csrf
			<center><h3>Submission Report of Student Attendance</h3>
            <br>    <br>
            <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <div class="form-group">
                                <label class="required">Select Attendance Date Range</label>
                                <input type="text" name="daterange" id="daterange" class="form-control" style="width:40%;" required />
                            </div>
                        </div>

                    </div>
                    <button type="submit" class="btn btn-primary submitbtn">
                    Generate Report
                </button>
            </center>
            <form>
			</div>
		</div>



@include('Navigation.footer')  
<script>
$(function() {
  $('#daterange').daterangepicker({
    opens: 'left'
  }, function(start, end, label) {
    console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
  });
});
</script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>       