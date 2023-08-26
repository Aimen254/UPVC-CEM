<?php echo e(Form::model($milestone, array('route' => array('project.windowopenacess.update', $milestone->id), 'method' => 'POST'))); ?>


<div class="modal-body">
<div class="row">
<div class="col-6 form-group">
            <?php echo e(Form::label('siliconrate', __('siliconrate'),['class' => 'form-label'])); ?>

            <?php echo e(Form::number('siliconrate', null, array('class' => 'form-control'))); ?> 
           
        </div>
        <div class="col-6 form-group">
            <?php echo e(Form::label('outwardcaserate', __('outwardcaserate'),['class' => 'form-label'])); ?>

            <?php echo e(Form::number('outwardcaserate', null, array('class' => 'form-control'))); ?> 
           
        </div>
        <div class="col-6 form-group">
            <?php echo e(Form::label('windowstayrate', __('windowstayrate'),['class' => 'form-label'])); ?>

            <?php echo e(Form::number('windowstayrate', null, array('class' => 'form-control'))); ?> 
          
        </div>
        <div class="col-6 form-group">
            <?php echo e(Form::label('frictionstayrate', __('frictionstayrate'),['class' => 'form-label'])); ?>

            <?php echo e(Form::number('frictionstayrate', null, array('class' => 'form-control'))); ?> 
            
        </div>
        <div class="col-6 form-group">
            <?php echo e(Form::label('pencilhindgerate', __('pencilhindgerate'),['class' => 'form-label'])); ?>

            <?php echo e(Form::number('pencilhindgerate', null, array('class' => 'form-control'))); ?> 
           
        </div>
        <div class="col-6 form-group">
            <?php echo e(Form::label('flathandlerate', __('flathandlerate'),['class' => 'form-label'])); ?>

            <?php echo e(Form::number('flathandlerate', null, array('class' => 'form-control'))); ?> 
           
        </div>

        <div class="col-6 form-group">
        <?php echo e(Form::label('twoDhindgesrate', __('2D hindgesrate'),['class' => 'form-label'])); ?>

            <?php echo e(Form::number('twoDhindgesrate', null, array('class' => 'form-control'))); ?> 
            
        </div>

        <div class="col-6 form-group">
        <?php echo e(Form::label('thDhindgesrate', __('3D hindgesrate'),['class' => 'form-label'])); ?>

            <?php echo e(Form::number('thDhindgesrate', null, array('class' => 'form-control'))); ?> 
           
        </div>

        
        <div class="col-6 form-group">
        <?php echo e(Form::label('openablekeeprate', __('3D hindgesrate'),['class' => 'form-label'])); ?>

            <?php echo e(Form::number('openablekeeprate', null, array('class' => 'form-control'))); ?> 
           
        </div>

        <div class="col-6 form-group">
        <?php echo e(Form::label('Tlockrate', __('Tlockrate'),['class' => 'form-label'])); ?>

            <?php echo e(Form::number('Tlockrate', null, array('class' => 'form-control'))); ?> 
           
        </div>

        <div class="col-6 form-group">
        <?php echo e(Form::label('cockspurrate', __('cockspurrate'),['class' => 'form-label'])); ?>

            <?php echo e(Form::number('cockspurrate', null, array('class' => 'form-control'))); ?> 
        
        </div>
</div>
</div>
<div class="modal-footer">
    <input type="button" value="<?php echo e(__('Cancel')); ?>" class="btn  btn-light" data-bs-dismiss="modal">
    <input class="btn btn-sm btn-primary btn-icon rounded-pill" type="submit" value="Add">
</div>
<?php echo e(Form::close()); ?><?php /**PATH /home2/babarras/public_html/resources/views/projectwindows/openedit.blade.php ENDPATH**/ ?>