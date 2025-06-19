<form id="sod_upholstry-input" method="post" novalidate class="table_form">
    <table width="100%" border="0">              
        <tr>
            <td align="right" width="30%"><label class="field_label">Material :</label></td>
            <td width="70%">
                <input type="text" id="sod_upholstryitemid" name="itemid" required style="width: 270px"/>
                <script type="text/javascript">
                    $(function () {
                        $('#sod_upholstryitemid').combobox({
                            url: '<?php echo site_url('item/get_for_combo') ?>',
                            method: 'post',
                            valueField: 'id',
                            textField: 'code',
                            panelHeight: '200',
                            mode: 'remote',
                            formatter: sod_upholstryItemFormat,
                            onSelect: function (row) {
                                $('#sod_upholstrymaterialdescription').val(row.description);
                                $('#sod_upholstryunitcode').combobox('clear');
                                $('#sod_upholstryunitcode').combobox('reload', base_url + 'itemunitprice/get_remote_unit/' + row.id);
                                $('#sod_upholstryunitcode').combobox('setValue', row.unitcode);
                            }
                        });
                    });
                    function sod_upholstryItemFormat(row) {
                        var s = '<span style="font-weight:bold">' + row.code + '</span><br/>' +
                                '<span style="color:#888;font-size:7.5pt">Desc: ' + row.description + '</span><br/>' +
                                '<span>Unit Code: ' + row.unitcode + '</span><br/>';
                        return s;
                    }
                </script>
            </td>
        </tr>
        <tr>
            <td align="right"><label class="field_label">Unit Code :</label></td>
            <td>
                <input id="sod_upholstryunitcode" name="unitcode" panelHeight="auto" editable="false" class="easyui-combobox" data-options="valueField:'id',textField:'text'" required="true" style="width: 100px;">
            </td>
        </tr>
    </table>        
</form>