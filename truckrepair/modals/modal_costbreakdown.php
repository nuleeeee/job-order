<div class="col-lg-12" id="printarea_breakdown"
	 style="padding:10px; background-color:#FFFFFF; font-family:Arial,Helvetica,sans-serif; font-size:12px; width:100%;">

	<div class="col-lg-12" style="width:100%;">
		<div id="logobranch">
			<img src="https://maquilingbuildersdepot.com/HRIMS/assets/top.png" style="width:100%;">
		</div>
		<center>
			<div class="mb-1 mt-1" style="margin-bottom:10px; margin-top:10px;">
				<label style="font-size:14px; font-weight:bold;">Cost Breakdown</label>
			</div>
		</center>
		<div style="padding:0px 10px;">
			<table class="table table-bordered table-sm col-lg-6 print" style="border: 1px solid #dee2e6; width: 100%; 
	  margin-bottom: 1rem; border-collapse: collapse; font-size: 12px;">
				<tbody>
					<tr>
						<td class="fw-bold" style="font-weight:bold;">Job Order ID:</td>
						<td><label style="margin-left:10px;" id="display_JobOrderID">&nbsp;</label></td>
						<td class="fw-bold" style="font-weight:bold;">Driver:</td>
						<td><label style="margin-left:10px;" id="display_Driver">&nbsp;</label></td>
					</tr>
					<tr>
						<td class="fw-bold" style="font-weight:bold;">Branch:</td>
						<td><label style="margin-left:10px;" id="display_Branch">&nbsp;</label></td>
						<td class="fw-bold" style="font-weight:bold;">Brand:</td>
						<td><label style="margin-left:10px;" id="display_Brand">&nbsp;</label></td>
					</tr>
					<tr>
						<td class="fw-bold" style="font-weight:bold;">Employee Name:</td>
						<td><label style="margin-left:10px;" id="display_Employee">&nbsp;</label></td>
						<td class="fw-bold" style="font-weight:bold;">Model:</td>
						<td><label style="margin-left:10px;" id="display_Model">&nbsp;</label></td>
					</tr>
					<tr>
						<td class="fw-bold" style="font-weight:bold;">Position:</td>
						<td><label style="margin-left:10px;" id="display_Position">&nbsp;</label></td>
						<td class="fw-bold" style="font-weight:bold;">Year:</td>
						<td><label style="margin-left:10px;" id="display_Year">&nbsp;</label></td>
					</tr>
					<tr>
						<td class="fw-bold" style="font-weight:bold;">Type Category:</td>
						<td><div style="margin-left:10px;" id="display_Category"></div></td>
						<td class="fw-bold" style="font-weight:bold;">Plate No.:</td>
						<td><label style="margin-left:10px;" id="display_PlateNo">&nbsp;</label></td>
					</tr>
					<tr>
						<td class="fw-bold" style="font-weight:bold;">Overview:</td>
						<td><div style="margin-left:10px;" id="display_Overview"></div></td>
						<td class="fw-bold" style="font-weight:bold;">ODO:</td>
						<td><label style="margin-left:10px;" id="display_ODO">&nbsp;</label></td>
					</tr>
					<tr>
						<td class="fw-bold" style="font-weight:bold;">Supplier:</td>
						<td><div id='supplier' style="margin-left:10px;"></div></td>
						<td class="fw-bold text-nowrap" style="font-weight:bold; white-space:nowrap;">Total Amount:</td>
						<td><div id='total_amount' style="margin-left:10px;"></div></td>
						<label class="d-none" id="job_order_id"></label>
            			<label class="d-none" id="datacount"></label>
					</tr>
					<tr class="approverandfunds">
						<td class="fw-bold" style="font-weight:bold;">Approver:</td>
						<td><label style="margin-left:10px;" id="display_Approver">&nbsp;</label></td>
						<td class="fw-bold" style="font-weight:bold;">Mode of Funds:</td>
						<td><label style="margin-left:10px;" id="display_ModeFunds">&nbsp;</label></td>
					</tr>
					<tr class="financialaidname d-none">
						<td class="fw-bold" style="font-weight:bold;">Financial Aid Recipient:</td>
						<td colspan="4"><label style="margin-left:10px;" id="display_Recipient">&nbsp;</label></td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>

	<div style="padding: 0 10px; font-size: 12px;">
		<div class="row" style="display: flex; flex-wrap: wrap;">
			<div class="col-lg-12" style="width: 100%;">
				<div class="quote1">
					<div style="color:red;">Quotation 1 (Labor Cost)</div>
					<div id="table_laborcost_breakdown_quot1"></div>
				</div>
				<div class="quote1">
					<div style="color:red;">Quotation 1 (Material Cost)</div>
					<div id="table_materialcost_breakdown_quot1"></div>
				</div>
				<div class="quote2">
					<div style="color:red;">Quotation 2 (Labor Cost)</div>
					<div id="table_laborcost_breakdown_quot2"></div>
				</div>
				<div class="quote2">
					<div style="color:red;">Quotation 2 (Material Cost)</div>
					<div id="table_materialcost_breakdown_quot2"></div>
				</div>
				<div class="quote3">
					<div style="color:red;">Quotation 3 (Labor Cost)</div>
					<div id="table_laborcost_breakdown_quot3"></div>
				</div>
				<div class="quote3">
					<div style="color:red;">Quotation 3 (Material Cost)</div>
					<div id="table_materialcost_breakdown_quot3"></div>
				</div>
			</div>
		</div>
	</div>

	<div id="logobranch" class="d-none"><img src="https://maquilingbuildersdepot.com/HRIMS/assets/bottom.png" style="width: 100%" ;=""></div>

</div>