{{ Form::open(['route' => ['usrimg.status' ],'enctype' => 'multipart/form-data']) }}
<div class="modal-body">
    <div class="row">
      
        <div class="col-sm-6">
            <div class="form-group">
                <input class="form-control" type="hidden" name="id" id="imageid" value="{{$data->id}}">
                {{ Form::label('status', __('Status'), ['class' => 'form-label']) }}
                <select name="status" id="status" class="form-control main-element select2">
                    @foreach(\App\Models\UserWindow::$windows_status as $k => $v)
                        <option value="{{$k}}">{{__($v)}}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
</div>

<div class="modal-footer">
    <input type="button" value="{{__('Cancel')}}" class="btn  btn-light" data-bs-dismiss="modal">
    <input type="submit" value="{{__('Create')}}" class="btn  btn-primary">
</div>

{{Form::close()}}

