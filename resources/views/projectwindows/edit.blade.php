{{ Form::model($projectwindow, array('route' => array('windows.update', $projectwindow->id), 'method' => 'PUT')) }}
<div class="modal-body">
    <div class="row">
        <div class="col-6 form-group">
            {{ Form::label('widthmm', __('Width in MM'),['class'=>'form-label']) }}<span class="text-danger">*</span>
            {{ Form::number('widthmm', null, array('class' => 'form-control','required'=>'required')) }}
        </div>
        <div class="col-6 form-group">
            {{ Form::label('heightmm', __('Height in MM'),['class'=>'form-label']) }}<span class="text-danger">*</span>
            {{ Form::number('heightmm', null, array('class' => 'form-control','required'=>'required')) }}
        </div>
         
    </div>
</div>

<div class="modal-footer">
    <input type="button" value="{{__('Cancel')}}" class="btn  btn-light" data-bs-dismiss="modal">
    <input type="submit" value="{{__('Add')}}" class="btn  btn-primary">
</div>

{{Form::close()}}

