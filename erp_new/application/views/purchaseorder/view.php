<div class="easyui-layout" data-options="fit:true">        
    <div region="center" style="border: none;" title="Purchase Order">
        <?php
        $this->load->view('purchaseorder/purchaseorder');
        $this->load->view('purchaseorder/edit');
        ?>
    </div>
    <div region="south" split="true" style="height:260px;border: none;">
        <?php $this->load->view('purchaseorder/purchaseorderdetail') ?>        
    </div>
</div>