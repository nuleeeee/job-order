<?php

include '../../phpconfig/session.php';

$cashieridz = $_SESSION['login_user'];

$display = "<table class='table table-hover text-nowrap' id='laborcost_datatable1' style='font-size: 12px;'>
                <thead>
                    <tr>
                        <th style='text-align:center;'>Supplier</th>
                        <th style='text-align:center;'>Material</th>	
                        <th style='text-align:center;'>Qty</th>
                        <th style='text-align:center;'>Price</th>
                        <th style='text-align:center;'>Attachments</th>
                        <th style='text-align:center;'></th>
                        <th style='text-align:center;'></th>
                        <th style='text-align:center;'></th>
                        <th style='text-align:center;'></th>
                    </tr>
                </thead>
                <tbody>";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['supplier']) && isset($_POST['material']) && isset($_POST['qty']) && isset($_POST['price'])) {
    $supplier = $_POST['supplier'];
    $material = $_POST['material'];
    $qty = $_POST['qty'];
    $price = $_POST['price'];

    $newRow = "<tr>
                    <td class='table-light text-center'>$supplier</td>
                    <td class='table-light text-center'>$material</td>
                    <td class='table-light text-center'>$qty</td>
                    <td class='table-light text-center'>$price</td>
                    <td class='table-light text-center'></td>
                    <td class='table-light text-center'></td>
                    <td class='table-light text-center'></td>
                    <td class='table-light text-center'></td>
                    <td class='table-light text-center'></td>
                </tr>";

    $display .= $newRow;
    
    echo $display;
    exit();
}



$display .= "	</tbody>
	         </table>

<script>
function getLaborSupplierOptions(callback) {
    $.ajax({
        url: 'truckrepair/php/getlaborsupplier.php',
        dataType: 'json',
        success: function (data) {
            callback(data.data);
        },
        error: function () {
            callback([]);
        }
    });
}

const editorLabor1 = new DataTable.Editor({
    fields: [
        {
            label: 'Supplier:',
            name: 'supplier',
            type: 'select',
            id: 'labor1-select'
        },
        {
            label: 'Material:',
            name: 'material',
            attr: {
                required: true
            }
        },
        {
            label: 'Qty:',
            name: 'qty',
            attr: {
                required: true
            }
        },
        {
            label: 'Price:',
            name: 'price',
            attr: {
                required: true
            }
        },
        {
            label: 'Attachments',
            name: 'attachments',
            type: 'hidden',
            def: ''
        }
    ],
    table: '#laborcost_datatable1'
});

editorLabor1.on('preSubmit', function (e, data, action) {
    if (action !== 'remove') {
        var material = this.field('material');
        var qty = this.field('qty');
        var price = this.field('price');

        if (!material.isMultiValue()) {
            if (!material.val()) {
                material.error('A material is required');
            }
        }

        if (!qty.isMultiValue()) {
            if (!qty.val()) {
                qty.error('A qty is required');
            }
        }

        if (!price.isMultiValue()) {
            if (!price.val()) {
                price.error('A price is required');
            }
        }

        if (this.inError()) {
            return false;
        }
    }
});

// Add event listeners to enforce numeric input for qty and price fields
editorLabor1.field('qty').input().on('input', function () {
    this.value = this.value.replace(/[^\d.]/g, ''); // Allow only numeric and dot input
    this.value = this.value.replace(/^\.+/, ''); // Remove leading dots
    this.value = this.value.replace(/\.{2,}/g, '.'); // Allow only one dot
});

editorLabor1.field('price').input().on('input', function () {
    this.value = this.value.replace(/[^\d.]/g, ''); // Allow only numeric and dot input
    this.value = this.value.replace(/^\.+/, ''); // Remove leading dots
    this.value = this.value.replace(/\.{2,}/g, '.'); // Allow only one dot
});

getLaborSupplierOptions(function (options) {
    editorLabor1.field('supplier').update(options);

    var labor1supplierSelect = editorLabor1.field('supplier').input();
    labor1supplierSelect.attr('id', 'labor1-select');
    labor1supplierSelect.select2({
        placeholder: 'Select a supplier',
        allowClear: true,
        width: '100%'
    });
});

