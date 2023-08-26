<?php echo e(Form::model($milestone, array('route' => array('assign.access.store', $milestone->id),'enctype' => 'multipart/form-data', 'method' => 'POST'))); ?>

<div class="modal-body">
<div class="row">
        
        <div class="col-6 form-group">
            <input type="checkbox" value="silicon" name="silicon">Silicon<br/> 
            <input class="form-control" type="number" name="siliconqty" placeholder="qty"  style="width: 5em;  display: inline-block;">
            <input class="form-control" type="number" name="siliconrate" placeholder="price" style="width: 6em;  display: inline-block;">
        </div>
        <div class="col-6 form-group">
            <input type="checkbox" value="steeltap" name="steeltap">SteelTapingScrew<br/> 
            <input class="form-control" type="number" name="steeltapqty"  placeholder="qty"  style="width: 5em;  display: inline-block;">
            <input class="form-control" type="number" name="steeltaprate"  placeholder="price"  style="width: 6em;  display: inline-block;">
        </div>
        <div class="col-6 form-group">
            <input type="checkbox" value="conscrew" name="conscrew">Concrete Screw<br/> 
            <input class="form-control" type="number" name="conscrewqty"  placeholder="qty"  style="width: 5em;  display: inline-block;">
            <input class="form-control" type="number" name="conscrewrate"  placeholder="price"  style="width: 6em;  display: inline-block;">
        </div>
        
</div>
</div>
<div class="modal-footer">
    <input type="button" value="<?php echo e(__('Cancel')); ?>" class="btn  btn-light" data-bs-dismiss="modal">
    <input class="btn btn-sm btn-primary btn-icon rounded-pill" type="submit" value="Add">
</div>
<?php echo e(Form::close()); ?><?php /**PATH /home2/babarras/public_html/resources/views/assignwindow/fixaccesscreate.blade.php ENDPATH**/ ?>