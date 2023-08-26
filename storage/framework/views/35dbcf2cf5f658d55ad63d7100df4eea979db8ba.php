

<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Manage Windows')); ?> 
<?php $__env->stopSection(); ?>

<?php $__env->startPush('css-page'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('css/summernote/summernote-bs4.css')); ?>">
<?php $__env->stopPush(); ?>
<?php $__env->startPush('script-page'); ?>
    <script src="<?php echo e(asset('css/summernote/summernote-bs4.js')); ?>"></script>
    <script>
        $(document).on("change", ".change-pipeline select[name=default_pipeline_id]", function () {
            $('#change-pipeline').submit();
        });
    </script>
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
    <!-- $('.btnprn').printPage(); -->
    <!-- $('.btnprn').window.print();
    }); -->

</script>
<script>
    function printme(){
        window.print();
    }
</script>

<script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.js"></script>
$(document).ready(function(){
     $(#myTable).DataTable({
        "info": false,
        "searching": false,
     });
    }); 
</script>

<?php $__env->stopPush(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
    <li class="breadcrumb-item"><?php echo e(__('Windows')); ?></li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('action-btn'); ?>
    <div class="float-end">
       
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="row" >
        <div class="col-xxl-12">
            <div class="row">
            
                <div class="col-md-3 col-md-offset-5">
               
                    <div class="card text-center">
                        <div class="card-header border-0 pb-0">
                            <div class="d-flex justify-content-between align-items-center">
                                <h6 class="mb-0">
                                    <div class=" badge bg-primary p-2 px-3 rounded">
                                    
                                       
                                    </div>
                                </h6>

                            </div>

                          
                        </div>
                        <div class="card-body full-card">
                           <div class="img-fluid rounded-circle card-avatar">
                                 <img id="myFrame" src="<?php if(!empty($window->image)): ?> <?php echo e(asset('/formulaimages/'.$window->image)); ?> <?php endif; ?>" alt="kal" class="img-user wid-30 width="500" height="200" ">
                           </div>
                          
                        </div>
                      
                    </div>

                </div>
            </div>
            <?php if($window->designtype == "sliding Total cost"): ?>
                <div class= "row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body table-border-style">
                                <div class="table-responsive">
            
                                    <table class="table datatable" id="myTable" >
                                        <thead>
                                        <tr>
                                                <th><?php echo e(__('Profile')); ?></th>
                                                <th><?php echo e(__('Quantity')); ?></th>
                                                <th><?php echo e(__('OuterFrameAmount')); ?></th>
                                                <th><?php echo e(__('SlideSashAmount')); ?></th>
                                                <th><?php echo e(__('NetSAshAmount')); ?></th>
                                                <th><?php echo e(__('SlidingBeedAmount')); ?></th>
                                                <th><?php echo e(__('OuterFrameSteel')); ?></th>
                                                <th><?php echo e(__('SlideSteel')); ?></th>
                                                <th><?php echo e(__('NetSteel')); ?></th>
                                                <th><?php echo e(__('InterlockAmount')); ?></th>
                                                    <th><?php echo e(__('Total Expense')); ?></th>
                                        </tr>
                                    
                                        </thead>
                                        <tbody >
                                        <tr>
                                            <td><?php echo e($window->frame); ?>PKR</td>
                                            <td><?php echo e($window->quantity); ?>PKR</td>
                                            <td><?php echo e($window->outeramount); ?>PKR</td>
                                            <td><?php echo e($window->slideamount); ?>PKR</td>
                                            <td><?php echo e($window->netamount); ?>PKR</td> 
                                            <td><?php echo e($window->slidebeedamount); ?>PKR</td> 
                                            <td><?php echo e($window->outersteelamount); ?>PKR</td> 
                                            <td><?php echo e($window->slidesteelamount); ?>PKR</td> 
                                            <td><?php echo e($window->netsteelamount); ?>PKR</td> 
                                            <td><?php echo e($window->typeamount); ?>PKR</td> 
                                            <td><?php echo e($window->totalexpense); ?>PKR</td> 
                    
                                                </tr>
                                        
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    
    
                    </div>
            
                </div>
            <?php elseif($window->designtype == "fix total cost"): ?>
                <div class= "row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body table-border-style">
                                <div class="table-responsive">
            
                                    <table class="table datatable" id="myTable" >
                                        <thead>
                                        <tr>
                                                <th><?php echo e(__('Profile')); ?></th>
                                                <th><?php echo e(__('OuterFrame')); ?></th>
                                                <th><?php echo e(__('OuterFrameSteel')); ?></th>
                                                <th><?php echo e(__('CasementBeed')); ?></th>
                                                <th><?php echo e(__('Gaskit EMBD')); ?></th>
                                                    <th><?php echo e(__('Total Expense')); ?></th>
                                        </tr>
                                    
                                        </thead>
                                        <tbody >
                                        <tr>
                                            <td><?php echo e($window->frame); ?>PKR</td>
                                            <td><?php echo e($window->outeramount); ?>PKR</td>
                                            <td><?php echo e($window->outersteelamount); ?>PKR</td> 
                                            <td><?php echo e($window->slidebeedamount); ?>PKR</td>
                                            <td><?php echo e($window->gaskitamount); ?>PKR</td>
                                            <td><?php echo e($window->totalexpense); ?>PKR</td> 
                    
                                                </tr>
                                        
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    
    
                    </div>
            
                </div>
               
            
            <?php elseif($window->designtype == "openable total cost"): ?>
                <div class= "row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body table-border-style">
                                <div class="table-responsive">
            
                                    <table class="table datatable" id="myTable" >
                                        <thead>
                                        <tr>
                                                <th><?php echo e(__('Profile')); ?></th>
                                                <th><?php echo e(__('OuterWard/Inward Frame')); ?></th>
                                                <th><?php echo e(__('Window Outward/Inward SAsh')); ?></th>
                                                <th><?php echo e(__('WindowSashBeed')); ?></th>
                                                <th><?php echo e(__('OuterSteelFrame')); ?></th>
                                                <th><?php echo e(__('WindowSashSteel')); ?></th>
                                                <th><?php echo e(__('Gaskit EMBD')); ?></th>
                                                <th><?php echo e(__('Gaskit EMBD')); ?></th>
                                                <th><?php echo e(__('Gaskit Beeding')); ?></th>
                                                    <th><?php echo e(__('Total Expense')); ?></th>
                                        </tr>
                                    
                                        </thead>
                                        <tbody >
                                        <tr>
                                            <td><?php echo e($window->frame); ?>PKR</td>
                                            <td><?php echo e($window->outeramount); ?>PKR</td>
                                            <td><?php echo e($window->slideamount); ?>PKR</td>
                                            <td><?php echo e($window->slidebeedamount); ?>PKR</td>
                                            <td><?php echo e($window->outersteelamount); ?>PKR</td> 
                                            <td><?php echo e($window->slidesteelamount); ?>PKR</td> 
                                            <td><?php echo e($window->gaskitamount); ?>PKR</td>
                                            <td><?php echo e($window->xgaskitamount); ?>PKR</td>
                                            <td><?php echo e($window->gaskitbeedamount); ?>PKR</td>
                                            <td><?php echo e($window->totalexpense); ?>PKR</td> 
                    
                                                </tr>
                                        
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    
    
                    </div>
            
                </div>
            <?php elseif($window->designtype == "door total cost"): ?>
            
                <div class= "row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body table-border-style">
                                <div class="table-responsive">
            
                                    <table class="table datatable" id="myTable" >
                                        <thead>
                                        <tr>
                                                <th><?php echo e(__('Profile')); ?></th>
                                                <th><?php echo e(__('Outer Frame')); ?></th>
                                                <th><?php echo e(__('OuterSteelFrame')); ?></th>
                                                <th><?php echo e(__('Gaskit EMBD')); ?></th>
                                                <th><?php echo e(__('Door SAsh')); ?></th>
                                                <th><?php echo e(__('DoorSashSteel')); ?></th>
                                                <th><?php echo e(__('Gaskit EMBD')); ?></th>
                                                <th><?php echo e(__('WindowSashBeed')); ?></th>
                                                <th><?php echo e(__('Gaskit Beeding')); ?></th>
                                                <th><?php echo e(__('Fix Panel')); ?></th>
                                                    <th><?php echo e(__('Total Expense')); ?></th>
                                        </tr>
                                    
                                        </thead>
                                        <tbody >
                                        <tr>
                                            <td><?php echo e($window->frame); ?>PKR</td>
                                            <td><?php echo e($window->outeramount); ?>PKR</td>
                                            <td><?php echo e($window->outersteelamount); ?>PKR</td>
                                            <td><?php echo e($window->gaskitamount); ?>PKR</td>
                                            <td><?php echo e($window->slideamount); ?>PKR</td>
                                            <td><?php echo e($window->slidesteelamount); ?>PKR</td>
                                            <td><?php echo e($window->xgaskitamount); ?>PKR</td>
                                            <td><?php echo e($window->slidebeedamount); ?>PKR</td>
                                            <td><?php echo e($window->gaskitbeedamount); ?>PKR</td>
                                            <td><?php echo e($window->fixpanelamount); ?>PKR</td>
                                            <td><?php echo e($window->totalexpense); ?>PKR</td> 
                    
                                                </tr>
                                        
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    
    
                    </div>
            
                </div>
            <?php else: ?>
            <?php endif; ?>
        </div>

</div>


<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home2/babarras/public_html/resources/views/projectwindows/allview.blade.php ENDPATH**/ ?>