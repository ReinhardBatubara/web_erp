<form id="model_add_stock50_input" method="post" novalidate>
    <table width="100%" border="0">
        <tr>
            <td align="right" width="30%"><label class="field_label">Serial : </label></td>
            <td>
                <input name="serial" class="easyui-validatebox" required="true" style="width: 150px"/>
            </td>
        </tr>
        <tr>
            <td align="right"><label class="field_label">Model : </label></td>
            <td>
                <input name="modelid" 
                       class="easyui-combobox"
                       url="<?php echo site_url('model/get_open') ?>"
                       method="post"
                       valueField="id"
                       textField="code"
                       panelHeight="300"
                       panelWidth="180"
                       data-options="formatter:formatComboModel50Input"
                       style="width: 150px" 
                       required="true" 
                       mode="remote"
                       />
                <script type="text/javascript">
                    function formatComboModel50Input(row){
                        return '<span>Code: ' + row.code +'</span><br/>' +
                            '<span>Name: ' + row.name +'</span><br/>' +
                            '<span style="color:#888">Desc:  </span>';
                    }
                </script>
            </td>
        </tr> 
        <tr>
            <td align="right"><label class="field_label">Process : </label></td>
            <td>
                <input name="processid"
                       class="easyui-combobox"
                       url="<?php echo site_url('tracking/get_tracking_process_for_combo') ?>"
                       mode="remote"
                       method="post"
                       valueField="id"
                       textField="name"
                       panelWidth="180"
                       panelHeight="auto"
                       style="width: 150px" 
                       required="true" 
                       />
            </td>
        </tr> 
    </table>        
</form>