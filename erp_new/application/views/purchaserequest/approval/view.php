<div id="purchaserequestapproval_toolbar" style="padding-bottom: 2px;min-height: 25px">
    <?php
    if ($this->session->userdata('department') == 7) {
        ?>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="purchaserequest_approval_change()">Edit Approval</a>
        <?php
    }
    ?>&nbsp;
</div>
<table id="purchaserequestapproval" data-options="       
       method:'post',
       border:false,
       singleSelect:true,
       fit:true,       
       rownumbers:false,
       fitColumns:true,
       pagination:false,
       toolbar:'#purchaserequestapproval_toolbar'">
    <thead>
        <tr>
            <th field="id_employee" width="150" halign="center">Employee/ID</th>         
            <th field="status_remark" width="80" align="center" styler="statusStyler">Status</th>            
            <th field="timeapprove" width="100" halign="center" styler="statusStyler">At</th>
        </tr>
    </thead>
</table>
<script type="text/javascript">
    $(function() {
        $('#purchaserequestapproval').datagrid();
    });
    function statusStyler(value, row, index) {
        if (row.status === '1') {
            return 'color:#336666;';
        } else if (row.status === '2') {
            return 'color:#d7d700;';
        } else if (row.status === '3') {
            return 'color:#cc0033;';
        } else {
            if (row.outstanding === 't') {
                return 'color:#330066;';
            } else {
                return 'color:#666600;';
            }
        }
    }
</script>
<?php
$this->load->view('purchaserequest/approval/default');
$this->load->view('purchaserequest/approval/pending_or_reject');
$this->load->view('purchaserequest/approval/change');
