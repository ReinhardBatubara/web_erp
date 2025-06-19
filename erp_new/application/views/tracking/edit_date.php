<form id="tracking_edit_date" method="post" novalidate>
    <table width="100%" border="0">
        <tr>
            <td align="right" width="30%"><label class="field_label">Date :</label></td>
            <td width="70%">
                <input type="hidden" name="serial" value="<?php echo $serial ?>" />
                <input type="hidden" name="processid" value="<?php echo $processid ?>" />
                <input type="hidden" name="status" value="<?php echo $status ?>" />
                <input type="text" name="date" class="easyui-datebox" size="30" required="true" value="" style="text-align: center" data-options="formatter:myformatter,parser:myparser"/>
            </td>
        </tr>
    </table>
</form>