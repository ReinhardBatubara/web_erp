<div id="costingmaterial-form" class="easyui-dialog" 
     data-options="iconCls:'icon-save',resizable:true,modal:true"
     style="width:460px; padding: 5px 5px" closed="true" buttons="#costingmaterial-button">
    <form id="costingmaterial-input" method="post" novalidate class="table_form">
        <table width="100%" border="0">
            <tr>
                <td align="right"><label class="field_label">Category :</td>
                <td>
                    <input type="hidden" name="costingid" id="costingmaterial-costingid" />
                    <input type="hidden" name="modelid" id="costingmaterial-modelid" />
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
                    <input type="hidden" id="costingmaterialitemid" name="itemid" class="easyui-validatebox" value="0"/>
                    <input type="text" name="code" id="costingmaterialitemcode" class="easyui-validatebox" value=""/>
                    <a href="javascript:void(0)" class="button" onclick="item_dialogsearch('costingmaterialitemid', 'costingmaterialitemcode', 'costingmaterialmaterialdescription', 'costingmaterialunitcode')">Select</a>
                </td>
            </tr>
            <tr>
                <td align="right"><label class="field_label">Material Description :</label></td>
                <td>
                    <textarea name="materialdescription" id="costingmaterialmaterialdescription" class="easyui-validatebox" readonly="true" style="width: 90%;height: 45px"></textarea>
                </td>
            </tr>
            <tr>
                <td align="right"><label class="field_label">Unit Code :</td>
                <td>
                    <input id="costingmaterialunitcode" name="unitcode" panelHeight="auto" editable="false" class="easyui-combobox" panelHeight="auto" editable="false" data-options="valueField:'id',textField:'text'" required="true" style="width: 80px;">
                </td>
            </tr>
            <tr>
                <td align="right"><label class="field_label">Yield :</label></td>
                <td><input type="text" name="yield" style="text-align: center" class="easyui-numberbox" size="5" required="true" value=""/> %</td>
            </tr>
            <tr>
                <td align="right"><label class="field_label">Qty :</label></td>
                <td><input type="text" name="qty" style="text-align: center" class="easyui-numberbox" precision="4" size="5" required="true" value=""/></td>
            </tr>
        </table>        
    </form>
</div>
<div id="costingmaterial-button">
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-ok" onclick="costingmaterial_save_material()">Save</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="$('#costingmaterial-form').dialog('close')">Cancel</a>
</div>
