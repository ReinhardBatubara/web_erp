<div class="easyui-layout" data-options="fit:true">        
    <div region="center" title="Stock Out"><?php $this->load->view('stockout/stockout'); ?></div>
    <div region="south" split="true" title="Stock Out Item" border="false" collapsible="false" style="height:300px;" href="<?php echo site_url("stockoutdetail") ?>"></div>
</div>
<div id="sto_temp99"></div>
<script type="text/javascript" src="js/stockout.js"></script>
