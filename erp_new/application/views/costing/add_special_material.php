<form id="costingmaterial_special_material_input" method="post" novalidate class="table_form">
    <table width="100%" border="0">
        <tr>
            <td align="right"><label class="field_label">Category :</td>
            <td>
                <select class="easyui-combobox" name="costingmaterialgroupid" panelHeight="auto" editable="false" required="true">
                    <?php
                    foreach ($costingmaterialgroup as $result) {
                        echo "<option value='" . $result->id . "'>" . $result->name . "</option>";
                    }
                    ?> 
                </select>
            </td>
        </tr>
        <tr>
            <td align="right" width="30%"><label class="field_label">Material Code :</label></td>
            <td>
                <input type="text" name="itemcode" id="costingmaterialitemcode" class="easyui-validatebox" style="width: 200px"/>
            </td>
        </tr>
        <tr>
            <td align="right"><label class="field_label">Material Description :</label></td>
            <td>
                <textarea name="itemname" id="costingmaterialmaterialdescription" class="easyui-validatebox"  required="true" style="width: 90%;height: 45px"></textarea>
            </td>
        </tr>
        <tr>
            <td align="right"><label class="field_label">Unit Code :</td>
            <td>
                <input class="easyui-combobox" name="unitcode" data-options="
                       url: '<?php echo site_url('unit/get') ?>',
                       method: 'post',
                       valueField: 'code',
                       textField: 'name',
                       panelHeight: '100',
                       formatter: formatCostingAddSpecialMaterialUnit"
                       style="width: 100px" 
                       required="true">
                <script type="text/javascript">
                    function formatCostingAddSpecialMaterialUnit(row){
                        return '<span>' + row.code +'</span><br/>';
                    }
                </script>
            </td>
        </tr>
        <tr>
            <td align="right"><label class="field_label">Yield :</label></td>
            <td><input type="text" name="yield" style="text-align: center" class="easyui-numberbox" size="5" required="true"/> %</td>
        </tr>
        <tr>
            <td align="right"><label class="field_label">Qty :</label></td>
            <td><input type="text" name="qty" style="text-align: center" class="easyui-numberbox" precision="4" size="5" required="true"/></td>
        </tr>
        <tr>
            <td align="right"><label class="field_label">Unit Cost :</label></td>
            <td><input type="text" name="cost" style="text-align: right" class="easyui-numberbox" precision="4" size="20" required="true"/></td>
        </tr>
    </table>        
</form>