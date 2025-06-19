<form id="model_search_form" method="post" novalidate onsubmit="return false;" class="table_form">
    <table width="100%" border="0">
        <tr>
            <td align="right" width="30%"><label class="field_label">Original Code :</label></td>
            <td width="70%">
                <input type="text" class="easyui-validatebox" id="model_originalcode_s" name="model_originalcode_s" style="width: 200px"/>
            </td>
        </tr>
        <tr>
            <td align="right"><label class="field_label">Name :</label></td>
            <td>
                <input type="text" style="width: 200px" class="easyui-validatebox" id="model_name_s" name="model_name_s"/>
            </td>
        </tr>
        <tr>
            <td align="right"><label class="field_label">Master Code :</label></td>
            <td>
                <input type="text" style="width: 200px" class="easyui-validatebox" id="model_mastercode_s" name="model_mastercode_s"/>
            </td>
        </tr>
        <tr>
            <td align="right"><label class="field_label">Item Code :</label></td>
            <td>
                <input type="text" style="width: 200px" class="easyui-validatebox" id="model_code_s" name="model_code_s"/>
            </td>
        </tr>
        <tr>
            <td align="right"><label class="field_label">Category :</label></td>
            <td>
                <input type="text" id="model_categorycode_s" style="width: 200px" name="model_categorycode_s"/>
                <script type="text/javascript">
                    $('#model_categorycode_s').combogrid({
                        panelWidth: 300,
                        mode: 'remote',
                        idField: 'code',
                        fitColumns: true,
                        textField: 'description',
                        url: '<?php echo site_url('modelcategory/get_remote_data') ?>',
                        columns: [[
                                {field: 'code', title: 'Code', width: 100, halign: 'center'},
                                {field: 'description', title: 'Description', width: 200, halign: 'center'}
                            ]]
                    });
                </script>
            </td>
        </tr>
        <tr>
            <td align="right"><label class="field_label">Finishing :</label></td>
            <td>
                <input type="text" id="model_finishingcode_s" style="width: 200px" name="model_finishingcode_s"/>
                <script type="text/javascript">
                    $('#model_finishingcode_s').combogrid({
                        panelWidth: 300,
                        mode: 'remote',
                        idField: 'code',
                        fitColumns: true,
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
            <td align="right"><label class="field_label">Material :</label></td>
            <td>
                <input type="text" id="model_materialcode_s" style="width: 200px" name="model_materialcode_s"/>
                <script type="text/javascript">
                    $('#model_materialcode_s').combogrid({
                        panelWidth: 300,
                        mode: 'remote',
                        idField: 'code',
                        fitColumns: true,
                        textField: 'description',
                        url: '<?php echo site_url('material/get_remote_data') ?>',
                        columns: [[
                                {field: 'code', title: 'Code', width: 100, halign: 'center'},
                                {field: 'description', title: 'Description', width: 200, halign: 'center'}
                            ]]
                    });
                </script>
            </td>
        </tr>
        <tr>
            <td align="right"><label class="field_label">Top :</label></td>
            <td>
                <input type="text" id="model_topcode_s" style="width: 200px" name="model_topcode_s"/>
                <script type="text/javascript">
                    $('#model_topcode_s').combogrid({
                        panelWidth: 300,
                        mode: 'remote',
                        idField: 'code',
                        fitColumns: true,
                        textField: 'description',
                        url: '<?php echo site_url('top/get_remote_data') ?>',
                        columns: [[
                                {field: 'code', title: 'Code', width: 100, halign: 'center'},
                                {field: 'description', title: 'Description', width: 200, halign: 'center'}
                            ]]
                    });
                </script>
            </td>
        </tr>
        <tr>
            <td align="right"><label class="field_label">Mirror / Glass :</label></td>
            <td>
                <input type="text" id="model_mirrorglasscode_s" style="width: 200px" name="model_mirrorglasscode_s"/>
                <script type="text/javascript">
                    $('#model_mirrorglasscode_s').combogrid({
                        panelWidth: 300,
                        mode: 'remote',
                        idField: 'code',
                        fitColumns: true,
                        textField: 'description',
                        url: '<?php echo site_url('mirrorglass/get_remote_data') ?>',
                        columns: [[
                                {field: 'code', title: 'Code', width: 100, halign: 'center'},
                                {field: 'description', title: 'Description', width: 200, halign: 'center'}
                            ]]
                    });
                </script>
            </td>
        </tr>
        <tr>
            <td align="right"><label class="field_label">Foam :</label></td>
            <td>
                <input type="text" id="model_foamcode_s" style="width: 200px" name="model_foamcode_s"/>
                <script type="text/javascript">
                    $('#model_foamcode_s').combogrid({
                        panelWidth: 300,
                        mode: 'remote',
                        idField: 'code',
                        fitColumns: true,
                        textField: 'description',
                        url: '<?php echo site_url('foam/get_remote_data') ?>',
                        columns: [[
                                {field: 'code', title: 'Code', width: 100, halign: 'center'},
                                {field: 'description', title: 'Description', width: 200, halign: 'center'}
                            ]]
                    });
                </script>
            </td>
        </tr>
        <tr>
            <td align="right"><label class="field_label">Interliner :</label></td>
            <td>
                <input type="text" id="model_interlinercode_s" style="width: 200px" name="model_interlinercode_s"/>
                <script type="text/javascript">
                    $('#model_interlinercode_s').combogrid({
                        panelWidth: 300,
                        mode: 'remote',
                        idField: 'code',
                        fitColumns: true,
                        textField: 'description',
                        url: '<?php echo site_url('interliner/get_remote_data') ?>',
                        columns: [[
                                {field: 'code', title: 'Code', width: 100, halign: 'center'},
                                {field: 'description', title: 'Description', width: 200, halign: 'center'}
                            ]]
                    });
                </script>
            </td>
        </tr>
        <tr>
            <td align="right"><label class="field_label">Fabric :</label></td>
            <td>
                <input type="text" id="model_fabriccode_s" style="width: 200px" name="model_fabriccode_s"/>
                <script type="text/javascript">
                    $('#model_fabriccode_s').combogrid({
                        panelWidth: 300,
                        mode: 'remote',
                        idField: 'code',
                        fitColumns: true,
                        textField: 'description',
                        url: '<?php echo site_url('fabric/get_remote_data') ?>',
                        columns: [[
                                {field: 'code', title: 'Code', width: 100, halign: 'center'},
                                {field: 'description', title: 'Description', width: 200, halign: 'center'}
                            ]]
                    });
                </script>
            </td>
        </tr>
        <tr>
            <td align="right"><label class="field_label">Furring :</label></td>
            <td>
                <input type="text" id="model_furringcode_s" style="width: 200px" name="model_furringcode_s"/>
                <script type="text/javascript">
                    $('#model_furringcode_s').combogrid({
                        panelWidth: 300,
                        mode: 'remote',
                        idField: 'code',
                        fitColumns: true,
                        textField: 'description',
                        url: '<?php echo site_url('furring/get_remote_data') ?>',
                        columns: [[
                                {field: 'code', title: 'Code', width: 100, halign: 'center'},
                                {field: 'description', title: 'Description', width: 200, halign: 'center'}
                            ]]
                    });
                </script>
            </td>
        </tr>
        <tr>
            <td align="right"><label class="field_label">Accessories :</label></td>
            <td>
                <input type="text" id="model_accessoriescode_s" style="width: 200px" name="model_accessoriescode_s"/>
                <script type="text/javascript">
                    $('#model_accessoriescode_s').combogrid({
                        panelWidth: 300,
                        mode: 'remote',
                        idField: 'code',
                        fitColumns: true,
                        textField: 'description',
                        url: '<?php echo site_url('accessories/get_remote_data') ?>',
                        columns: [[
                                {field: 'code', title: 'Code', width: 100, halign: 'center'},
                                {field: 'description', title: 'Description', width: 200, halign: 'center'}
                            ]]
                    });
                </script>
            </td>
        </tr>
        <tr>
            <td align="right"><label class="field_label">Status :</label></td>
            <td>
                <select name="status" style="width: 150px">
                    <option value="-1">All</option>
                    <option value="1">Open</option>
                    <option value="0">Close</option>
                    <option value="2">Complete</option>
                    <option value="3">Not Complete</option>
                </select>
            </td>
        </tr>
        <tr>
            <td></td>
            <td style="padding-top: 10px">
                <a href="javascript:void(0)" 
                   class="easyui-linkbutton" 
                   iconCls="icon-search" plain="true" 
                   onclick="model_search()">Find</a>
                <a href="javascript:void(0)" 
                   class="easyui-linkbutton" 
                   iconCls="icon-excel" plain="true" 
                   onclick="model_export_to_excel()">Excel</a>
                <a href="javascript:void(0)" 
                   class="easyui-linkbutton" 
                   iconCls="icon-clear" 
                   plain="true" 
                   onclick="$('#model_search_form').form('clear');
                           model_search()">Clear</a>
                <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="$('#model_menu_search').tooltip('hide');">Close</a>
            </td>
        </tr>
    </table>   
</form>
