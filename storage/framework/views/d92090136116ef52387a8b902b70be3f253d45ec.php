<?php echo e(Form::model($milestone, array('route' => array('project.windowacess.update', $milestone->id), 'method' => 'POST'))); ?>


<div class="modal-body">
<div class="row">
      <div class="col-6 form-group">
        <?php if(!empty($milestone->gearlockrate)): ?>
        <?php echo e(Form::label('gearlockrate', __('gearlockrate'),['class' => 'form-label'])); ?>

        <?php echo e(Form::number('gearlockrate', null, array('class' => 'form-control','required'=>'required'))); ?>

        <?php else: ?>    
        <?php echo e(Form::label('latchlockrate', __('latchlockrate'),['class' => 'form-label'])); ?>

        <?php echo e(Form::number('latchlockrate', null, array('class' => 'form-control','required'=>'required'))); ?>

        <?php endif; ?>
    </div>
        <div class="col-6 form-group">
        <?php echo e(Form::label('sashrollrate', __('sashrollrate'),['class' => 'form-label'])); ?>

        <?php echo e(Form::number('sashrollrate', null, array('class' => 'form-control','required'=>'required'))); ?>

        </div>
        <div class="col-6 form-group">
        <?php echo e(Form::label('flathandlerate', __('flathandlerate'),['class' => 'form-label'])); ?>

        <?php echo e(Form::number('flathandlerate', null, array('class' => 'form-control','required'=>'required'))); ?>

           
        </div>
        <div class="col-6 form-group">
        <?php echo e(Form::label('slidekeeprate', __('slidekeeprate'),['class' => 'form-label'])); ?>

        <?php echo e(Form::number('slidekeeprate', null, array('class' => 'form-control','required'=>'required'))); ?>

           
        
        </div>
        <div class="col-6 form-group">
        <?php echo e(Form::label('dummywheelrate', __('dummywheelrate'),['class' => 'form-label'])); ?>

        <?php echo e(Form::number('dummywheelrate', null, array('class' => 'form-control','required'=>'required'))); ?> 
           
        </div>
        <div class="col-6 form-group">
        <?php echo e(Form::label('netwheelrate', __('netwheelrate'),['class' => 'form-label'])); ?>

        <?php echo e(Form::number('netwheelrate', null, array('class' => 'form-control','required'=>'required'))); ?> 
           
        </div>
        <div class="col-6 form-group">
        <?php echo e(Form::label('siliconrate', __('siliconrate'),['class' => 'form-label'])); ?>

        <?php echo e(Form::number('siliconrate', null, array('class' => 'form-control','required'=>'required'))); ?> 
           
        </div>
        <div class="col-6 form-group">
        <?php echo e(Form::label('fixerrate', __('fixerrate'),['class' => 'form-label'])); ?>

        <?php echo e(Form::number('fixerrate', null, array('class' => 'form-control','required'=>'required'))); ?> 
           
        </div>
        <div class="col-6 form-group">
        <?php echo e(Form::label('windbreakrate', __('windbreakrate'),['class' => 'form-label'])); ?>

        <?php echo e(Form::number('windbreakrate', null, array('class' => 'form-control','required'=>'required'))); ?> 
           
        </div>
        <div class="col-6 form-group">
        <?php echo e(Form::label('stopperrate', __('stopperrate'),['class' => 'form-label'])); ?>

        <?php echo e(Form::number('stopperrate', null, array('class' => 'form-control','required'=>'required'))); ?> 
             
        </div>
        <div class="col-6 form-group">
            <?php echo e(Form::label('bumperblockrate', __('bumperblockrate'),['class' => 'form-label'])); ?>

            <?php echo e(Form::number('bumperblockrate', null, array('class' => 'form-control','required'=>'required'))); ?> 
             
        </div>
        <div class="col-6 form-group">
        <?php echo e(Form::label('steeltaprate', __('steeltaprate'),['class' => 'form-label'])); ?>

        <?php echo e(Form::number('steeltaprate', null, array('class' => 'form-control','required'=>'required'))); ?> 
             
        </div>
        <div class="col-6 form-group">
            <?php echo e(Form::label('conscrewrate', __('conscrewrate'),['class' => 'form-label'])); ?>

            <?php echo e(Form::number('conscrewrate', null, array('class' => 'form-control','required'=>'required'))); ?> 
             
        </div>
        
</div>
</div>
<div class="modal-footer">
    <input type="button" value="<?php echo e(__('Cancel')); ?>" class="btn  btn-light" data-bs-dismiss="modal">
    <input class="btn btn-sm btn-primary btn-icon rounded-pill" type="submit" value="Add">
</div>
<?php echo e(Form::close()); ?><?php /**PATH /home2/babarras/public_html/resources/views/projectwindows/slidedit.blade.php ENDPATH**/ ?>