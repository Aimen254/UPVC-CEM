<?php echo e(Form::open(array('url' => 'access'))); ?>

<div class="modal-body">
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <?php echo e(Form::label('name', __('Name'),['class'=>'form-label'])); ?><span class="text-danger">*</span>
                <div class="form-icon-user">
                    <?php echo e(Form::text('name', '', array('class' => 'form-control'))); ?>

                </div>
            </div>
        </div>
        <div class="form-group col-md-12">
            <?php echo e(Form::label('description', __('Description'),['class'=>'form-label'])); ?>

            <?php echo Form::textarea('description', null, ['class'=>'form-control','rows'=>'2']); ?>

        </div>
        <div class="col-md-6">
            <div class="form-group">
                <?php echo e(Form::label('price', __('Price'),['class'=>'form-label'])); ?><span class="text-danger">*</span>
                <div class="form-icon-user">
                    <?php echo e(Form::number('price', '', array('class' => 'form-control'))); ?>

                </div>
            </div>
        </div>

        <div class="form-group col-md-6">
            <?php echo e(Form::label('quantity', __('Quantity'),['class'=>'form-label'])); ?><span class="text-danger">*</span>
            <?php echo e(Form::text('quantity',null, array('class' => 'form-control'))); ?>

        </div>
      
        <div class="form-group col-md-6">
            <?php echo e(Form::label('type_id', __('Type'),['class'=>'form-label'])); ?><span class="text-danger">*</span>
            <?php echo e(Form::select('type_id', $type,null, array('class' => 'form-control select'))); ?>

        </div>
    </div>
</div>
<div class="modal-footer">
    <input type="button" value="<?php echo e(__('Cancel')); ?>" class="btn  btn-light" data-bs-dismiss="modal">
    <input type="submit" value="<?php echo e(__('Create')); ?>" class="btn  btn-primary">
</div>
<?php echo e(Form::close()); ?>



<?php /**PATH /home2/babarras/public_html/resources/views/accessories/create.blade.php ENDPATH**/ ?>