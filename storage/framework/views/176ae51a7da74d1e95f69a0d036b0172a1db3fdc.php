
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
    var type;
    var slide;
    var fix;
    var typetext;
    var designtyptext;
    var typeratioval;
    var profileval;
    var lockvalue;
    var opendirval;
    var openhingval;
    var handleval;
    
$(document).ready(function(){
    typetext = $('#type').val();
    typeratioval = $('.designtyperatio').val();
    profileval= $(".selprofile option:selected").text();
    lockvalue = $('.sellock').val();
    openhingval = $('.selhing').val();
    opendirval = $('.selopendir').val();
    handleval = $('.selhandle').val();
    $('.selhandle').on('change',function(){
        handleval = $(this).find('option:selected').val();
        type = $('#type').val();
        $('.handle').val(handleval);
    });
    $('.selhing').on('change',function(){
        openhingval = $(this).find('option:selected').val();
        type = $('#type').val();
        $('.hing').val(openhingval);
    });
    $('.selopendir').on('change',function(){
        opendirval = $(this).find('option:selected').val();
        type = $('#type').val();
        $('.opendir').val(opendirval);
    });
    $('.sellock').on('change',function(){
        lockvalue = $(this).find('option:selected').val();
        type = $('#type').val();
        $('.lock').val(lockvalue);
    });
    $('.designtyperatio').on('change',function(){
        typeratioval = $(this).find('option:selected').val();
        type = $('#type').val();
        var selhing = document.getElementById("selhing");
       var hingdis = document.getElementById("hingdis");
        if(type == 'open' && typeratioval== 'tophing'){
            $('.designtyperatioinp').val(typeratioval);
            $('#hinghead').hide();
            $('#hingg').hide();
            $('#hinginp').hide();
            selhing.disabled = true;
            hingdis.disabled = true;
        }else if(type == 'open' && typeratioval == 'casement'){
            $('.designtyperatioinp').val(typeratioval);
            $('#hinghead').show();;
            $('#hingg').show();
            $('#hinginp').show();
            selhing.disabled = false;
            hingdis.disabled = false;
            
        }else{
            $('.designtyperatioinp').val(typeratioval);
        }
       
    });
    $('.selprofile').on('change',function(){
        profile = $(this).find('option:selected').val();
        profileval = $(this).find('option:selected').text();
        type = $('#type').val();
        $('.profile').val(profileval);
    });

});

  var btn = $('.addRow');

