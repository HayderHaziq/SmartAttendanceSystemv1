<div class="modal fade bs-example-modal-lg" id="bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">
                    Add New Class
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    ×
                </button>
            </div>
            <div class="modal-body">
                <form action="addclass" method="POST" autocomplete="off" aria-autocomplete="off">
                    @csrf
                    <input type="hidden" name="type" id="type" value="C">
                    <input type="hidden" name="id" id="id">


                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label class="required">Teacher</label>
                                <select class="form-control" name="teacher" id="teacher" required>
                                    <option value="" selected disabled>-- Select Teacher --</option>
                                    @foreach($teachers as $teacher)
                                    <option value="{{ $teacher->id }}">{{ $teacher->fullname }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label class="required">Class</label>
                                <input type="text" name="class" id="class" class="form-control" required />
                            </div>
                        </div>

                    </div>

                    <div class="row">
                    <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label class="required">Subject</label>
                                <input type="text" name="subject" id="subject" class="form-control" required />
                            </div>
                        </div>
                        </div>

                    <div class="row">

                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label class="required">Time In</label>
                                <input type="time" name="time_in" id="time_in" class="form-control" required/>
                            </div>
                        </div>

                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label class="required">Time Out</label>
                                <input type="time" name="time_out" id="time_out" class="form-control" required/>
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