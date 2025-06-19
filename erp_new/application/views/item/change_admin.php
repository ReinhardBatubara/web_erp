<form id="item_change_admin_form" method="post" novalidate>
    <table width="100%" border="0">
        <tr>
            <td width="35%" align="right"><label class="field_label">Admin :</label></td>
            <td width="65%">
                <input type="text"
                       name="userid" 
                       id="item_search_warehouseid" 
                       class="easyui-combobox" 
                       url="<?php echo site_url('users/get_admin_warehouse') ?>"
                       data-options="
                       valueField: 'id',
                       textField: 'name',
                       formatter:userFormatEmployee" 
                       style="width: 150px" 
                       panelHeight="auto"
                       required="true"
                       />
                <script type="text/javascript">
                    function userFormatEmployee(row){
                        var s = '<span style="font-weight:bold">ID : ' + row.id +'</span><br/>' +
                            '<span>Name: ' + row.name +'</span>';
                        return s;
                    }
                </script>
            </td>
        </tr>
        <tr>
            <td align="right"><label class="field_label">Warehouse :</label></td>
            <td>
                <input type="text"
                       name="warehouseid" 
                       id="item_search_warehouseid" 
                       class="easyui-combobox" 
                       url="<?php echo site_url('warehouse/get') ?>"
                       data-options="
                       valueField: 'id',
                       textField: 'code'" 
                       style="width: 80px" 
                       panelHeight="auto"
                       required="true" 
                       />
            </td>
        </tr>
    </table>
</form>