$(btn).click(function(e){
    e.preventDefault();
    var tr =  "<tr>" +
    "<td><input type='number' class='form-control width' name='width[]'></td>" +
    " <td><input type='number' class='form-control height' name='height[]'></td> " +
    " <td><input type='text' id='' class='form-control mytype' name='type[]'></td>" +
    " <td><input type='text' id='' class='form-control myprof' name='myprof[]'></td>" +
    "</td>"+
    " <td><input type='text' id='' class='form-control designtyperat' name='designtyperatio[]'></td>" +
    "</td>"+
    " <td id='locktd'><input type='text' id='lockinp' class='form-control lock' name='lock[]'></td>" +
    "</td>"+
    " <td id='dirtd'><input type='text' id='opendirin' class='form-control myopendir' name='opendir[]'></td>" +
    "</td>"+
    " <td id='hingtd'><input type='text' id='openhing' class='form-control myhing' name='hing[]'></td>" +
    "</td>"+
    " <td id='handletd'><input type='text' id='doorhandle' class='form-control myhandle' name='handle[]'></td>" +
        "</td>"+

    " <th><a href='javascript:void(0)'' class='btn btn-danger deleteRow'>-</a></th>"+
    " <td><input type='hidden' class='form-control profile' name='profile[]'></td>" +
    "</tr>"
    
    $('tbody').append(tr);
    var el = $(this).parent().parent().parent().parent();
    typetext = el.find('.type').val(); 
  
    if(typetext == 'sliding'){
        el.find('.mytype').val(typetext);
        el.find('.myprof').val(profileval);
        el.find('.designtyperat').val(typeratioval);
        el.find('.lock').val(lockvalue);
        var dirchild = el.find('#opendirin');
        var dirtd = el.find('#dirtd');
        var hingchild = el.find('#openhing');
        var hingtd = el.find('#hingtd');
        var handlechild = el.find('#doorhandle');
        var handletd = el.find('#handletd');
        if (typeof(hingchild) != 'undefined' && hingchild != null){
        dirchild.remove();
        dirtd.remove();
        hingchild.remove();
        hingtd.remove();
        handlechild.remove();
        handletd.remove();
        }
    }else if(typetext == 'fix'){
        el.find('.mytype').val(typetext);
        el.find('.myprof').val(profileval);
        el.find('.designtyperat').val(typeratioval);
        var dirchild = el.find('#opendirin');
        var dirtd = el.find('#dirtd');
        var hingchild = el.find('#openhing');
        var hingtd = el.find('#hingtd');
        var lockchild = el.find('#lockinp');
        var locktd = el.find('#locktd');
        var handlechild = el.find('#doorhandle');
        var handletd = el.find('#handletd');
        if (typeof(hingchild) != 'undefined' && hingchild != null){
        dirchild.remove();
        dirtd.remove();
        hingchild.remove();
        hingtd.remove();
        lockchild.remove();
        locktd.remove();
        handlechild.remove();
        handletd.remove();
        }
    }else if(typetext == 'open' && typeratioval == 'casement'){
        el.find('.mytype').val(typetext);
        el.find('.myprof').val(profileval);
        el.find('.designtyperat').val(typeratioval);
        el.find('.lock').val(lockvalue);
        el.find('.myopendir').val(opendirval);
        el.find('.myhing').val(openhingval);
        var handlechild = el.find('#doorhandle');
        var handletd = el.find('#handletd');
        if (typeof(handlechild) != 'undefined' && handlechild != null){
            handlechild.remove();
            handletd.remove();
        }

    }else if(typetext == 'open' && typeratioval == 'tophing'){
        el.find('.mytype').val(typetext);
        el.find('.myprof').val(profileval);
        el.find('.designtyperat').val(typeratioval);
        el.find('.lock').val(lockvalue);
        el.find('.myopendir').val(opendirval);
            var hingchild = el.find('#openhing');
            var hingtd = el.find('#hingtd');
            var handlechild = el.find('#doorhandle');
            var handletd = el.find('#handletd');
        if (typeof(hingchild) != 'undefined' && hingchild != null){
                hingchild.remove();
                hingtd.remove();
                    handlechild.remove();
            handletd.remove();
        }
    }else if(typetext == 'door'){
            el.find('.mytype').val(typetext);
            el.find('.myprof').val(profileval);
            el.find('.designtyperat').val(typeratioval);
            el.find('.lock').val(lockvalue);
            el.find('.myhing').val(openhingval);
            el.find('.myhandle').val(handleval);
            var dirchild = el.find('#opendirin');
            
            var dirtd = el.find('#dirtd');
            if (typeof(dirchild) != 'undefined' && dirchild != null){
                dirchild.remove();
                dirtd.remove();
            }
     }

});

  
 $('tbody').on('click' ,'.deleteRow' , function(){
       $(this).parent().parent().remove();
 });


 
$(document).ready(function(){
   var value =  $('.hiddentype').val();
   var tdd =  $('#tddir').html();
   var selhing = document.getElementById("selhing");
   var hingdis = document.getElementById("hingdis");
   if( value == 'open'){
      if(tdd == 'tophing'){
      $('#outhead').show();
      $('#hinghead').hide();
      selhing.disabled = true;
      hingdis.disabled = true;
      }else{
        $('#hinghead').show();
      $('#outhead').show();
      $('#hingg').show();
      $('#hinginp').show();
      selhing.disabled = false;
      hingdis.disabled = false;
      }
   }else if(value == 'fix'){
    $('#lockhead').hide();
   }else if(value == 'door'){
    $('#hinghead').show();
    $('#handlehead').show();
   }
});
</script>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>

