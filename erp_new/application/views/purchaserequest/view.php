<div class="easyui-layout" data-options="fit:true">        
    <div data-options="region:'center'" border="false">
        <div class="easyui-layout" data-options="fit:true" border="false">
            <div region="center" title='Purchase Request'>                
                <div id="purchaserequest_toolbar" style="padding-bottom: 2px;display: inline-block;width: 100%">
                    <form id="purchaserequest_search-form2" method="post" novalidate onsubmit="return false;" style="margin: 0">
                        <label class="field_label">PR No # : </label>
                        <input type="text" size="8" class="easyui-validatebox" name="number" onkeypress="if (event.keyCode === 13) {
                                        purchaserequest_search2();
                                    }"/>
                        <label class="field_label">Date : </label>
                        <input type="text" size="12" class="easyui-datebox" name="datefrom" data-options="formatter:myformatter,parser:myparser"/>
                        <label class="field_label">To :</label>
                        <input type="text" size="12" class="easyui-datebox" name="dateto" data-options="formatter:myformatter,parser:myparser"/>
                        <label class="field_label">Status :</label>
                        <select class="easyui-combobox" name="status" panelHeight="auto">
                            <option value="">All</option>
                            <option value="Preparing">Preparing</option>
                            <option value="Approval Process">Approval Process</option>
                            <option value="Ready to Create PO">Ready to Create PO</option>
                            <option value="Already Have PO">Have PO</option>
                        </select>
                        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-search" plain="true" onclick="purchaserequest_search2()">Search</a>
                         <?php
                    if ($this->session->userdata('department') == 7) {
                        if (in_array('add', $action)) {
                            ?>
                            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="purchaserequest_add()">Add</a>                            
                        <?php }if (in_array('edit', $action)) { ?>
                            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="purchaserequest_edit_information()" id="purchaserequest-edit">Edit</a>
                        <?php }if (in_array('delete', $action)) { ?>
                            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" id="purchaserequest-delete" onclick="purchaserequest_delete()"> Delete</a>
                        <?php }if (in_array('create_po', $action)) { ?>
                            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-purchase_order" plain="true" id="purchaseorder-create" onclick="purchaseorder_create()"> Create PO</a>
                            <?php
                        }
                    }
                    ?>
                    <!--<a href="javascript:void(0)" class="easyui-menubutton" iconCls="icon-decisions_approve" id='mm_action_approve' menu="#mm-purchaserequestapproval">Action To Approve</a>-->
                    <a id="purchaserequest_menu_search" href="#" class="easyui-linkbutton" plain="true" iconCls="icon-search" style="float: right;">Search</a>
                    </form>
                    
                   
                </div>
