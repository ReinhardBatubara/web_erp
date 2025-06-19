<div id="carvingsubmission_carver_input_dialog" class="easyui-dialog" 
     data-options="iconCls:'icon-save',resizable:true,modal:true"
     style="width:400px; padding: 5px 5px" closed="true" buttons="#carvingsubmission_carver_button">
    <form id="carver_input_form" method="post" novalidate>
        <table width="100%" border="0">            
            <tr>
                <td align="right" width="25%"><label class="field_label">Carver :</label></td>
                <td>
                    <input class="easyui-combobox" name="carverid" data-options="
                           url: '<?php echo site_url('carver/get') ?>',
                           method: 'post',
                           valueField: 'id',
                           textField: 'name',
                           panelHeight: '200',
                           formatter: carvingsubmission_carver_format"
                           style="width: 200px" 
                           required="true" />
                    <script type="text/javascript">
                        function carvingsubmission_carver_format(row) {
                            return '<span>' + row.name + '</span><br/>';
                        }
                    </script>
                </td>
            </tr>
        </table>        
    </form>
</div>
<div id="carvingsubmission_carver_button">
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-ok" onclick="carvingsubmission_carver_save()">Save</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="$('#carvingsubmission_carver_input_dialog').dialog('close')">Cancel</a>
</div>