<?php echo e(Form::open(array('route' => ['project.quote.store',$project_id],'class'=>'w-100'))); ?>

    <input type="hidden" name="_token" id="token" value="<?php echo e(csrf_token()); ?>">

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
                                    <th>Width</th>
                                    <th>Height</th>
                                    <th>Type</th>
                                    <th>Profile</th>
                                    <th>Profile Type</th>
                                    <th  id="lockhead">Lock</th>
                                    <th style="display: none;" id="outhead">Outward</th>
                                    <th style="display: none;" id="hinghead">HindgeType</th>
                                    <th style="display: none;" id="handlehead">Handle Type</th>
                                    <th><a href="javascript:void(0)" class="btn btn-success addRow">+</a></th>
                                </tr>
                            </thead>

                            <tbody class="ui-sortable" data-repeater-item>
                               <?php
                               $count = $projectWindow->count();
                               $i = 0;
                               ?>
                            <?php $__currentLoopData = $projectWindow; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $proj): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                              <?php if($i == 0): ?>
                                 <input type="hidden" name="hiddentype[]"  class="form-control hiddentype" value="<?php echo e($proj->designtype); ?>">
                                 <p id="tddir" style="display: none;"><?php echo e($proj->designtyperatio); ?></p>
                              <?php if($proj->designtype == 'fix'): ?>
                                <tr>
                                    <td>
                                    <input type="number" class="form-control width" name="width[]" value="<?php echo e($proj->width); ?>">  
                                    </td>
                                    <td>
                                    <input type="number" class="form-control height" name="height[]" value="<?php echo e($proj->height); ?>">
                                    </td>
                                    <td width="20%" class="form-group pt-0">
                                        <select name="type[]"  class="form-control type" id="type">
                                            <option value="">Select Type</option>
                                            <?php $__currentLoopData = $accounts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($k); ?>" <?php if($proj->designtype ==($k)): ?> selected <?php endif; ?>><?php echo e(__($v)); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </td>

                                    <td >
                                        <div style="display: block;" id="fixselect">
                                            <select name="profile[]"  class="form-control selprofile" id="fix">
                                            <option value="">Select profile</option>
                                                <?php $__currentLoopData = $fixs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($k); ?>" <?php if($proj->frame ==($v)): ?> selected <?php endif; ?>><?php echo e(__($v)); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </div>
                                    </td>

                                    <td >
                                        <div style="display: block;" id="fixtypee">
                                            <select name="designtyperatio[]"  class="form-control designtyperatio" id="fixtype">
                                                <?php $__currentLoopData = $fixtype; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($k); ?>" <?php if($proj->designtyperatio ==($k)): ?> selected <?php endif; ?>><?php echo e(__($v)); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </div>
                                    </td>
                                    <th><a href="javascript:void(0)" class="btn btn-danger deleteRow">-</a></th>
                                </tr>
                              <?php elseif($proj->designtype == 'sliding'): ?>
                                <tr>
                                <td>
                                    <input type="number" class="form-control width" name="width[]" value="<?php echo e($proj->width); ?>">  
                                    </td>
                                    <td>
                                    <input type="number" class="form-control height" name="height[]" value="<?php echo e($proj->height); ?>">
                                    </td>
                                    <td width="20%" class="form-group pt-0">
                                        <select name="type[]"  class="form-control type" id="type">
                                            <option value="">Select Type</option>
                                            <?php $__currentLoopData = $accounts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($k); ?>" <?php if($proj->designtype ==($k)): ?> selected <?php endif; ?>><?php echo e(__($v)); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </td>
                                    <td >
                                        <div style="display: block;" id="slideselect">
                                            <select name="profile[]"  class="form-control selprofile" id="slide">
                                            <option value="">Select profile</option>
                                                <?php $__currentLoopData = $slide; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($k); ?>" <?php if($proj->frame ==($v)): ?> selected <?php endif; ?>><?php echo e(__($v)); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </div>
                                    </td>

                                    <td >
                                        <div style="display: block;" id="slidetypee">
                                            <select name="designtyperatio[]"  class="form-control designtyperatio" id="slidetype">
                                                <?php $__currentLoopData = $slidetype; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($k); ?>" <?php if($proj->designtyperatio ==($k)): ?> selected <?php endif; ?>><?php echo e(__($v)); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </div>
                                    </td>
                                    <td>
                                        <div style="display: block;" id="slidelockk">
                                            <select name="lock[]"  class="form-control sellock" id="slidelock">
                                                <?php $__currentLoopData = $slidelock; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($k); ?>" <?php if($proj->winlock ==($k)): ?> selected <?php endif; ?>><?php echo e(__($v)); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </div>
                                    </td>
                                
                                
                                    <th><a href="javascript:void(0)" class="btn btn-danger deleteRow">-</a></th>
                                </tr>
                              <?php elseif($proj->designtype == 'open'): ?>
                                <tr>
                                <td>
                                    <input type="number" class="form-control width" name="width[]" value="<?php echo e($proj->width); ?>">  
                                    </td>
                                    <td>
                                    <input type="number" class="form-control height" name="height[]" value="<?php echo e($proj->height); ?>">
                                    </td>
                                    <td width="20%" class="form-group pt-0">
                                        <select name="type[]"  class="form-control type" id="type">
                                            <option value="">Select Type</option>
                                            <?php $__currentLoopData = $accounts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($k); ?>" <?php if($proj->designtype ==($k)): ?> selected <?php endif; ?>><?php echo e(__($v)); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </td>
                                    <td >
                                        <div style="display: block;" id="openselect">
                                            <select name="profile[]"  class="form-control selprofile" id="open">
                                            <option value="">Select profile</option>
                                                <?php $__currentLoopData = $open; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($k); ?>" <?php if($proj->frame ==($v)): ?> selected <?php endif; ?>><?php echo e(__($v)); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </div>
                                    </td>

                                    <td >
                                        <div style="display: block;" id="opentypee">
                                            <select name="designtyperatio[]"  class="form-control designtyperatio" id="opentype">
                                                <?php $__currentLoopData = $opentype; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($k); ?>" <?php if($proj->designtyperatio ==($k)): ?> selected <?php endif; ?>><?php echo e(__($v)); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </div>
                                    </td>
                                    <td>
                                        <div style="display: block;" id="openlockk">
                                            <select name="lock[]"  class="form-control sellock" id="openlock">
                                                <?php $__currentLoopData = $openlock; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($k); ?>" <?php if($proj->winlock ==($k)): ?> selected <?php endif; ?>><?php echo e(__($v)); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </div>
                                    </td>
                                    <td id="opendirr">
                                        <select name="opendir[]"  class="form-control selopendir" id="opendir">
                                            <?php $__currentLoopData = $opendir; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($k); ?>" <?php if($proj->openabledir ==($k)): ?> selected <?php endif; ?>><?php echo e(__($v)); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </td>
                                    <td  id="hingg" style="display: none;">
                                        <select name="hing[]"  class="form-control selhing" id="selhing" >
                                            <?php $__currentLoopData = $hing; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($k); ?>" <?php if($proj->hing ==($k)): ?> selected <?php endif; ?>><?php echo e(__($v)); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </td>
                                    <th><a href="javascript:void(0)" class="btn btn-danger deleteRow">-</a></th>
                                </tr>
                              <?php elseif($proj->designtype == 'door'): ?>
                                <tr>
                                    <td>
                                    <input type="number" class="form-control width" name="width[]" value="<?php echo e($proj->width); ?>">  
                                    </td>
                                    <td>
                                    <input type="number" class="form-control height" name="height[]" value="<?php echo e($proj->height); ?>">
                                    </td>
                                    <td width="20%" class="form-group pt-0">
                                        <select name="type[]"  class="form-control type" id="type">
                                            <option value="">Select Type</option>
                                            <?php $__currentLoopData = $accounts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($k); ?>" <?php if($proj->designtype ==($k)): ?> selected <?php endif; ?>><?php echo e(__($v)); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </td>
                                    <td >
                                        <div style="display: block;" id="doorselect">
                                            <select name="profile[]"  class="form-control selprofile" id="door">
                                            <option value="">Select profile</option>
                                                <?php $__currentLoopData = $door; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($k); ?>" <?php if($proj->frame ==($v)): ?> selected <?php endif; ?>><?php echo e(__($v)); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </div>
                                    </td>

                                    <td >
                                        <div style="display: block;" id="doortypee">
                                            <select name="designtyperatio[]"  class="form-control designtyperatio" id="doortype">
                                                <?php $__currentLoopData = $doortype; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($k); ?>" <?php if($proj->designtyperatio ==($k)): ?> selected <?php endif; ?>><?php echo e(__($v)); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </div>
                                    </td>
                                    <td>
                                        <div style="display: block;" id="doorlockk">
                                            <select name="lock[]"  class="form-control sellock" id="doorlock">
                                                <?php $__currentLoopData = $doorlock; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($k); ?>" <?php if($proj->winlock ==($k)): ?> selected <?php endif; ?>><?php echo e(__($v)); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </div>
                                    </td>
                                    <td>
                                        <select name="hing[]"  class="form-control selhing" id="selhing" >
                                            <?php $__currentLoopData = $hing; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($k); ?>" <?php if($proj->hing ==($k)): ?> selected <?php endif; ?>><?php echo e(__($v)); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </td>
                                    <td id=handlee>
                                        <select name="handle[]"  class="form-control selhandle" id="selhandle" >
                                            <?php $__currentLoopData = $doorhandle; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($k); ?>" <?php if($proj->doorhandle ==($k)): ?> selected <?php endif; ?>><?php echo e(__($v)); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </td>
                                
                                
                                    <th><a href="javascript:void(0)" class="btn btn-danger deleteRow">-</a></th>
                                </tr>
                              <?php endif; ?>
                              <?php
                                $i++;
                                ?>
                              <?php elseif($i > 0): ?>
                              <?php if($proj->designtype == 'fix'): ?>
                                <tr>
                                    <td>
                                    <input type="number" class="form-control width" name="width[]" value="<?php echo e($proj->width); ?>">  
                                    </td>
                                    <td>
                                    <input type="number" class="form-control height" name="height[]" value="<?php echo e($proj->height); ?>">
                                    </td>
                                    <td width="20%" class="form-group pt-0">
                                    <input type="text" class="form-control typeinp"  name="type[]" value="<?php echo e($proj->designtype); ?>">
                                    </td>

                                    <td >
                                        <div style="display: block;" id="fixselect">
                                         <input type="text" class="form-control profile"  name="profile[]" value="<?php echo e($proj->frame); ?>">
                                        </div>
                                    </td>

                                    <td >
                                        <div style="display: block;" id="fixtypee">
                                         <input type="text" class="form-control designtyperatioinp" name="designtyperatio[]" value="<?php echo e($proj->designtyperatio); ?>">
                                        </div>
                                    </td>
                                    <th><a href="javascript:void(0)" class="btn btn-danger deleteRow">-</a></th>
                                </tr>
                              <?php elseif($proj->designtype == 'sliding'): ?>
                            
                                <tr>
                                <td>
                                    <input type="number" class="form-control width" name="width[]" value="<?php echo e($proj->width); ?>">  
                                    </td>
                                    <td>
                                    <input type="number" class="form-control height" name="height[]" value="<?php echo e($proj->height); ?>">
                                    </td>
                                    <td width="20%" class="form-group pt-0">
                                    <input type="text" class="form-control typeinp" name="type[]" value="<?php echo e($proj->designtype); ?>">
                                    </td>
                                    <td >
                                        <div style="display: block;" id="slideselect">
                                         <input type="text" class="form-control profile" name="profile[]" value="<?php echo e($proj->frame); ?>">
                                        </div>
                                    </td>

                                    <td >
                                        <div style="display: block;" id="slidetypee">
                                         <input type="text" class="form-control designtyperatioinp" name="designtyperatio[]" value="<?php echo e($proj->designtyperatio); ?>">
                                        </div>
                                    </td>
                                    <td>
                                        <div style="display: block;" id="slidelockk">
                                         <input type="text" class="form-control lock" name="lock[]" value="<?php echo e($proj->winlock); ?>">
                                            </select>
                                        </div>
                                    </td>
                                
                                
                                    <th><a href="javascript:void(0)" class="btn btn-danger deleteRow">-</a></th>
                                </tr>
                              
                              <?php elseif($proj->designtype == 'open'): ?>
                                <tr>
                                <td>
                                    <input type="number" class="form-control width" name="width[]" value="<?php echo e($proj->width); ?>">  
                                    </td>
                                    <td>
                                    <input type="number" class="form-control height" name="height[]" value="<?php echo e($proj->height); ?>">
                                    </td>
                                    <td width="20%" class="form-group pt-0">
                                     <input type="text" class="form-control typeinp" name="type[]" value="<?php echo e($proj->designtype); ?>">
                                    </td>
                                    <td >
                                        <div style="display: block;" id="openselect">
                                        <input type="text" class="form-control profile" name="profile[]" value="<?php echo e($proj->frame); ?>">
                                        </div>
                                    </td>

                                    <td >
                                        <div style="display: block;" >
                                         <input type="text" class="form-control designtyperatioinp" name="designtyperatio[]" value="<?php echo e($proj->designtyperatio); ?>">
                                        </div>
                                    </td>
                                    <td>
                                        <div style="display: block;" id="openlockk">
                                         <input type="text" class="form-control lock" name="lock[]" value="<?php echo e($proj->winlock); ?>">
                                        </div>
                                    </td>
                                    <td>
                                    <input type="text" class="form-control opendir" name="opendir[]" value="<?php echo e($proj->openabledir); ?>">
                                    </td>
                                    <td class = "hinginp" style="display: none;">
                                        <input type="text" class="form-control hing" name="hing[]" value="<?php echo e($proj->hing); ?>" id="hingdis">
                                    </td>
                                
                                    <th><a href="javascript:void(0)" class="btn btn-danger deleteRow">-</a></th>
                                </tr>
                            <?php elseif($proj->designtype == 'door'): ?>
                                <tr>
                                    <td>
                                    <input type="number" class="form-control width" name="width[]" value="<?php echo e($proj->width); ?>">  
                                    </td>
                                    <td>
                                    <input type="number" class="form-control height" name="height[]" value="<?php echo e($proj->height); ?>">
                                    </td>
                                    <td width="20%" class="form-group pt-0">
                                     <input type="text" class="form-control typeinp" name="type[]" value="<?php echo e($proj->designtype); ?>">
                                    </td>
                                    <td >
                                        <div style="display: block;" id="openselect">
                                        <input type="text" class="form-control profile" name="profile[]" value="<?php echo e($proj->frame); ?>">
                                        </div>
                                    </td>

                                    <td >
                                        <div style="display: block;" >
                                         <input type="text" class="form-control designtyperatioinp" name="designtyperatio[]" value="<?php echo e($proj->designtyperatio); ?>">
                                        </div>
                                    </td>
                                    <td>
                                        <div style="display: block;" id="openlockk">
                                         <input type="text" class="form-control lock" name="lock[]" value="<?php echo e($proj->winlock); ?>">
                                        </div>
                                    </td>
                                    <td class = "hinginp" >
                                        <input type="text" class="form-control hing" name="hing[]" value="<?php echo e($proj->hing); ?>" id="hingdis">
                                    </td>
                                    <td class = "handleinp" >
                                        <input type="text" class="form-control handle" name="handle[]" value="<?php echo e($proj->doorhandle); ?>" id="handledis">
                                    </td>
                                
                                    <th><a href="javascript:void(0)" class="btn btn-danger deleteRow">-</a></th>
                                </tr>
                              <?php endif; ?>
                              <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal-footer">
        <input type="submit" value="<?php echo e(__('Create')); ?>" class="btn btn-primary">
    </div>
    <?php echo e(Form::close()); ?>



<?php $__env->stopSection(); ?>



<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home2/babarras/public_html/resources/views/projectwindows/quotedit.blade.php ENDPATH**/ ?>