<!--                <div id="mm-purchaserequestapproval" class="easyui-menu" border="false">
                    <div onclick="purchaserequest_approval_action_approve(1)" id="purchaserequestapproval-approve" iconCls="icon-ok"><span>Approve</span></div>
                    <div onclick="purchaserequest_approval_action_approve(2)" id="purchaserequestapproval-pending" iconCls="icon-wait"><span>Pending</span></div>
                    <div onclick="purchaserequest_approval_action_approve(3)" id="purchaserequestapproval-reject"iconCls="icon-reject"><span>Reject</span></div>    
                </div>-->
                <table id="purchaserequest" data-options="
                       method:'post',
                       border:false,
                       singleSelect:true,
                       fit:true,     
                       pageList: [30, 50, 70, 90, 110],
                       pageSize:30,
                       rownumbers:true,                       
                       fitColumns:false,
                       pagination:true,
                       striped:true,
                       idField:'id',
                       nowrap: false,                       
                       sortName:'number',
                       sortOrder:'desc',
                       toolbar:'#purchaserequest_toolbar'">
                    <thead>
                        <tr>  
                            <th field="chck" checkbox="true"></th>
                            <th field="number" width="80" halign="center" sortable="true">PR NO.</th>                            
                            <th field="date" formatter="myFormatDate" sortable="true" width="70" align="center">Date</th>
                            <th field="mr_number_list" width="150" halign="center" formatter='pr_mr_list_format'>MR</th>
                            <!--<th field="employeerequest" width="110" halign="center">Request By</th>-->
                            <!--<th field="department" width="150" halign="center">Department</th>-->
                            <th field="total_amount" width="150" halign="center" align="right">Amount</th>
                            <th field="prepared_by" width="130" halign="center">Prepared By</th>
                            <th field="status" width="100" halign="center">Status</th>
                            <th field="comment" width="100" halign="center" formatter="purchaserequest_comments">Comment</th>
                            <th field="attachment" width="100" halign="center" formatter="purchaserequest_attachments">Attachment</th>
                            <th field="remark" width="180">Remark</th>
                        </tr>
                    </thead>
                </table>
                <script type="text/javascript">
                            var purchaserequestid = 0;
                            $(function() {
                            $('#purchaserequest').datagrid({
                                    url: base_url + 'purchaserequest/get',
                                    onSelect: function(value, row, index) {
                                            $('#po_plan').datagrid('reload', {purchaserequestid: row.id});
                                            $('#purchaserequestdetail').datagrid({
                                            url: '<?php echo site_url('purchaserequestdetail/get') ?>',
                                                    queryParams: {
                                                    purchaserequestid: row.id
                                                    }
                                            });
                                            
                                            $('#purchaserequestapproval').datagrid({
                                                url: '<?php echo site_url('purchaserequestapproval/get') ?>',
                                                queryParams: {
                                                    purchaserequestid: row.id
                                                }
                                            });
                                            if (row.countitem === '0') {
                                    //alert(row.countitem);
                                                $('#process_approve').linkbutton('disable');
                                                $('#purchaseorder-create').linkbutton('disable');
                                                
                                                if (row.countapproval === '0'){
                                                    $('#purchaserequestdetail-add').linkbutton('enable');
                                                    $('#purchaserequestdetail-edit').linkbutton('enable');
                                                    $('#purchaserequestdetail-remove').linkbutton('enable');
                                                    
                                                    $('#purchaserequestdetail-add-from-requisition').linkbutton('enable');                                                    
                                                    $('#purchaserequestdetail-add-to-outsource').linkbutton('enable');
                                                    
                                                    $('#process_approve').linkbutton('enable');
                                                    $('#purchaseorder-create').linkbutton('disable');
                                                    $('#purchaserequest-edit').linkbutton('enable');
                                                    $('#purchaserequest-delete').linkbutton('enable');
                                                }
                                            } else {
                                                if (row.countapproval === '0') {
                                                    $('#purchaserequestdetail-add').linkbutton('enable');
                                                    $('#purchaserequestdetail-edit').linkbutton('enable');
                                                    $('#purchaserequestdetail-remove').linkbutton('enable');
                                                    $('#purchaserequestdetail-set-vendor_price').linkbutton('enable');
                                                    $('#purchaserequestdetail-add-from-requisition').linkbutton('enable');                                                    
                                                    $('#purchaserequestdetail-add-to-outsource').linkbutton('enable');
                                                    
                                                    $('#process_approve').linkbutton('enable');
                                                    $('#purchaseorder-create').linkbutton('disable');
                                                    $('#purchaserequest-edit').linkbutton('enable');
                                                    $('#purchaserequest-delete').linkbutton('enable');
                                                } else {
                                                    $('#purchaserequest-edit').linkbutton('disable');
                                                    $('#purchaserequest-delete').linkbutton('disable');
                                                    $('#purchaserequestdetail-add').linkbutton('disable');
                                                    $('#purchaserequestdetail-edit').linkbutton('disable');
                                                    $('#purchaserequestdetail-remove').linkbutton('disable');
                                                    
                                                    $('#purchaserequestdetail-set-vendor_price').linkbutton('disable');
                                                    $('#purchaserequestdetail-add-from-requisition').linkbutton('disable');                                                    
                                                    $('#purchaserequestdetail-add-to-outsource').linkbutton('disable');
                                                    
                                                    $('#process_approve').linkbutton('disable');
                                                    
                                                    if (row.complete_approve === 'f') {
                                                        $('#purchaseorder-create').linkbutton('disable');
                                                    } else {
                                                        if (row.countpurchaseorder === '0') { //if this purchase request has purchase order
                                                            $('#purchaseorder-create').linkbutton('enable');
                                                        } else {
                                                            $('#purchaseorder-create').linkbutton('disable');
                                                        }
                                                    }
                                                }
                                            }
                                            
                                            var session_employeeid = '<?php echo $this->session->userdata("id") ?>';
                                            //if active user outstanding to approve Purchase request, make approval button available
                                            if (row.purchaserequestapprovalemployeeid === session_employeeid) {
                                                $('#mm_action_approve').menubutton('enable');
                                            } else {
                                                $('#mm_action_approve').menubutton('disable');
                                            }
                                        },
                                        view: detailview,
                                        detailFormatter:function(index, row){
                                            return '<div class="ddv" style="padding:5px 0"></div>';
                                        },
                                        onExpandRow: function(index, row){
                                            $('#purchaserequest').datagrid('selectRow', index);
                                            var ddv = $(this).datagrid('getRowDetail', index).find('div.ddv');
                                            
                                            ddv.panel({
                                            height:80,
                                                    border:false,
                                                    cache:false,
                                                    href: base_url + 'purchaserequest/view_approval/' + row.id,
                                                    onLoad:function(){
                                                    $('#purchaserequest').datagrid('fixDetailRowHeight', index);
                                                    }
                                            });
                                            $('#purchaserequest').datagrid('fixDetailRowHeight', index);
                                    }
                            }).datagrid('getPager').pagination({
                            buttons: [
                            {
<?php
if ($this->session->userdata('department') == 7 && in_array('change_default_approval', $action)) {
    ?>
                                id: 'config_default_aprroval',
                                        text: 'Default Approval',
                                        iconCls: 'icon-configuration',
                                        handler: function() {
                                        purchaserequest_config_default_aprroval();
                                        }
<?php } ?>
                            }
                            , {
<?php
if ($this->session->userdata('department') == 7) {
    ?>
                                id: 'process_approve',
                                        text: 'Submit for Approval >>',
                                        iconCls: 'icon-process_approve',
                                        handler: function() {
                                        purchaserequest_process_to_approve();
                                        }
<?php } ?>
                            }
                            ]
                            });
                            });
                            function purchaserequest_comments(value, row, index) {
                            return '<a href="#" onclick="purchaserequest_comment(' + row.id + ')">Comment (' + row.countcomment + ')</a>';
                            }

                    function purchaserequest_attachments(value, row, index){
                    return '<a href="#" onclick="purchaserequest_attachment(' + row.id + ')">Attachment (' + row.countattachment + ')</a>';
                    }

                    $('#purchaserequest_menu_search').tooltip({
                    position: 'bottom',
                            content: $('<div></div>'),
                            showEvent: 'click',
                            hideEvent: 'none',
                            onUpdate: function (content) {
                            content.panel({
                            width: 320,
                                    border: true,
                                    title: 'Search',
                                    href: base_url + 'purchaserequest/load_search_form'
                            });
                            },
                            onShow: function() {
                            var t = $(this);
                                    t.tooltip('tip').unbind().bind('mouseenter', function() {
                            t.tooltip('show');
                            });
                            }
                    });
                            function pr_mr_list_format(value, row, index){
                            if (value !== null){
                                    var mr_list = value.split(",");
                                    var rtn_format = '';
                                    for (var i = 0; i < mr_list.length; i++){
                                        var temp = mr_list[i].split("#");
                                        if(i===0){
                                            rtn_format = rtn_format + '<a href="javascript:void('+temp[0]+')">'+temp[1]+'</a>'
                                        }else{
                                            rtn_format = rtn_format + ', <a href="javascript:void('+temp[0]+')">'+temp[1]+'</a>'
                                        }
                                        
                                    }
                                    return rtn_format;
                            }
                            }
                </script>

            </div>
        <!--<div region="east" title="Purchase Approval" href="<?php //echo site_url('purchaserequestapproval')                           ?>" split="true" style="width: 270px;"></div>-->
        </div>
    </div>
    <div data-options="region:'south',split:true" collapsible="false" style="height:300px;">
        <div class="easyui-tabs" fit="true" tabHeight="18">
            <div title="Item" 
                 border="false"
                 href="<?php echo site_url('purchaserequestdetail/view_detail') ?>">
            </div>
            <div title="PO Plan" 
                 fit="true" 
                 border="false"
                 href="<?php echo site_url('purchaserequest/po_plan') ?>"
                 data-options='onLoad:function(){
                 var row = $("#purchaserequest").datagrid("getSelected");
                 if(row !== null){
                 $("#po_plan").datagrid("reload", {
                 purchaserequestid: row.id
                 });
                 }
                 }'>
            </div>
        </div>

    </div>
</div>
</div>
<?php
//$this->load->view('pricecomparison/view');
//$this->load->view('pricecomparison/add');
//$this->load->view('purchaserequest/comment/view');
//$this->load->view('purchaserequest/attachment/view');
//$this->load->view('purchaseorder/add');
//$this->load->view('purchaserequest/edit_price');











