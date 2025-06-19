<div style="height: 400px">
    <div id="jo_print_barcode_custom_detail_item_toolbar" style="padding-bottom:0;">
        <form id="jo_print_barcode_custom_detail_item_form_search" style="margin: 0">
            Serial :
            <input type="text" 
                   class="easyui-validatebox" 
                   size="25" 
                   name="serial"
                   onkeyup="if (event.keyCode == 13) {
                               joborder_print_barcode_custom_item_search()
                           }"
                   />
            Item Code :
            <input type="text" 
                   class="easyui-validatebox" 
                   size="15" 
                   name="itemcode"
                   onkeyup="if (event.keyCode == 13) {
                               joborder_print_barcode_custom_item_search()
                           }"
                   />
            Item Name :
            <input type="text" 
                   class="easyui-validatebox" 
                   size="15"
                   name="itemname"
                   onkeyup="if (event.keyCode == 13) {
                               joborder_print_barcode_custom_item_search()
                           }"
                   />
            SO :
            <input type="text" 
                   class="easyui-validatebox" 
                   size="15" 
                   name="so"
                   onkeyup="if (event.keyCode == 13) {
                               joborder_print_barcode_custom_item_search()
                           }"
                   />
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-search" plain="true" onclick="joborder_print_barcode_custom_item_search()"></a>
        </form>
    </div>
    <table id="jo_print_barcode_custom_detail_item" data-options="
           url:'<?php echo site_url('joborder/get_detail_item/' . $joborderid) ?>',
           method:'post',
           border:false,
           singleSelect:false,
           fit:true,
           rownumbers:true,
           fitColumns:true,
           pagination:false,
           striped:true,
           toolbar:'#jo_print_barcode_custom_detail_item_toolbar'">
        <thead>
            <tr>
                <th field="pbc_chck" checkbox="true" />
                <th field="serial" width="120" halign="center">Serial</th>
                <th field="sonumber" width="100" halign="center">SO NO</th>            
                <th field="itemcode" width="130" halign="center">Item Code</th>
                <th field="itemname" width="200" halign="center">Item Name</th>            
                <th field="customer" width="200" halign="center">Customer</th>
            </tr>
        </thead>
    </table>
    <script type="text/javascript">
        $(function () {
            $('#jo_print_barcode_custom_detail_item').datagrid({
            });
        });
    </script>
</div>
