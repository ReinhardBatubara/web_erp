<div id="item-form" class="easyui-dialog" 
     data-options="iconCls:'icon-save',resizable:true,modal:true"
     style="width:400px; padding: 5px 5px" closed="true" buttons="#item-button">
    <form id="item-input" method="post" novalidate enctype="multipart/form-data">
        <table width="100%" border="0">
            <tr>
                <td width="35%" align="right"><label class="field_label">Code :</label></td>
                <td width="65%"><input type="text" name="code" id="code" class="easyui-validatebox" required="true"/></td>
            </tr>
            <tr>
                <td align="right"><label class="field_label">Description :</label></td>
                <td><textarea id="description" name="description" style="width: 90%; height: 40px;" class="easyui-validatebox" required="true"></textarea></td>  
            </tr>
            <tr>
                <td align="right"><label class="field_label">Group :</label></td>
                <td>

                    <input class="easyui-combobox" name="groupid" data-options="
                           url: '<?php echo site_url('itemgroup/get') ?>',
                           method: 'post',
                           valueField: 'id',
                           textField: 'name',
                           mode: 'remote',
                           panelHeight: '200',
                           formatter: formatGroup"
                           style="width: 150px" 
                           required="true">
                    <script type="text/javascript">
                        function formatGroup(row){
                            var s = '<span style="font-weight:bold">' + row.code +'</span><br/>' +
                                    '<span style="color:#888">Name: ' + row.name +'</span><br/>';
                            return s;
                        }
                    </script>
                </td>
            </tr>
            <tr>
                <td align="right"><label class="field_label">Category :</label></td>
                <td>
                    <select id="category" name="category" class="easyui-combobox" required="true" style="width: 80px" panelHeight="auto" panelWidth="90">
                        <option value="1">Local</option>
                        <option value="2">Import</option>
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
    </form>
</div>
<div id="item-button">
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-ok" onclick="item_save()">Save</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="$('#item-form').dialog('close')">Cancel</a>
</div>