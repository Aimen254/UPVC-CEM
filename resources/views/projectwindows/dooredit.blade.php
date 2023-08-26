{{ Form::model($milestone, array('route' => array('project.windowopenacess.update', $milestone->id), 'method' => 'POST')) }}

<div class="modal-body">
<div class="row">
<div class="col-6 form-group">
            {{ Form::label('siliconrate', __('siliconrate'),['class' => 'form-label']) }}
            {{ Form::number('siliconrate', null, array('class' => 'form-control')) }} 
           
        </div>
        <div class="col-6 form-group">
        {{ Form::label('imphandlesprate', __('imphandlesprate'),['class' => 'form-label']) }}
            {{ Form::number('imphandlesprate', null, array('class' => 'form-control')) }} 
            
        </div>
        <div class="col-6 form-group">
        {{ Form::label('imphandlerate', __('imphandlerate'),['class' => 'form-label']) }}
            {{ Form::number('imphandlerate', null, array('class' => 'form-control')) }} 
           
        </div>
        <div class="col-6 form-group">
        {{ Form::label('imphandlecylrate', __('imphandlecylrate'),['class' => 'form-label']) }}
            {{ Form::number('imphandlecylrate', null, array('class' => 'form-control')) }} 
           
        </div>

        <div class="col-6 form-group">
        {{ Form::label('twoDhindgesrate', __('2D hindgesrate'),['class' => 'form-label']) }}
            {{ Form::number('twoDhindgesrate', null, array('class' => 'form-control')) }} 
            
        </div>

        <div class="col-6 form-group">
        {{ Form::label('thDhindgesrate', __('3D hindgesrate'),['class' => 'form-label']) }}
            {{ Form::number('thDhindgesrate', null, array('class' => 'form-control')) }} 
           
        </div>

        <div class="col-6 form-group">
        {{ Form::label('Tlockrate', __('Tlockrate'),['class' => 'form-label']) }}
            {{ Form::number('Tlockrate', null, array('class' => 'form-control')) }} 
           
        </div>

        <div class="col-6 form-group">
        {{ Form::label('cockspurrate', __('cockspurrate'),['class' => 'form-label']) }}
            {{ Form::number('cockspurrate', null, array('class' => 'form-control')) }} 
        
        </div>
</div>
</div>
<div class="modal-footer">
    <input type="button" value="{{__('Cancel')}}" class="btn  btn-light" data-bs-dismiss="modal">
    <input class="btn btn-sm btn-primary btn-icon rounded-pill" type="submit" value="Add">
</div>
{{ Form::close() }}