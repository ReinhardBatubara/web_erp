<form id="quotationdetail-input" method="post" novalidate enctype="multipart/form-data" class="table_form" style="padding: 2px">
    <table width="100%" border="0">
        <tr>
            <td align="right" width="40%"><label class="field_label">Item Code : </label></td>
            <td>
                <input type="text" class="easyui-validatebox" name="item_code" style="width: 250px" required="true"/>                
            </td>
        </tr>

        <tr>
            <td align="right"><label class="field_label">Item Name : </label></td>
            <td>
                <input type="text" class="easyui-validatebox" name="item_name" style="width: 250px" required="true"/>                
            </td>
        </tr>
        <tr>
            <td align="right"><label class="field_label">Dimension (WxDxH) : </label></td>
            <td>
                <input type="text" class="easyui-numberbox" name="item_size_w" required="true" precision="0" style="width: 60px;text-align: center;"/> X
                <input type="text" class="easyui-numberbox" name="item_size_d" required="true" precision="0"  style="width: 60px;text-align: center;" /> X 
                <input type="text" class="easyui-numberbox" name="item_size_h" required="true" precision="0"  style="width: 60px;text-align: center;" />
            </td>
        </tr>
        <tr>
            <td align="right"><label class="field_label">Finishing : </label></td>
            <td>
                <input type="text" id="quo_finishingcode" style="width: 250px" name="finishingcode"/>
                <script type="text/javascript">
                    $('#quo_finishingcode').combogrid({
                        panelWidth: 350,
                        mode: 'remote',
                        idField: 'code',
                        textField: 'description',
                        url: '<?php echo site_url('finishing/get_remote_data') ?>',
                        columns: [[
                                {field: 'code', title: 'Code', width: 100, halign: 'center'},
                                {field: 'description', title: 'Description', width: 200, halign: 'center'}
                            ]]
                    });
                </script>
            </td>
        </tr>
        <tr>
            <td align="right"><label class="field_label">Price :</label></td>
            <td><input type="text" name="price" id="quo_model_price" class="easyui-numberbox" style="text-align: right;width: 250px" precision="2" groupSeparator="," required="true" value=""/></td>
        </tr>        
        <tr>
            <td align="right"><label class="field_label">Remark : </label></td>
            <td>
                <textarea name="remark" class="easyui-validatebox" style="width: 250px;height: 30px"></textarea>
            </td>
        </tr> 
        <tr>
            <td align="right"><label class="field_label">Image :</label></td>
            <td><input type="text" name="fileupload" class="easyui-filebox" style="width: 250px" required="true" /></td>
        </tr>
    </table>      
</form>