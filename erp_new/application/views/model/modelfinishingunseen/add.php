<form id="modelfinishingunseen-input" method="post" novalidate>
    <table width="100%" border="0" style="padding-top: 10px;">
        <tr>
            <td align="right" width="30%"><label class="field_label">Description : </label></td>
            <td width="70%"><input type="text" name="description" class="easyui-validatebox" style="width: 250px" required="true"/></td>
        </tr>
        <tr>
            <td align="right"><label class="field_label">Finishing Type : </label></td>
            <td>
                <input class="easyui-combobox" name="finishingtypeid" data-options="
                       url: '<?php echo site_url('finishingtype/get_by_position/3') ?>',
                       method: 'post',
                       valueField: 'id',
                       textField: 'name',
                       panelHeight: '200',
                       formatter: formatFinishingTypeSeen"
                       style="width: 200px" 
                       required="true">
                <script type="text/javascript">
                    function formatFinishingTypeSeen(row){
                        var s = '<span>' + row.name +'</span><br/>' +
                            '<span style="color:#888">Remark: ' + row.remark + '</span>';
                        return s;
                    }
                </script>
            </td>
        </tr>
        <tr>
            <td align="right"><label class="field_label">Area : </label></td>
            <td><input type="text" name="area" class="easyui-numberbox" precision="4" style="width: 100px;text-align: center;"/></td>
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
            <td align="right"><label class="field_label">Qty : </label></td>
            <td><input type="text" name="qty" class="easyui-numberbox" precision="1" style="width: 100px;text-align: center;" required="true"/></td>
        </tr>
        <tr>
            <td align="right"><label class="field_label">Remark : </label></td>
            <td><textarea class="easyui-textbox" name="remark" style="width: 95%;height: 40px"></textarea></td>
        </tr>
    </table>        
</form>