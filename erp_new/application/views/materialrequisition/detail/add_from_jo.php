<form id="materialrequisitiondetail_from_jo-input" method="post" novalidate>
    <table width="100%" border="0">
        <tr>
            <td align="right" width="25%"><label class="field_label">Item Code : </label></td>
            <td>
                <input type="hidden" id="mrpid_" name="mrpid"/>
                <input type="text" id="mrdetail_itemid_from_jo" required="true" name="itemid" style="width: 300px"/>
                <script type="text/javascript">
                    $(function() {
                        $('#mrdetail_itemid_from_jo').combobox({
                            url: '<?php echo site_url('joborder/get_mrp/' . $joborderid) ?>',
                            method: 'post',
                            valueField: 'itemid',
                            textField: 'itemcode',
                            panelHeight: '200',
                            mode: 'remote',
                            formatter: formatMRDetailFromJOAddItemFormat,
                            onSelect:function(row){
                                var last_mrpid = $('#mrpid_').val();
                                $('#mrdetail_itemid_from_jo').val(row.itemid);
                                $('#mrdetail_code_from_jo').val(row.itemcode);
                                $('#mrdetail_description_from_jo').val(row.itemdescription);
                                $('#mrdetail_unitcode_from_jo').val(row.unitcode);
                                $('#mrpid_').val(row.id);
                    
                                if(mrp_frst_id === row.id){
                                    var new_ots = parseFloat($('#mrdetail_qty_inputed').val()) + parseFloat(row.ots_requisition);
                                    $('#ots_qty_from_jo').val(new_ots);
                                }else{
                                    $('#ots_qty_from_jo').val(row.ots_requisition);
                                }
                            }
                        });
                    });
                    function formatMRDetailFromJOAddItemFormat(row){
                        var s = '<span style="font-weight:bold">' + row.itemcode +'</span><br/>' +
                            '<span style="color:#888;font-size:7.5pt">Desc: ' + row.itemdescription + '</span><br/>' +
                            '<span>Unit Code: '+row.unitcode+',Outstanding: '+row.ots_requisition+'</span><br/>';
                        return s;
                    }
                </script>
            </td>
        </tr>            
        <tr>
            <td align="right"><label class="field_label">Description : </label></td>
            <td>
                <textarea name="description" readonly id="mrdetail_description_from_jo" class="easyui-validatebox" style="width: 300px;height: 40px"></textarea>
            </td>
        </tr>
        <tr>
            <td align="right"><label class="field_label">Unit Code : </label></td>
            <td>
                <input type="text" id="mrdetail_unitcode_from_jo" name="unitcode" readonly style="width: 50px;text-align: center;">
            </td>
        </tr>
        <tr>
            <td align="right"><label class="field_label">Qty :</label></td>
            <td>
                <input type="hidden" name="mrdetail_qty_inputed" id="mrdetail_qty_inputed" value="0" />
<!--                <input type="text" name="qty" id="qty_from_jo" validType="check_ots_mr['#ots_qty_from_jo']" style="text-align: center" class="easyui-numberbox" size="10" precision="4" required="true"/>-->
                <input type="text" name="qty" id="qty_from_jo" style="text-align: center" class="easyui-numberbox" size="10" precision="4" required="true"/>
                &nbsp;&nbsp;&nbsp;
                <label class="field_label">Ots :</label>
                <input type="text" name="ots_qty_from_jo" class="easyui-validatebox" id="ots_qty_from_jo" readonly value="0" style="text-align: center;width: 50px;border: none;background: none;"/>

            </td>
        </tr>
        <tr>
            <td align="right"><label class="field_label">Required For  :</label></td>
            <td>
                <textarea class="easyui-validatebox" style="width: 300px;height: 40px" name="requiredfor"></textarea>
            </td>
        </tr>
    </table>       
</form>
<script>
    $.extend($.fn.validatebox.defaults.rules, {
        check_ots_mr: {
            validator: function(value,param){
                return (parseFloat(value) <= parseFloat($(param[0]).val())) && (parseFloat(value) > 0);
            },
            message: 'Out of Outsanding'
        }
    });
</script>
