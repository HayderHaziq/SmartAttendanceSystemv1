<div class="modal fade bs-example-modal-lg" id="viewInfoModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">
                    Add New Student
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    ×
                </button>
            </div>
            <div class="modal-body">
                <form action="addstudent" method="POST" autocomplete="off" aria-autocomplete="off">
                    @csrf
                    <input type="hidden" name="type" id="type" value="C">
                    <input type="hidden" name="id" id="id">


                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label class="required">Student Name</label>
                                <input type="text" name="student_name" id="student_name" class="form-control" required />
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label class="required">Student ID</label>
                                <input type="text" name="student_id" id="student_id" class="form-control" required />
                            </div>
                        </div>

                    </div>
                    <div class="row">

                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label class="required">Class</label>
                                <select class="form-control" name="class_id" id="class_id" required>
                                    <option value="" selected disabled>-- Select Class --</option>
                                    @foreach($classes as $class)
                                    <option value="{{ $class->classid }}" name="{{ $class->fullname }}">{{ $class->class }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label class="required">Teacher</label>
                                <input type="text" name="teachers" id="teachers" class="form-control" required readonly/>
                            </div>
                        </div>
                    </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    Close
                </button>
                <button type="submit" class="btn btn-primary submitbtn">
                    Submit
                </button>
            </div>
            </form>
        </div>
    </div>
</div>