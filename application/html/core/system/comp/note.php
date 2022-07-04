<div class="card">
    <!-- <div class="card-header bg-secondary">
        <h3 class="text-white mb-0">Note</h3>
    </div> -->
    <div class="card-header bg-secondary">
        <h3 class=" text-white mb-0">Student note</h3>
        <a class="heading-elements-toggle text-white" data-toggle="modal" data-target="#modalNoteDialog">
            <i class="bx bx-pencil font-medium-3"></i>
        </a>
        <div class="heading-elements">
            <ul class="list-inline mb-0">
                <li>
                    <a data-action="#" class="text-white" data-toggle="modal" data-target="#modalNoteDialog">
                        <i class="bx bx-pencil"></i>
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive" style="max-height: 500px;">
            <table class="table table-striped table-sm- mb-0">
                <thead>
                    <tr>
                        <th style="width: 200px;" class="text-dark">Date - time</th>
                        <th class="text-dark">Note</th>
                    </tr>
                </thead>
                <tbody id="noteList">
                    <tr><td colspan="2">Note record found.</td></tr>
                </tbody>
            </table>
        </div>
    </div>
    
</div>

<div class="modal fade" id="modalNoteDialog" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-full modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" id="exampleModalCenterTitle">Create note</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i class="bx bx-x"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="d-none d-sm-block">
                    <div class="row">
                        <div class="col-12 col-sm-6">
                            <div class="form-group">
                                <label for="">Student ID : </label>
                                <input type="text" class="form-control" id="txtStudentId" readonly value="<?php echo $id; ?>">
                            </div>
                        </div>
                        <div class="col-12 col-sm-6">
                            <div class="form-group">
                                <label for="">Fullname : </label>
                                <input type="text" class="form-control" id="txtStudentFullname" readonly value="<?php echo $std_basic_info['FNAME']. " " . $std_basic_info['LNAME']; ?>">
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="">Note : <span class="text-danger">*</span></label>
                    <textarea name="txtNote" id="txtNote" cols="30" rows="5" class="form-control"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-secondary" data-dismiss="modal">
                    <i class="bx bx-x d-block d-sm-none"></i>
                    <span class="d-none d-sm-block">Close</span>
                </button>
                <button type="button" class="btn btn-primary ml-1"  onclick="student.save_note()">
                    <i class="bx bx-check d-block d-sm-none"></i>
                    <span class="d-none d-sm-block">Save</span>
                </button>
            </div>
        </div>
    </div>
</div>