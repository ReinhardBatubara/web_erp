<form id="set_reference_iten_on_process-input" method="post" novalidate>
    <table width="100%" border="0" style="padding:10px;">        
        <tr>
            <td align="right"><label class="field_label">Serial :</label></td>
            <td>
                <input type="text" 
                       name="joborderitembarcodeid" 
                       id="joborderitembarcodeid" 
                       mode="remote" style="width: 200px" 
                       required="true"
                       />
                <script type="text/javascript">
                    $('#joborderitembarcodeid').combogrid({
                        idField: 'id',
                        fitColumns: true,
                        textField: 'serial',
                        pagination: false,
                        url: '<?php echo site_url('joborder/get_item_detail_stock_by_process/' . $modelid . "/" . $processid) ?>',
                        columns: [[
                                {field: 'serial', title: 'Serial', width: 160}
                            ]]
                    });
                </script>
            </td>
        </tr>
        <tr>
            <td align="right" width="35%"><label class="field_label">Start Process From:</label></td>
            <td width="65%">
                <input type="text" 
                       name="processid" 
                       id="modelprocessid_stock" 
                       mode="remote" 
                       style="width: 200px" 
                       required="true"
                       />
                <script type="text/javascript">
                    $('#modelprocessid_stock').combogrid({
                        idField: 'processid',
                        fitColumns: true,
                        textField: 'process',
                        pagination: false,
                        url: '<?php echo site_url('modelprocess/get_by_modelid/' . $modelid) ?>',
                        columns: [[
                                {field: 'process', title: 'Name', width: 160}
                            ]]
                    });
                </script>
            </td>
        </tr>
    </table>        
</form>