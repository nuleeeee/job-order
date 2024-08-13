<form>
	<div class="p-5 mt-5">
		<div class="shadow-sm mb-5">
			<div class="row">
				<!-- Left Container -->
				<div class="col-sm-6 bg-light p-3 border left-container">
					<div class="mt-2">
						<h4 class="text-nowrap">CREATE JOB ORDER</h4>
					</div>

					<div class="type_info">
						<div class="row mt-3">
						    <div class="col">
						      	<label class="d-flex align-items-center">Type of Job Order<hr class="flex-grow-1 mx-1"></label>
						    </div>
						</div>

						<div class="row mt-3">
							<div class="col-sm-4">
								<label>Type</label><br>
								<select id="type_selection" class="form-select pointer" onchange="selectType();">

								</select>
							</div>
						</div>
					</div>

					<div class="user_info">
						<div class="row mt-3">
						    <div class="col">
						      	<label class="d-flex align-items-center">Requested By<hr class="flex-grow-1 mx-1"></label>
						    </div>
						</div>

						<div class="row mt-3">
							<div class="col-sm-4">
								<label>Branch</label><br>
								<input type="text" id="branch_selection" class="form-select pointer" readonly>
								<input type="hidden" id="branch_id">
							</div>
							<div class="col-sm-4">
								<label class="text-nowrap">Employee Name</label><br>
								<input type="text" id="employeename_selection" class="form-select pointer" readonly>
								<input type="hidden" id="employeename_id">
							</div>
							<div class="col-sm-4">
								<label>Position</label><br>
								<input type="text" id="label_position" class="form-control pointer" data-bs-toggle="tooltip" data-bs-placement="bottom" readonly>
							</div>
						</div>
					</div>

					<div class="transportation d-none">
						<div class="row mt-3">
						    <div class="col">
						      	<label class="d-flex align-items-center">Transportation<hr class="flex-grow-1 mx-1"></label>
						    </div>
						</div>

						<div class="row mt-3">
							<div class="col-sm-4">
								<label>Driver Name</label><br>
								<input type="text" id="drivername" name="drivername" class="form-control">
							</div>
							<div class="col-sm-4">
								<label>Plate Number</label><br>
								<input type="text" id="driverplatenum" name="driverplatenum" class="form-control">
							</div>
						</div>
					</div>

					<div class="vehicle_info d-none">
						<div class="row mt-3">
						    <div class="col">
						      	<label class="d-flex align-items-center">Vehicle Information<hr class="flex-grow-1 mx-1"></label>
						    </div>
						</div>

						<div class="row mt-3">
							<div class="col-sm-4">
								<label>Brand</label><br>
								<select id="vehicle_brand" class="form-select" onchange="getVehicleModel();">

								</select>
							</div>
							<div class="col-sm-4">
								<label>Model</label><br>
								<select id="vehicle_model" class="form-select" onchange="getPlateNo(this)">

								</select>
							</div>
							<div class="col-sm-4">
								<label>Year</label><br>
								<input type="text" id="label_year" name="label_year" class="form-control">
								<i class="errormsg text-danger"></i>
							</div>
						</div>

						<div class="row mt-3">
							<div class="col-sm-4">
								<label>Plate No.</label><br>
								<select id="vehicle_platenum" class="form-select">

								</select>
							</div>
							<div class="col-sm-4">
								<label>ODO</label><br>
								<input type="text" id="label_odo" name="label_odo" class="form-control">
							</div>
							<div class="col-sm-4"></div>
						</div>
					</div>

					<div class="fuel_info d-none">
						<div class="row mt-3">
						    <div class="col">
						      	<label class="d-flex align-items-center">Fuel Information<hr class="flex-grow-1 mx-1"></label>
						    </div>
						</div>

						<div class="row mt-3">
							<div class="col-sm-4">
								<label>Type</label><br>
								<select id="fuel_type" class="form-select" onchange="getFuelInfo();">
									<option value="" selected>Please Select</option>
									<option value="Genset">Genset</option>
									<option value="Truck">Truck</option>
								</select>
							</div>
							<div class="col-sm-4 truck-plate-num d-none">
								<label>Plate Number</label><br>
								<input type="text" id="truck_platenum" class="form-control">
							</div>
						</div>
					</div>

					<div class="financial_aid d-none">
						<div class="row mt-3">
						    <div class="col">
						      	<label class="d-flex align-items-center">Financial Aid<hr class="flex-grow-1 mx-1"></label>
						    </div>
						</div>

						<div class="row mt-3">
							<div class="col-sm-4">
								<label>Select Employee</label><br>
								<select id="personforfinancialaid" class="form-select" onchange="getAidee()" style="width: 100%; padding: 10px 0;">

								</select>
							</div>
							<div class="col-sm-4">
								<label>Position</label><br>
								<input type="text" id="aidee_position" class="form-control" readonly data-bs-toggle="tooltip" data-bs-placement="bottom">
							</div>
							<div class="col-sm-4">
								<label>Supplier</label><br>
								<input type="text" id="aidee_supplier" class="form-control" readonly>
							</div>
						</div>
					</div>

					<div class="general_overview">
						<div class="row mt-3">
						    <div class="col">
						      	<label class="d-flex align-items-center">General Overview of Works<hr class="flex-grow-1 mx-1"></label>
						    </div>
						</div>

						<div class="row mt-3">
							<div class="col">
								<label>Overview</label><br>
								<textarea id="text_overview" class="form-control"></textarea>
							</div>
						</div>
					</div>
				</div>

				<!-- Right Container -->
				<div class="col-sm-6 bg-light p-3 border right-container">
					<div class="row mt-3">
					    <div class="col">
					      	<label class="d-flex align-items-center">Job Order Request<hr class="flex-grow-1 mx-1"></label>
					    </div>
					</div>

					<div class="row mt-3">
						<div class="col-sm-4">
							<label>Set Number of Canvass</label><br>
							<select id="selection_canvassnum" class="form-select" onchange="clearSupplier()">
								<option value="1" selected>1</option>
								<option value="2">2</option>
								<option value="3">3</option>
							</select>
						</div>
						<div class="col-sm-4"></div>
						<div class="col-sm-4"></div>
					</div>

					<ul class="nav nav-tabs mt-3" id="myTab">
						<li class="nav-item">
						    <button class="nav-link active" id="input_supplier1" data-bs-toggle="tab" data-bs-target="#supplier1" type="button" role="tab" aria-controls="supplier1" aria-selected="true">Supplier 1</button>
					  	</li>
					  	<li class="nav-item">
					    	<button class="nav-link" id="input_supplier2" data-bs-toggle="tab" data-bs-target="#supplier2" type="button" role="tab" aria-controls="supplier2" aria-selected="false">Supplier 2</button>
					  	</li>
					  	<li class="nav-item">
					    	<button class="nav-link" id="input_supplier3" data-bs-toggle="tab" data-bs-target="#supplier3" type="button" role="tab" aria-controls="supplier3" aria-selected="false">Supplier 3</button>
					  	</li>
					</ul>

					<div class="tab-content" id="myTabContent">
					  	<div class="tab-pane fade show active text-dark" id="supplier1" role="tabpanel" aria-labelledby="input_supplier1">
			                <div class="mt-3" id="laborcost_table1">

			                </div>
			                <hr>
			                <div class="mt-3" id="materialcost_table1">

			                </div>
					  	</div>

					  	<div class="tab-pane fade text-dark" id="supplier2" role="tabpanel" aria-labelledby="input_supplier2">
					  		<div class="mt-3" id="laborcost_table2">

			                </div>
			                <hr>
			                <div class="mt-3" id="materialcost_table2">

			                </div>
					  	</div>

					  	<div class="tab-pane fade text-dark" id="supplier3" role="tabpanel" aria-labelledby="input_supplier3">
					  		<div class="mt-3" id="laborcost_table3">

			                </div>
			                <hr>
			                <div class="mt-3" id="materialcost_table3">

			                </div>
					  	</div>
					</div>
					<hr>
					<div class="row d-flex justify-content-end">
						<div class="col-sm-2">
							<button type="button" class="btn btn-secondary btn-sm custom-btn text-nowrap mt-1 w-100" id="create_btn" onclick="checkInputs()">
								Create
							</button>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="shadow-sm">
			<div class="row">
				<!-- Bottom Container -->
				<div class="bg-light p-3 border right-container">
					<div class="d-flex justify-content-between">
						<div class="mt-2">
							<h4 class="text-nowrap">JOB ORDER HISTORY</h4>
						</div>
						<div class="mt-2">
							<button class="btn btn-sm btn-secondary custom-btn" id="export_history">Export Excel</button>
						</div>
					</div>
					<hr>

					<div class="mt-3 table-responsive">
					    <!-- DATATABLE -->
						<div id="job-order-history"></div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class='modal fade' id='printHistory' tabindex='-1' data-bs-keyboard="false" data-bs-backdrop="static" aria-labelledby='exampleModalLabel' aria-hidden='true'>
	    <div class='modal-dialog modal-lg'>
	        <div class='modal-content'>

	            <?php include "modals/modal_costbreakdown.php" ?>

	            <div class='modal-footer'>
	                <button type='button' class='btn btn-sm btn-danger close-modal' data-bs-dismiss='modal'>Close</button>
	                <button type='button' class='btn btn-sm custom-btn print-btn' id="btnPrintCostBreakdown">Print</button>
	                <button type='button' class='btn btn-sm btn-success send-email-btn d-none' onclick="sendtoemail()">Send To Email</button>
	            </div>
	        </div>
	    </div>
	</div>

