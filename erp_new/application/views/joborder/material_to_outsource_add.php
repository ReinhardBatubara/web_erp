<form id="joborder_material_to_oursource-input" method="post" novalidate>
    <table width="100%" border="0">
        <tr>
            <td align="right" width="30%"><label class="field_label">Material :</label></td>
            <td width="70%">
                <input type="hidden" id="jmtoitemid" name="itemid" class="easyui-validatebox" value="0"/>
                <input type="text" name="code" id="jmtoitemcode" class="easyui-validatebox" value=""/>
                <a href="javascript:void(0)" class="button" onclick="item_dialogsearch('jmtoitemid', 'jmtoitemcode', 'jmtomaterialdescription', 'jmtounitcode')">Select</a>
            </td>
        </tr>
        <tr>
            <td align="right"><label class="field_label">Material Description :</label></td>
            <td>
                <textarea name="materialdescription" id="jmtomaterialdescription" class="easyui-validatebox" readonly="true" style="width: 90%;height: 45px"></textarea>
            </td>
        </tr>
        <tr>
            <td align="right"><label class="field_label">Unit Code :</label></td>
            <td>
                <input id="jmtounitcode" name="unitcode" panelHeight="auto" editable="false" class="easyui-combobox" panelHeight="auto" data-options="valueField:'id',textField:'text'" required="true" style="width: 80px;">
            </td>
        </tr>
        <tr>
            <td align="right"><label class="field_label">Qty :</label></td>
            <td><input type="text" name="qty" style="text-align: center" class="easyui-numberbox" size="5" value="" required="true"/></td>
        </tr>
        <tr>
            <td align="right"><label class="field_label">Remark :</label></td>
            <td>
                <textarea name="remark" id="remark" class="easyui-validatebox" style="width: 90%;height: 45px"></textarea>
            </td>
        </tr>
    </table>        
</form>