{{ Form::model($milestone, array('route' => array('project.windowacess.update', $milestone->id), 'method' => 'POST')) }}

<div class="modal-body">
<div class="row">
      <div class="col-6 form-group">
        @if(!empty($milestone->gearlockrate))
        {{ Form::label('gearlockrate', __('gearlockrate'),['class' => 'form-label']) }}
        {{ Form::number('gearlockrate', null, array('class' => 'form-control','required'=>'required')) }}
        @else    
        {{ Form::label('latchlockrate', __('latchlockrate'),['class' => 'form-label']) }}
        {{ Form::number('latchlockrate', null, array('class' => 'form-control','required'=>'required')) }}
        @endif
    </div>
        <div class="col-6 form-group">
        {{ Form::label('sashrollrate', __('sashrollrate'),['class' => 'form-label']) }}
        {{ Form::number('sashrollrate', null, array('class' => 'form-control','required'=>'required')) }}
        </div>
        <div class="col-6 form-group">
        {{ Form::label('flathandlerate', __('flathandlerate'),['class' => 'form-label']) }}
        {{ Form::number('flathandlerate', null, array('class' => 'form-control','required'=>'required')) }}
           
        </div>
        <div class="col-6 form-group">
        {{ Form::label('slidekeeprate', __('slidekeeprate'),['class' => 'form-label']) }}
        {{ Form::number('slidekeeprate', null, array('class' => 'form-control','required'=>'required')) }}
           
        
        </div>
        <div class="col-6 form-group">
        {{ Form::label('dummywheelrate', __('dummywheelrate'),['class' => 'form-label']) }}
        {{ Form::number('dummywheelrate', null, array('class' => 'form-control','required'=>'required')) }} 
           
        </div>
        <div class="col-6 form-group">
        {{ Form::label('netwheelrate', __('netwheelrate'),['class' => 'form-label']) }}
        {{ Form::number('netwheelrate', null, array('class' => 'form-control','required'=>'required')) }} 
           
        </div>
        <div class="col-6 form-group">
        {{ Form::label('siliconrate', __('siliconrate'),['class' => 'form-label']) }}
        {{ Form::number('siliconrate', null, array('class' => 'form-control','required'=>'required')) }} 
           
        </div>
        <div class="col-6 form-group">
        {{ Form::label('fixerrate', __('fixerrate'),['class' => 'form-label']) }}
        {{ Form::number('fixerrate', null, array('class' => 'form-control','required'=>'required')) }} 
           
        </div>
        <div class="col-6 form-group">
        {{ Form::label('windbreakrate', __('windbreakrate'),['class' => 'form-label']) }}
        {{ Form::number('windbreakrate', null, array('class' => 'form-control','required'=>'required')) }} 
           
        </div>
        <div class="col-6 form-group">
        {{ Form::label('stopperrate', __('stopperrate'),['class' => 'form-label']) }}
        {{ Form::number('stopperrate', null, array('class' => 'form-control','required'=>'required')) }} 
             
        </div>
        <div class="col-6 form-group">
            {{ Form::label('bumperblockrate', __('bumperblockrate'),['class' => 'form-label']) }}
            {{ Form::number('bumperblockrate', null, array('class' => 'form-control','required'=>'required')) }} 
             
        </div>
        <div class="col-6 form-group">
        {{ Form::label('steeltaprate', __('steeltaprate'),['class' => 'form-label']) }}
        {{ Form::number('steeltaprate', null, array('class' => 'form-control','required'=>'required')) }} 
             
        </div>
        <div class="col-6 form-group">
            {{ Form::label('conscrewrate', __('conscrewrate'),['class' => 'form-label']) }}
            {{ Form::number('conscrewrate', null, array('class' => 'form-control','required'=>'required')) }} 
             
        </div>
        
</div>
</div>
<div class="modal-footer">
    <input type="button" value="{{__('Cancel')}}" class="btn  btn-light" data-bs-dismiss="modal">
    <input class="btn btn-sm btn-primary btn-icon rounded-pill" type="submit" value="Add">
</div>
{{ Form::close() }}