const tableLabor1 = new DataTable('#laborcost_datatable1', {
    buttons: [
        {
            text: 'Add New Labor Cost',
            action: () => {
                editorLabor1.create({
                    title: 'LABOR COST | Create new record',
                    buttons: 'Add'
                });
            }
        }
    ],
    columns: [
        { data: 'supplier' },
        { data: 'material' },
        { data: 'qty' },
        { data: 'price' },
        { 
            data: 'attachments',
            render: function (data, type, row) {
                if (type === 'display') {
                    var rowIndex = tableLabor1.row(row).index();
                    return '<div id=\"labor1_attachments_div_' + rowIndex + '\" class=\"labor1-attachment-div text-center\"></div>';
                }
                return data;
            }
        },
        {
            data: null,
            className: 'dt-center editor-upload',
            defaultContent: '<label class=\"labor1_fileLabel\"><i class=\"bi bi-images pointer\" data-bs-toggle=\"tooltip\" data-bs-placement=\"bottom\" title=\"Upload Files\"/><input type=\"file\" accept=\".jpeg, .jpg, .png, .gif\" name=\"labor1_fileInput\" id=\"labor1_fileInput_\" class=\"labor1_fileInput d-none\"></label>',
            orderable: false
        },
        {
            data: null,
            className: 'dt-center editor-edit',
            defaultContent: '<i class=\"bi bi-pencil-square pointer\" data-bs-toggle=\"tooltip\" data-bs-placement=\"bottom\" title=\"Edit\"/>',
            orderable: false
        },
        {
            data: null,
            className: 'dt-center editor-delete',
            defaultContent: '<i class=\"bi bi-trash-fill pointer\" data-bs-toggle=\"tooltip\" data-bs-placement=\"bottom\" title=\"Delete\"/>',
            orderable: false
        },
        {
            data: null,
            defaultContent: '<label id=\"labor1_newdata\" class=\"labor1-newdata-label d-none\"></label>',
            orderable: false
        }
    ],
    createdRow: function(row, data, dataIndex) {
        var attachmentDiv = $(row).find('.labor1-attachment-div');
        attachmentDiv.attr('id', 'labor1_attachments_div_' + dataIndex);

        var labor1_fileInput = $(row).find('.labor1_fileInput');
        var inputId = 'labor1_fileInput_' + dataIndex;
        labor1_fileInput.attr('id', inputId);

        var labor1_fileLabel = $(row).find('.labor1_fileLabel');
        labor1_fileLabel.attr('for', inputId);

        var labor1_newdataLabel = $(row).find('.labor1-newdata-label');
        labor1_newdataLabel.text($('#labor1_newdata').text());
    },
    dom: 'Bfrtip',
    searching: false,
    info: false,
    sorting: false,
    paging: false,
});

$(document).on('change', '.labor1_fileInput', function() {
    var name = $(this).prop('files')[0].name;

    var row = $(this).closest('tr');
 
    var form_data = new FormData();
    var ext = name.split('.').pop().toLowerCase();
    if(jQuery.inArray(ext, ['gif','png','jpg','jpeg']) == -1) 
    {
        alert('Invalid Image File');
        return;
    }
    var oFReader = new FileReader();
    oFReader.readAsDataURL($(this).prop('files')[0]);
    var f = $(this).prop('files')[0];
    var fsize = f.size||f.fileSize;
    if(fsize > 2000000000)
    {
        alert('Image File Size is very big');
        return;
    }
    else
    {
        form_data.append('labor1_fileInput', $(this).prop('files')[0]);
        var attachmentDiv = $(row).find('.labor1-attachment-div');
        var rowIndex = tableLabor1.row(row).index();
        $.ajax ({
            url:'./labor1_upload.php',
            method:'POST',
            data: form_data,
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function() {
                attachmentDiv.html(\"<label class='text-success'>Image Uploading...</label>\");
            },   
            success:function(data)
            {
                $('input[name=\"attachments\"]', row).val(data);
                attachmentDiv.html(\"<img src='\" + data + \"' class='img-thumbnail' id='file_image' width='40' height='40'>\");
                $('#labor1_newdata', row).html(data);
            }
        });
    }
});

tableLabor1.on('click', 'td.editor-edit', function (e) {
    e.preventDefault();
 
    editorLabor1.edit(e.target.closest('tr'), {
        title: 'Edit record',
        buttons: 'Update'
    });
});

tableLabor1.on('click', 'td.editor-delete', function (e) {
    e.preventDefault();
 
    editorLabor1.remove(e.target.closest('tr'), {
        title: 'Delete record',
        message: 'Are you sure you wish to remove this record?',
        buttons: 'Delete'
    });
});

function checkAddButtonStatus() {
    const materialValue = editorLabor1.field('material').val();
    const qtyValue = editorLabor1.field('qty').val();
    const priceValue = editorLabor1.field('price').val();

    const addButton = $('.DTE_Form_Buttons button.btn');
    if (materialValue && qtyValue && priceValue && qtyValue !== \"0\" && priceValue !== \"0\" && materialValue !== \"0\" && qtyValue >= \"0\" && priceValue >= \"0\") {
        addButton.prop('disabled', false);
    } else {
        addButton.prop('disabled', true);
    }
}

editorLabor1.field('material').input().on('keyup change', checkAddButtonStatus);
editorLabor1.field('qty').input().on('keyup change', checkAddButtonStatus);
editorLabor1.field('price').input().on('keyup change', checkAddButtonStatus);

checkAddButtonStatus();


</script>

";

echo $display;

?>