{{ Form::model($milestone, array('route' => array('project.windowacess.update', $milestone->id), 'method' => 'POST')) }}

<div class="modal-body">
<div class="row">
       
<div class="col-6 form-group">
        {{ Form::label('siliconrate', __('siliconrate'),['class' => 'form-label']) }}
        {{ Form::number('siliconrate', null, array('class' => 'form-control','required'=>'required')) }}
           
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