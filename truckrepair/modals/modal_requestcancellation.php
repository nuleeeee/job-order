<div class="modal fade" id="RequestCancellation" data-bs-backdrop="static" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div id="logobranch">
                <img src="https://maquilingbuildersdepot.com/HRIMS/assets/top.png" style="width:100%;">
            </div>
            <div class="modal-body">
                <div class="row mb-2 p-3">
                    <table class="table table-bordered table-sm col-sm-6" style="font-size:12px;">
                        <tbody>
                            <tr>
                                <td class="fw-bold">Job Order ID:</td>
                                <td colspan="3"><label style="margin-left:10px;" id="request_cancel_JobOrderID">&nbsp;</label></td>
                            </tr>
                            <tr>
                                <td class="fw-bold">Branch:</td>
                                <td><label style="margin-left:10px;" id="request_cancel_Branch">&nbsp;</label></td>
                                <td class="fw-bold">Brand:</td>
                                <td><label style="margin-left:10px;" id="request_cancel_Brand">&nbsp;</label></td>
                            </tr>
                            <tr>
                                <td class="fw-bold">Employee Name:</td>
                                <td><label style="margin-left:10px;" id="request_cancel_Employee">&nbsp;</label></td>
                                <td class="fw-bold">Model:</td>
                                <td><label style="margin-left:10px;" id="request_cancel_Model">&nbsp;</label></td>
                            </tr>
                            <tr>
                                <td class="fw-bold">Position:</td>
                                <td><label style="margin-left:10px;" id="request_cancel_Position">&nbsp;</label></td>
                                <td class="fw-bold">Year:</td>
                                <td><label style="margin-left:10px;" id="request_cancel_Year">&nbsp;</label></td>
                            </tr>
                            <tr>
                                <td rowspan="2" class="fw-bold">Overview:</td>
                                <td rowspan="2">
                                    <div style="margin-left:10px;" id="request_cancel_Overview"></div>
                                </td>
                                <td class="fw-bold">Plate No.:</td>
                                <td><label style="margin-left:10px;" id="request_cancel_PlateNo">&nbsp;</label></td>
                            </tr>
                            <tr>
                                <td class="fw-bold">ODO:</td>
                                <td><label style="margin-left:10px;" id="request_cancel_ODO">&nbsp;</label></td>
                            </tr>
                            <tr>
                                <td class="fw-bold">Supplier:</td>
                                <td><div id='request_cancel_supplier' style="margin-left:10px;"></div></td>
                                <td class="fw-bold text-nowrap">Total Amount:</td>
                                <td><div id='request_cancel_total_amount' style="margin-left:10px;"></div></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <b>Reason for Cancelling :</b><textarea type="text" id="request_cancel_reason" name="request_cancel_reason" rows="5" cols="auto" class="form-control"></textarea><br>
            </div>
            <div class="modal-footer">
                <button type='button' class='btn btn-sm btn-secondary' data-bs-dismiss='modal'>Close</button>
                <button type='button' class='btn btn-sm btn-danger' onclick="submitCancellationRequest()">Submit</button>
            </div>
        </div>
    </div>
</div>