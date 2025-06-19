<div id="purchaserequest_attachment" class="easyui-dialog" 
     data-options="resizable:false,modal:true"
     style="width:400px;height: 370px;padding: 5px 5px" closed="true" buttons="#purchaserequest_attachment-button">
    <table width="100%" cellpadding="0" cellspacing="0" border="0">      
        <tr>
            <td >
                <table width="100%" cellpadding="0" cellspacing="0">
                    <tr>
                        <td colspan="2">
                            <form id="purchaserequest-attachment" method="post" novalidate>
                                <table width="100%">
                                    <tr>
                                        <td align="right" width="30%">Title :</td>
                                        <td>
                                            <input type="hidden" name="purchaserequestid" id="attachment_purchaserequestid" value="0" />
                                            <input type="text" class="easyui-validatebox" name="attachment_title" id="attachment_title" required="true"/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="right">File :</td>
                                        <td><input type="file" name="attachment_file" class="easyui-validatebox" id="attachment_file" required="true" style="max-width: 150px"/></td>
                                    </tr>
                                </table>
                            </form>
                        </td>
                    </tr>
                    <tr>
                        <td width="30%">&nbsp;</td>
                        <td><button class="button" onclick="purchaserequest_attachment_upload()">Upload</button></td>
                    </tr>
                </table>                
            </td>
        </tr>
        <tr>
            <td>
                <br/>
                <div id="purchaserequest_attachment_list" class="easyui-panel" title="Attachment List" style="width: 370px;height: 185px">

                </div>
            </td>
        </tr>
    </table>
</div>
<div id="purchaserequest_attachment-button">    
    <a href="javascript:void(0)" class="easyui-linkbutton" onclick="$('#purchaserequest_attachment').dialog('close')">Close</a>
</div>