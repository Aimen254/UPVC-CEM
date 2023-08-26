<div class="card sticky-top" style="top:30px">
    <div class="list-group list-group-flush" id="useradd-sidenav">
        <a href="<?php echo e(route('taxes.index')); ?>" class="list-group-item list-group-item-action border-0 <?php echo e((Request::route()->getName() == 'taxes.index' ) ? ' active' : ''); ?>"><?php echo e(__('Taxes')); ?> <div class="float-end"><i class="ti ti-chevron-right"></i></div></a>

        <a href="<?php echo e(route('product-category.index')); ?>" class="list-group-item list-group-item-action border-0 <?php echo e((Request::route()->getName() == 'product-category.index' ) ? 'active' : ''); ?>"><?php echo e(__('Category')); ?><div class="float-end"><i class="ti ti-chevron-right"></i></div></a>

        <a href="<?php echo e(route('product-unit.index')); ?>" class="list-group-item list-group-item-action border-0 <?php echo e((Request::route()->getName() == 'product-unit.index' ) ? ' active' : ''); ?>"><?php echo e(__('Unit')); ?><div class="float-end"><i class="ti ti-chevron-right"></i></div></a>

        <a href="<?php echo e(route('custom-field.index')); ?>" class="list-group-item list-group-item-action border-0 <?php echo e((Request::route()->getName() == 'custom-field.index' ) ? 'active' : ''); ?>   "><?php echo e(__('Custom Field')); ?><div class="float-end"><i class="ti ti-chevron-right"></i></div></a>
        <a href="<?php echo e(route('access-type.index')); ?>" class="list-group-item list-group-item-action border-0 <?php echo e((Request::route()->getName() == 'access-type.index' ) ? 'active' : ''); ?>   "><?php echo e(__('Access Type')); ?><div class="float-end"><i class="ti ti-chevron-right"></i></div></a>
                <a href="<?php echo e(route('frames.index')); ?>" class="list-group-item list-group-item-action border-0 <?php echo e((Request::route()->getName() == 'frames.index' ) ? 'active' : ''); ?>   "><?php echo e(__('Frame')); ?><div class="float-end"><i class="ti ti-chevron-right"></i></div></a>


    </div>
</div>
<?php /**PATH /home2/babarras/public_html/resources/views/layouts/account_setup.blade.php ENDPATH**/ ?>