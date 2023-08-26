{{ Form::open(['route' => ['usrimg.assign' ],'enctype' => 'multipart/form-data']) }}
<div class="modal-body">
    <div class="row">
      
        <div class="col-6 form-group">
        <input class="form-control" type="hidden" name="id" id="imageid" value="{{$data->id}}">
            {{ Form::label('assign', __('Assign to'),['class'=>'form-label']) }}<span class="text-danger">*</span>
            {{ Form::select('assign[]', $users,null, array('class' => 'form-control select2','id'=>'choices-multiple2','multiple'=>'','required'=>'required')) }}
        </div>
    </div>
</div>

<div class="modal-footer">
    <input type="button" value="{{__('Cancel')}}" class="btn  btn-light" data-bs-dismiss="modal">
    <input type="submit" value="{{__('Create')}}" class="btn  btn-primary">
</div>

{{Form::close()}}

