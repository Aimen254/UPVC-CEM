<?php $__env->startSection('page-title'); ?>
    <?php echo e(ucwords($project->project_name)); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startPush('script-page'); ?>
    <script>
        (function () {
            var options = {
                chart: {
                    type: 'area',
                    height: 60,
                    sparkline: {
                        enabled: true,
                    },
                },
                colors: ["#ffa21d"],
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    curve: 'smooth',
                    width: 2,
                },
                series: [{
                    name: 'Bandwidth',
                    data:<?php echo e(json_encode(array_map('intval',$project_data['timesheet_chart']['chart']))); ?>

                }],

                tooltip: {
                    followCursor: false,
                    fixed: {
                        enabled: false
                    },
                    x: {
                        show: false
                    },
                    y: {
                        title: {
                            formatter: function (seriesName) {
                                return ''
                            }
                        }
                    },
                    marker: {
                        show: false
                    }
                }
            }
            var chart = new ApexCharts(document.querySelector("#timesheet_chart"), options);
            chart.render();
        })();

        (function () {
            var options = {
                chart: {
                    type: 'area',
                    height: 60,
                    sparkline: {
                        enabled: true,
                    },
                },
                colors: ["#ffa21d"],
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    curve: 'smooth',
                    width: 2,
                },
                series: [{
                    name: 'Bandwidth',
                    data:<?php echo e(json_encode($project_data['task_chart']['chart'])); ?>

                }],

                tooltip: {
                    followCursor: false,
                    fixed: {
                        enabled: false
                    },
                    x: {
                        show: false
                    },
                    y: {
                        title: {
                            formatter: function (seriesName) {
                                return ''
                            }
                        }
                    },
                    marker: {
                        show: false
                    }
                }
            }
            var chart = new ApexCharts(document.querySelector("#task_chart"), options);
            chart.render();
        })();

        $(document).ready(function () {
            loadProjectUser();
            $(document).on('click', '.invite_usr', function () {
                var project_id = $('#project_id').val();
                var user_id = $(this).attr('data-id');

                $.ajax({
                    url: '<?php echo e(route('invite.project.user.member')); ?>',
                    method: 'POST',
                    dataType: 'json',
                    data: {
                        'project_id': project_id,
                        'user_id': user_id,
                        "_token": "<?php echo e(csrf_token()); ?>"
                    },
                    success: function (data) {
                        if (data.code == '200') {
                            show_toastr(data.status, data.success, 'success')
                            setInterval('location.reload()', 5000);
                            loadProjectUser();
                        } else if (data.code == '404') {
                            show_toastr(data.status, data.errors, 'error')
                        }
                    }
                });
            });
        });

        function loadProjectUser() {
            var mainEle = $('#project_users');
            var project_id = '<?php echo e($project->id); ?>';

            $.ajax({
                url: '<?php echo e(route('project.user')); ?>',
                data: {project_id: project_id},
                beforeSend: function () {
                    $('#project_users').html('<tr><th colspan="2" class="h6 text-center pt-5"><?php echo e(__('Loading...')); ?></th></tr>');
                },
                success: function (data) {
                    mainEle.html(data.html);
                    $('[id^=fire-modal]').remove();
                    loadConfirm();
                }
            });
        }

    </script>
     <script>
        
    $(document).on('keyup', '.price', function () {
            var quntityTotalTaxPrice = 0;

            var el = $(this).parent().parent().parent().parent();
            var sum =  $(el.find('.sum')).val();
            var price = $(el.find('.price')).val();

            var totalItemPrice = (sum * price);
            var amount = (totalItemPrice);
            $(el.find('.total')).html(amount);


        
        });
        function show(){
            $("#mullion").show();
        }
        function hidediv(){
            $("#mullion").hide();
        }
    </script>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
    <li class="breadcrumb-item"><a href="<?php echo e(route('projects.index')); ?>"><?php echo e(__('Project')); ?></a></li>
    <li class="breadcrumb-item"><?php echo e(ucwords($project->project_name)); ?></li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('action-btn'); ?>
    <div class="float-end">
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view grant chart')): ?>
            <a href="<?php echo e(route('project.quote.index',$project->id)); ?>" class="btn btn-sm btn-primary">
                <?php echo e(__('Quotation')); ?>

            </a>
        <?php endif; ?>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view grant chart')): ?>
            <a href="<?php echo e(route('projects.gantt',$project->id)); ?>" class="btn btn-sm btn-primary">
                <?php echo e(__('Gantt Chart')); ?>

            </a>
        <?php endif; ?>
        <?php if(\Auth::user()->type!='client' || (\Auth::user()->type=='client' )): ?>
            <a href="<?php echo e(route('projecttime.tracker',$project->id)); ?>" class="btn btn-sm btn-primary">
                <?php echo e(__('Tracker')); ?>

            </a>
        <?php endif; ?>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view expense')): ?>
            <a href="<?php echo e(route('projects.expenses.index',$project->id)); ?>" class="btn btn-sm btn-primary">
                <?php echo e(__('Expense')); ?>

            </a>
        <?php endif; ?>
        <?php if(\Auth::user()->type != 'client'): ?>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view timesheet')): ?>
                <a href="<?php echo e(route('timesheet.index',$project->id)); ?>" class="btn btn-sm btn-primary">
                    <?php echo e(__('Timesheet')); ?>

                </a>
            <?php endif; ?>
        <?php endif; ?>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage bug report')): ?>
            <a href="<?php echo e(route('task.bug',$project->id)); ?>" class="btn btn-sm btn-primary">
                <?php echo e(__('Bug Report')); ?>

            </a>
        <?php endif; ?>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create project task')): ?>
            <a href="<?php echo e(route('projects.tasks.index',$project->id)); ?>" class="btn btn-sm btn-primary">
                <?php echo e(__('Task')); ?>

            </a>
        <?php endif; ?>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit project')): ?>
            <a href="#" data-size="lg" data-url="<?php echo e(route('projects.edit', $project->id)); ?>" data-ajax-popup="true" data-bs-toggle="tooltip" title="<?php echo e(__('Edit Project')); ?>" class="btn btn-sm btn-primary">
                <i class="ti ti-pencil"></i>
            </a>
        <?php endif; ?>
           <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit project')): ?>
            <a href="<?php echo e(route('projcut.all.sheet',$project->id)); ?>" class="btn btn-sm btn-primary">
                <?php echo e(__('Cutting Sheet')); ?>

            </a>
        <?php endif; ?>

    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <div class="row">
        <div class="col-lg-3 col-md-4">
            <div class="card">
                <div class="card-body">
                    <div class="row align-items-center justify-content-between">
                        <div class="col-auto mb-3 mb-sm-0">
                            <div class="d-flex align-items-center">
                                <div class="theme-avtar bg-warning">
                                    <i class="ti ti-list"></i>
                                </div>
                                <div class="ms-3">
                                    <small class="text-muted h6"><?php echo e(__('Total Task')); ?></small>
                                    <h6 class="m-0"><?php echo e($project_data['task']['total']); ?></h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto text-end">
                            <h4 class="m-0"><?php echo e($project_data['task']['done']); ?></h4>
                            <small class="text-muted h6"><?php echo e(__('Done Task')); ?></small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-8">
            <div class="card">
                <div class="card-body">
                    <div class="row align-items-center justify-content-between">
                        <div class="col-auto mb-3 mb-sm-0">
                            <div class="d-flex align-items-center">
                                <div class="theme-avtar bg-danger">
                                    <i class="ti ti-report-money"></i>
                                </div>
                                <div class="ms-3">
                                    <small class="text-muted"><?php echo e(__('Total')); ?></small>
                                    <h6 class="m-0"><?php echo e(__('Budget')); ?></h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto text-end">
                            <h4 class="m-0"><?php echo e(\Auth::user()->priceFormat($project->budget)); ?></h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-4">
            <div class="card">
                <div class="card-body">
                    <div class="row align-items-center justify-content-between">
                        <div class="col-auto mb-3 mb-sm-0">
                            <div class="d-flex align-items-center">
                                <div class="theme-avtar bg-success">
                                    <i class="ti ti-report-money"></i>
                                </div>
                                <div class="ms-3">
                                    <small class="text-muted"><?php echo e(__('Total')); ?></small>
                                    <h6 class="m-0"><?php echo e(__('Expense')); ?></h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto text-end">
                            <h4 class="m-0"><?php echo e(\Auth::user()->priceFormat($project_data['expense']['total'])); ?></h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
          <div class="col-lg-3 col-md-4">
            <div class="card">
                <div class="card-body">
                    <div class="row align-items-center justify-content-between">
                        <div class="col-auto mb-3 mb-sm-0">
                            <div class="d-flex align-items-center">
                                <div class="theme-avtar bg-success">
                                    <i class="ti ti-report-money"></i>
                                </div>
                                <div class="ms-3">
                                    <small class="text-muted"><?php echo e(__('Total')); ?></small>
                                    <h6 class="m-0"><?php echo e(__('Design Cost')); ?></h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto text-end">
                            <!--<h4 class="m-0"><?php echo e(\Auth::user()->priceFormat($totalcost)); ?></h4>-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-lg-4 col-md-4">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="avatar me-3">
                            <img <?php echo e($project->img_image); ?> alt="" class="img-user wid-45 rounded-circle">
                        </div>
                        <div class="d-block  align-items-center justify-content-between w-100">
                            <div class="mb-3 mb-sm-0">
                                <h5 class="mb-1"> <?php echo e($project->project_name); ?></h5>
                                <p class="mb-0 text-sm">
                                <div class="progress-wrapper">
                                    <span class="progress-percentage"><small class="font-weight-bold"><?php echo e(__('Completed:')); ?> : </small><?php echo e($project->project_progress()['percentage']); ?></span>
                                    <div class="progress progress-xs mt-2">
                                        <div class="progress-bar bg-info" role="progressbar" aria-valuenow="<?php echo e($project->project_progress()['percentage']); ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo e($project->project_progress()['percentage']); ?>;"></div>
                                    </div>
                                </div>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-10">
                            <h4 class="mt-3 mb-1"></h4>
                            <p> <?php echo e($project->description); ?></p>
                        </div>
                    </div>
                    <div class="card bg-primary mb-0">
                        <div class="card-body">
                            <div class="d-block d-sm-flex align-items-center justify-content-between">
                                <div class="row align-items-center">
                                    <span class="text-white text-sm"><?php echo e(__('Start Date')); ?></span>
                                    <h5 class="text-white text-nowrap"><?php echo e(Utility::getDateFormated($project->start_date)); ?></h5>
                                </div>
                                <div class="row align-items-center">
                                    <span class="text-white text-sm"><?php echo e(__('End Date')); ?></span>
                                    <h5 class="text-white text-nowrap"><?php echo e(Utility::getDateFormated($project->end_date)); ?></h5>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-4">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-start">
                        <div class="theme-avtar bg-primary">
                            <i class="ti ti-clipboard-list"></i>
                        </div>
                        <div class="ms-3">
                            <p class="text-muted mb-0"><?php echo e(__('Last 7 days task done')); ?></p>
                            <h4 class="mb-0"><?php echo e($project_data['task_chart']['total']); ?></h4>

                        </div>
                    </div>
                    <div id="task_chart"></div>
                </div>

                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <div class="d-flex align-items-center">
                            <span class="text-muted"><?php echo e(__('Day Left')); ?></span>
                        </div>
                        <span><?php echo e($project_data['day_left']['day']); ?></span>
                    </div>
                    <div class="progress mb-3">
                        <div class="progress-bar bg-primary" style="width: <?php echo e($project_data['day_left']['percentage']); ?>%"></div>
                    </div>
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <div class="d-flex align-items-center">

                            <span class="text-muted"><?php echo e(__('Open Task')); ?></span>
                        </div>
                        <span><?php echo e($project_data['open_task']['tasks']); ?></span>
                    </div>
                    <div class="progress mb-3">
                        <div class="progress-bar bg-primary" style="width: <?php echo e($project_data['open_task']['percentage']); ?>%"></div>
                    </div>
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <div class="d-flex align-items-center">
                            <span class="text-muted"><?php echo e(__('Completed Milestone')); ?></span>
                        </div>
                        <span><?php echo e($project_data['milestone']['total']); ?></span>
                    </div>
                    <div class="progress mb-3">
                        <div class="progress-bar bg-primary" style="width: <?php echo e($project_data['milestone']['percentage']); ?>%"></div>
                    </div>
                </div>
            </div>

        </div>
        <div class="col-lg-4 col-md-4">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-start">
                        <div class="theme-avtar bg-primary">
                            <i class="ti ti-clipboard-list"></i>
                        </div>
                        <div class="ms-3">
                            <p class="text-muted mb-0"><?php echo e(__('Last 7 days hours spent')); ?></p>
                            <h4 class="mb-0"><?php echo e($project_data['timesheet_chart']['total']); ?></h4>

                        </div>
                    </div>
                    <div id="timesheet_chart"></div>
                </div>
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <div class="d-flex align-items-center">
                            <span class="text-muted"><?php echo e(__('Total project time spent')); ?></span>
                        </div>
                        <span><?php echo e($project_data['time_spent']['total']); ?></span>
                    </div>
                    <div class="progress mb-3">
                        <div class="progress-bar bg-primary" style="width: <?php echo e($project_data['time_spent']['percentage']); ?>%"></div>
                    </div>
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <div class="d-flex align-items-center">

                            <span class="text-muted"><?php echo e(__('Allocated hours on task')); ?></span>
                        </div>
                        <span><?php echo e($project_data['task_allocated_hrs']['hrs']); ?></span>
                    </div>
                    <div class="progress mb-3">
                        <div class="progress-bar bg-primary" style="width: <?php echo e($project_data['task_allocated_hrs']['percentage']); ?>%"></div>
                    </div>
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <div class="d-flex align-items-center">
                            <span class="text-muted"><?php echo e(__('User Assigned')); ?></span>
                        </div>
                        <span><?php echo e($project_data['user_assigned']['total']); ?></span>
                    </div>
                    <div class="progress mb-3">
                        <div class="progress-bar bg-primary" style="width: <?php echo e($project_data['user_assigned']['percentage']); ?>%"></div>
                    </div>
                </div>
            </div>

        </div>
        <div class="col-lg-6 col-md-6">
            <div class="card">
                <div class="card-header">
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit project')): ?>
                        <div class="float-end">
                            <a href="#" data-size="lg" data-url="<?php echo e(route('invite.project.member.view', $project->id)); ?>" data-ajax-popup="true" data-bs-toggle="tooltip" title="" class="btn btn-sm btn-primary" data-bs-original-title="<?php echo e(__('Add Member')); ?>">
                                <i class="ti ti-plus"></i>
                            </a>
                        </div>
                    <?php endif; ?>
                    <h5><?php echo e(__('Members')); ?></h5>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush list" id="project_users">
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-6">
            <div class="card">
                <div class="card-header">
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create milestone')): ?>
                        <div class="float-end">
                            <a href="#" data-size="md" data-url="<?php echo e(route('project.milestone', $project->id)); ?>" data-ajax-popup="true" data-bs-toggle="tooltip" title="" class="btn btn-sm btn-primary" data-bs-original-title="<?php echo e(__('Create New Milestone')); ?>">
                                <i class="ti ti-plus"></i>
                            </a>
                        </div>
                    <?php endif; ?>
                    <h5><?php echo e(__('Milestones')); ?> (<?php echo e(count($project->milestones)); ?>)</h5>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <?php if($project->milestones->count() > 0): ?>
                            <?php $__currentLoopData = $project->milestones; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $milestone): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li class="list-group-item px-0">
                                    <div class="row align-items-center justify-content-between">
                                        <div class="col-sm-auto mb-3 mb-sm-0">
                                            <div class="d-flex align-items-center">
                                                <div class="div">
                                                    <h6 class="m-0"><?php echo e($milestone->title); ?>

                                                        <span class="badge-xs badge bg-<?php echo e(\App\Models\Project::$status_color[$milestone->status]); ?> p-2 px-3 rounded"><?php echo e(__(\App\Models\Project::$project_status[$milestone->status])); ?></span>
                                                    </h6>
                                                    <small class="text-muted"><?php echo e($milestone->tasks->count().' '. __('Tasks')); ?></small>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-auto text-sm-end d-flex align-items-center">
                                            <div class="action-btn bg-warning ms-2">
                                                <a href="#" data-size="md" data-url="<?php echo e(route('project.milestone.show',$milestone->id)); ?>" data-ajax-popup="true" data-bs-toggle="tooltip" title="<?php echo e(__('View')); ?>" class="btn btn-sm">
                                                    <i class="ti ti-eye text-white"></i>
                                                </a>
                                            </div>
                                            <div class="action-btn bg-info ms-2">
                                                <a href="#" data-size="md" data-url="<?php echo e(route('project.milestone.edit',$milestone->id)); ?>" data-ajax-popup="true" data-bs-toggle="tooltip" title="<?php echo e(__('Edit')); ?>" class="btn btn-sm">
                                                    <i class="ti ti-pencil text-white"></i>
                                                </a>
                                            </div>
                                            <div class="action-btn bg-danger ms-2">
                                                <?php echo Form::open(['method' => 'DELETE', 'route' => ['project.milestone.destroy', $milestone->id]]); ?>

                                                <a href="#" class="mx-3 btn btn-sm  align-items-center bs-pass-para" data-bs-toggle="tooltip" title="<?php echo e(__('Delete')); ?>"><i class="ti ti-trash text-white"></i></a>

                                                <?php echo Form::close(); ?>

                                            </div>
                                        </div>
                                    </div>
                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php else: ?>
                            <div class="py-5">
                                <h6 class="h6 text-center"><?php echo e(__('No Milestone Found.')); ?></h6>
                            </div>
                        <?php endif; ?>
                    </ul>

                </div>
            </div>
        </div>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view activity')): ?>
            <div class="col-xl-6">
                <div class="card">
                    <div class="card-header">
                        <h5><?php echo e(__('Activity Log')); ?></h5>
                        <small><?php echo e(__('Activity Log of this project')); ?></small>
                    </div>
                    <div class="card-body vertical-scroll-cards">
                        <?php $__currentLoopData = $project->activities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $activity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="card p-2 mb-2">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="d-flex align-items-center">
                                        <div class="theme-avtar bg-primary">
                                            <i class="ti ti-<?php echo e($activity->logIcon($activity->log_type)); ?>"></i>
                                        </div>
                                        <div class="ms-3">
                                            <h6 class="mb-0"><?php echo e(__($activity->log_type)); ?></h6>
                                            <p class="text-muted text-sm mb-0"><?php echo $activity->getRemark(); ?></p>
                                        </div>
                                    </div>
                                    <p class="text-muted text-sm mb-0"><?php echo e($activity->created_at->diffForHumans()); ?></p>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>
        <div class="col-lg-6 col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5><?php echo e(__('Attachments')); ?></h5>
                    <small><?php echo e(__('Attachment that uploaded in this project')); ?></small>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <?php if($project->projectAttachments()->count() > 0): ?>
                            <?php $__currentLoopData = $project->projectAttachments(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attachment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li class="list-group-item px-0">
                                    <div class="row align-items-center justify-content-between">
                                        <div class="col mb-3 mb-sm-0">
                                            <div class="d-flex align-items-center">
                                                <div class="div">
                                                    <h6 class="m-0"><?php echo e($attachment->name); ?></h6>
                                                    <small class="text-muted"><?php echo e($attachment->file_size); ?></small>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-auto text-sm-end d-flex align-items-center">
                                            <div class="action-btn bg-info ms-2">
                                                <a href="<?php echo e(asset(Storage::url('tasks/'.$attachment->file))); ?>" download data-bs-toggle="tooltip" title="<?php echo e(__('Download')); ?>" class="btn btn-sm">
                                                    <i class="ti ti-download text-white"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php else: ?>
                            <div class="py-5">
                                <h6 class="h6 text-center"><?php echo e(__('No Attachments Found.')); ?></h6>
                            </div>
                        <?php endif; ?>
                    </ul>

                </div>
            </div>
        </div>
        <!-- <div class="col-xxl-12">-->
        <!--    <div class="row">-->
        <!--        <?php $__currentLoopData = $windows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $window): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>-->
        <!--        <?php $__currentLoopData = $images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>-->
        <!--            <?php if($image->id == $window->image_id): ?>-->
        <!--                <div class="col-md-3">-->
                        
        <!--                        <div class="card text-center">-->
        <!--                            <div class="card-header border-0 pb-0">-->
        <!--                                <div class="d-flex justify-content-between align-items-center">-->
        <!--                                    <h6 class="mb-0">-->
        <!--                                        <div class=" badge bg-primary p-2 px-3 rounded">-->
        <!--                                            <?php echo e(ucfirst($image->name)); ?>-->
        <!--                                            <input type="hidden" value="<?php echo e($image->name); ?>" id="imagname" >-->
        <!--                                        </div>-->
        <!--                                    </h6>-->

        <!--                                </div>-->

                                    
        <!--                            </div>-->
        <!--                            <div class="card-body full-card">-->
        <!--                            <div class="img-fluid rounded-circle card-avatar">-->
        <!--                                   <img src="<?php echo e((!empty($image->image))? asset(Storage::url("uploads/windows/".$image->image)): asset(Storage::url("uploads/avatar/avatar.png"))); ?>" alt="kal" class="img-user wid-140 ">-->
        <!--                            </div>-->
                                    
        <!--                            </div>-->
                                
        <!--                        </div>-->
                    
        <!--                </div>-->

        <!--                <div class="col-md-9">-->
        <!--                    <div class="card">-->
        <!--                        <div class="card-body table-border-style">-->
        <!--                            <div class="table-responsive">-->
                
        <!--                                <table class="table -->
        <!--                                " id="myTable" >-->
        <!--                                    <thead>-->
        <!--                                    <tr>-->
        <!--                                        <th><?php echo e(__('OuterWidth')); ?></th>-->
        <!--                                        <th><?php echo e(__('OuterHeight')); ?></th>-->
        <!--                                        <th><?php echo e(__('InnerWidth')); ?></th>-->
        <!--                                        <th><?php echo e(__('InnerHeight')); ?></th>-->
        <!--                                        <th><?php echo e(__('FixWidth')); ?></th>-->
        <!--                                        <th><?php echo e(__('FixHeight')); ?></th>-->
        <!--                                         <th><?php echo e(__('Total Expense')); ?></th>-->
        <!--                                    </tr>-->
                                        
        <!--                                    </thead>-->
        <!--                                    <tbody >-->
                                            
                                                
        <!--                                                <td><?php echo e($window->outerwidth); ?></td>-->
        <!--                                                <td><?php echo e($window->outerheight); ?></td> -->
        <!--                                                <td><?php echo e($window->innerwidth); ?></td> -->
        <!--                                                <td><?php echo e($window->innerheight); ?></td> -->
        <!--                                                <td><?php echo e($window->fixwidth); ?></td> -->
        <!--                                                <td><?php echo e($window->fixheight); ?></td> -->
        <!--                                                  <td><?php echo e($window->totalexpense); ?></td> -->
                                                    
        <!--                                            </tr>-->
                                            
        <!--                                    </tbody>-->
        <!--                                </table>-->
        <!--                            </div>-->
        <!--                        </div>-->
        <!--                    </div>-->
        <!--                </div>-->
        <!--            <?php endif; ?>-->
        <!--        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>-->
        <!--        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>-->
        <!--    </div>-->
        <!--</div>-->
        
        <!-- <div class="col-xxl-12">-->
        <!--    <div class="card">-->
        <!--            <div class="card-header">-->
        <!--                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create milestone')): ?>-->
        <!--                    <div class="float-end">-->
        <!--                        <a href="#" data-size="md" data-url="<?php echo e(route('projwindow.create', $project->id)); ?>" data-ajax-popup="true" data-bs-toggle="tooltip" title="" class="btn btn-sm btn-primary" data-bs-original-title="<?php echo e(__('Create New Design')); ?>">-->
        <!--                            <i class="ti ti-plus"></i>-->
        <!--                        </a>-->
        <!--                    </div>-->
        <!--                <?php endif; ?>-->
        <!--                <h5><?php echo e(__('Windows')); ?> (<?php echo e(count($project->windows)); ?>)</h5>-->
        <!--            </div>-->
        <!--            <div class="card-body table-border-style">-->
        <!--                <ul class="list-group list-group-flush">-->
        <!--                <div class="card-body table-border-style">-->
        <!--                    <div class="table-responsive">-->
        <!--                        <table class="table datatable" >-->
        <!--                            <thead>-->
        <!--                                <tr>-->
        <!--                                    <th><?php echo e(__('Profile')); ?></th>-->
        <!--                                    <th><?php echo e(__('Design')); ?></th>-->
        <!--                                     <th><?php echo e(__('DesignType')); ?></th>-->
        <!--                                    <th><?php echo e(__('OuterFrameAmount')); ?></th>-->
        <!--                                    <th><?php echo e(__('SlideSashAmount')); ?></th>-->
        <!--                                    <th><?php echo e(__('NetSAshAmount')); ?></th>-->
        <!--                                    <th><?php echo e(__('SlidingBeedAmount')); ?></th>-->
        <!--                                     <th><?php echo e(__('Interlock')); ?></th>-->
        <!--                                    <th><?php echo e(__('OuterFrameSteel')); ?></th>-->
        <!--                                    <th><?php echo e(__('SlideSteel')); ?></th>-->
        <!--                                    <th><?php echo e(__('NetFrameSteel')); ?></th>-->
        <!--                                      <th><?php echo e(__('Net')); ?></th>-->
        <!--                                    <th><?php echo e(__('GasKit')); ?></th>-->
        <!--                                    <th><?php echo e(__('NettingGasKit')); ?></th>-->
        <!--                                     <th><?php echo e(__('SlidingBrush')); ?></th>-->
        <!--                                   <th><?php echo e(__('AluminiumRail')); ?></th>-->
        <!--                                    <th><?php echo e(__('GearHandle/Latchlock')); ?></th>-->
        <!--                                        <th><?php echo e(__('Total Expense')); ?></th>-->
        <!--                                    <th><?php echo e(__('Action')); ?></th>-->

        <!--                                </tr>-->
                                
        <!--                            </thead>-->
        <!--                            <tbody >-->
                                                
        <!--                                <?php $__currentLoopData = $project->windows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $milestone): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>-->
                                    
        <!--                                    <tr>-->
        <!--                                        <td><?php echo e($milestone->frame); ?></td>-->
        <!--                                                                                  <td scope="row">-->
                                        
        <!--                                            <?php if(!empty($milestone->image)): ?>-->
                                            <!--<img alt="image" data-toggle="tooltip" data-original-title="<?php echo e($image->name); ?>" <?php if($image->image): ?> src="<?php echo e(asset('/formulaimages/'.$image->image)); ?>" <?php endif; ?>  width="35" height="35">-->
        <!--                                                                                                                     <img src="<?php echo e((!empty($image->image))? asset(Storage::url("uploads/windows/".$image->image)): asset(Storage::url("uploads/avatar/avatar.png"))); ?>" alt="kal" class="img-user wid-80">-->


        <!--                                    <?php else: ?>-->
        <!--                                        <a href="#" class="btn btn-sm btn-secondary btn-icon rounded-pill">-->
        <!--                                            <span class="btn-inner--icon"><i class="ti ti-times-circle"></i></span>-->
        <!--                                        </a>-->
        <!--                                    <?php endif; ?>-->
                                        

                                        

        <!--                                 </td>-->
        <!--                                 <td><?php echo e($milestone->designtyperatio); ?></td>-->
                                           
        <!--                                        <td><?php echo e($milestone->outeramount); ?>PKR</td>-->
        <!--                                <?php if(!empty( $milestone->slideamount)): ?>-->
        <!--                                        <td><?php echo e($milestone->slideamount); ?>PKR</td>-->
        <!--                                <?php else: ?>-->
        <!--                                        <td>no data!</td>-->
        <!--                                <?php endif; ?>-->
        <!--                                 <?php if(!empty( $milestone->netamount)): ?>-->
        <!--                                        <td><?php echo e($milestone->netamount); ?>PKR</td>-->
        <!--                                <?php else: ?>-->
        <!--                                        <td>no data!</td>-->
        <!--                                <?php endif; ?>-->
                                        
        <!--                                        <td><?php echo e($milestone->slidebeedamount); ?>PKR</td> -->
        <!--                                <?php if(!empty( $milestone->interlockamount)): ?>-->
        <!--                                        <td><?php echo e($milestone->interlockamount); ?>PKR</td>-->
        <!--                                <?php else: ?>-->
        <!--                                        <td>no data!</td>-->
        <!--                                <?php endif; ?>-->
                                              
                                             
        <!--                                        <td><?php echo e($milestone->outersteelamount); ?>PKR</td>-->
        <!--                                <?php if(!empty(  $milestone->slidesteelamount)): ?>-->
        <!--                                        <td><?php echo e($milestone->slidesteelamount); ?>PKR</td>-->
        <!--                                <?php else: ?>-->
        <!--                                        <td>no data!</td>-->
        <!--                                <?php endif; ?>-->
        <!--                                 <?php if(!empty(  $milestone->netsteelamount )): ?>-->
        <!--                                        <td><?php echo e($milestone->netsteelamount); ?>PKR</td>-->
        <!--                                <?php else: ?>-->
        <!--                                        <td>no data!</td>-->
        <!--                                <?php endif; ?> -->
        <!--                                 <?php if(!empty( $milestone->nettamount )): ?>-->
        <!--                                        <td><?php echo e($milestone->nettamount); ?>PKR</td>-->
        <!--                                <?php else: ?>-->
        <!--                                        <td>no data!</td>-->
        <!--                                <?php endif; ?> -->
        <!--                                           <td><?php echo e($milestone->gaskitamount); ?></td>-->
        <!--                                <?php if(!empty($milestone->netgaskitamount)): ?>-->
        <!--                                        <td><?php echo e($milestone->netgaskitamount); ?>PKR</td>-->
        <!--                                <?php else: ?>-->
        <!--                                        <td>no data!</td>-->
        <!--                                <?php endif; ?> -->
        <!--                                  <?php if(!empty($milestone->slidingbrushamount)): ?>-->
        <!--                                        <td><?php echo e($milestone->slidingbrushamount); ?>PKR</td>-->
        <!--                                <?php else: ?>-->
        <!--                                        <td>no data!</td>-->
        <!--                                <?php endif; ?> -->
        <!--                                 <?php if(!empty($milestone->aluminiumrailamount)): ?>-->
        <!--                                        <td><?php echo e($milestone->aluminiumrailamount); ?>PKR</td>-->
        <!--                                <?php else: ?>-->
        <!--                                        <td>no data!</td>-->
        <!--                                <?php endif; ?> -->
        <!--                                <?php if(!empty($milestone->typeamount)): ?>-->
        <!--                                        <td><?php echo e($milestone->typeamount); ?>PKR</td>-->
        <!--                                <?php else: ?>-->
        <!--                                        <td>no data!</td>-->
        <!--                                <?php endif; ?> -->
        <!--                                        <td><?php echo e($milestone->totalexpense); ?>PKR</td> -->
        <!--                                <td>-->
        <!--                                       <div class="action-btn bg-danger ms-2">-->
        <!--                                        <?php echo Form::open(['method' => 'DELETE', 'route' => ['project.window.delete', $milestone->id]]); ?>-->
        <!--                                        <a href="#" class="mx-3 btn btn-sm  align-items-center bs-pass-para" data-bs-toggle="tooltip" title="<?php echo e(__('Delete')); ?>"><i class="ti ti-trash text-white"></i></a>-->

        <!--                                        <?php echo Form::close(); ?>-->
        <!--                                    </div>  -->
        <!--                                      <div class="action-btn bg-warning ms-2">-->
        <!--                                        <a href="<?php echo e(route('windows.show',$milestone->id)); ?>" title="<?php echo e(__('View')); ?>" class="btn btn-sm">-->
        <!--                                            <i class="ti ti-eye text-white"></i>-->
        <!--                                        </a>-->
        <!--                                        </div>-->
        <!--                                </td>-->
                                            
        <!--                                    </tr>-->
        <!--                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>-->
                                
        <!--                            </tbody>-->
        <!--                        </table>-->
        <!--                    </div>-->
        <!--                </div>-->
                        
        <!--                </ul>-->

        <!--            </div>-->
        <!--    </div>-->
        <!--</div>-->
        
         <div class="col-xxl-12">
            <div class="card">
                   <?php
                        $buraq = "Buraq";
                        ?>
                    <div class="card-header">
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create milestone')): ?>
                            <div class="float-end">
                                <!--<a href="<?php echo e(route('projectall.quote.sheet',$project->id)); ?>"  data-bs-toggle="tooltip" title="<?php echo e(__('Internal Quote')); ?>" class="btn btn-sm btn-primary">-->
                                <!--    <i class="fa fa-quote-left"></i>-->
                                <!--</a>-->
                                  <?php echo e(Form::open(['route' => ['projectall.quote.sheet',$project->id],'enctype' => 'multipart/form-data'])); ?>

                            <input type="hidden" class="form-control" name="company"  value="<?php echo e($buraq); ?>">
                            <input type="submit" value="<?php echo e(__('jobcost')); ?>" class="btn btn-sm btn-primary">
                            <?php echo e(Form::close()); ?>

                            </div>
                        <?php endif; ?>
                        <h5><?php echo e(__('Buraq')); ?> (<?php echo e(count($project->buraqentry)); ?>)</h5>
                    </div>
                    <div class="card-body table-border-style">
                        <ul class="list-group list-group-flush">
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
                                            <th><?php echo e(__('No of  Windows')); ?></th>
                                            <th><?php echo e(__('Action')); ?></th>

                                        </tr>
                                
                                    </thead>
                                    <tbody >
                                                
                                        <?php $__currentLoopData = $project->buraqentry; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $milestone): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    
                                            <tr>
                                                <td><?php echo e($milestone->frame); ?></td>
                                                                                          <td scope="row">
                                        
                                                <?php if(!empty($milestone->image)): ?>
                                         
                                                                                           <img src="<?php echo e((!empty   ($milestone ->image))?
                                                                                        asset(Storage::url("uploads/windows/".$milestone->image)): asset(Storage::url("uploads/avatar/avatar.png"))); ?>" alt="kal" class="img-user wid-80">


                                            <?php else: ?>
                                                <a href="#" class="btn btn-sm btn-secondary btn-icon rounded-pill">
                                                    <span class="btn-inner--icon"><i class="ti ti-times-circle"></i></span>
                                                </a>
                                            <?php endif; ?>

                                         </td>
                                        <td><?php echo e($milestone->designtype); ?></td>
                                      
                                         <td><?php echo e($milestone->designtyperatio); ?></td>
                                         
                                                <td><?php echo e($milestone->company); ?></td>
                                                   <td><?php echo e($milestone->count()); ?></td>

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
                                             <div class="action-btn bg-primary ms-2">
                                                    <a href="<?php echo e(route('projects.window.list',$milestone->id)); ?>"  data-bs-toggle="tooltip" title="<?php echo e(__('List View')); ?>" class="btn btn-sm btn-primary">
                                                        <i class="ti ti-list"></i>
                                                    </a>
                                                </div>
                                        </td>
                                            
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        
                        </ul>

                    </div>
            </div>
        </div>
        
         <div class="col-xxl-12">
            <div class="card">
                 <?php
                        $asapen = "Asaspen";
                        ?>
                    <div class="card-header">
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create milestone')): ?>
                            <div class="float-end">
                         <?php echo e(Form::open(['route' => ['projectall.quote.sheet',$project->id],'enctype' => 'multipart/form-data'])); ?>

                            <input type="hidden" class="form-control" name="company"  value="<?php echo e($asapen); ?>">
                            <input type="submit" value="<?php echo e(__('jobcost')); ?>" class="btn btn-sm btn-primary">
                            <?php echo e(Form::close()); ?>

                            </div>
                        <?php endif; ?>
                        <h5><?php echo e(__('Asapen')); ?> (<?php echo e(count($project->asapenentry)); ?>)</h5>
                    </div>
                    <div class="card-body table-border-style">
                        <ul class="list-group list-group-flush">
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
                                             <th><?php echo e(__('No of  Windows')); ?></th>
                                            <th><?php echo e(__('Action')); ?></th>

                                        </tr>
                                
                                    </thead>
                                    <tbody >
                                                
                                        <?php $__currentLoopData = $project->asapenentry; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $milestone): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    
                                            <tr>
                                                <td><?php echo e($milestone->frame); ?></td>
                                                                                          <td scope="row">
                                        
                                                    <?php if(!empty($milestone->image)): ?>
                                            <!--<img alt="image" data-toggle="tooltip" data-original-title="<?php echo e($image->name); ?>" <?php if($image->image): ?> src="<?php echo e(asset('/formulaimages/'.$image->image)); ?>" <?php endif; ?>  width="35" height="35">-->
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
                                                   <td><?php echo e($milestone->count()); ?></td>
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
                                        </td>
                                            
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        
                        </ul>

                    </div>
            </div>
        </div>
        
        <div class="col-xxl-12">
            <div class="card">
                 <?php
                        $winplast = "Winplast";
                        ?>
                    <div class="card-header">
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create milestone')): ?>
                            <div class="float-end">
                         <?php echo e(Form::open(['route' => ['projectall.quote.sheet',$project->id],'enctype' => 'multipart/form-data'])); ?>

                            <input type="hidden" class="form-control" name="company"  value="<?php echo e($winplast); ?>">
                            <input type="submit" value="<?php echo e(__('jobcost')); ?>" class="btn btn-sm btn-primary">
                            <?php echo e(Form::close()); ?>

                            </div>
                        <?php endif; ?>
                        <h5><?php echo e(__('Winplast')); ?> (<?php echo e(count($project->winplast)); ?>)</h5>
                    </div>
                    <div class="card-body table-border-style">
                        <ul class="list-group list-group-flush">
                        <div class="card-body table-border-style">
                            <div class="table-responsive">
                                <table class="table datatable" >
                                    <thead>
                                        <tr>
                                             <th><?php echo e(__('Profile')); ?></th>
                                            <th><?php echo e(__('Design')); ?></th>
                                               <th><?php echo e(__('Width')); ?></th>
                                              <th><?php echo e(__('Height')); ?></th>
                                          <th><?php echo e(__('DesignType')); ?></th>
                                            <th><?php echo e(__('Windowtype')); ?></th>
                                            <th><?php echo e(__('Company')); ?></th>
                                             <th><?php echo e(__('No of  Windows')); ?></th>
                                            <th><?php echo e(__('Action')); ?></th>

                                        </tr>
                                
                                    </thead>
                                    <tbody >
                                                
                                        <?php $__currentLoopData = $project->winplast; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $milestone): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    
                                            <tr>
                                                <td><?php echo e($milestone->frame); ?></td>
                                                                                          <td scope="row">
                                        
                                                    <?php if(!empty($milestone->image)): ?>
                                            <!--<img alt="image" data-toggle="tooltip" data-original-title="<?php echo e($image->name); ?>" <?php if($image->image): ?> src="<?php echo e(asset('/formulaimages/'.$image->image)); ?>" <?php endif; ?>  width="35" height="35">-->
                                                                                                                             <img src="<?php echo e((!empty($milestone->image))? asset(Storage::url("uploads/windows/".$milestone->image)): asset(Storage::url("uploads/avatar/avatar.png"))); ?>" alt="kal" class="img-user wid-80">


                                            <?php else: ?>
                                                <a href="#" class="btn btn-sm btn-secondary btn-icon rounded-pill">
                                                    <span class="btn-inner--icon"><i class="ti ti-times-circle"></i></span>
                                                </a>
                                            <?php endif; ?>
                                        

                                        

                                         </td>
                                             <td><?php echo e($milestone->width); ?></td>
                                          <td><?php echo e($milestone->height); ?></td>
                                          <td><?php echo e($milestone->designtype); ?></td>
                                           
                                         <td><?php echo e($milestone->designtyperatio); ?></td>
                                         
                                                <td><?php echo e($milestone->company); ?></td>
                                                    <td><?php echo e($milestone->count()); ?></td>
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
                                        </td>
                                            
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        
                        </ul>

                    </div>
            </div>
        </div>
        
          <div class="col-xxl-12">
         <?php echo e(Form::open(array('route' => ['projectmul.window.update' ,$project->id],'class'=>'w-100'))); ?>

            <div class="card">
                <div class="card-header">
                 
                        <div class="float-end">
                            <a  class="btn btn-sm btn-primary" onclick="show()" ondblclick="hidediv()" data-toggle="modal" >
                                   Calculate Mullion
                            </a>
                        </div>
                    
                </div>
                <div class="card-body table-border-style mt-2" id="mullion" style="display: none;">
                    <div class="table-responsive" >
                        <table class="table  mb-0 table-custom-style" data-repeater-list="items" id="sortable-table">
                            <thead>
                            <tr>
                                <th><?php echo e(__('Frames height')); ?></br><?php echo e(__('greater than 10')); ?></th>
                                <th><?php echo e(__('Sum of')); ?></br><?php echo e(__('heights')); ?></th>
                                <th><?php echo e(__('Price')); ?> </th>
                                <th></th>
                                <th></th>
                                <th class="text-end"><?php echo e(__('Amount')); ?> </th>
                                <th></th>
                            </tr>
                            </thead>

                            <tbody class="ui-sortable" data-repeater-item>
                            <tr>

                                <td width="20%" class="form-group pt-0">

                                <?php echo e(Form::select('item', $jobs,'', array('class' => 'form-control select2 item','data-url'=>route('invoice.product'),'required'=>'required'))); ?>

                                    
                                </td>
                                <td>
                                    <div class="form-group price-input input-group search-form">
                                    <?php echo e(Form::text('sum',$sums, array('class' => 'form-control sum','required'=>'required','placeholder'=>__('sum'),'required'=>'required'))); ?>

                                    </div>
                                </td>
                                <td>
                                    <div class="form-group price-input input-group search-form">
                                    <?php echo e(Form::text('price','', array('class' => 'form-control price','required'=>'required','placeholder'=>__('Price'),'required'=>'required'))); ?>

                                    </div>
                                </td>
                                <td>

                                </td>
                                <td>

                                </td>
                                <td>
                              
                                    <a href="" class="total" id="total"></a>
                                </td>
                                
                            </tr>
                            </tbody>
                            <tfoot>
                            <div class="modal-footer">
                            <input type="button" value="<?php echo e(__('Cancel')); ?>" onclick="location.href = '<?php echo e(route("invoice.index")); ?>';" class="btn btn-light">
                            <input type="submit" value="<?php echo e(__('Create')); ?>" class="btn  btn-primary">
                            </div>
                        <?php echo e(Form::close()); ?>

                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
          
        </div>
         <div class="col-xxl-12">
            <div class="card">
                <div class="card-body">
                    <?php echo e(Form::open(['route' => ['projectall.window.store',$project->id], 'method' => 'POST', 'id' => 'product_service'])); ?>

                    <div class="d-flex align-items-center justify-content-end">
                        <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
                            <div class="btn-box">
                                <?php echo e(Form::label('designtype', __('DesignType'),['class'=>'form-label'])); ?>

                                <select name="designtype" id="designtype" class="form-control main-element select3">
                                    <option>Select Item</option>
                                    <?php $__currentLoopData = \App\Models\ProjectWindow::$alldesign_type; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($k); ?>"><?php echo e(__($v)); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-auto float-end ms-2 mt-4">
                            <a href="#" class="btn btn-sm btn-primary"
                            onclick="document.getElementById('product_service').submit(); return false;"
                            data-bs-toggle="tooltip" title="<?php echo e(__('apply')); ?>">
                                <span class="btn-inner--icon"><i class="ti ti-search"></i></span>
                            </a>
                        </div>

                    </div>
                    <?php echo e(Form::close()); ?>

                </div>
            </div>
          
        </div>
         
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home2/babarras/public_html/resources/views/projects/view.blade.php ENDPATH**/ ?>