</form>


<!-- Modal Viewing for Attachments -->
<?php include "modals/modal_viewattachments.php"; ?>

<!-- Modal for Uploading Attachments -->
<?php include "modals/modal_uploadattachments.php"; ?>


<!-- Modal Viewing for Requesting for Cancellation -->
<?php include "modals/modal_requestcancellation.php"; ?>


<!-- Modal Viewing for Sending an Email -->
<?php include "modals/modal_sendasemail.php"; ?>


<!-- Modal Viewing of Conversation -->
<?php include "modals/modals_conversation.php"; ?>


<script type="text/javascript">
	var loadGif = "<p align='center'><img src=\"assets/wedges.gif\" width=\"20%\"></p>";

	getJobOrderTypes();
	getBranches();
	getEmployeeNames();
    getjoborderhistory();
    updateTabCounts();
    getLaborSupplier();
    getPersonForFinancialAid();

    function getJobOrderTypes() {
    	event.preventDefault();

        $.post('truckrepair/php/getjobordertypes.php', {}, function(result) {
			$('#type_selection').html(result);
		});
    }

    function selectType() {
    	var type_selection = parseInt($('#type_selection').val());

    	$('.vehicle_info').addClass("d-none");
	    $('.fuel_info').addClass("d-none");
	    $('.financial_aid').addClass("d-none");
	    $('.transportation').addClass("d-none");

    	if (type_selection === 1) {
    		$('.vehicle_info').removeClass("d-none");
    	} else if (type_selection === 11) {
			$('.transportation').removeClass("d-none");
    	} else if (type_selection === 12) {
			$('.fuel_info').removeClass("d-none");
    	} else if (type_selection === 13) {
			$('.financial_aid').removeClass("d-none");
    	}
    }

    function getBranches() {
    	event.preventDefault();

        $.post('truckrepair/php/getBranches.php', {}, function(result) {
            var records = JSON.parse(result);
            for (var i = 0; i < records.length; i++) {
		        $('#branch_id').val(records[i].bridz);
		        $('#branch_selection').val(records[i].brname);

		        getVehicleBrand(records[i].bridz);
		    }
        });
    }

    function getEmployeeNames() {
    	event.preventDefault();

        $.post('truckrepair/php/getemployees.php', {}, function(result) {
        	var records = JSON.parse(result);
            for (var i = 0; i < records.length; i++) {
		        $('#employeename_id').val(records[i].nameid);
		        $('#employeename_selection').val(records[i].vname);

		        getPosition(records[i].nameid);
		    }
        });
    }

    function getPosition(nameid) {
    	event.preventDefault();
    	if (nameid === null || nameid === '' || nameid === 0) {
	        $('#label_position').val('');
	        $('#label_position').attr('data-bs-original-title', '');
	    } else {
	        $.post('truckrepair/php/getposition.php', {nameid: nameid}, function(result) {
	            $('#label_position').val(result);
			    $('#label_position').attr('data-bs-original-title', result);
	        });
	    }
    }

    function getVehicleBrand(branchid) {
    	event.preventDefault();

        $.post('truckrepair/php/getvehiclebrand.php', {branchid: branchid}, function(result) {
            $('#vehicle_brand').html(result);
        });
    }

    function getVehicleModel() {
    	event.preventDefault();
    	var brand = $('#vehicle_brand').val();

        $.post('truckrepair/php/getvehiclemodel.php', {brand: brand}, function(result) {
            $('#vehicle_model').html(result);
        });
    }

    function getPlateNo(selectElement) {
    	event.preventDefault();
    	var brand = $('#vehicle_brand').val();
    	var model = selectElement.options[selectElement.selectedIndex].text;

        $.post('truckrepair/php/getplateno.php', {
        	brand: brand,
        	model: model
        }, function(result) {
            $('#vehicle_platenum').html(result);
        });
    }

    // This is for displaying and populating the Financial Aid div.
    $('#personforfinancialaid').select2();
    function getPersonForFinancialAid() {
        $.post('truckrepair/php/getpersonforfinancialaid.php', {}, function(result) {
		    $('#personforfinancialaid').html(result);
        });
    }

    // This is for displaying the selected employee.
    function getAidee() {
    	employee = $('#personforfinancialaid').val();

    	if (employee == 0) {
    		$('#aidee_position').val("");
		    $('#aidee_supplier').val("");
		    $('#aidee_position').attr('data-bs-original-title', '');
    	}

    	$.post('truckrepair/php/getaidee.php', {employee: employee}, function(result) {
		    var data = JSON.parse(result);
            for (var i = 0; i < data.length; i++) {
		        $('#aidee_position').val(data[i].position);
		        $('#aidee_supplier').val(data[i].supplier);

		        $('#aidee_position').attr('data-bs-original-title', data[i].position);
		    }
        });
    }

    // This is for displaying the fuel information.
    function getFuelInfo() {
    	fuel_type = $('#fuel_type').val();

    	if (fuel_type == "Truck") {
    		$('.truck-plate-num').removeClass("d-none");
    	} else {
    		$('.truck-plate-num').addClass("d-none");
    	}
    }







    // DISPLAY JOB ORDER HISTORY ON DATATABLE
    function getjoborderhistory() {
        $.post('truckrepair/datatables/orderhistory.php', {}, function(result) {
            $('#job-order-history').html(result);
        });
    }

    // DISPLAYING LIST OF ADDED SUPPLIERS
    function getLaborSupplier() {
        $.post('truckrepair/php/selectsupplier.php', {}, function(result) {
            $('.supplier').html(result);
        });
    }


    // On Change of Number of Canvass
	function updateTabCounts() {
		var selectedCanvassNum = document.getElementById('selection_canvassnum').value;
		var tabList = document.querySelectorAll('#myTab .nav-link');

		tabList.forEach(function (tab) {
		  tab.classList.add('d-none');
		});

		for (var i = 1; i <= selectedCanvassNum; i++) {
		  var tabId = 'input_supplier' + i;
		  var tab = document.getElementById(tabId);
		  if (tab) {
		    tab.classList.remove('d-none');
		  }
		}
	}

	var selectionCanvassNum = document.getElementById('selection_canvassnum');
	selectionCanvassNum.addEventListener('change', updateTabCounts);


	$(document).ready(function() {
	  	var currentCanvassNum = $('#selection_canvassnum').val();

	  	$('#selection_canvassnum').on('change', function() {
	    	var newCanvassNum = $(this).val();

	    	for (var i = parseInt(newCanvassNum) + 1; i <= parseInt(currentCanvassNum); i++) {
	      		$('#input_supplier' + i).addClass('d-none');

	      		$('#supplier' + i + ' input').val('');
	      		$('#supplier' + i + ' select').val('Select');
	    	}

	    	currentCanvassNum = newCanvassNum;
	  	});
	});


	displayLaborCost1();
	function displayLaborCost1() {
		event.preventDefault();

		$.post('truckrepair/datatables/laborcost_table1.php', {}, function(result) {
            $('#laborcost_table1').html(result);
        });
	}

	displayMaterialCost1();
	function displayMaterialCost1() {
		event.preventDefault();

		$.post('truckrepair/datatables/materialcost_table1.php', {}, function(result) {
            $('#materialcost_table1').html(result);
        });
	}

	displayLaborCost2();
	function displayLaborCost2() {
		event.preventDefault();

		$.post('truckrepair/datatables/laborcost_table2.php', {}, function(result) {
            $('#laborcost_table2').html(result);
        });
	}

	displayMaterialCost2();
	function displayMaterialCost2() {
		event.preventDefault();

		$.post('truckrepair/datatables/materialcost_table2.php', {}, function(result) {
            $('#materialcost_table2').html(result);
        });
	}

	displayLaborCost3();
	function displayLaborCost3() {
		event.preventDefault();

		$.post('truckrepair/datatables/laborcost_table3.php', {}, function(result) {
            $('#laborcost_table3').html(result);
        });
	}

	displayMaterialCost3();
	function displayMaterialCost3() {
		event.preventDefault();

		$.post('truckrepair/datatables/materialcost_table3.php', {}, function(result) {
            $('#materialcost_table3').html(result);
        });
	}

	function CreateOrder() {
	    event.preventDefault();

		function emptyToNull(value) {
	        return value === '' ? null : value;
	    }

	    var type_selection = $('#type_selection').val();
	    var branchid = $('#branch_id').val();
	    var employeename = $('#employeename_id').val();
	    var overview = $('#text_overview').val().replace(/'/g, "`").replace(/"/g, "&quot;").replace(/</g, " < ").replace(/>/g, " > ").replace(/(\r\n|\n|\r)/gm, " ");

	    var aidee_name = $('#personforfinancialaid').val(); // this is for financial aid

	    input1 = $("#input_supplier1").is(":visible");
	    input2 = $("#input_supplier2").is(":visible");
	    input3 = $("#input_supplier3").is(":visible");

	    var driver = null;
	    var brand = null;
	    var model = null;
	    var year = null;
	    var platenum = null;
	    var odo = null;

	    // NEW CHANGES 2024-01-10
	    if (type_selection == 0) {
	        $("#errorMsgModal").modal('show');
	        $("#errorMsgModal .modal-body").html("Please select a type of job order.");
	        return;
	    } else if (type_selection == 1) {
	        brand = $('#vehicle_brand').val();
	        var selectElement = document.getElementById("vehicle_model");
	        model = selectElement.options[selectElement.selectedIndex].text;
	        year = $('#label_year').val();
	        platenum = $('#vehicle_platenum').val();
	        odo = $('#label_odo').val();
	    } else if (type_selection == 11) {
    		driver = $('#drivername').val();
    		platenum = $('#driverplatenum').val();
	    } else if (type_selection == 12) {
	    	fuel_type = $('#fuel_type').val();

	    	if (fuel_type == "Truck") {
	    		platenum = $('#truck_platenum').val();
	    	} else if (fuel_type == "Genset") {
	    		platenum = "Genset";
	    	}
	    }

	    var laborcost_data1 = [];
	    var laborcost_table1 = $('#laborcost_datatable1').DataTable();
	    laborcost_table1.rows().every(function (rowIdx, tableLoop, rowLoop) {
	        var rowData = this.data();
	        var supplier = emptyToNull(rowData['supplier']);
	        var material = emptyToNull(rowData['material']);
	        var qty = emptyToNull(rowData['qty']);
	        var price = emptyToNull(rowData['price']);

	        var fileInput = $(this.node()).find('.labor1-newdata-label').text();

	        laborcost_data1.push({
	            supplier: supplier,
	            material: material,
	            qty: qty,
	            price: price,
	            attachments: fileInput
	        });
	    });

	    var materialcost_data1 = [];
	    var materialcost_table1 = $('#materialcost_datatable1').DataTable();
	    materialcost_table1.rows().every(function (rowIdx, tableLoop, rowLoop) {
	        var rowData = this.data();
	        var supplier = emptyToNull(rowData['supplier']);
	        var material = emptyToNull(rowData['material']);
	        var qty = emptyToNull(rowData['qty']);
	        var price = emptyToNull(rowData['price']);

	        var fileInput = $(this.node()).find('.material1-newdata-label').text();

	        materialcost_data1.push({
	            supplier: supplier,
	            material: material,
	            qty: qty,
	            price: price,
	            attachments: fileInput
	        });
	    });

	    var laborcost_data2 = [];
	    var laborcost_table2 = $('#laborcost_datatable2').DataTable();
	    laborcost_table2.rows().every(function (rowIdx, tableLoop, rowLoop) {
	        var rowData = this.data();
	        var supplier = emptyToNull(rowData['supplier']);
	        var material = emptyToNull(rowData['material']);
	        var qty = emptyToNull(rowData['qty']);
	        var price = emptyToNull(rowData['price']);

	        var fileInput = $(this.node()).find('.labor2-newdata-label').text();

	        laborcost_data2.push({
	            supplier: supplier,
	            material: material,
	            qty: qty,
	            price: price,
	            attachments: fileInput
	        });
	    });

	    var materialcost_data2 = [];
	    var materialcost_table2 = $('#materialcost_datatable2').DataTable();
	    materialcost_table2.rows().every(function (rowIdx, tableLoop, rowLoop) {
	        var rowData = this.data();
	        var supplier = emptyToNull(rowData['supplier']);
	        var material = emptyToNull(rowData['material']);
	        var qty = emptyToNull(rowData['qty']);
	        var price = emptyToNull(rowData['price']);

	        var fileInput = $(this.node()).find('.material2-newdata-label').text();

	        materialcost_data2.push({
	            supplier: supplier,
	            material: material,
	            qty: qty,
	            price: price,
	            attachments: fileInput
	        });
	    });

	    var laborcost_data3 = [];
	    var laborcost_table3 = $('#laborcost_datatable3').DataTable();
	    laborcost_table3.rows().every(function (rowIdx, tableLoop, rowLoop) {
	        var rowData = this.data();
	        var supplier = emptyToNull(rowData['supplier']);
	        var material = emptyToNull(rowData['material']);
	        var qty = emptyToNull(rowData['qty']);
	        var price = emptyToNull(rowData['price']);

	        var fileInput = $(this.node()).find('.labor3-newdata-label').text();

	        laborcost_data3.push({
	            supplier: supplier,
	            material: material,
	            qty: qty,
	            price: price,
	            attachments: fileInput
	        });
	    });

	    var materialcost_data3 = [];
	    var materialcost_table3 = $('#materialcost_datatable3').DataTable();
	    materialcost_table3.rows().every(function (rowIdx, tableLoop, rowLoop) {
	        var rowData = this.data();
	        var supplier = emptyToNull(rowData['supplier']);
	        var material = emptyToNull(rowData['material']);
	        var qty = emptyToNull(rowData['qty']);
	        var price = emptyToNull(rowData['price']);

	        var fileInput = $(this.node()).find('.material3-newdata-label').text();

	        materialcost_data3.push({
	            supplier: supplier,
	            material: material,
	            qty: qty,
	            price: price,
	            attachments: fileInput
	        });
	    });


	    if (input1 && (laborcost_data1.length === 0 && materialcost_data1.length === 0)) {
	        $("#errorMsgModal").modal('show');
	        $("#errorMsgModal .modal-body").html("Supplier 1 has no data in it.");
	        return;
	    } else if (input2 && (laborcost_data2.length === 0 && materialcost_data2.length === 0)) {
	        $("#errorMsgModal").modal('show');
	        $("#errorMsgModal .modal-body").html("Supplier 2 has no data in it.");
	        return;
	    } else if (input3 && (laborcost_data3.length === 0 && materialcost_data3.length === 0)) {
	        $("#errorMsgModal").modal('show');
	        $("#errorMsgModal .modal-body").html("Supplier 3 has no data in it.");
	        return;
	    } else {
	        $.post('truckrepair/php/createorder.php', {
	            type_selection: type_selection,
	            branchid: branchid,
	            employeename: employeename,
	            driver: driver,
	            brand: brand,
	            model: model,
	            year: year,
	            platenum: platenum,
	            odo: odo,
	            overview: overview,
	            laborcost_data1: laborcost_data1,
	            materialcost_data1: materialcost_data1,
	            laborcost_data2: laborcost_data2,
	            materialcost_data2: materialcost_data2,
	            laborcost_data3: laborcost_data3,
	            materialcost_data3: materialcost_data3,
	            aidee_name: aidee_name
	        }, function (result) {
	            console.log(result);
	            laborcost_table1.clear().draw();
	            materialcost_table1.clear().draw();
	            laborcost_table2.clear().draw();
	            materialcost_table2.clear().draw();
	            laborcost_table3.clear().draw();
	            materialcost_table3.clear().draw();
	            clearAll();
	            saveEmployeeNameToLocalStorage(employeename);
	            $("#ordersentMsgModal").modal('show');
	        });
	    }
	}


    // Save selected email as hidden entity
    document.querySelector('#SendAsEmail select').addEventListener('change', (event) => {

        const selectedOptions = Array.from(event.target.selectedOptions).map(option => option.value).join(', ');

        document.querySelector('#dept_email_hidden').value = selectedOptions;

        const isEmailSelected = selectedOptions.length > 0;

        $('.preview-btn').prop('disabled', !isEmailSelected);

    });


	// SEND AS EMAIL
	function sendtoemail() {
		event.preventDefault();

		var modalContent = document.getElementById("printarea_breakdown").innerHTML;
        var selectedEmail = $("#dept_email_hidden").val();

        console.log(selectedEmail); // testemail@gmail.com, nolsatwork@gmail.com

        $.post("truckrepair/php/sendemail.php", {
            modalContent: modalContent,
            selectedEmail: selectedEmail
        })
        .done(function(result) {
            // SHOW SUCCESS MODAL
            $('#SendAsEmail').modal('hide');
            $("#printHistory").modal('hide');
            $('#successMsgModal').modal('show');
            $('#successMsgModal .modal-body').html("Email Sent! \n\nPlease wait for their response/s.");
            $('.close-modal').removeClass('d-none');
	        $('.send-email-btn').addClass('d-none');
	        $('.vehicle_info').removeClass('d-none');
	        clearAll();

	        // Now, send text messages for each contact
	        // $.post("truckrepair/php/sendastext.php", {
	        //     selectedEmail: selectedEmail
	        // }).done(function(result) {
	        //     // console.log(result);
	        // });
        })
        .fail(function() {
            // SHOW ERROR MESSAGE OR HANDLE FAILURE
            alert("Failed to send email. Please direct to the HR / MIS Department for further instructions.");
        });
	}


	// Open up a modal to view what you created, add a button to send as email.
	$('#SendAsEmail .btn-success').on('click', function() {
		var employeename = getEmployeeNameFromLocalStorage();

	    $.ajax({
	        type: 'POST',
	        url: 'truckrepair/php/populateemaildata.php',
	        data: {employeename: employeename},
	        dataType: 'json',
	        success: function(response) {

	        	var joid = response.joid;
	            var nameid = response.nameid;
	            var brname = response.brname;
	            var vname = response.vname;
	            var position = response.position;
	            var overview = response.overview;
	            var driver = response.driver;
	            var brand = response.brand;
	            var model = response.model;
	            var year = response.year;
	            var platenum = response.platenum;
	            var odo = response.odo;
	            var jobid = response.jobid;
	            var datacount = response.datacount;
	            var suppname = response.suppname;
	            var suppamount = response.suppamount;
	            var aid_recipient = response.aid_recipient;
	            var type = response.repairtype;

	            // Call the printSupplier function to open the "printHistory" modal and display the data
	            printSupplier(joid, nameid, brname, vname, position, overview, driver, brand, model, year, platenum, odo, jobid, datacount, suppname, suppamount, aid_recipient, type);

	            datacount = $('#datacount').val();
	    		supplier = $('#supplier').text().toUpperCase();

	            if (supplier == "PENDING" || supplier == "CANCELLED") {
				    if (datacount == 1) {
				    	$('.quote1').removeClass("d-none");
				    	$('.quote2, .quote3').addClass("d-none");

				    	$('.quote1').css('display', 'block');
    					$('.quote2, .quote3').css('display', 'none');
				    } else if (datacount == 2) {
				    	$('.quote1, .quote2').removeClass("d-none");
				    	$('.quote3').addClass("d-none");

				    	$('.quote1, .quote2').css('display', 'block');
    					$('.quote3').css('display', 'none');
				    } else if (datacount == 3) {
				    	$('.quote1, .quote2, .quote3').removeClass("d-none");

				    	$('.quote1, .quote2, .quote3').css('display', 'block');
				    }
			    } else {
					if (datacount == 1) {
				    	$('.quote1').removeClass("d-none");
				    	$('.quote2, .quote3').addClass("d-none");

				    	$('.quote1').css('display', 'block');
				    	$('.quote2, .quote3').css('display', 'none');
				    } else if (datacount == 2) {
				    	$('.quote1, .quote3').addClass("d-none");
				    	$('.quote2').removeClass("d-none");

				    	$('.quote1, .quote3').css('display', 'none');
    					$('.quote2').css('display', 'block');
				    } else if (datacount == 3) {
				    	$('.quote1, .quote2').addClass("d-none");
				    	$('.quote3').removeClass("d-none");

				    	$('.quote1, .quote2').css('display', 'none');
    					$('.quote3').css('display', 'block');
				    }
			    }

			    if (type == "FINANCIAL AID") {
			    	$('.financialaidname').removeClass("d-none");
			    	$('#display_Recipient').html(aid_recipient);
			    }

	            $('.close-modal').addClass('d-none');
	            $('.send-email-btn').removeClass('d-none');
	            $('#logobranch').removeClass('d-none');
	            $('.approverandfunds').addClass('d-none');
	            $('.approverandfunds').css('display', 'none');
	        },
	        error: function(xhr, status, error) {
	            // Handle errors, if any
	            console.error(xhr.responseText);
	        }
	    });
	});


	// ADDING OF SUPPLIER
    function addSupplier() {
        event.preventDefault();

        var add_name = $('#name_addsupplier').val().replace(/'/g, "`").replace(/(\r\n|\n|\r)/gm, " ");
        var add_contact = $('#contactno_addsupplier').val();
        var add_address = $('#address_addsupplier').val().replace(/'/g, "`").replace(/(\r\n|\n|\r)/gm, " ");

        if (add_contact.length < 10) {
            $('.invalidnum').removeClass("d-none");
            inputElement = document.getElementById('contactno_addsupplier');
            inputElement.focus();
            return;
        }

        $.post('truckrepair/php/addnewsupplier.php', {
            add_name: add_name,
            add_contact: add_contact,
            add_address: add_address
        }, function(result) {
            clearModal();
            alert("Success!");
            $('#AddSupplier').modal('hide');

            location.reload();
            setTimeout(function() {
                location.reload();
            }, 100);
        });
    }


    function getCostBreakdown(upload) {
	    job_order_id = $('#job_order_id').val();
	    datacount = $('#datacount').val();
	    supplier = $('#supplier').text().toUpperCase();

	    if (supplier == "PENDING" || supplier == "CANCELLED") {
		    if (datacount == 1) {
		    	$('.quote1').removeClass("d-none");
		    	$('.quote2').addClass("d-none");
		    	$('.quote3').addClass("d-none");
		    } else if (datacount == 2) {
		    	$('.quote1').removeClass("d-none");
		    	$('.quote2').removeClass("d-none");
		    	$('.quote3').addClass("d-none");
		    } else if (datacount == 3) {
		    	$('.quote1').removeClass("d-none");
		    	$('.quote2').removeClass("d-none");
		    	$('.quote3').removeClass("d-none");
		    }
	    } else {
			if (datacount == 1) {
				$('.quote1').removeClass("d-none");
		    	$('.quote2').addClass("d-none");
		    	$('.quote3').addClass("d-none");
		    } else if (datacount == 2) {
		    	$('.quote1').addClass("d-none");
		    	$('.quote2').removeClass("d-none");
		    	$('.quote3').addClass("d-none");
		    } else if (datacount == 3) {
		    	$('.quote1').addClass("d-none");
		    	$('.quote2').addClass("d-none");
		    	$('.quote3').removeClass("d-none");
		    }
	    }

	    for (let i = 1; i <= 3; i++) {
	        $.post('truckrepair/datatables/table_laborcost_breakdown.php', {
	            job_order_id: job_order_id,
	            datacount: i
	        }, function(result) {
	            $('#table_laborcost_breakdown_quot' + i).html(result);
	            if (upload == "upload_attachments") {
			    	$(".file-upload").removeClass("d-none");
			    } else {
			    	$(".file-upload").addClass("d-none");
			    }
	        });

	        $.post('truckrepair/datatables/table_materialcost_breakdown.php', {
	            job_order_id: job_order_id,
	            datacount: i
	        }, function(result) {
	            $('#table_materialcost_breakdown_quot' + i).html(result);
	        });
	    }
	}



	function getWinnerSupplier(suppname) {
		event.preventDefault();

		$.post('truckrepair/php/getwinnersupplier.php', {
            suppname: suppname
        }, function(result) {});
	}



    function printSupplier(joid, nameid, brname, vname, position, overview, driver, brand, model, year, platenum, odo, jobid, datacount, suppname, suppamount, vapprover, approvaldate, modeoffunds, aid_recipient, type)
    {
        event.preventDefault();

        var_joid = joid;
        var_nameid = nameid;
        var_brname = brname;
        var_vname = vname;
        var_position = position;
        var_overview = overview;
        var_driver = driver;
        var_brand = brand;
        var_model = model;
        var_year = year;
        var_platenum = platenum;
        var_odo = odo;
        var_jobid = jobid;
        var_datacount = datacount;
        var_suppname = suppname;
        var_suppamount = suppamount;
        var_vapprover = vapprover;
        var_approvaldate = approvaldate;
        var_modeoffunds = modeoffunds;
        var_aid_recipient = aid_recipient;
        var_type = type;

        $.post('truckrepair/php/getwinnersupplier.php', {
            suppname: suppname
        }, function(result) {
        	supplier_contact = result;

        	if (var_suppname == "PENDING") {
	        	$("#supplier").addClass("text-danger");
	        	$(".update-btn").addClass("d-none");
	        } else if (var_suppname == "CANCELLED") {
	        	$("#supplier").removeClass("text-danger");
	        	$("#supplier").addClass("text-secondary");
	        } else if (var_suppname == "FOR CANCELLATION") {
	        	$("#supplier").removeClass("text-danger");
	        	$("#supplier").addClass("text-secondary");
	        } else {
	        	$("#supplier").removeClass("text-danger");
	        	$("#supplier").removeClass("text-secondary");

	        	$("#supplier").addClass("text-primary");
	        	var_suppname = var_suppname + " (WINNER) " + "(" + supplier_contact + ")";

	        	var_vapprover = var_vapprover + " (" + var_approvaldate + ")";
	        }


	        if (var_type == "FINANCIAL AID") {
	        	$('.financialaidname').removeClass("d-none");
	        } else {
	        	$('.financialaidname').addClass("d-none");
	        }

	        $("#display_JobOrderID").html(var_joid);
	        $("#display_Branch").html(var_brname);
	        $("#display_Employee").html(var_vname);
	        $("#display_Position").html(var_position);
	        $("#display_Category").html(type);
	        $("#display_Overview").html(var_overview);
	        $("#display_Driver").html(var_driver);
	        $("#display_Brand").html(var_brand);
	        $("#display_Model").html(var_model);
	        $("#display_Year").html(var_year);
	        $("#display_PlateNo").html(var_platenum);
	        $("#display_ODO").html(var_odo);

	        $("#job_order_id").val(var_jobid);
	        $("#datacount").val(var_datacount);
	        $("#supplier").html(var_suppname);
	        $("#total_amount").html(var_suppamount);
	        $("#display_Approver").html(var_vapprover);
	        $("#display_ModeFunds").html(var_modeoffunds);
	        $("#display_Recipient").html(var_aid_recipient);

	        $("#printHistory").modal('show');

	        getCostBreakdown();
        });

    }


    // PRINT MODAL PDF
    document.getElementById("btnPrintCostBreakdown").addEventListener("click", function() {
        var divToPrint = document.getElementById('printarea_breakdown');
        var newWin = window.open('', 'Print-Window');
        newWin.document.open();
        newWin.document.write('<html><head><title>Cost Breakdown</title><link rel="stylesheet" type="text/css" href="stylesheets/printcostbreakdown.css"></head><body onload="window.print()">');
        newWin.document.write(divToPrint.innerHTML);
        newWin.document.write('</body></html>');
        newWin.document.close();
        setTimeout(function() {
            newWin.close();
        }, 200);
    });


    // viewing attachments
    function viewAttachments(jobid, nameid) {
    	event.preventDefault();

    	var_jobid = jobid;
        var_nameid = nameid;

        $.post("truckrepair/php/getattachments.php", {
            var_jobid: var_jobid,
            var_nameid: var_nameid
        }, function(result) {
            $("#carouselExampleIndicators").html(result);

            $("#carouselExampleIndicators").empty();
        	$("#carouselExampleIndicators").html(loadGif);

        	$("#ViewAttachments").modal('show');

        	$("#ViewAttachments").on('shown.bs.modal', function () {
	            $("#carouselExampleIndicators").html(result);
	        });
        });

    }


    const fileInput = document.querySelector("#fileInput");
	let selectedFiles = [];
	const formData = new FormData();

	$('.close-modal').on("click", function() {
	    selectedFiles = [];
	    formData.delete("files[]");
	    $('#fileInput').val("");
	    updateButtonState();
	});

	// Function to update the update button state based on file input
	function updateButtonState() {
	    if (selectedFiles.length > 0) {
	        $('.update-btn').removeClass("disabled").prop("disabled", false);
	    } else {
	        $('.update-btn').addClass("disabled").prop("disabled", true);
	    }
	}

	updateButtonState(); // initialize

	$('.update-btn').on("click", function() {
		if ($(this).hasClass("disabled")) {
	        return; // Don't do anything if the button is disabled
	    }

	    $.ajax({
	        url: 'truckrepair/php/updateattachment.php',
	        type: 'POST',
	        data: formData,
	        processData: false,
	        contentType: false,
	        cache: false,
	        success: function(result) {
	            $("#UploadAttachment").modal('hide');
	            $("#successMsgModal").modal('show');
	            $("#successMsgModal .modal-body").html("Attachments updated");
	            selectedFiles = [];
	            formData.delete("files[]");
	            $('#fileInput').val("");
	            $("form")[0].reset();
	            getjoborderhistory();
	        }
	    });
	});

    // uploadng new attachments
	function uploadAttachments(cid, joid, nameid, upload) {
	    event.preventDefault();

	    if (upload == "upload_attachments") {
	        $(".update-btn").removeClass("d-none");
	    }

	    $("#UploadAttachment").modal('show');

	    fileInput.addEventListener("change", handleFileUpload);

	    function handleFileUpload(event) {
	        const files = event.target.files;
	        if (files.length === 0) { // Aside from return, these are added to disabled button when no files attached and clear its cache.
	        	selectedFiles = [];
        		formData.delete("files[]");
        		$('.update-btn').addClass("disabled").prop("disabled", true);
	            return;
	        }

	        selectedFiles = [];
	        formData.delete("files[]");

	        for (const file of files) {
	            selectedFiles.push(file);
	            formData.append("files[]", file);
	        }

	        updateButtonState(); // Update the button state whenever file input changes
	    }

	    formData.append("cid", cid);
	    formData.append("joid", joid);
	    formData.append("nameid", nameid);
	}


    // viewing attachments
    function requestCancellation(jobid, nameid, brname, vname, position, overview, driver, brand, model, year, platenum, odo, suppname, suppamount, reqid) {
    	event.preventDefault();

    	var_jobid = jobid;
        var_nameid = nameid;
        var_brname = brname;
        var_vname = vname;
        var_position = position;
        var_overview = overview;
        var_brand = brand;
        var_model = model;
        var_year = year;
        var_platenum = platenum;
        var_odo = odo;
        var_suppname = suppname;
        var_suppamount = suppamount;

        if (var_suppname == "PENDING") {
        	$("#request_cancel_supplier").addClass("text-danger");
        	$(".print-btn").addClass("d-none");
        } else if (var_suppname == "CANCELLED") {
        	$("#request_cancel_supplier").removeClass("text-danger");
        	$("#request_cancel_supplier").addClass("text-secondary");
        	$(".print-btn").addClass("d-none");
        } else if (var_suppname == "FOR CANCELLATION") {
        	$("#request_cancel_supplier").removeClass("text-danger");
        	$("#request_cancel_supplier").addClass("text-secondary");
        	$(".print-btn").addClass("d-none");
        } else {
        	$("#request_cancel_supplier").removeClass("text-danger");
        	$("#request_cancel_supplier").removeClass("text-secondary");
        	$(".print-btn").removeClass("d-none");

        	$("#request_cancel_supplier").addClass("text-primary");
        	var_suppname = var_suppname + " (WINNER)";
        }

        $("#request_cancel_JobOrderID").html(jobid);
        $("#request_cancel_Branch").html(var_brname);
        $("#request_cancel_Employee").html(var_vname);
        $("#request_cancel_Position").html(var_position);
        $("#request_cancel_Overview").html(var_overview);
        $("#request_cancel_Brand").html(var_brand);
        $("#request_cancel_Model").html(var_model);
        $("#request_cancel_Year").html(var_year);
        $("#request_cancel_PlateNo").html(var_platenum);
        $("#request_cancel_ODO").html(var_odo);

        $("#request_cancel_JobOrderID").val(var_jobid);
        $("#request_cancel_supplier").html(var_suppname);
        $("#request_cancel_total_amount").html(var_suppamount);

    	$("#RequestCancellation").modal('show');
    }

    function submitCancellationRequest() {
    	event.preventDefault();

    	var approvalstatus = 3;
        var joborderidxx = $("#request_cancel_JobOrderID").html();
        var cancel_text = $("#request_cancel_reason").val().replace(/'/g, "`").replace(/"/g, "&quot;").replace(/(\r\n|\n|\r)/gm, " ");

        if (!cancel_text) {
            inputElement = document.getElementById('request_cancel_reason');
            inputElement.focus();
            return;
        }

        $.post('truckrepair/php/requestcancellationapproval.php', {
            approvalstatus: approvalstatus,
            joborderidxx: joborderidxx,
            cancel_text: cancel_text
        }, function(result) {
            $("#successMsgModal").modal('show');
            $("#successMsgModal .modal-body").html("Request for cancellation has been sent.");
            $("#RequestCancellation").modal('hide');
            clearAll();
        });
    }



    		// ******************************************************************************************* //
    									// THESE ARE RESTRICTIONS //

	$(document).ready(function() {
		var yearInput = $('#label_year');
	  	$('#label_year').on('change', function() {
	    	var year = $(this).val();
	    	var currentYear = new Date().getFullYear();

	    	if (!isValidYear(year)) {
	    		$('.errormsg').text("Restriction: 1990 to " + currentYear);
	    		yearInput.focus();
	    	} else {
	    		$('.errormsg').text("");
	    	}
	  	});
	});


	// Function to save employeename in Local Storage
	function saveEmployeeNameToLocalStorage(employeename) {
	  	localStorage.setItem('employeename', employeename);
	}

	// Function to retrieve employeename from Local Storage
	function getEmployeeNameFromLocalStorage() {
	  	return localStorage.getItem('employeename');
	}

	// Function to clear employeename from Local Storage
	function clearEmployeeNameFromLocalStorage() {
	  	localStorage.removeItem('employeename');
	}


	// CURRENTLY NOT IN USE
	function checkInputs() {
		var brand = "";

		type_selection = $('#type_selection').val();
		overview = document.getElementById("text_overview").value;
		selectElement = document.getElementById("vehicle_brand");
		year = document.getElementById("label_year").value;
		model = document.getElementById("vehicle_model").value;
		plateno = document.getElementById("vehicle_platenum").value;
		fuel_type = document.getElementById("fuel_type").value;
		personforfinancialaid = document.getElementById("personforfinancialaid").value;
		truck_platenum = document.getElementById("truck_platenum").value;
		drivername = document.getElementById("drivername").value;
		driverplatenum = document.getElementById("driverplatenum").value;

	    if (selectElement.selectedIndex >= 0) {
	        brand = selectElement.options[selectElement.selectedIndex].text;
	    }

	    if (type_selection == 1) {
			if (brand == 'NO DATA' || brand == '' || model == 0 || plateno == 0 || !isValidYear(year) || overview == '') {
				$("#errorMsgModal").modal('show');
			} else {
                CreateOrder();
			}
		} else if (type_selection == 11) {
			if (drivername == '' || driverplatenum == '' || overview == '') {
				$("#errorMsgModal").modal('show');
			} else {
				CreateOrder();
			}
		} else if (type_selection == 12) {
			if (fuel_type == '' || overview == '') {
				$("#errorMsgModal").modal('show');
			} else if(fuel_type == "Truck" && truck_platenum == '') {
				$("#errorMsgModal").modal('show');
			} else {
				CreateOrder();
			}
		} else if (type_selection == 13) {
			if (personforfinancialaid == 0 || overview == '') {
				$("#errorMsgModal").modal('show');
			} else {
				CreateOrder();
			}
		} else if (type_selection != 1) {
			if (overview == '') {
				$("#errorMsgModal").modal('show');
			} else {
				CreateOrder();
			}
		}

        // saveEmployeeNameToLocalStorage(employee);
	}


	function isValidYear(yearString) {
	    var yearRegex = /^(19|20)\d{2}$/;
	    var currentYear = new Date().getFullYear();
	    return yearRegex.test(yearString) && parseInt(yearString) >= 1990 && parseInt(yearString) <= currentYear;
	}



	// USE FOR CLEARING INPUTS THROUGHOUT SITE
	function clearAll() {
		document.getElementById("type_selection").value = 0;
		document.getElementById("vehicle_brand").value = "";
		document.getElementById("vehicle_model").value = "";
		document.getElementById("label_year").value = "";
		document.getElementById("vehicle_platenum").value = "";
		document.getElementById("label_odo").value = "";
		document.getElementById("text_overview").value = "";
		document.getElementById("vehicle_model").value = "";
		document.getElementById("selection_canvassnum").value = 1;
		document.getElementById("department_emails").value = '';

		$('#input_supplier1').addClass("active");
		$('#input_supplier2').addClass("d-none");
		$('#input_supplier3').addClass("d-none");

		$('.transportation').addClass("d-none");
		document.getElementById("drivername").value = "";
		document.getElementById("driverplatenum").value = "";

		$('.fuel_info').addClass("d-none");
		document.getElementById("fuel_type").value = "";
		document.getElementById("truck_platenum").value = "";

		$("#personforfinancialaid").val(0).trigger("change");
		$('.financial_aid').addClass("d-none");
		
	    getjoborderhistory();
	    updateTabCounts();
	    getLaborSupplier();

	}

    function clearModal() {
        document.getElementById("name_addsupplier").value = "";
        document.getElementById("contactno_addsupplier").value = "";
        document.getElementById("address_addsupplier").value = "";
    }

    function clearSupplier() {
    	selectedCanvassNum = document.getElementById('selection_canvassnum').value;
    	
    	laborcost_table1 = $('#laborcost_datatable1').DataTable();
    	laborcost_table2 = $('#laborcost_datatable2').DataTable();
    	laborcost_table3 = $('#laborcost_datatable3').DataTable();
    	materialcost_table1 = $('#materialcost_datatable1').DataTable();
    	materialcost_table2 = $('#materialcost_datatable2').DataTable();
    	materialcost_table3 = $('#materialcost_datatable3').DataTable();

    	if (selectedCanvassNum == 1) {
			laborcost_table2.clear().draw();
			materialcost_table2.clear().draw();
			laborcost_table3.clear().draw();
			materialcost_table3.clear().draw();
    	} else if (selectedCanvassNum == 2) {
			laborcost_table3.clear().draw();
			materialcost_table3.clear().draw();
    	}
    }


    // Export to Excel
    document.getElementById("export_history").addEventListener("click", function() {
        event.preventDefault();
        var table = document.getElementById("job_order_datatable");

        // create a new table without the 2nd column
        var newTable = document.createElement("table");
        for (var i = 0; i < table.rows.length; i++) {
            var newRow = newTable.insertRow();
            for (var j = 0; j < table.rows[i].cells.length; j++) {
                if (j !== 5 && j !== 6 && j !== 10) {
                    var newCell = newRow.insertCell();
                    newCell.innerHTML = table.rows[i].cells[j].innerHTML;
                }   
            }
        }

        var wb = XLSX.utils.book_new();
        var ws = XLSX.utils.table_to_sheet(newTable);
        XLSX.utils.book_append_sheet(wb, ws, "Job Order History");
        
        XLSX.writeFile(wb, "JO_History.xlsx");

    });

    $(document).ready(function() {
		var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
	    var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
	        return new bootstrap.Tooltip(tooltipTriggerEl);
	    });
	});


	function viewConvo(jobid, msngr) {
		event.preventDefault();

		$("#send_convo").off("click");
		$('.btn-close-convo').off("click");

		loadConvo(jobid);
		msgRead(jobid, msngr);
		localStorage.setItem("jobid", jobid);
		console.log("jobid on opening: " + localStorage.getItem("jobid"));

		$("#ModalConvo").modal("show");
		$("#ConvoData").html("<p align='center'><img src=\"assets/skl-loader.gif\" width=\"80%\"></p>");

		$('#ModalConvo').on('shown.bs.modal', function () {
            var conversationBody = document.getElementById("ConvoData");
            conversationBody.scrollTop = conversationBody.scrollHeight;
        });

		$("#send_convo").on("click", function() {
			var message = $("#convo_message").val().replace(/'/g, "`").replace(/"/g, "&quot;").replace(/</g, " < ").replace(/>/g, " > ").replace(/(\r\n|\n|\r)/gm, "<br>");
			if (!message || message == "") {
				$("#convo_message").focus();
				return;
			}

			const fileInput = document.querySelector("#msg_files");
			const formData = new FormData();

			formData.append("jobid", jobid);

			for (let i = 0; i < fileInput.files.length; i++) {
			    formData.append("attachments[]", fileInput.files[i]);
			}

			$.ajax({
		        url: 'truckrepair/php/upload_msg_attachments.php',
		        type: 'POST',
		        data: formData,
		        processData: false,
		        contentType: false,
		        cache: false,
		        success: function(result) {
		        	$("#msg_files").val("");
		        	var file_paths = result;

					$.post("truckrepair/php/conversation.php", {
						jobid: jobid,
						message: message,
						file_paths: file_paths,
                        msngr: msngr
					}, function(result) {
						if (result == 1) {
							loadConvo(localStorage.getItem("jobid"));
							$("#convo_message").val("");
						} else {
							alert("Error sending message.");
							return;
						}
					});
				}
		    });
		});

		$('.btn-close-convo').on("click", function() {
			getjoborderhistory();
			$("#convo_message").val("");
			$("#msg_files").val("");
			localStorage.removeItem("jobid");
		});

		$("#up_attachments").click(function() {
		    $("#ModalConvo").modal("hide");
		});
	}

	function loadConvo(jobid) {
		$.post("truckrepair/php/convodata.php", {
			jobid: jobid
		}, function(result) {
			$("#ConvoData").html(result);

			var conversationBody = document.getElementById("ConvoData");
        	conversationBody.scrollTop = conversationBody.scrollHeight;
		});
	}

	function msgRead(jobid, msngr) {
		$.post("truckrepair/php/readconversation.php", {jobid: jobid, msngr: msngr}, function(result) {});
	}

	function addAttachments(jobid) {
		$("#ModalConvo").modal("hide");

		$("#modal_add_attachments").modal("show");
		$('#modal_add_attachments').on('hidden.bs.modal', function (e) {
	        $("#addFiles").val("");
	    });

		$("#uploadNewFiles").off("click").on("click", function() {
			const newfileInput = document.querySelector("#addFiles");
			const newformData = new FormData();

			for (let i = 0; i < newfileInput.files.length; i++) {
		        newformData.append("jobid", jobid);
		        newformData.append("newattachment[]", newfileInput.files[i]);
		    }

			$.ajax({
		        url: 'truckrepair/php/uploadnewimg.php',
		        type: 'POST',
		        data: newformData,
		        processData: false,
		        contentType: false,
		        cache: false,
		        success: function(result) {
					$("#addFiles").val("");
					$("#modal_add_attachments").modal("hide");
					getjoborderhistory();
					localStorage.removeItem("jobid");
		        }
		    });
		});
	}

</script>