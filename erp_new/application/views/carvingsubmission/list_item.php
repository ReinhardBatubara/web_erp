<div id="carvingsubmission_list_item_toolbar" style="padding-bottom: 0px;">
    <form id="carvingsubmission_list_item_search_form" style="margin-bottom: 0px" onsubmit="return false;">
        Search: 
        <input type="text" 
               size="25" 
               name="itemcode" 
               id="cli_s_type"
               class="easyui-validatebox"
               onkeyup="if (event.keyCode === 13) {
                           carvingsubmission_list_item_search();
                       }"/>        
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-search" plain="true" onclick="carvingsubmission_list_item_search()"></a>        
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="carvingsubmission_list_item_add()">Add</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="carvingsubmission_list_item_edit()">Edit</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="carvingsubmission_list_item_delete()">Delete</a>
    </form>
</div>
<table id="carvingsubmission_list_item" data-options="
       url:'<?php echo site_url('carvingsubmission/list_item_get') ?>',
       method:'post',
       border:false,
       singleSelect:true,
       fit:true,
       pageSize:30,
       pageList: [30, 50, 70, 90, 110],
       rownumbers:true,
       fitColumns:true,
       pagination:true,
       striped:true,
       toolbar:'#carvingsubmission_list_item_toolbar'">
    <thead>
        <tr>
            <th field="imagename" width="120" halign="center" rowspan="2" formatter="cp_item_list_display_image">Product Photo</th>
            <th field="serial" width="90" halign="center" rowspan="2">Barcode / Serial</th>
            <th field="code" width="90" halign="center" rowspan="2">Item Code</th>
            <th field="originalcode" width="90" halign="center" rowspan="2">Original Code</th>
            <th field="name" width="180" halign="center" rowspan="2">Item Name</th>
            <th align="center" colspan="3">Item Size (MM)</th>
            <th field="price" width="100" align="right" halign='center' rowspan="2" formatter="formatPrice">Price</th>
            <th field="status" width="90" halign="center" rowspan="2">Status</th>
            <th field="remark" width="400" rowspan="2">Remark</th>
        </tr>
        <tr>
            <th field="itemsize_mm_w" width="50" align="center">W</th>
            <th field="itemsize_mm_d" width="50" align="center">D</th>
            <th field="itemsize_mm_h" width="50" align="center">H</th>
        </tr>
    </thead>
</table>
<script type="text/javascript">
    $(function () {
        $('#carvingsubmission_list_item').datagrid();
    });
    function cp_item_list_display_image(value, row, index) {
        return "<center><img src='files/model/" + value + "' style='max-width:50px;max-height:50px;padding:1px;border:none;'></center>";
    }
</script>
<?php
$this->load->view('carvingsubmission/list_item_input_form');
