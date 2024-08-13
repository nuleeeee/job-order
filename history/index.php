<style type="text/css">
	.sticky-left {
        position: -webkit-sticky;
        position: sticky;
        top: 88px;
    }

    .dataTables_scrollBody {
    	max-height: 60vh;
    }

    .dataTables_scrollHead {
    	background-color: #F8F9FA;
	    position: sticky !important;
	    z-index: 1 !important;
	    top: 0px !important;
	    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
	}
</style>

<div class="pt-5"></div>

<div class="p-5 mb-5">

	<div class="bg-light shadow-sm p-3 rounded-1 mb-3 d-flex justify-content-between">
		<div class="mt-2">
			<h2>Truck Repair History</h2>
		</div>
		<div class="d-flex flex-row">
			<div class="dropdown">
				<button class="btn d-flex flex-column align-items-center" type="button" data-bs-toggle="dropdown" aria-expanded="false">
				    <img src="assets/icons/filter.png" height="20">
					<span style="font-size: 15px;">Filter</span>
				</button>
				  <ul class="dropdown-menu p-1">
				    <li>
				    	<select id="status_report" class="form-select">
				    		<option value="99" selected>All</option>
				    		<option value="0">For Approval</option>
				    		<option value="1">Pending Repair</option>
				    		<option value="2">Cancelled Job Order</option>
				    		<option value="3">Accomplished</option>
				    	</select>
				    </li>
				    <li><hr class="dropdown-divider"></li>
				    <li><button class="btn btn-sm custom-btn w-100" onclick="getHistory();">Filter</button></li>
				  </ul>
			</div>
			<div class="btn d-flex flex-column align-items-center pointer" id="printExcel">
				<img src="assets/icons/print.png" height="20">
				<span style="font-size: 15px;">Excel</span>
			</div>
		</div>
	</div>

	<div class="bg-light shadow-sm p-3 rounded-1">
		<div class="table-responsive-xxl">
			<div id="display_history">

			</div>
		</div>
	</div>

</div>




<script type="text/javascript">
	var loadGif = "<p align='center'><img src=\"assets/wedges.gif\" width=\"20%\"></p>";

	getHistory();

    function getHistory() {
    	$('#display_history').html(loadGif);
    	var status_report = $("#status_report").val();
        $.post('history/datatables/repairhistorytable.php', {
        	status_report: status_report
        }, function(result) {
            $('#display_history').html(result);
        });
    }

    // Export to Excel
    document.getElementById("printExcel").addEventListener("click", function() {
        event.preventDefault();
        var table = document.getElementById("tbl_history");

        var wb = XLSX.utils.book_new();
        var ws = XLSX.utils.table_to_sheet(table);
        XLSX.utils.book_append_sheet(wb, ws, "Truck Repair History");

        XLSX.writeFile(wb, "Truck Repair History.xlsx");

    });

</script>