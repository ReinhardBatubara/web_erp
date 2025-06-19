<div style="height: 400px">
    <div id="view_bom_toolbar" style="padding-bottom: 0px;min-height: 25px;">
        <form id="view_bom_search_form" style="margin-bottom: 0px">
            Item Code : <input type="text" size="12" class="easyui-validatebox" name="itemcode" onkeypress="if (event.keyCode == 13) {model_bom_search(<?php echo $modelid ?>)}"/>
            Item Description : <input type="text" size="12" class="easyui-validatebox" name="itemdescription" onkeypress="if (event.keyCode == 13) {model_bom_search(<?php echo $modelid ?>)}"/>
            Unit Code <select name="unitcode" id="unitcode" class="easyui-combobox" style="width: 100px;">
                <option value=""></option>
                <?php
                foreach ($unit as $result) {
                    echo "<option value='" . $result->code . "'>" . $result->name . "</option>";
                }
                ?>
            </select>
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-search" plain="true" onclick="model_bom_search(<?php echo $modelid ?>)"></a>
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-print" plain="true" onclick="model_bom_print(<?php echo $modelid ?>)"> Print</a>

        </form>
    </div>
    <table id="view_bom" data-options="
           url:'<?php echo site_url('model/get_bom/' . $modelid) ?>',
           method:'post',
           border:false,
           singleSelect:true,
           fit:true,
           rownumbers:true,
           fitColumns:true,
           pagination:false,
           striped:true,
           toolbar:'#view_bom_toolbar'">
        <thead>
            <tr>
                <th field="itemcode" width="100" halign="center">Item Code</th>            
                <th field="itemdescription" width="200" halign="center">Item Description</th> 
                <th field="unitcode" width="100" align="center">Unit Code</th> 
                <th field="qty" width="100" halign="center" align="right">Qty</th> 
            </tr>
        </thead>
    </table>
    <script type="text/javascript">
        $(function() {
            $('#view_bom').datagrid();
        });
    </script>
</div>


