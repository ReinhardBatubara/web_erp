<div style="height: 500px">
    <div id="mrp_list_to_request-toolbar" style="padding-bottom: 2px;">
        Code : 
        <input type="text" 
               size="12" 
               class="easyui-validatebox" 
               id="mr_detail_code_s_" 
               onkeyup="if (event.keyCode === 13) {materialwithdrawdetail_from_mrp_searchfordialog();}" 
               />    
        Description : 
        <input type="text" 
               size="20" 
               class="easyui-validatebox" 
               id="mr_detail_description_s" 
               onkeyup="if (event.keyCode === 13) {materialwithdrawdetail_from_mrp_searchfordialog();}"
               />
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-search" plain="true" onclick="materialwithdrawdetail_from_mrp_searchfordialog()">Search</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-pointer" plain="true" onclick="materialwithdrawdetail_set_selected_from_mrp()">Set Selected</a>  
    </div>
    <table id="mrp_list_to_request" data-options="
           url:'<?php echo site_url('joborder/get_mrp/' . $joborderid) ?>',
           method:'post',
           border:false,
           singleSelect:true,
           fit:true,
           rownumbers:true,
           fitColumns:true,
           pagination:false,
           striped:true,
           idField:'id',
           toolbar:'#mrp_list_to_request-toolbar'">
        <thead>
            <tr>
                <th field="itemcode" width="80" halign="center">Item Code</th>
                <th field="itemdescription" width="180" halign="center">Item Description</th>
                <th field="unitcode" width="40" align="center">Unit</th>
                <th field="ots_withdraw" width="50" halign="center" align="right">Ots Withdraw</th>
            </tr>
        </thead>
    </table>
    <script type="text/javascript">
        $(function () {
            $('#mrp_list_to_request').datagrid({
                onDblClickRow: function(index, row) {
                    //alert(row.itemcode);
                    $('#mrdetail_itemid_from_jo').val(row.itemid);
                    $('#mrdetail_code_from_jo').val(row.itemcode);
                    $('#mrdetail_description_from_jo').val(row.itemdescription);
                    $('#mrdetail_unitcode_from_jo').val(row.unitcode);
                    $('#mrpid_').val(row.id);
                    
                    if(mrp_frst_id === row.id){
                        var new_ots = parseFloat($('#mrdetail_qty_inputed').val()) + parseFloat(row.ots_withdraw);
                        $('#ots_qty_from_jo').val(new_ots);
                    }else{
                        $('#ots_qty_from_jo').val(row.ots_withdraw);
                    }
                    
                    $('#mw_dialog').dialog('close');
                }
            });
        });
    </script>
</div>