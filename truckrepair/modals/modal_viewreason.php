<div class="modal fade" id="ViewReason" data-bs-backdrop="static" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div id="logobranch">
                <img src="https://maquilingbuildersdepot.com/HRIMS/assets/top.png" style="width:100%;">
            </div>
            <div class="modal-body">
                <div class="row mb-2">
                    <div class="col-lg-12">
                        <b>Job Order ID:</b>
                        <input type="text" id="cancel_joid" name="cancel_joid" class="form-control" disabled>
                    </div>
                    <div class="col-lg-6">
                        <b>Employee Name:</b>
                        <input type="text" id="user_vname" name="user_vname" class="form-control" disabled>
                    </div>
                    <div class="col-lg-6">
                        <b>Branch:</b>
                        <input type="text" id="user_branch" name="user_branch" class="form-control" disabled>
                    </div>
                    <div class="col-lg-12">
                        <b>Position:</b>
                        <input type="text" id="user_position" name="user_position" class="form-control" disabled>
                    </div>
                </div>
                <b>Reason for Cancelling :</b><textarea type="text" id="cancel_reason" name="cancel_reason" rows="5" cols="auto" class="form-control" disabled></textarea><br>
            </div>
            <div class="modal-footer">
                <button type='button' class='btn btn-sm btn-danger' data-bs-dismiss='modal'>Close</button>
            </div>
        </div>
    </div>
</div>