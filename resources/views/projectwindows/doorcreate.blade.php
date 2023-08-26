{{ Form::open(['route' => ['project.window.store' ,$project->id],'enctype' => 'multipart/form-data']) }}
<div class="modal-body">
    <div class="row">
      
        <div class="col-12 form-group">
            {{ Form::label('frame_id', __('Select Frames'),['class'=>'form-label']) }}<span class="text-danger">*</span>
            {{ Form::select('frame_id', $dooraccess,null, array('class' => 'form-control select','required'=>'required')) }}
            <input type="hidden" name="designtype"  class="form-check-input" value="door">
        </div>
        <div class="row" id="designtype">
            <div class="col-sm-12 col-md-12">
                    <div class="form-check form-check-inline">
                        <input type="radio" name="size" onclick="sizecheck()" class="form-check-input" id="60MM" value="60MM">
                        <label class="custom-control-label form-label">{{__('60MM')}}</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input type="radio" name="size" onclick="sizecheck()" id="60MM" class="form-check-input" value="70MM">
                        <label class="custom-control-label form-label">{{__('70MM')}}</label>
                    </div>  
                    <div class="form-group">
                        {{ Form::label('designtyperatio', __('Opener Type'), ['class' => 'form-label']) }}
                        <select name="designtyperatio"  class="form-control main-element select3">
                            <option>Select Item</option>
                            @foreach(\App\Models\ProjectWindow::$ratio as $k => $v)
                                <option value="{{$k}}">{{__($v)}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        {{ Form::label('handle', __('Select Handle'), ['class' => 'form-label']) }}
                        <select name="handle"  class="form-control main-element select5">
                            <option>Select Item</option>
                            @foreach(\App\Models\ProjectWindow::$handle as $k => $v)
                                <option value="{{$k}}">{{__($v)}}</option>
                            @endforeach
                        </select>
                    </div>
            </div>
        </div>
        <div class="col-12 form-group">
            <label><strong>Width</strong></label><br/>
            <input class="form-control" type="number" name="width" id="width">
        </div>
        <div class="col-12 form-group">
                <label><strong>Height</strong></label><br/>
                <input class="form-control" type="number" name="height" id="height">
        </div>
        <div class="col-12 form-group">
            {{Form::label('image',__('Image'),['class'=>'form-label'])}}
            <div class="choose-file form-group">
                <label for="image" class="form-label">
                    <div>{{__('Choose file here')}}</div>
                    <input type="file" class="form-control" name="image" id="attachment" data-filename="attachment_create">
                </label>
                <p class="attachment_create"></p>
            </div>
        </div>
        <div class="type" id="hindge" >
            <div class="form-group">
                {{ Form::label('hindge', __('Hindge'), ['class' => 'form-label']) }}
                <select name="hindge"  class="form-control main-element select4">
                    <option>Select Item</option>
                    @foreach(\App\Models\ProjectWindow::$hing as $k => $v)
                        <option value="{{$k}}">{{__($v)}}</option>
                    @endforeach
                </select>
            </div>
        <div class="col-md-6" id ="lock">
            <div class="form-check form-check-inline">
                <input type="radio" class="form-check-input" id="customRadio8" name="type" value="tlock" onclick="hide_show(this)">
                <label class="custom-control-label form-label" for="customRadio6">{{__('T-lock')}}<label>
            </div>
        </div>
    </div>
</div>

<div class="modal-footer">
    <input type="button" value="{{__('Cancel')}}" class="btn  btn-light" data-bs-dismiss="modal">
    <input type="submit" value="{{__('Create')}}" class="btn  btn-primary">
</div>

{{Form::close()}}

