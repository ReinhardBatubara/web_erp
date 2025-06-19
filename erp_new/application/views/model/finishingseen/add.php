<div id="finishingseen-form" class="easyui-dialog" 
     data-options="iconCls:'icon-save',resizable:true,modal:true"
     style="width:460px; padding: 5px 5px" closed="true" buttons="#finishingseen-button">
    <form id="finishingseen-input" method="post" novalidate>
        <table width="100%" border="0">            
            <tr>
                <td align="right" width="30%"><label class="field_label">Description :</label></td>
                <td width="70%">
                    <textarea name="description" class="easyui-validatebox" style="width: 99%;height: 45px" required="true"></textarea>
                </td>
            </tr>    
            <tr>
                <td align="right"><label class="field_label">Material :</label></td>
                <td>
                    <input type="hidden" id="finishingseenitemid" name="itemid" class="easyui-validatebox" value="0"/>
                    <input type="text" name="code" id="finishingseenitemcode" class="easyui-validatebox" value=""/>
                    <a href="javascript:void(0)" class="button" onclick="item_dialogsearch('finishingseenitemid', 'finishingseenitemcode', 'finishingseenmaterialdescription', 'finishingseenunitcode')">Select</a>
                </td>
            </tr>
            <tr>
                <td align="right"><label class="field_label">Material Description :</label></td>
                <td>
                    <textarea name="materialdescription" id="finishingseenmaterialdescription" class="easyui-validatebox" readonly="true" style="width: 90%;height: 45px"></textarea>
                </td>
            </tr>
            <tr>
                <td align="right"><label class="field_label">Unit Code :</label></td>
                <td>
                    <input id="finishingseenunitcode" name="unitcode" panelHeight="auto" editable="false"  class="easyui-combobox" data-options="valueField:'id',textField:'text'" required="true" style="width: 80px;">
                </td>
            </tr>
            <tr>
                <td align="right"><label class="field_label">Comment :</label></td>
                <td>
                    <textarea name="comment" class="easyui-validatebox" style="width: 99%;height: 45px"></textarea>
                </td>
            </tr>
            <tr>
                <td align="right"><label class="field_label">Area :</label></td>
                <td><input type="text" class="easyui-numberbox" name="area" precision="2"  size="8" style="text-align: center;"/></td>
            </tr>
            <tr>
                <td align="right"><label class="field_label">Size :</label></td>
                <td>
                    <table width="80%" border="0" style="border-width: 1px;border-collapse: collapse;border-color: #ccccff;" cellpadding="0" cellspacing="0">                        
                        <tr>
                            <td align="center" style="border: 1px solid #ccccff;" width="50%"><b>L</b></td>
                            <td align="center" style="border: 1px solid #ccccff;" width="50%"><b>W</b></td>                            
                        </tr>
                        <tr>
                            <td align="center" style="border: 1px solid #ccccff;padding: 2px;"><input type="text" class="easyui-numberbox" name="size_l" precision="2"  style="width: 90%;text-align: center;"/></td>
                            <td align="center" style="border: 1px solid #ccccff;padding: 2px;"><input type="text" class="easyui-numberbox" name="size_w" precision="2"  style="width: 90%;text-align: center;" /></td>                            
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td align="right"><label class="field_label">Qty :</label></td>
                <td><input type="text" name="qty" style="text-align: center" class="easyui-numberbox" size="5" value=""/></td>
            </tr>
        </table>        
    </form>
</div>
<div id="finishingseen-button">
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-ok" onclick="finishingseen_save()">Save</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="$('#finishingseen-form').dialog('close')">Cancel</a>
</div>
