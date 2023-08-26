
<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Manage Images')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('css-page'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('css/summernote/summernote-bs4.css')); ?>">
<?php $__env->stopPush(); ?>
<?php $__env->startPush('script-page'); ?>
    <script src="<?php echo e(asset('css/summernote/summernote-bs4.js')); ?>"></script>
 
<script>
$(document).ready(function(){
    $('#select_id').on('change', function() {
        var val = $(this).val();
    $("#myTable tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(val) > -1)
    });
  });
});
</script>
<script>
    $(document).ready(function(){
    $('.btnprn').printPage(); 
$('.btnprn').window.print();
    }); 

</script>
<script>
    function printme(){
        window.print();
    }
</script>

<?php $__env->stopPush(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
    <li class="breadcrumb-item"><?php echo e(__('Quotations')); ?></li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('action-btn'); ?>
    <div class="float-end">
        
        <a href="#" onclick="printme();" data-size="lg" data-url="" data-ajax-popup="true" data-bs-toggle="tooltip" title="<?php echo e(__('Print Data')); ?>" class="btn btn-sm btn-primary btnprn">
            <i class="fa fa-print"></i>
        </a>
      
       <a href="<?php echo e(route('project.quote',$id)); ?>"  title="<?php echo e(__('Create New User')); ?>" class="btn btn-sm btn-primary">
            <i class="ti ti-plus"></i>
        </a>
        <a href="<?php echo e(route('project.quote.sheet',$id)); ?>"  data-bs-toggle="tooltip" title="<?php echo e(__('Internal Quote')); ?>" class="btn btn-sm btn-primary">
            <i class="fa fa-quote-left"></i>
        </a>
           <a href="<?php echo e(route('project.quote.client',$id)); ?>"  data-bs-toggle="tooltip" title="<?php echo e(__('Clients Quote')); ?>" class="btn btn-sm btn-primary">
           Quote
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
                                <th><?php echo e(__('Profile')); ?></th>
                                <th><?php echo e(__('Design')); ?></th>
                                <th><?php echo e(__('DesignType')); ?></th>
                                <th><?php echo e(__('Windowtype')); ?></th>
                                <th><?php echo e(__('Company')); ?></th>
                                <th><?php echo e(__('Action')); ?></th>
                                </tr>
                             
                                </thead>
                                <tbody id="myTable">
                                   
                                <?php $__currentLoopData = $projent; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $milestone): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    
                                    <tr>
                                        <td><?php echo e($milestone->frame); ?></td>
                                                                                  <td scope="row">
                                
                                            <?php if(!empty($milestone->image)): ?>
                              
                                               <img src="<?php echo e((!empty($milestone->image))? asset(Storage::url("uploads/windows/".$milestone->image)): asset(Storage::url("uploads/avatar/avatar.png"))); ?>" alt="kal" class="img-user wid-80">


                                    <?php else: ?>
                                        <a href="#" class="btn btn-sm btn-secondary btn-icon rounded-pill">
                                            <span class="btn-inner--icon"><i class="ti ti-times-circle"></i></span>
                                        </a>
                                    <?php endif; ?>
                                

                                

                                 </td>
                                 
                                  <td><?php echo e($milestone->designtype); ?></td>
                                   
                                 <td><?php echo e($milestone->designtyperatio); ?></td>
                                 
                                        <td><?php echo e($milestone->company); ?></td>
                                <td>
                                       <div class="action-btn bg-danger ms-2">
                                        <?php echo Form::open(['method' => 'DELETE', 'route' => ['quote.window.delete', $milestone->id]]); ?>

                                        <a href="#" class="mx-3 btn btn-sm  align-items-center bs-pass-para" data-bs-toggle="tooltip" title="<?php echo e(__('Delete')); ?>"><i class="ti ti-trash text-white"></i></a>

                                        <?php echo Form::close(); ?>

                                    </div> 
                                       <div class="action-btn bg-warning ms-2">
                                        <a href="<?php echo e(route('windows.show',$milestone->id)); ?>" title="<?php echo e(__('View')); ?>" class="btn btn-sm">
                                            <i class="ti ti-eye text-white"></i>
                                        </a>
                                        </div>
                                           <div class="action-btn bg-info ms-2">
                                        <a href="<?php echo e(route('project-quote.edit',[$milestone->id])); ?>" title="<?php echo e(__('Edit')); ?>" class="btn btn-sm">
                                            <i class="ti ti-pencil text-white"></i>
                                        </a>
                                        </div>
                                          <div class="action-btn bg-danger ms-2">
                                            <a href="<?php echo e(route('change_win_status', $milestone->id)); ?>" class=" btn btn-sm  align-items-center btn-<?php echo e($milestone->final  == 1 ? 'info' : 'primary'); ?>" title="<?php echo e(__('Final Window')); ?>">
                                        <?php if( $milestone->final == 1 ): ?> <i class="fa fa-quote-left"></i>  <?php else: ?> <i  class="fa fa-ban"></i> <?php endif; ?></a>
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

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home2/babarras/public_html/resources/views/projectwindows/quoteindex.blade.php ENDPATH**/ ?>