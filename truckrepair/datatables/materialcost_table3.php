<?php

include '../../phpconfig/allfunction.php';

$display = "<table class='table table-hover text-nowrap' id='materialcost_datatable3' style='font-size: 12px;'>
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
let editorMaterial3;

function getMaterialSupplierOptions(callback) {
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

editorMaterial3 = new DataTable.Editor({
    fields: [
        {
            label: 'Supplier:',
            name: 'supplier',
            type: 'select',
            id: 'material3-select'
        },
        {
            label: 'Material:',
            name: 'material'
        },
        {
            label: 'Qty:',
            name: 'qty'
        },
        {
            label: 'Price:',
            name: 'price'
        },
        {
            label: 'Attachments',
            name: 'attachments',
            type: 'hidden',
            def: ''
        }
    ],
    table: '#materialcost_datatable3'
});

editorMaterial3.on('preSubmit', function (e, data, action) {
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

getMaterialSupplierOptions(function (options) {
    editorMaterial3.field('supplier').update(options);

    var material3supplierSelect = editorMaterial3.field('supplier').input();
    material3supplierSelect.attr('id', 'material3-select');
    material3supplierSelect.select2({
        placeholder: 'Select a supplier',
        allowClear: true,
        width: '100%'
    });
});

// Add event listeners to enforce numeric input for qty and price fields
editorMaterial3.field('qty').input().on('input', function () {
    this.value = this.value.replace(/[^\d.]/g, ''); // Allow only numeric and dot input
    this.value = this.value.replace(/^\.+/, ''); // Remove leading dots
    this.value = this.value.replace(/\.{2,}/g, '.'); // Allow only one dot
});

editorMaterial3.field('price').input().on('input', function () {
    this.value = this.value.replace(/[^\d.]/g, ''); // Allow only numeric and dot input
    this.value = this.value.replace(/^\.+/, ''); // Remove leading dots
    this.value = this.value.replace(/\.{2,}/g, '.'); // Allow only one dot
});

const tableMaterial3 = new DataTable('#materialcost_datatable3', {
    buttons: [
        {
            text: 'Add New Material Cost',
            action: () => {
                editorMaterial3.create({
                    title: 'MATERIAL COST | Create new record',
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
                    var rowIndex = tableMaterial3.row(row).index();
                    return '<div id=\"material3_attachments_div_' + rowIndex + '\" class=\"material3-attachment-div text-center\"></div>';
                }
                return data;
            }
        },
        {
            data: null,
            className: 'dt-center editor-upload',
            defaultContent: '<label class=\"material3_fileLabel\"><i class=\"bi bi-images pointer\" data-bs-toggle=\"tooltip\" data-bs-placement=\"bottom\" title=\"Upload Files\"/><input type=\"file\" accept=\".jpeg, .jpg, .png, .gif\" name=\"material3_fileInput\" id=\"material3_fileInput_\" class=\"material3_fileInput d-none\"></label>',
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
            defaultContent: '<label id=\"material3_newdata\" class=\"material3-newdata-label d-none\"></label>',
            orderable: false
        }
    ],
    createdRow: function(row, data, dataIndex) {
        var attachmentDiv = $(row).find('.material3-attachment-div');
        attachmentDiv.attr('id', 'material3_attachments_div_' + dataIndex);

        var material3_fileInput = $(row).find('.material3_fileInput');
        var inputId = 'material3_fileInput_' + dataIndex;
        material3_fileInput.attr('id', inputId);

        var material3_fileLabel = $(row).find('.material3_fileLabel');
        material3_fileLabel.attr('for', inputId);

        var material3_newdataLabel = $(row).find('.material3-newdata-label');
        material3_newdataLabel.text($('#material3_newdata').text());
    },
    dom: 'Bfrtip',
    searching: false,
    info: false,
    sorting: false,
    paging: false
});

$(document).on('change', '.material3_fileInput', function() {
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
        form_data.append('material3_fileInput', $(this).prop('files')[0]);
        var attachmentDiv = $(row).find('.material3-attachment-div');
        var rowIndex = tableMaterial3.row(row).index();
        $.ajax ({
            url:'./material3_upload.php',
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
                $('#material3_newdata', row).html(data);
            }
        });
    }
});


tableMaterial3.on('click', 'td.editor-edit', function (e) {
    e.preventDefault();
 
    editorMaterial3.edit(e.target.closest('tr'), {
        title: 'Edit record',
        buttons: 'Update'
    });
});
 

tableMaterial3.on('click', 'td.editor-delete', function (e) {
    e.preventDefault();
 
    editorMaterial3.remove(e.target.closest('tr'), {
        title: 'Delete record',
        message: 'Are you sure you wish to remove this record?',
        buttons: 'Delete'
    });
});

function checkAddButtonStatus() {
    const materialValue = editorMaterial3.field('material').val();
    const qtyValue = editorMaterial3.field('qty').val();
    const priceValue = editorMaterial3.field('price').val();

    const addButton = $('.DTE_Form_Buttons button.btn');
    if (materialValue && qtyValue && priceValue && qtyValue !== \"0\" && priceValue !== \"0\" && materialValue !== \"0\" && qtyValue >= \"0\" && priceValue >= \"0\") {
        addButton.prop('disabled', false);
    } else {
        addButton.prop('disabled', true);
    }
}

editorMaterial3.field('material').input().on('keyup change', checkAddButtonStatus);
editorMaterial3.field('qty').input().on('keyup change', checkAddButtonStatus);
editorMaterial3.field('price').input().on('keyup change', checkAddButtonStatus);

checkAddButtonStatus();


</script>

";

echo $display;

?>