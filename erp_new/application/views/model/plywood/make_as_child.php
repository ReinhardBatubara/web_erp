<table width="100%">
    <tr>
        <td width="20%" align="right"><label class="field_label">Child Of : </label></td>
        <td width="70%">
            <input type="text" id="plywood_mtr" style="width: 300px"/>
            <script type="text/javascript">
                $('#plywood_mtr').combogrid({
                    mode: 'remote',
                    idField: 'id',
                    textField: 'description',
                    url: '<?php echo site_url('plywood/get/' . $modelid) ?>',
                    columns: [[
                            {field: 'description', title: 'Description', width: 300}
                        ]],
                    onSelect:function(index,row){
                        plywood_do_make_as_child(<?php echo $id ?>,row.id);
                    }
                });
            </script>
        </td>
    </tr>
</table>
