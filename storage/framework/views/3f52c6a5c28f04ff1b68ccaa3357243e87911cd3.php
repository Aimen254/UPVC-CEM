<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Balance Entry Create')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
    <li class="breadcrumb-item"><?php echo e(__('Double Entry')); ?></li>
    <li class="breadcrumb-item"><?php echo e(__('Balance Entry')); ?></li>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script-page'); ?>
    <script src="<?php echo e(asset('js/jquery.min.js')); ?>"></script>
    <script src="<?php echo e(asset('js/jquery.repeater.min.js')); ?>"></script>
    <script>
        var selector = "body";
        if ($(selector + " .repeater").length) {
            // var $dragAndDrop = $("body .repeater tbody").sortable({
            //     handle: '.sort-handler'
            // });
            var $repeater = $(selector + ' .repeater').repeater({
                initEmpty: false,
                defaultValues: {
                    'status': 1
                },
                show: function () {
                    $(this).slideDown();
                    var file_uploads = $(this).find('input.multi');
                    if (file_uploads.length) {
                        $(this).find('input.multi').MultiFile({
                            max: 3,
                            accept: 'png|jpg|jpeg',
                            max_size: 2048
                        });
                    }
                    if($('.select2').length) {
                        $('.select2').select2();
                    }
                },
                hide: function (deleteElement) {
                    if (confirm('Are you sure you want to delete this element?')) {
                        $(this).slideUp(deleteElement);
                        $(this).remove();

                        var inputs = $(".debit");
                        var totalDebit = 0;
                        for (var i = 0; i < inputs.length; i++) {
                            totalDebit = parseFloat(totalDebit) + parseFloat($(inputs[i]).val());
                        }
                        $('.totalDebit').html(totalDebit.toFixed(2));


                        var inputs = $(".credit");
                        var totalCredit = 0;
                        for (var i = 0; i < inputs.length; i++) {
                            totalCredit = parseFloat(totalCredit) + parseFloat($(inputs[i]).val());
                        }
                        $('.totalCredit').html(totalCredit.toFixed(2));


                    }
                },
                ready: function (setIndexes) {
                    // $dragAndDrop.on('drop', setIndexes);
                },
                isFirstItemUndeletable: true
            });
            var value = $(selector + " .repeater").attr('data-value');

            if (typeof value != 'undefined' && value.length != 0) {
                value = JSON.parse(value);
                $repeater.setList(value);
                for (var i = 0; i < value.length; i++) {
                    var tr = $('#sortable-table .id[value="' + value[i].id + '"]').parent();
                    tr.find('.item').val(value[i].product_id);
                    changeItem(tr.find('.item'));
                }
            }

        }
        var fix;
        var cfix= 0;
        var total=0;
        $(document).on('keyup', '.debit', function () {
            var el = $(this).parent().parent().parent().parent();
            var debit = $(this).val();
            var credit = 0;
            el.find('.credit').val(credit);
           
            var inputs = $(".debit");
            var am = 0;
            var totalDebit = 0;
          
            for (var i = 0; i < inputs.length; i++) {
                if(cfix == 0){
                    am = parseFloat(am) + parseFloat($(inputs[i]).val());
                el.find('.amount').html(am.toFixed(2));
                fix = el.find('.amount').html();
                total = el.find('.amount').text();
                }else{
                    am = parseFloat(cfix) + parseFloat($(inputs[i]).val());
                el.find('.amount').html(am.toFixed(2));
                fix = el.find('.amount').html();
                total = el.find('.amount').text();
                }
             
           
            }
     
            for (var i = 0; i < inputs.length; i++) {
                totalDebit = parseFloat(totalDebit) + parseFloat($(inputs[i]).val());
            }
            $('.totalDebit').html(totalDebit.toFixed(2));
            
            if(cfix == 0){
                $('.totalblnce').html(totalDebit.toFixed(2));
              
            }else{
                $('.totalblnce').html(am.toFixed(2));
               
            }
            
            el.find('.amt').val(total);
            el.find('.credit').attr("disabled", true);
            if (debit == '') {
                el.find('.credit').attr("disabled", false);
            }
        })

        $(document).on('keyup', '.credit', function () {
            var el = $(this).parent().parent().parent().parent();
            var credit = $(this).val();
            var debit = 0;
            el.find('.debit').val(debit);
      

            var inputs = $(".credit");
            var totalCredit = 0;
            for (var i = 0; i < inputs.length; i++) {
                am = parseFloat(fix) - parseFloat($(inputs[i]).val());
                el.find('.amount').html(am.toFixed(2));
                cfix = el.find('.amount').html();
                total = el.find('.amount').text();
            } 
            el.find('.amt').val(total);

            for (var i = 0; i < inputs.length; i++) {
                totalCredit = parseFloat(totalCredit) + parseFloat($(inputs[i]).val());
                am = parseFloat(fix) - parseFloat($(inputs[i]).val());
              
            }
            $('.totalCredit').html(totalCredit.toFixed(2));
            $('.totalblnce').html(am.toFixed(2));

            el.find('.debit').attr("disabled", true);
            if (credit == '') {
                el.find('.debit').attr("disabled", false);
            }
        })


    </script>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>

    <?php echo e(Form::open(array('route' => ['balance.entry.store'],'class'=>'w-100'))); ?>

    <input type="hidden" name="_token" id="token" value="<?php echo e(csrf_token()); ?>">
    <div class="row mt-4">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                    
                        <div class="col-lg-4 col-md-4">
                            <div class="form-group">
                                <?php echo e(Form::label('date', __('Transaction Date'),['class'=>'form-label'])); ?>

                                <div class="form-icon-user">
                                    <?php echo e(Form::date('date',null,array('class'=>'form-control','required'=>'required'))); ?>


                                </div>
                            </div>
                        </div>
                        <div class="col-lg-8 col-md-8">
                            <div class="form-group">
                                <?php echo e(Form::label('description', __('Description'),['class'=>'form-label'])); ?>

                                <?php echo e(Form::textarea('description', '', array('class' => 'form-control','rows'=>'2'))); ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-12">
            <div class="card repeater">
                <div class="item-section py-4">
                    <div class="row justify-content-between align-items-center">
                        <div class="col-md-12 d-flex align-items-center justify-content-between justify-content-md-end">
                            <a href="#" data-repeater-create="" class="btn btn-primary mr-2" data-toggle="modal" data-target="#add-bank">
                                <i class="ti ti-plus"></i> <?php echo e(__('Add Accounts')); ?>

                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body table-border-style">
                    <div class="table-responsive">
                        <table class="table mb-0" data-repeater-list="accounts" id="sortable-table">
                            <thead>
                            <tr>
                                <th><?php echo e(__('Account')); ?></th>
                                <th><?php echo e(__('Revenue')); ?></th>
                                <th><?php echo e(__('Expense')); ?> </th>
                                <th><?php echo e(__('Description')); ?></th>
                                <th class="text-end"><?php echo e(__('Amount')); ?> </th>
                                <th width="2%"></th>
                            </tr>
                            </thead>

                            <tbody class="ui-sortable" data-repeater-item>
                            <tr>
                                <td width="25%" class="form-group pt-0">
                                    <?php echo e(Form::select('account', $accounts,'', array('class' => 'form-control select','required'=>'required'))); ?>


                                </td>

                                <td>
                                    <div class="form-group price-input">
                                        <?php echo e(Form::text('debit','', array('class' => 'form-control debit','required'=>'required','placeholder'=>__('Revenue'),'required'=>'required'))); ?>

                                    </div>
                                </td>
                                <td>
                                    <div class="form-group price-input">
                                        <?php echo e(Form::text('credit','', array('class' => 'form-control credit','required'=>'required','placeholder'=>__('Expense'),'required'=>'required'))); ?>

                                    </div>
                                </td>
                                <td>
                                    <div class="form-group">
                                        <?php echo e(Form::text('discription','', array('class' => 'form-control','placeholder'=>__('Description'),'value' => ''))); ?>

                                    </div>
                                </td>
                                <td class="text-end amount" >0.00</td>
                                <td>
                                    <a href="#" class="ti ti-trash text-white text-danger" data-repeater-delete></a>
                                </td>
                                <td>
                            <td><?php echo e(Form::text('amount','', array('class' => 'form-control amt', 'id'  => 'am',) )); ?></td>
                                </td>
                            </tr>
                            </tbody>
                            <tfoot>
                            <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td></td>
                                <td class="text-end"><strong><?php echo e(__('Total Expense')); ?> (<?php echo e(\Auth::user()->currencySymbol()); ?>)</strong></td>
                                <td class="text-end totalCredit">0.00</td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td class="text-end"><strong><?php echo e(__('Total Revenue')); ?> (<?php echo e(\Auth::user()->currencySymbol()); ?>)</strong></td>
                                <td class="text-end totalDebit">0.00</td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td class="text-end"><strong><?php echo e(__('Total Balance')); ?> (<?php echo e(\Auth::user()->currencySymbol()); ?>)</strong></td>
                                <td class="text-end totalblnce">0.00</td>
                            </tr>
                           
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal-footer">
        <input type="button" value="<?php echo e(__('Cancel')); ?>" onclick="location.href = '<?php echo e(route("balance-entry.index")); ?>';" class="btn btn-light">
        <input type="submit" value="<?php echo e(__('Create')); ?>" class="btn btn-primary">
    </div>
    <?php echo e(Form::close()); ?>


<?php $__env->stopSection(); ?>



<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home2/babarras/public_html/resources/views/balancentry/create.blade.php ENDPATH**/ ?>