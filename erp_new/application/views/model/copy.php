<div style="width:95%; padding: 3px">
    <form id="model_copy-input" method="post" novalidate>
        <table width="100%" border="0">
            <tr>
                <td align="right" width="30%"><label class="field_label">Original Code :</label></td>
                <td width="70%">
                    <input type="hidden" name="modelid" value="<?php echo $modelid ?>" />
                    <input type="text" name="originalcode" id="c_originalcode" size="40" class="easyui-validatebox" required="true"/>
                </td>
            </tr>
            <tr>
                <td align="right"><label class="field_label">Master Code :</label></td>
                <td><input type="text" name="mastercode" id="c_mastercode" size="40" class="easyui-validatebox"/></td>
            </tr>
            <tr>
                <td align="right"><label class="field_label">Item Code :</label></td>
                <td><input type="text" name="code" id="c_code" size="40" class="easyui-validatebox" required="true"/></td>
            </tr>
            <tr>
                <td align="right"><label class="field_label">Item Name :</label></td>
                <td><input type="text" name="name" id="c_name" size="40" class="easyui-validatebox" required="true"/></td>
            </tr>
        </table>
    </form>
</div>
