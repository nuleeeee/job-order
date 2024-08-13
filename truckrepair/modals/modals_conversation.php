<!-- OPEN TICKET DETAILS MODAL -->
<div class="modal fade" id="ModalConvo" tabindex="-1" role="dialog" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
        	<img src="https://maquilingbuildersdepot.com/HRIMS/assets/top.png" style="width:100%; max-height: 80px; border-radius: 5px 5px 0 0;">
            <div class="modal-header">
            	<h5 class="modal-title">#</h5>
            	<h5 class="modal-title fw-bold me-2" id="JobOrderID"></h5>
                <h5 class="modal-title fw-bold me-2">•</h5>
                <h5 class="modal-title fw-bold" id="JobOrderCategory"></h5>
                <button type="button" class="btn btn-close btn-close-convo" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            	<div class="row">
	            	<div id="ConvoData" class="col-lg-8 border-2 border-end" style="height: 300px; overflow: auto;">

	            	</div>
	            	<div id="ConvoAttachment" class="col-lg-4" style="height: 300px; overflow: auto;">

	            	</div>
            	</div>
            </div>
            <div class="modal-footer">
               	<div class="row w-100">
	            	<div class="col-lg-12">
		               	<textarea class="form-control" id="convo_message" rows="2" placeholder="Type your message..."></textarea>
	               	</div>
	               	<div class="d-flex justify-content-between mt-1">
	               		<div>
	           				<input type="file" id="msg_files" class="form-control form-control-sm ml-auto" accept=".jpeg, .jpg, .png, .gif" multiple> <i style="font-size:11px; color:gray;">Strictly images only. <b>CTRL+Click</b> for multiple selections.</i>
	           			</div>
	           			<div>
		            		<button type="button" class="btn btn-md mt-2 custom-btn text-nowrap" id="send_convo">
		            			Send <img src="assets/icons/send.png" height="20">
		            		</button>
		            	</div>
	                </div>
                </div>
            </div>
        </div>
    </div>
</div>



<!-- ADDING ATTACHMENTS POPUP -->
<div class="modal fade" id="modal_add_attachments" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<img src="https://maquilingbuildersdepot.com/HRIMS/assets/top.png" style="width:100%; border-radius: 5px 5px 0 0;">
			<div class="modal-body text-center">
				<img src="assets/icons/images.png" height="40">
				<input type="file" id="addFiles" class="form-control mt-2" accept=".jpeg, .jpg, .png, .gif" multiple>
				<i class="text-secondary">NOTE: Only accepts .jpeg, .jpg, .png, .gif file formats (images specifically). <b>CTRL + CLICK</b> for multiple selections.</i>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
				<button type="button" class="btn btn-sm custom-btn" id="uploadNewFiles">Upload</button>
			</div>
		</div>
	</div>
</div>