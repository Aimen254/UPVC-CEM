
<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Manage Product & Services')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startPush('css-page'); ?>
  
    
<?php $__env->stopPush(); ?>
<?php $__env->startPush('script-page'); ?>

<?php $__env->stopPush(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
    <li class="breadcrumb-item"><?php echo e(__('Product & Services')); ?></li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('action-btn'); ?>
    <div class="float-end">
 
        <a href="#" data-size="md"  data-bs-toggle="tooltip" title="<?php echo e(__('Import')); ?>" data-url="<?php echo e(route('productservice.file.import')); ?>" data-ajax-popup="true" data-title="<?php echo e(__('Import product CSV file')); ?>" class="btn btn-sm btn-primary">
            <i class="ti ti-file-import"></i>
        </a>
         <a href="<?php echo e(route('projcut.sheet',$id)); ?>" class="btn btn-sm btn-primary">
                <?php echo e(__('Cutting Sheet')); ?>

        </a>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
 
<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body table-border-style">
                <div class="table-responsive">
                    <table class="table datatable">
                        <thead>
                        <tr>
                            <th><?php echo e(__('Profile')); ?></th>
                            <th><?php echo e(__('Design')); ?></th>
                            <th><?php echo e(__('DesignType')); ?></th>
                            <th><?php echo e(__('Windowtype')); ?></th>
                            <th><?php echo e(__('Company')); ?></th>         
                            <th class="text-end"><?php echo e(__('Action')); ?></th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $projs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($project->frame); ?></td>
                                    <td scope="row">
                                
                                        <?php if(!empty($project->image)): ?>
                                    
                                            <img src="<?php echo e((!empty($project ->image))?
                                            asset(Storage::url("uploads/windows/".$project->image)): asset(Storage::url("uploads/avatar/avatar.png"))); ?>" alt="kal" class="img-user wid-80">

                                        <?php else: ?>
                                        <a href="#" class="btn btn-sm btn-secondary btn-icon rounded-pill">
                                            <span class="btn-inner--icon"><i class="ti ti-times-circle"></i></span>
                                        </a>
                                        <?php endif; ?>

                                    </td>
                                    <td><?php echo e($project->designtype); ?></td>
                                    <td><?php echo e($project->designtyperatio); ?></td>
                                    <td><?php echo e($project->company); ?></td>
                                    <td>
                                        <div class="action-btn bg-primary ms-2">
                                            <a href="#" class="mx-3 btn btn-sm d-inline-flex align-items-center" data-url="<?php echo e(route('projwin.edit',$project->id)); ?>" data-ajax-popup="true" data-size="md" data-bs-toggle="tooltip" title="<?php echo e(__('FinalValues')); ?>" data-title="<?php echo e(__(' Add Final Values')); ?>">
                                                <i class="ti ti-pencil text-white"></i>
                                            </a>
                                        </div>
                                    </td>

                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home2/babarras/public_html/resources/views/projectwindows/list.blade.php ENDPATH**/ ?>