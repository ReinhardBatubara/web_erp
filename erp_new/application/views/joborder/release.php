<form id="joborder_release-form" method="post" novalidate>
    <table width="100%" border="0">
        <tr>
            <td align="right" width="40%"><label class="field_label">Release Date : </label></td>
            <td width="60%">
                <input type="hidden" value="<?php echo $joborderid ?>" name="joborderid" />
                <input type="text" style="width: 180px" class="easyui-datebox" id="release_date" name="release_date" data-options="formatter:myformatter,parser:myparser" required="true"/>
            </td>
        </tr>
        <tr>
            <td align="right"><label class="field_label">Release By : </label></td>
            <td><input type="text" class="easyui-validatebox" name="release_by" required="true" style="width: 180px"/></td>
        </tr>
        <tr>
            <td align="right"><label class="field_label">Exp. Delivery Date : </label></td>
            <td><input type="text" style="width: 180px" class="easyui-datebox" id="expected_delivery_date" name="expected_delivery_date" data-options="formatter:myformatter,parser:myparser" required="true"/></td>
        </tr>
    </table>
</form>