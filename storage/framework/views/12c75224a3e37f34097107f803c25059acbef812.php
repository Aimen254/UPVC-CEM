<?php echo e(Form::open(array('url' => 'leads'))); ?>

<div class="modal-body">
    <div class="row">
        <div class="col-6 form-group">
            <?php echo e(Form::label('subject', __('Subject'),['class'=>'form-label'])); ?>

            <?php echo e(Form::text('subject', null, array('class' => 'form-control','required'=>'required'))); ?>

        </div>
        <div class="col-6 form-group">
            <?php echo e(Form::label('user_id', __('User'),['class'=>'form-label'])); ?>

            <?php echo e(Form::select('user_id', $users,null, array('class' => 'form-control select','required'=>'required'))); ?>

            <?php if(count($users) == 1): ?>
                <div class="text-muted text-xs">
                    <?php echo e(__('Please create new users')); ?> <a href="<?php echo e(route('users.index')); ?>"><?php echo e(__('here')); ?></a>.
                </div>
            <?php endif; ?>
        </div>
        <div class="col-6 form-group">
            <?php echo e(Form::label('name', __('Name'),['class'=>'form-label'])); ?>

            <?php echo e(Form::text('name', null, array('class' => 'form-control','required'=>'required'))); ?>

        </div>
        <!--<div class="col-6 form-group">-->
        <!--    <?php echo e(Form::label('email', __('Email'),['class'=>'form-label'])); ?>-->
        <!--    <?php echo e(Form::text('email', null, array('class' => 'form-control','required'=>'required'))); ?>-->
        <!--</div>-->
        <div class="col-6 form-group">
            <?php echo e(Form::label('phone', __('Phone'),['class'=>'form-label'])); ?>

            <?php echo e(Form::text('phone', null, array('class' => 'form-control','required'=>'required'))); ?>

        </div>
          <div class="col-6 form-group">
            <?php echo e(Form::label('houseno', __('House#'),['class'=>'form-label'])); ?>

            <?php echo e(Form::number('houseno', null, array('class' => 'form-control'))); ?>

        </div>
        <div class="col-6 form-group">
            <?php echo e(Form::label('streetno', __('Street#'),['class'=>'form-label'])); ?>

            <?php echo e(Form::text('streetno', null, array('class' => 'form-control'))); ?>

        </div>
         <div class="col-6 form-group">
            <?php echo e(Form::label('sector', __('Sector'),['class'=>'form-label'])); ?>

            <?php echo e(Form::text('sector', null, array('class' => 'form-control'))); ?>

        </div>
        <div class="col-6 form-group">
            <?php echo e(Form::label('area', __('Area'),['class'=>'form-label'])); ?>

            <?php echo e(Form::text('area', null, array('class' => 'form-control'))); ?>

        </div>
        <div class="col-6 form-group">
            <?php echo e(Form::label('housesize', __('HouseSize'),['class'=>'form-label'])); ?>

            <?php echo e(Form::text('housesize', null, array('class' => 'form-control'))); ?>

        </div>
        <div class="col-6 form-group">
            <?php echo e(Form::label('whoishe', __('Who is he'),['class'=>'form-label'])); ?>

            <?php echo e(Form::text('whoishe', null, array('class' => 'form-control','required'=>'required'))); ?>

        </div>
          <div class="col-sm-6 col-md-6">
            <div class="form-group">
                <?php echo e(Form::label('created_at', __('Created_at'), ['class' => 'form-label'])); ?>

                <?php echo e(Form::date('created_at', null, ['class' => 'form-control'])); ?>

            </div>
        </div>
    </div>
</div>

<div class="modal-footer">
    <input type="button" value="<?php echo e(__('Cancel')); ?>" class="btn  btn-light" data-bs-dismiss="modal">
    <input type="submit" value="<?php echo e(__('Create')); ?>" class="btn  btn-primary">
</div>

<?php echo e(Form::close()); ?>


<?php /**PATH /home2/babarras/public_html/resources/views/leads/create.blade.php ENDPATH**/ ?>