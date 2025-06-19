<div id="comment" class="easyui-dialog" 
     data-options="resizable:false,modal:true"
     style="width:400px;height: 550px;padding: 5px 5px" closed="true" buttons="#comment-button">
    <table width="100%" cellpadding="0" cellspacing="0" border="0">        
        <tr>            
            <td>
                <input type="hidden" id="purchaserequestid" value="0" />
                <textarea name="comment_content" id="comment_content" style="width: 360px;height:50px"></textarea>
                <br/>
                <button class="button" onclick="purchaserequest_comment_post()">Post</button>
            </td>
        </tr>
        <tr>
            <td>
                <br/>
                <div id="commentlist" class="easyui-panel" title="Comment List" style="width: 370px;height: 360px">

                </div>
            </td>
        </tr>
    </table>
</div>
<div id="comment-button">    
    <a href="javascript:void(0)" class="easyui-linkbutton" onclick="$('#comment').dialog('close')">Close</a>
</div>