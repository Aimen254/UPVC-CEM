<?php echo e(Form::model($milestone, array('route' => array('project.window.update', $milestone->id),'enctype' => 'multipart/form-data', 'method' => 'POST'))); ?>

<div class="modal-body">
<div class="row">
        <div class="col-12 form-group">
            <label><strong>Width</strong></label><br/>
            <input class="form-control" type="number" name="width" id="width">
        </div>
        <div class="col-12 form-group">
                <label><strong>Height</strong></label><br/>
                <input class="form-control" type="number" name="height" id="height">
        </div>
          <div class="col-12 form-group">
            <?php echo e(Form::label('image',__('Image'),['class'=>'form-label'])); ?>

            <div class="choose-file form-group">
                <label for="image" class="form-label">
                    <div><?php echo e(__('Choose file here')); ?></div>
                    <input type="file" class="form-control" name="image" id="attachment" data-filename="attachment_create">
                </label>
                <p class="attachment_create"></p>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-check form-check-inline">
                <input type="radio" class="form-check-input" id="customRadio5" name="type" value="gear_handles" checked="checked" onclick="hide_show(this)">
                <label class="custom-control-label form-label" for="customRadio5"><?php echo e(__('Gear Handles')); ?></label>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-check form-check-inline">
                <input type="radio" class="form-check-input" id="customRadio6" name="type" value="interlock" onclick="hide_show(this)">
                <label class="custom-control-label form-label" for="customRadio6"><?php echo e(__('Latchlock')); ?></label>
            </div>
        </div>
          <div class="col-12 form-group">
                <?php echo e(Form::label('typequantity', __('Lock Quantity'), ['class' => 'form-label'])); ?>

                <?php echo e(Form::number('typequantity', null, ['class' => 'form-control'])); ?>

        </div>
</div>
</div>
<div class="modal-footer">
    <input type="button" value="<?php echo e(__('Cancel')); ?>" class="btn  btn-light" data-bs-dismiss="modal">
    <input class="btn btn-sm btn-primary btn-icon rounded-pill" type="submit" value="Add">
</div>
<?php echo e(Form::close()); ?><?php /**PATH /home2/babarras/public_html/resources/views/projectwindows/addvalues.blade.php ENDPATH**/ ?>