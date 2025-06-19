<table width="99%" border="0" align="center">
    <tr>
        <td width="15%" align="right"><label class="field_label">Item Code :</label></td>
        <td width="85%">
            <input type="text" name="code" id="code" class="easyui-validatebox" required="true" style="width: 200px;"/>
            <label class="field_label">Group : </label>
            <select id="groupid" name="groupid" class="easyui-combobox" style="width: 98%" required="true" panelHeight="150" panelWidth="90">
                <option value=""></option>                        
                <?php
                foreach ($itemgroup as $result) {
                    echo "<option value='" . $result->id . "'>" . $result->name . "</option>";
                }
                ?>
            </select>
            <label class="field_label">Category : </label>
            <select id="category" name="category" class="easyui-combobox" required="true" style="width: 90%" panelHeight="auto" panelWidth="90">
                <option value="1">Local</option>
                <option value="2">Import</option>
<!--                <option value="3">Mix</option>-->
            </select> 
        </td>
    </tr>
    <tr>
        <td align="right"><label class="field_label">Description :</label></td>
        <td><textarea id="description" name="description" style="width: 90%; height: 40px;" class="easyui-validatebox" required="true"></textarea></td>
    </tr>
    <tr>
        <td align="right"><label class="field_label">Base Unit :</label></td>
        <td>
            <select name="unitcode" id="unitcode" class="easyui-combobox" required="true" style="width: 80px;">
                <option value=""></option>
                <?php
                foreach ($unit as $result) {
                    echo "<option value='" . $result->code . "'>" . $result->name . "</option>";
                }
                ?>
            </select>
            <label class="field_label">MOQ :</label>
            <input type="text" name="moq" id="moq" size="5" class="easyui-numberbox" value="1" style="text-align: center"/>
            <label class="field_label">RoP:</label>
            <input type="tex" name="reorderpoint" id="reorderpoint" size="5" style="text-align: center;" class="easyui-numberbox"/>*Base Unit
            &nbsp;&nbsp;<label class="field_label">Lead Time :</label>
            <input type="text" name="lt" id="lt" size="5" style="text-align: center" class="easyui-numberbox"/>
        </td>
    </tr>
</table>

<!--<table width="680" border="0" align="center">
    
    <tr>
        <td width="330" valign="top">
            <table width="100%" border="0">
                <tr>
                    <td width="35%" align="right"><label class="field_label">Item Code :</label></td>
                    <td width="65%"><input type="text" name="code" id="code" class="easyui-validatebox" required="true"/></td>
                </tr>
                <tr>
                    <td align="right"><label class="field_label">Description :</label></td>
                    <td><textarea id="description" name="description" style="width: 90%; height: 40px;" class="easyui-validatebox" required="true"></textarea></td>  
                </tr>
                <tr>
                    <td align="right"><label class="field_label">Group :</label></td>
                    <td>
                        <select id="groupid" name="groupid" class="easyui-combobox" style="width: 90%" required="true" panelHeight="150" panelWidth="90">
                            <option value=""></option>                        
<?php
foreach ($itemgroup as $result) {
    echo "<option value='" . $result->id . "'>" . $result->name . "</option>";
}
?>
                        </select>                    
                    </td>
                </tr>
                <tr>
                    <td align="right"><label class="field_label">Category :</label></td>
                    <td>
                        <select id="category" name="category" class="easyui-combobox" required="true" style="width: 90%" panelHeight="auto" panelWidth="90">
                            <option value="1">Local</option>
                            <option value="2">Import</option>
                            <option value="3">Mix</option>
                        </select>         
                    </td>
                </tr>
                <tr>
                    <td align="right"><label class="field_label">Yield :</label></td>
                    <td><input type="text" size="5" maxlength="3" style="text-align: center;" value="0" id="yield" name="yield" class="easyui-numberbox"/> %</td>
                </tr>
                <tr>
                    <td align="right"><label class="field_label">Base Unit :</label></td>
                    <td>
                        <select name="unitcode" id="unitcode" class="easyui-combobox" required="true" style="width: 100px;">
                            <option value=""></option>
<?php
foreach ($unit as $result) {
    echo "<option value='" . $result->code . "'>" . $result->name . "</option>";
}
?>
                        </select>                        
                    </td>
                </tr>
                <tr>
                    <td align="right"><label class="field_label">Re-order Point :</label></td>
                    <td><input type="tex" name="reorderpoint" id="reorderpoint" size="5" style="text-align: center;" class="easyui-numberbox"/> *In Base Unit</td>
                </tr>
                <tr>
                    <td align="right"><label class="field_label">MOQ :</label></td>
                    <td><input type="text" name="moq" id="moq" size="5" class="easyui-numberbox" value="1" style="text-align: center"/></td>
                </tr>
                <tr>
                    <td align="right"><label class="field_label">Lead Time :</label></td>
                    <td><input type="text" name="lt" id="lt" size="5" style="text-align: center" class="easyui-numberbox"/></td>
                </tr>
                <tr>
                    <td align="right"><label class="field_label">Check On Receive :</label></td>
                    <td>
                        <select name="qccheck" class="easyui-combobox" panelHeight="auto" required="true">
                            <option value="true">Yes</option>
                            <option value="false">No</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td align="right"><label class="field_label">Original Price :</label></td>
                    <td><input type="tex" name="originalprice" id="originalprice" size="15" style="text-align: right;" class="easyui-numberbox" precision="2"/></td>
                </tr>
                <tr>
                    <td align="right"><label class="field_label">Sell/Costing Price :</label></td>
                    <td><input type="tex" name="costingprice" id="costingprice" size="15" style="text-align: right;" class="easyui-numberbox" precision="2"/></td>
                </tr>
                <tr>
                    <td align="right"><label class="field_label">Currency :</label></td>
                    <td>                                
                        <select name="currency" class="easyui-combobox" panelHeight="auto">
<?php
foreach ($currency as $result) {
    echo "<option value='$result->code'>$result->code</option>";
}
?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td align="right"><label class="field_label">Image :</label></td>
                    <td><input type="file" name="fileupload" id="fileupload" style="width: 150px"/></td>
                </tr>
            </table>
        </td>
        <td width="330" valign="top" align="center">
            <div style="width: 330px;height: 400px">
                <div id="tt-item" class="easyui-tabs" data-options="fit:true,tabHeight:20">
                    <div title="Home">
                        <div class="easyui-panel" fit="true">

                        </div>
                    </div>
                </div>
            </div>
        </td>
    </tr>
</table>-->
