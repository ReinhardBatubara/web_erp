<form id="item_search_form" method="post" novalidate onsubmit="return false;">
    <table width="100%" border="0">
        <tr>
            <td align="right" width="30%"><label class="field_label">Code :</label></td>
            <td>
                <input type="text" size="12" class="easyui-validatebox" id="item_code_s" name="code" onkeypress="if (event.keyCode === 13) {
                            item_search();
                        }" />
            </td>
        </tr>
        <tr>
            <td align="right"><label class="field_label">Description :</label></td>
            <td>
                <input type="text" size="20" class="easyui-validatebox" id="item_description_s" name="description" onkeypress="if (event.keyCode === 13) {
                            item_search();
                        }"/>
            </td>
        </tr>
        <tr>
            <td align="right"><label class="field_label">Group :</label></td>
            <td>
                <select id="item_groupid_s" class="easyui-combobox" panelHeight="100" name="groupid">
                    <option></option>
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
                <select id="item_category_s" name="category" class="easyui-combobox" style="width: 80px" panelHeight="auto" panelWidth="90">
                    <option></option>
                    <option value="1">Local</option>
                    <option value="2">Import</option>
                    <option value="3">Mix</option>
                </select>
            </td>
        </tr>
        <tr>
            <td></td>
            <td style="padding-top: 10px">
                <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-search" plain="true" onclick="item_search()">Find</a>
                <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-excel" plain="true" onclick="item_excel()">Excel</a>
                <a href="javascript:void(0)" 
                   class="easyui-linkbutton" 
                   iconCls="icon-clear" 
                   plain="true" 
                   onclick="$('#item_search_form').form('clear');
                           item_search()">Clear</a>
                <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="$('#item_menu_search').tooltip('hide');">Close</a>
            </td>
        </tr>
    </table>   
</form>
