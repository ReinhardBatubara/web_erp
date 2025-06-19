<div id="joborder_toolbar">
    JO NO
    <input type="text" 
           class="easyui-validatebox" 
           id="jo_search_number50" 
           style="width: 100px"
           onkeyup="if (event.keyCode == 13) {
                     joborder_search()
                 }"
           />
    Order Type
    <select class="easyui-combobox" data-options="onChange:function(o,n){joborder_search()}" id="jo_search_order_type50" panelHeight="auto">
        <option value=""></option>
        <option value="Order">Order</option>
        <option value="Stock/Sample">Stock/Sample</option>
    </select>
    Status
    <select class="easyui-combobox" data-options="onChange:function(o,n){joborder_search()}" id="jo_search_status51" panelHeight="auto">
        <option value=""></option>
        <option value="0">Not Submit</option>
        <option value="1">Not Release</option>
        <option value="3">Release</option>
        <option value="4">Finish</option>
    </select>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-search" plain="true" onclick="joborder_search()"></a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="joborder_add()">Add</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" id='joborder_btn_edit' plain="true" onclick="joborder_edit()">Edit</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" id='joborder_btn_delete' plain="true" onclick="joborder_delete()">Delete</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-print" id='joborder_btn_delete' plain="true" onclick="joborder_print()">Print</a>
    <a href="javascript:void(0)" id="jo_close" class="easyui-linkbutton" iconCls="icon-material-to-outsource" plain="true" onclick="joborder_material_to_outsource()">Material to Outsource</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-process_approve" id='joborder_btn_submit_to_create_mrp' plain="true" onclick="joborder_submit_to_create_mrp()">Submit to Create MRP >></a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-release" id='joborder_btn_release' plain="true" onclick="joborder_release()">Release</a>
    <a href="javascript:void(0)" id="joborder_close" class="easyui-linkbutton" iconCls="icon-close" plain="true" onclick="joborder_close()">Close JO</a>
</div>
<table id="joborder" data-options="
       url:'<?php echo site_url('joborder/get') ?>',
       method:'post',
       border:false,
       singleSelect:true,
       fit:true,
       pageSize:30,
       pageList: [30, 60, 90, 120],
       rownumbers:true,
       fitColumns:true,
       nowrap:false,
       pagination:true,
       striped:true,
       idField:'id',
       sortName:'id',
       sortOrder:'desc',
       toolbar:'#joborder_toolbar'">
    <thead>
        <tr>
            <th field="joborder_no" width="80" halign="center" sortable="true">JO NO</th>        
            <th field="project_name" width="150" halign="center" sortable="true">Project Name</th>
            <th field="week" width="50" align="center" sortable="true">Week</th>
            <th field="order_type" width="100" halign="center" sortable="true">Order Type</th>
            <th field="release_date_f" width="80" align="center" sortable="true">Release Date</th>
            <th field="release_by" width="100" halign="center" sortable="true">Release By</th>
            <th field="expected_delivery_date_f" width="80" align="center" sortable="true">Exp.Date</th>
            <th field="status_remark" width="110" halign="center" sortable="true">Status</th>
            <th field="remark" width="300" halign="center">Remark</th>
        </tr>
    </thead>
</table>
<script type="text/javascript">
    $(function () {
        $('#joborder').datagrid({
            onSelect: function (value, row, index) {
                $('#joborderitem').datagrid('reload', {
                    joborderid: row.id
                });
                $('#allocated_process').datagrid('reload', {
                    joborderid: row.id
                });
                $('#joborderoutsource').datagrid('reload', {
                    joborderid: row.id
                });

                if (row.status == '0') {
                    $('#joborder_btn_edit').linkbutton('enable');
                    $('#joborder_btn_delete').linkbutton('enable');
                    $('#joborderitemitem_btn_add').linkbutton('enable');
//                    $('#joborderitemitem_btn_edit').linkbutton('enable');
//                    $('#joborderitemitem_btn_delete').linkbutton('enable');
                    $('#allocated_process_btn_add').linkbutton('enable');
                    $('#allocated_process_btn_edit').linkbutton('enable');
                    $('#allocated_process_btn_delete').linkbutton('enable');
                    $('#joborderoutsource_btn_add').linkbutton('enable');
                    $('#joborderoutsource_btn_delete').linkbutton('enable');
                    $('#joborder_btn_submit_to_create_mrp').linkbutton('enable');
                    $('#joborder_generate_barcode').linkbutton('disable');
//                    $('#joborder_print_barcode').linkbutton('disable');
                    $('#joborder_print_sticker').linkbutton('disable');
                    $('#joborder_btn_view_detail_item').linkbutton('disable');
                    $('#joborder_btn_release').linkbutton('disable');
                } else {
                    $('#joborder_btn_edit').linkbutton('disable');
                    $('#joborder_btn_delete').linkbutton('disable');
                    $('#joborderitemitem_btn_add').linkbutton('disable');
//                    $('#joborderitemitem_btn_edit').linkbutton('disable');
//                    $('#joborderitemitem_btn_delete').linkbutton('disable');
                    $('#allocated_process_btn_add').linkbutton('disable');
                    $('#allocated_process_btn_edit').linkbutton('disable');
                    $('#allocated_process_btn_delete').linkbutton('disable');
                    $('#joborderoutsource_btn_add').linkbutton('disable');
                    $('#joborderoutsource_btn_delete').linkbutton('disable');
                    $('#joborder_btn_submit_to_create_mrp').linkbutton('disable');

                    if (row.generated_barcode == 1) {
                        $('#joborder_generate_barcode').linkbutton('disable');
//                        $('#joborder_print_barcode').linkbutton('enable');
                        $('#joborder_print_sticker').linkbutton('enable');
                        $('#joborder_btn_view_detail_item').linkbutton('enable');
                    } else {
                        $('#joborder_generate_barcode').linkbutton('enable');
//                        $('#joborder_print_barcode').linkbutton('disable');                        
                        $('#joborder_print_sticker').linkbutton('disable');
                        $('#joborder_btn_view_detail_item').linkbutton('disable');
                    }
                    if (row.status == '3') {
                        $('#allocated_process_btn_configure').linkbutton('disable');
                        $('#joborder_btn_release').linkbutton('disable');
                        $('#joborder_close').linkbutton('enable');
                    } else {
                        $('#allocated_process_btn_configure').linkbutton('enable');
                        $('#joborder_btn_release').linkbutton('enable');
                        $('#joborder_close').linkbutton('disable');
                    }

                }
            },
            rowStyler: function (index, row) {
                if (row.status == 3) {
                    return 'background-color:#f4fff4';
                }
                if (row.status == 0 || row.status == 1) {
                    return 'background-color:#ffcccc';
                }
                if (row.status == 2) {
                    return 'background-color:#f4fff4';
                }
            }

        });
    });
</script>
<div id="mto_v_temp"></div>
<div id="temp_edit_specification_item"></div>
<div id="temp_shipment"></div>
<script src="<?php echo base_url() ?>js/salesorderdetail.js"></script>
<?php
$this->load->view('joborder/create');

