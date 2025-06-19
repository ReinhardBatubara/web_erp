<div id="pending_or_reject-form" class="easyui-dialog" 
     data-options="resizable:true,modal:true"
     style="width:300px; padding: 5px 5px" closed="true" buttons="#pending_or_reject-button">
    <form id="pending_or_reject-input" method="post" novalidate>
        <table width="100%" border="0">                     
            <tr>
                <td align="right">Notes :</td>
                <td>
                    <textarea name="notes" id="notes" class="easyui-validatebox" style="width: 170px;height: 50px"></textarea>
                </td>
            </tr>            
        </table>       
    </form>
</div>
<div id="pending_or_reject-button">
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-ok" onclick="purchaserequest_approval_action_pending_or_reject()">Save</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="$('#pending_or_reject-form').dialog('close')">Cancel</a>
</div>