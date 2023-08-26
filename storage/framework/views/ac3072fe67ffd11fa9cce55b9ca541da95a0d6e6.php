
<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Manage Images')); ?> 
<?php $__env->stopSection(); ?>

<?php $__env->startPush('css-page'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('css/summernote/summernote-bs4.css')); ?>">
<?php $__env->stopPush(); ?>
<?php $__env->startPush('script-page'); ?>
    <script src="<?php echo e(asset('css/summernote/summernote-bs4.js')); ?>"></script>
    
<?php $__env->stopPush(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
    <li class="breadcrumb-item"><?php echo e(__('Image')); ?></li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('action-btn'); ?>
    <div class="float-end">
        
      
        <a href="#" data-size="lg" data-url="<?php echo e(route('assignwindows.create')); ?>" data-ajax-popup="true" data-bs-toggle="tooltip" title="<?php echo e(__('Create New User')); ?>" class="btn btn-sm btn-primary">
            <i class="ti ti-plus"></i>
        </a>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body table-border-style">
                        <div class="table-responsive">
      
                            <table class="table datatable" >
                                <thead>
                                <tr>
                                   
                                 
                                   
                                    <th><?php echo e(__('Frames')); ?></th>
                                    <th><?php echo e(__('Design')); ?></th>
                                   <th><?php echo e(__('Type')); ?></th>
                                    <th><?php echo e(__('Action')); ?></th>
                                </tr>
                             
                                </thead>
                                <tbody id="myTable">
                                   
                                <?php if(count($images) > 0): ?>
                                <?php $__currentLoopData = $images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                     
                                     <tr>
                                        
                                         <td>
                                         <?php if(!empty($image->frame_id)): ?>
                                            <?php
                                                $frames=\Utility::frame($image->frame_id);
                                            ?>

                                            <?php $__currentLoopData = $frames; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $frame): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php echo e(!empty($frame)?$frame->name:''); ?><br>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php else: ?>
                                            -
                                        <?php endif; ?>
                                         </td>
                                         <!--<td scope="row">-->
                                        
                                         <!--   <?php if(!empty($image->image)): ?>-->
                                            
                                         <!--   <img src="<?php echo e((!empty($image->image))? asset(Storage::url("uploads/payment".$image->image)): asset(Storage::url("uploads/avatar/avatar.png"))); ?>" alt="kal" class="img-user wid-80 rounded-circle">-->
                                           
                                         <!--   <?php else: ?>-->
                                         <!--       <a href="#" class="btn btn-sm btn-secondary btn-icon rounded-pill">-->
                                         <!--           <span class="btn-inner--icon"><i class="ti ti-times-circle"></i></span>-->
                                         <!--       </a>-->
                                         <!--   <?php endif; ?>-->
                                        

                                         <!--</td>-->

                                       <td><?php echo e($image->profile); ?></td>
                                       <td><?php echo e($image->type); ?></td>
                                       <?php if($image->type == "sliding"): ?>
                                             <td class="Action">
                                                        
                                                   <a href="#" data-size="md" data-url="<?php echo e(route('assign.access.create',$image->id)); ?>" data-ajax-popup="true" data-bs-toggle="tooltip" title="<?php echo e(__('Edit')); ?>" class="btn btn-sm btn-primary">
                                                        Add Accessories
                                                    </a>        
                                               <a href="#" data-size="md" data-url="<?php echo e(route('assign.window.edit',$image->id)); ?>" data-ajax-popup="true" data-bs-toggle="tooltip" title="<?php echo e(__('Edit')); ?>" class="btn btn-sm btn-primary">
                                                        <i class="ti ti-plus"></i>
                                                    </a>
                                                       
                                             </td>
                                        <?php else: ?>
                                       <td class="Action">
                                                <a href="#" data-size="md" data-url="<?php echo e(route('assign.access.create',$image->id)); ?>" data-ajax-popup="true" data-bs-toggle="tooltip" title="<?php echo e(__('Edit')); ?>" class="btn btn-sm btn-primary">
                                                    Add Accessories
                                                </a>   
                                                <a href="#" data-size="md" data-url="<?php echo e(route('assign.window.edit',$image->id)); ?>" data-ajax-popup="true" data-bs-toggle="tooltip" title="<?php echo e(__('Edit')); ?>" class="btn btn-sm btn-primary">
                                                    <i class="ti ti-plus"></i>
                                                </a>
                                            </td>
                                        <?php endif; ?>
                                     </tr>
                                   
                                 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php else: ?>
                                    <tr class="font-style">
                                        <td colspan="6" class="text-center"><?php echo e(__('No data available in table')); ?></td>
                                    </tr>
                                <?php endif; ?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
   

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home2/babarras/public_html/resources/views/assignwindow/index.blade.php ENDPATH**/ ?>