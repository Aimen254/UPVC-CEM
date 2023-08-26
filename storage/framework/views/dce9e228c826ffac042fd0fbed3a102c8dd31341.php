
    <?php echo e(Form::open(array('route' => ['leads.remind.store',$lead->id]))); ?>


<div class="modal-body">
    <div class="row">
        <div class="col-6 form-group">
            <?php echo e(Form::label('name', __('Name'),['class'=>'form-label'])); ?>

            <?php echo e(Form::text('name', null, array('class' => 'form-control','required'=>'required'))); ?>

        </div>
        <div class="col-6 form-group">
            <?php echo e(Form::label('description', __('Description'),['class'=>'form-label'])); ?>

            <?php echo Form::textarea('description', null, ['class'=>'form-control','rows'=>'2']); ?>

        </div>
        <div class="col-12 form-group">
            <?php echo e(Form::label('time', __('Time'),['class'=>'form-label'])); ?> <small class="font-weight-bold"><?php echo e(__(' (Format h:m:s i.e 00:35:20 means 35 Minutes and 20 Sec)')); ?></small>
            <?php echo e(Form::time('time', null, array('class' => 'form-control','placeholder'=>'00:35:20','step'=>'2'))); ?>

        </div>
        <div class="col-12 form-group">
            <?php echo e(Form::label('date', __('Date'),['class'=>'form-label'])); ?>

            <?php echo e(Form::date('date',null,array('class'=>'form-control','required'=>'required'))); ?>


        </div>
    </div>
</div>
<div class="modal-footer">
    <input type="button" value="<?php echo e(__('Cancel')); ?>" class="btn  btn-light" data-bs-dismiss="modal">
    <?php if(isset($call)): ?>
        <input type="submit" value="<?php echo e(__('Update')); ?>" class="btn  btn-primary">
    <?php else: ?>
        <input type="submit" value="<?php echo e(__('Create')); ?>" class="btn  btn-primary">
    <?php endif; ?>
</div>
<?php echo e(Form::close()); ?>


<?php /**PATH /home2/babarras/public_html/resources/views/leads/reminder.blade.php ENDPATH**/ ?>