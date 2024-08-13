<div class="col-lg-12" id="printEmailData"
	 style="padding:10px; background-color:#FFFFFF; font-family:Arial,Helvetica,sans-serif; font-size:12px; width:100%;">

	<div class="col-lg-12">
		<div id="logobranch">
			<img src="https://maquilingbuildersdepot.com/HRIMS/assets/top.png" style="width:100%;">
		</div>
		<center>
			<div class="mb-1 mt-1">
				<label style="font-size:14px; font-weight:bold;">Cost Breakdown</label>
			</div>
		</center>
		<div style="padding:0px 10px;">
			<table class="table table-bordered table-sm col-sm-6 print">
				<tbody>
					<tr>
						<td class="fw-bold">Job Order ID:</td>
						<td><label style="margin-left:10px;" id="display_JobOrderID">&nbsp;</label></td>
						<td class="fw-bold" style="font-weight:bold;">Driver:</td>
						<td><label style="margin-left:10px;" id="display_Driver">&nbsp;</label></td>
					</tr>
					<tr>
						<td class="fw-bold">Branch:</td>
						<td><label style="margin-left:10px;" id="display_Branch">&nbsp;</label></td>
						<td class="fw-bold">Brand:</td>
						<td><label style="margin-left:10px;" id="display_Brand">&nbsp;</label></td>
					</tr>
					<tr>
						<td class="fw-bold">Employee Name:</td>
						<td><label style="margin-left:10px;" id="display_Employee">&nbsp;</label></td>
						<td class="fw-bold">Model:</td>
						<td><label style="margin-left:10px;" id="display_Model">&nbsp;</label></td>
					</tr>
					<tr>
						<td class="fw-bold">Position:</td>
						<td><label style="margin-left:10px;" id="display_Position">&nbsp;</label></td>
						<td class="fw-bold">Year:</td>
						<td><label style="margin-left:10px;" id="display_Year">&nbsp;</label></td>
					</tr>
					<tr>
						<td rowspan="2" class="fw-bold">Overview:</td>
						<td rowspan="2">
							<div style="margin-left:10px;" id="display_Overview"></div>
						</td>
						<td class="fw-bold">Plate No.:</td>
						<td><label style="margin-left:10px;" id="display_PlateNo">&nbsp;</label></td>
					</tr>
					<tr>
						<td class="fw-bold">ODO:</td>
						<td><label style="margin-left:10px;" id="display_ODO">&nbsp;</label></td>
					</tr>
					<tr>
						<td class="fw-bold">Supplier:</td>
						<td><div id='supplier' style="margin-left:10px;"></div></td>
						<td class="fw-bold text-nowrap">Total Amount:</td>
						<td><div id='total_amount' style="margin-left:10px;"></div></td>
						<label class="d-none" id="job_order_id"></label>
            			<label class="d-none" id="datacount"></label>
					</tr>
				</tbody>
			</table>
		</div>
	</div>

	<div style="padding: 0 10px;">
		<div class="row">
			<div class="col-lg-6">
				<div class="text-center">
					<label class="fw-bold">Labor Cost</label>
				</div>
				<div class="quote1">
					<div>Quotation 1</div>
					<div id="table_laborcost_breakdown_quot1"></div>
				</div>
				<div class="quote2">
					<div>Quotation 2</div>
					<div id="table_laborcost_breakdown_quot2"></div>
				</div>
				<div class="quote3">
					<div>Quotation 3</div>
					<div id="table_laborcost_breakdown_quot3"></div>
				</div>
			</div>
			<div class="p-quot d-none"></div>
			<div class="col-lg-6">
				<div class="text-center">
					<label class="fw-bold">Material Cost</label>
				</div>
				<div class="quote1">
					<div>Quotation 1</div>
					<div id="table_materialcost_breakdown_quot1"></div>
				</div>
				<div class="quote2">
					<div>Quotation 2</div>
					<div id="table_materialcost_breakdown_quot2"></div>
				</div>
				<div class="quote3">
					<div>Quotation 3</div>
					<div id="table_materialcost_breakdown_quot3"></div>
				</div>
			</div>
		</div>
	</div>

	<div id="logobranch"><img src="https://maquilingbuildersdepot.com/HRIMS/assets/bottom.png" style="width: 100%" ;=""></div>

</div>