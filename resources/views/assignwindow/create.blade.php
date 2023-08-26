{{ Form::open(['route' => ['assignwindows.store'],'enctype' => 'multipart/form-data']) }}
<div class="modal-body">
    <div class="row">
       
        <div class="col-12 form-group">
            {{ Form::label('frame_id', __('Select Frames'),['class'=>'form-label']) }}<span class="text-danger">*</span>
            {{ Form::select('frame_id[]', $access,null, array('class' => 'form-control select2','id'=>'choices-multiple2','multiple'=>'','required'=>'required')) }}
        </div>
          
        <!--<div class="col-12 form-group">-->
        <!--    {{Form::label('image',__('Image'),['class'=>'form-label'])}}-->
        <!--    <div class="choose-file form-group">-->
        <!--        <label for="image" class="form-label">-->
        <!--            <div>{{__('Choose file here')}}</div>-->
        <!--            <input type="file" class="form-control" name="image" id="attachment" data-filename="attachment_create">-->
        <!--        </label>-->
        <!--        <p class="attachment_create"></p>-->
        <!--    </div>-->
        <!--</div>-->
         <div class="col-md-3">
            <div class="form-check form-check-inline">
                <input type="radio" class="form-check-input" id="customRadio5" name="type" value="sliding" checked="checked" onclick="hide_show(this)">
                <label class="custom-control-label form-label" for="customRadio5">{{__('Sliding')}}</label>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-check form-check-inline">
                <input type="radio" class="form-check-input" id="customRadio6" name="type" value="fix" onclick="hide_show(this)">
                <label class="custom-control-label form-label" for="customRadio6">{{__('Fix')}}<label>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-check form-check-inline">
                <input type="radio" class="form-check-input" id="customRadio6" name="type" value="openable" onclick="hide_show(this)">
                <label class="custom-control-label form-label" for="customRadio6">{{__('Openable')}}<label>
            </div>
        </div>
         <div class="col-md-3">
            <div class="form-check form-check-inline">
                <input type="radio" class="form-check-input" id="customRadio6" name="type" value="door" onclick="hide_show(this)">
                <label class="custom-control-label form-label" for="customRadio6">{{__('Door')}}<label>
            </div>
        </div>
        <div class="col-16 form-group">
            {{ Form::label('profile', __('Profile'),['class'=>'form-label']) }}
            {{ Form::text('profile', null, array('class' => 'form-control','required'=>'required')) }}
        </div>
        <div class="col-16 form-group">
            {{ Form::label('company', __('Choose company'), ['class' => 'form-label']) }}
                    <select name="company" id="company" class="form-control main-element select3">
                        <option>Select company</option>
                        @foreach(\App\Models\ProjectWindow::$brand as $k => $v)
                            <option value="{{$k}}">{{__($v)}}</option>
                        @endforeach
                    </select>
        </div>
        
    </div>
</div>

<div class="modal-footer">
    <input type="button" value="{{__('Cancel')}}" class="btn  btn-light" data-bs-dismiss="modal">
    <input type="submit" value="{{__('Create')}}" class="btn  btn-primary">
</div>

{{Form::close()}}

