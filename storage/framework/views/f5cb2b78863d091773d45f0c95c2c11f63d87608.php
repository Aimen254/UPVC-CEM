<?php echo e(Form::model($milestone, array('route' => array('assign.window.update', $milestone->id),'enctype' => 'multipart/form-data', 'method' => 'POST'))); ?>

<div class="modal-body">
<div class="row">
        <div class="col-6 form-group">
            <label><strong>Outer Frame Price</strong></label><br/>
            <input class="form-control" type="number" name="outerprice" id="outerprice">
        </div>
        <div class="col-6 form-group">
                <label><strong>Outer Frame Steel Price</strong></label><br/>
                <input class="form-control" type="number" name="outersteelprice" id="outersteelprice">
        </div>
         
        <div class="col-6 form-group">
                <label><strong>Gaskit EPDM</strong></label><br/>
                <input class="form-control" type="number" name="gaskitprice" id="gaskitprice">
        </div>
        <div class="col-6 form-group">
                <label><strong>Door Sash Price</strong></label><br/>
                <input class="form-control" type="number" name="slideprice" id="slideprice">
        </div>
        <div class="col-6 form-group">
                <label><strong>Sash steel Price</strong></label><br/>
                <input class="form-control" type="number" name="slidesteelprice" id="slidesteelprice">
        </div>
        <div class="col-6 form-group">
                <label><strong>Door Sash Beeding Frame Price</strong></label><br/>
                <input class="form-control" type="number" name="slidebeedprice" id="slidebeedprice">
        </div>
        <div class="col-6 form-group">
                <label><strong>Gaskit EPDM 2X</strong></label><br/>
                <input class="form-control" type="number" name="xgaskitprice" id="gaskitprice">
        </div>
        <div class="col-6 form-group">
                <label><strong>Gaskit EPDM Beeding</strong></label><br/>
                <input class="form-control" type="number" name="gaskitbeedprice" id="gaskitbeedprice">
        </div>
        <div class="col-6 form-group">
                <label><strong>Fix panel</strong></label><br/>
                <input class="form-control" type="number" name="fixpanelprice" id="fixpanelprice">
        </div>
        
</div>
</div>
<div class="modal-footer">
    <input type="button" value="<?php echo e(__('Cancel')); ?>" class="btn  btn-light" data-bs-dismiss="modal">
    <input class="btn btn-sm btn-primary btn-icon rounded-pill" type="submit" value="Add">
</div>
<?php echo e(Form::close()); ?><?php /**PATH /home2/babarras/public_html/resources/views/assignwindow/dooraddprice.blade.php ENDPATH**/ ?>