<div id="itemdialogsearch-form" class="easyui-dialog" resizable="true" modal="true" style="width:800px; height: 500px;" closed="true">
    <div id="itemdialogsearch_toolbar" style="padding: 0;">            
        Code : 
        <input type="text" 
               size="10" 
               class="easyui-validatebox" 
               id="itemdialogsearch_code_s" 
               onkeyup="if (event.keyCode === 13) {item_searchfordialog();}"
               />    
        Description : 
        <input type="text" 
               size="10" 
               class="easyui-validatebox" 
               id="itemdialogsearch_description_s" 
               onkeyup="if (event.keyCode === 13) {item_searchfordialog();}"
               />
        Group : 
        <select id="itemdialogsearch_groupid_s" 
                name="itemdialogsearch_groupid_s" 
                class="easyui-combobox" 
                onchange="if (event.keyCode === 13) {item_searchfordialog();}"
                >
            <option></option>
            <?php
            foreach ($itemgroup as $result) {
                echo "<option value='" . $result->id . "'>" . $result->name . "</option>";
            }
            ?>
        </select>
        Category
        <select id="itemdialogsearch_category_s" 
                name="itemdialogsearch_category_s" 
                class="easyui-combobox" 
                required="true" 
                style="width: 80px" 
                panelHeight="auto" 
                panelWidth="90">
            <option value=""></option>
            <option value="1">Local</option>
            <option value="2">Import</option>
            <option value="3">Mix</option>
        </select>

        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-search" plain="true" onclick="item_searchfordialog()"> Search</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-pointer" plain="true" onclick="item_setselected()"> Set Selected</a>
    </div>
    <table id="itemdialogsearch" data-options="
           url:'<?php echo site_url('item/getfordialog') ?>',
           method:'post',
           singleSelect:true,
           fit:true,
           pageSize:100,
           pageList: [100, 200, 300, 400, 500],
           border:false,
           rownumbers:true,
           fitColumns:true,
           pagination:true,
           striped:true,
           toolbar:'#itemdialogsearch_toolbar'">
        <thead>
            <tr>
                <th field="id" hidden="true"></th>            
                <th field="code" width="80" halign="center">Code</th>                    
                <th field="description" width="350" halign="center">Description</th>
                <th field="unitcode" width="80" halign="center">Unit Code</th>
                <th field="group" width="100" halign="center">Group</th>  
                <th field="category_f" width="100" halign="center">Category</th>
            </tr>
        </thead>
    </table>
    <script type="text/javascript">
        $(function() {
            $('#itemdialogsearch').datagrid({
                onDblClickRow: function(row, data) {
                    item_setselected();
                }
            });
        });
    </script>

</div>
