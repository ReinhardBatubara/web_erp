<table width="100%" border="0">
    <tr>
        <td width="20%" align="right"><label class="field_label">Child Of : </label></td>
        <td width="70%">
            <input type="text" id="solidwood_mtr" style="width: 300px"/>
            <script type="text/javascript">
                $('#solidwood_mtr').combogrid({
                    mode: 'remote',
                    idField: 'id',
                    textField: 'description',
                    url: '<?php echo site_url('solidwood/get/' . $modelid) ?>',
                    columns: [[
                            {field: 'description', title: 'Description', width: 280}
                        ]],
                    onSelect:function(index,row){
                        solidwood_do_make_as_child(<?php echo $id ?>,row.id);
                    }
                });
            </script>
        </td>
    </tr>
</table>
