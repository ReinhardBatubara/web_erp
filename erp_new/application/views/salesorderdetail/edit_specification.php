<form id="salesorderdetail_edit_specification_item" method="post" novalidate class="table_form" style="padding: 2px">
    <table width="100%">
        <tr>
            <td width="50%"  valign="top">
                <table width="100%" border="0">
                    <tr>
                        <td width="30%" align="right"><label class="field_label">Finishing :</label></td>
                        <td width="70%">
                            <input type="text" id="finishingcode" style="width: 100%" name="finishingcode"/>
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
                        <td align="right"><label class="field_label">Material :</label></td>
                        <td>
                            <input type="text" id="materialcode" style="width: 100%" name="materialcode"/>
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
                        <td align="right"><label class="field_label">Top :</label></td>
                        <td>
                            <input type="text" id="topcode" style="width: 100%" name="topcode"/>
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
                        <td align="right"><label class="field_label">Mirror / Glass :</label></td>
                        <td>
                            <input type="text" id="mirrorglasscode" style="width: 100%" name="mirrorglasscode"/>
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
                        <td width="30%" align="right"><label class="field_label">Foam :</label></td>
                        <td>
                            <input type="text" id="foamcode" style="width: 100%" name="foamcode"/>
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
                </table>                        
            </td>
            <td width="50%" valign="top">
                <table width="100%" border="0">
                    <tr>
                        <td width="30%" align="right"><label class="field_label">Interliner :</label></td>
                        <td width="70%">
                            <input type="text" id="interlinercode" style="width: 100%" name="interlinercode"/>
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
                        <td align="right"><label class="field_label">Fabric :</label></td>
                        <td>
                            <input type="text" id="fabriccode" style="width: 100%" name="fabriccode"/>
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
                        <td align="right"><label class="field_label">Furring :</label></td>
                        <td>
                            <input type="text" id="furringcode" style="width: 100%" name="furringcode"/>
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
                        <td align="right"><label class="field_label">Accessories :</label></td>
                        <td>
                            <input type="text" id="accessoriescode" style="width: 100%" name="accessoriescode"/>
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
        </tr>
    </table>

</form>