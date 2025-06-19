<form id="materialwithdrawdetail_from_jo-input" method="post" novalidate>
    <table width="100%" border="0">
        <tr>
            <td align="right" width="30%"><label class="field_label">Item Code : </label></td>
            <td>
                <input type="hidden" id="mrpid_" name="mrpid"/>
                <input type="hidden" id="mrdetail_itemid_from_jo" name="itemid"/>
                <input type="text" name="code" id="mrdetail_code_from_jo" class="easyui-validatebox" required="true" value="" readonly/>
                <a href="javascript:void(0)" class="button" onclick="materialwithdraw_dialog_item_search_from_jo(<?php echo $joborderid ?>)">Select</a>
            </td>
        </tr>            
        <tr>
            <td align="right"><label class="field_label">Description : </label></td>
            <td>
                <textarea name="description" readonly id="mrdetail_description_from_jo" class="easyui-validatebox" style="width: 90%;height: 40px"></textarea>
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
                <input type="text" name="qty" id="qty_from_jo" validType="check_ots_mr['#ots_qty_from_jo']" style="text-align: center" class="easyui-numberbox" precision="5" size="5" required="true"/>
                <label class="field_label">Ots :</label>
                <input type="text" name="ots_qty_from_jo" class="easyui-validatebox" id="ots_qty_from_jo" readonly value="0" style="text-align: center;width: 50px;border: none;background: none;"/>

            </td>
        </tr>
        <tr>
            <td align="right"><label class="field_label">Required For  :</label></td>
            <td>
                <textarea class="easyui-validatebox" style="width: 90%;height: 40px" name="requiredfor"></textarea>
            </td>
        </tr>
    </table>       
</form>
</div>
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