<div id="costingdetail_toolbar" style="padding-bottom: 2px;">
    Category : <select id="costingdetail_costingmaterialgroupid_s" class="easyui-combobox" panelHeight='auto' editable='false'>
        <option value="">All</option>
        <?php
        foreach ($costingmaterialgroup as $result) {
            echo "<option value='" . $result->id . "'>" . $result->name . "</option>";
        }
        ?>
    </select>
    <script>
        $('#costingdetail_costingmaterialgroupid_s').combobox({
            onSelect: function () {
                costingdetail_search();
            }
        });
    </script>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-search" plain="true" onclick="costingdetail_search()"></a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="costingdetail_add_material()">Add</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="costingdetail_edit_material()">Edit</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="costingdetail_remove_material()">Remove</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add2" plain="true" onclick="costingdetail_add_special_material()">Add Special Material</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-copy" plain="true" onclick="costingdetail_copy_from()">Copy From</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-save" plain="true" onclick="costingdetail_save()">Save</a>
    <a href="javascript:void(0)" 
       class="easyui-menubutton" 
       iconCls="icon-move" 
       plain="true"
       data-options="menu:'#mm-costing'">Move To</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-load" plain="true" id="costingdetail-load-price" onclick="costingdetail_load_price()">Load Price</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-save2" plain="true" id="costingdetail-save-loaded-price" style="display: none" onclick="costingdetail_save_load_price()">Save Changed Price</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel2" plain="true" id="costingdetail-cancel-save-loaded-price" style="display: none" onclick="costingdetail_cancel_save_load_price()">Cancel</a>
</div>
<div id="mm-costing" class="easyui-menu">
    <?php
    foreach ($costingmaterialgroup as $result2) {
        ?>
        <div onclick="costingdetail_move('<?php echo $result2->id ?>')"><span><?php echo $result2->name ?></span></div>
        <?php
    }
    ?>    
</div>
<table id="costingdetail" data-options="
       url: '<?php echo site_url('costing/get_material') ?>',
       singleSelect:true,
       collapsible:true,
       rownumbers:true,
       fitColumns:false,
       border:false,
       showFooter: true,
       fit:true,
       view:groupview,
       toolbar:'#costingdetail_toolbar',
       groupField:'costing_group',
       groupFormatter:function(value,rows){
       return '<b>'+ value +  '</b>';
       }">
    <thead>
        <tr>
            <th field="id" hidden="true"></th>
            <th field="costingdetail_chck" checkbox="true"></th>
            <th field="itemcode" width="100" halign="center">Material Code</th>
            <th field="itemname" width="300" halign="center">Material Name</th>
            <th field="qty" width="50" align="center">Qty</th>
            <th field="yield" width="50" align="center" data-options="editor:{type:'numberbox',options:{precision:0}}">Yield %</th>
            <th field="gross_qty" width="60" align="center">Gross</th>
            <th field="unitcode" width="50" align="center">Unit</th>
            <th field="cost" width="100" halign="center" align="right" data-options="editor:{type:'numberbox',options:{precision:2}}">Cost</th>
            <th field="total_cost" width="100" halign="center" align="right" styler="cellStyler">Total</th>
            <th field="remark" width="180" halign="center" styler="remark_cellStyler">Remark</th>
        </tr>
    </thead>
</table>
<script type="text/javascript">
    $(function () {
        temp_index = 0;
        $('#costingdetail').datagrid({
            rowStyler: function (index, row) {
                var id_field = parseInt(row.id);
                if (id_field < 0) {
                    return 'background-color:#6293BB;color:#fff;font-weight:bold;';
                }
                if(row.special_material == 't'){
                    return 'color:#6c3600;';
                }else{
                    if(row.model_material_summary_id == 0){
                        return 'color:#004000;';
                    }
                }
            },
            onLoadSuccess: function (data) {

            },
            onDblClickRow: function (rowIndex, row) {
                var _id = parseInt(row.id);
                if (_id > 0) {
                    $('#costingdetail').datagrid('beginEdit', rowIndex);
                    temp_index = rowIndex;
                }
            },
            onClickRow: function (rowIndex, row) {
                var _id = parseInt(row.id);
                if(_id < 0){
                    $('#costingdetail').datagrid('unselectRow', rowIndex);   
                }
                $('#costingdetail').datagrid('endEdit', temp_index);
            }
        });
    });

    function cellStyler(value, row, index) {
        if (value <= 0 && parseInt(row.id) > 0) {
            return 'background-color:#ffee00;color:red;';
        }
    }

    function remark_cellStyler(value, row, index) {
        if (value !== null && value !== '' && parseInt(row.id) > 0) {
            return 'background-color:#fff4f4;';
        }
    }
</script>
<?php
$this->load->view('costing/add_material');
