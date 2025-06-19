<form id="model-input" method="post" novalidate class="table_form">
    <table width="100%" border="0">
        <tr valign="top">
            <td width="50%">
                <table width="100%">
                    <tr>
                        <td width="40%" align="right"><label class="field_label">Original Code :</label></td>
                        <td width="60%"><input type="text" name="originalcode" size="20" class="easyui-validatebox" required="true" style="width: 180px"/></td>
                    </tr>
                    <tr>
                        <td width="40%" align="right"><label class="field_label">Item Code :</label></td>
                        <td width="60%"><input type="text" name="code"  size="20" class="easyui-validatebox" required="true" style="width: 180px"/></td>
                    </tr>
                    <tr>
                        <td width="40%" align="right"><label class="field_label">Item Name :</label></td>
                        <td width="60%"><input type="text" name="name"  size="25" class="easyui-validatebox" style="width:180px"/></td>
                    </tr>
<!--                    <tr>
                        <td width="40%" align="right"><label class="field_label">Master Code :</label></td>
                        <td width="60%"><input type="text" name="mastercode"  size="20" class="easyui-validatebox" required="true"/></td>
                    </tr>-->                    
                    <tr>
                        <td width="40%" align="right"><label class="field_label">Category :</label></td>
                        <td width="60%">
                            <input type="text" id="modelcategorycode" style="width: 180px" name="modelcategorycode" required="true"/>
                            <script type="text/javascript">
                                $('#modelcategorycode').combogrid({
                                    panelWidth: 350,
                                    mode: 'remote',
                                    idField: 'code',
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
                        <td width="40%" align="right"><label class="field_label">Finishing :</label></td>
                        <td width="60%">
                            <input type="text" id="finishingcode" style="width: 180px" name="finishingcode"/>
                            <script type="text/javascript">
                                $('#finishingcode').combogrid({
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
                        <td width="40%" align="right"><label class="field_label">Material :</label></td>
                        <td width="60%">
                            <input type="text" id="materialcode" style="width: 180px" name="materialcode"/>
                            <script type="text/javascript">
                                $('#materialcode').combogrid({
                                    panelWidth: 350,
                                    mode: 'remote',
                                    idField: 'code',
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
                        <td width="40%" align="right"><label class="field_label">Top :</label></td>
                        <td width="60%">
                            <input type="text" id="topcode" style="width: 180px" name="topcode"/>
                            <script type="text/javascript">
                                $('#topcode').combogrid({
                                    panelWidth: 350,
                                    mode: 'remote',
                                    idField: 'code',
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
                        <td width="40%" align="right"><label class="field_label">Mirror / Glass :</label></td>
                        <td width="60%">
                            <input type="text" id="mirrorglasscode" style="width: 180px" name="mirrorglasscode"/>
                            <script type="text/javascript">
                                $('#mirrorglasscode').combogrid({
                                    panelWidth: 350,
                                    mode: 'remote',
                                    idField: 'code',
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
                        <td width="40%" align="right"><label class="field_label">Foam :</label></td>
                        <td width="60%">
                            <input type="text" id="foamcode" style="width: 180px" name="foamcode"/>
                            <script type="text/javascript">
                                $('#foamcode').combogrid({
                                    panelWidth: 350,
                                    mode: 'remote',
                                    idField: 'code',
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
                        <td width="40%" align="right"><label class="field_label">Interliner :</label></td>
                        <td width="60%">
                            <input type="text" id="interlinercode" style="width: 180px" name="interlinercode"/>
                            <script type="text/javascript">
                                $('#interlinercode').combogrid({
                                    panelWidth: 350,
                                    mode: 'remote',
                                    idField: 'code',
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
                        <td width="40%" align="right"><label class="field_label">Fabric :</label></td>
                        <td width="60%">
                            <input type="text" id="fabriccode" style="width: 180px" name="fabriccode"/>
                            <script type="text/javascript">
                                $('#fabriccode').combogrid({
                                    panelWidth: 350,
                                    mode: 'remote',
                                    idField: 'code',
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
                        <td width="40%" align="right"><label class="field_label">Furring :</label></td>
                        <td width="60%">
                            <input type="text" id="furringcode" style="width: 180px" name="furringcode"/>
                            <script type="text/javascript">
                                $('#furringcode').combogrid({
                                    panelWidth: 350,
                                    mode: 'remote',
                                    idField: 'code',
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
                        <td width="40%" align="right"><label class="field_label">Accessories :</label></td>
                        <td width="60%">
                            <input type="text" id="accessoriescode" style="width: 180px" name="accessoriescode"/>
                            <script type="text/javascript">
                                $('#accessoriescode').combogrid({
                                    panelWidth: 350,
                                    mode: 'remote',
                                    idField: 'code',
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
                </table>
            </td>
            <td width="50%">
                <table width="100%">
                    <tr>
                        <td colspan="2" align="right">
                            <table width="95%" border="0" style="border-width: 1px;border-collapse: collapse;border-color: #ccccff;" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td colspan="3" align="center" style="border: 1px solid  #ccccff;"><label class="field_label"> Item Size (mm)</label></td>
                                </tr>
                                <tr>
                                    <td align="center" style="border: 1px solid #ccccff;" width="33%"><label class="field_label">W</label></td>
                                    <td align="center" style="border: 1px solid #ccccff;" width="33%"><label class="field_label">D</label></td>
                                    <td align="center" style="border: 1px solid #ccccff;" width="33%"><label class="field_label">H</label></td>
                                </tr>
                                <tr>
                                    <td align="center" style="border: 1px solid #ccccff;padding: 2px;"><input type="text" class="easyui-numberbox" name="itemsize_mm_w" required="true" precision="0" style="width: 95%;text-align: center;"/></td>
                                    <td align="center" style="border: 1px solid #ccccff;padding: 2px;"><input type="text" class="easyui-numberbox" name="itemsize_mm_d" required="true" precision="0"  style="width: 95%;text-align: center;" /></td>
                                    <td align="center" style="border: 1px solid #ccccff;padding: 2px;"><input type="text" class="easyui-numberbox" name="itemsize_mm_h" required="true" precision="0"  style="width: 95%;text-align: center;" /></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" align="right"><br/>
                            <table width="95%" border="0" style="border-width: 1px;border-collapse: collapse;border-color: #ccccff;" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td colspan="3" align="center" style="border: 1px solid  #ccccff;"><label class="field_label">Packaging Size 1 (mm)</td>
                                </tr>
                                <tr>
                                    <td align="center" style="border: 1px solid #ccccff;" width="33%"><label class="field_label">W</label></td>
                                    <td align="center" style="border: 1px solid #ccccff;" width="33%"><label class="field_label">D</label></td>
                                    <td align="center" style="border: 1px solid #ccccff;" width="33%"><label class="field_label">H</label></td>
                                </tr>
                                <tr>
                                    <td align="center" style="border: 1px solid #ccccff;padding: 2px;"><input type="text" class="easyui-numberbox" name="packagingsize_mm_w" precision="0"  style="width: 95%;text-align: center;"/></td>
                                    <td align="center" style="border: 1px solid #ccccff;padding: 2px;"><input type="text" class="easyui-numberbox" name="packagingsize_mm_d" precision="0"  style="width: 95%;text-align: center;" /></td>
                                    <td align="center" style="border: 1px solid #ccccff;padding: 2px;"><input type="text" class="easyui-numberbox" name="packagingsize_mm_h" precision="0"  style="width: 95%;text-align: center;" /></td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <tr>
                        <td colspan="2" align="right"><br/>
                            <table width="95%" border="0" style="border-width: 1px;border-collapse: collapse;border-color: #ccccff;" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td colspan="3" align="center" style="border: 1px solid  #ccccff;"><label class="field_label">Packaging Size 2 (mm)</label></td>
                                </tr>
                                <tr>
                                    <td align="center" style="border: 1px solid #ccccff;" width="33%"><label class="field_label">W</label></td>
                                    <td align="center" style="border: 1px solid #ccccff;" width="33%"><label class="field_label">D</label></td>
                                    <td align="center" style="border: 1px solid #ccccff;" width="33%"><label class="field_label">H</label></td>
                                </tr>
                                <tr>
                                    <td align="center" style="border: 1px solid #ccccff;padding: 2px;"><input type="text" class="easyui-numberbox" name="packagingsize2_mm_w" precision="0" style="width: 95%;text-align: center;"/></td>
                                    <td align="center" style="border: 1px solid #ccccff;padding: 2px;"><input type="text" class="easyui-numberbox" name="packagingsize2_mm_d" precision="0" style="width: 95%;text-align: center;" /></td>
                                    <td align="center" style="border: 1px solid #ccccff;padding: 2px;"><input type="text" class="easyui-numberbox" name="packagingsize2_mm_h" precision="0" style="width: 95%;text-align: center;" /></td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <tr>
                        <td colspan="2" align="right"><br/>
                            <table width="95%" border="0" style="border-width: 1px;border-collapse: collapse;border-color: #ccccff;" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td colspan="4" align="center" style="border: 1px solid  #ccccff;"><label class="field_label">Seat Size (mm)</label></td>
                                </tr>
                                <tr>
                                    <td align="center" style="border: 1px solid #ccccff;" width="25%"><label class="field_label">W</label></td>
                                    <td align="center" style="border: 1px solid #ccccff;" width="25%"><label class="field_label">D</label></td>
                                    <td align="center" style="border: 1px solid #ccccff;" width="25%"><label class="field_label">H</label></td>
                                    <td align="center" style="border: 1px solid #ccccff;" width="25%"><label class="field_label">ARM HEIGHT</label></td>
                                </tr>
                                <tr>
                                    <td align="center" style="border: 1px solid #ccccff;padding: 2px;"><input type="text" class="easyui-numberbox" name="seat_width" precision="0" style="width: 95%;text-align: center;"/></td>
                                    <td align="center" style="border: 1px solid #ccccff;padding: 2px;"><input type="text" class="easyui-numberbox" name="seat_depth" precision="0" style="width: 95%;text-align: center;" /></td>
                                    <td align="center" style="border: 1px solid #ccccff;padding: 2px;"><input type="text" class="easyui-numberbox" name="seat_height" precision="0" style="width: 95%;text-align: center;" /></td>
                                    <td align="center" style="border: 1px solid #ccccff;padding: 2px;"><input type="text" class="easyui-numberbox" name="arm_height" precision="0" style="width: 95%;text-align: center;" /></td>
                                </tr>
                                <tr>
                                    <td colspan="4"><br/>
                                        <label class="field_label">Image : </label><br/>
                                        <input type="file" name="fileupload" style="width: 100%"/>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>                      
    </table>
</form>