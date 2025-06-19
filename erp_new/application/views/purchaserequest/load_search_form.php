<form id="purchaserequest_search-form" method="post" novalidate onsubmit="return false;">
    <table width="95%" border="0">
        <tr>
            <td align="right" width="30%"><label class="field_label">PR No # : </label></td>
            <td>
                <input type="text" size="8" class="easyui-validatebox" name="number" onkeypress="if (event.keyCode === 13) {
                    purchaserequest_search();
                }"/>
            </td>
        </tr>
        <tr>
            <td align="right"><label class="field_label">Date From : </label></td>
            <td>
                <input type="text" size="12" class="easyui-datebox" name="datefrom" data-options="formatter:myformatter,parser:myparser"/>
                <label class="field_label">To :</label>
                <input type="text" size="12" class="easyui-datebox" name="dateto" data-options="formatter:myformatter,parser:myparser"/>
            </td>
        </tr>
        <tr>
            <td align="right"><label class="field_label">Department :</label></td>
            <td>

                <input class="easyui-combobox" name="departmentid" data-options="
                       url: '<?php echo site_url('department/get') ?>',
                       method: 'post',
                       valueField: 'id',
                       textField: 'name',
                       panelHeight: '200',
                       panelWidth: '180',
                       formatter: formatDepartment,
                       onSelect:purchaserequest_search"
                       style="width: 100px" 
                       required="true">

                <script type="text/javascript">
                function formatDepartment(row){
                    var s = '<span>Code: ' + row.code +'</span><br/>' +
                        '<span>Name: ' + row.name +'</span><br/>' +
                        '<span style="color:#888">Desc: ' + row.description + '</span>';
                    return s;
                }
                </script>
            </td>
        </tr>
        <tr>
            <td align="right"><label class="field_label">Status :</label></td>
            <td>
                <select class="easyui-combobox" name="status" panelHeight="auto">
                    <option value="">All</option>
                    <option value="New">New</option>
                    <option value="Approval Process">Approval Process</option>
                    <option value="No PO">No PO</option>
                    <option value="Have PO">Have PO</option>
                </select>
            </td>
        </tr>
        <tr>
            <td></td>
            <td style="padding-top: 10px">
                <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-search" plain="true" onclick="purchaserequest_search()">Find</a>
                <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-clear" plain="true" onclick="purchaserequest_clear_search()" style="float: right">Clear</a>
                <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="$('#purchaserequest_menu_search').tooltip('hide');"  style="float: right">Close</a>
            </td>
        </tr>
    </table>
</form>