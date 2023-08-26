{{ Form::open(['route' => ['project.window.store' ,$project->id],'enctype' => 'multipart/form-data']) }}
<div class="modal-body">
    <div class="row">
      
       
        <div class="row" id="designtype">
            <div class="col-sm-12 col-md-12">
                <div class="form-group">
                    {{ Form::label('designtype', __('DesignType'), ['class' => 'form-label']) }}
                    <select name="designtype" id="designsel" class="form-control main-element select3">
                        <option>Select Item</option>
                        @foreach(\App\Models\ProjectWindow::$design_type as $k => $v)
                            <option value="{{$k}}">{{__($v)}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="sliding" id="sliding" style="display:none;">
                    <div class="form-check form-check-inline">
                        <input type="radio" name="designtyperatio" class="form-check-input" value="single" checked>
                        <label class="custom-control-label form-label">{{__('single')}}</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input type="radio" name="designtyperatio" class="form-check-input" value="double">
                        <label class="custom-control-label form-label">{{__('double')}}</label>
                    </div>
                </div>
                <div class="fix" id="fix" style="display:none;">
                    <div class="form-check form-check-inline">
                        <input type="radio" name="designtyperatio" class="form-check-input" value="60MM" checked>
                        <label class="custom-control-label form-label">{{__('60MM')}}</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input type="radio" name="designtyperatio" class="form-check-input" value="70MM">
                        <label class="custom-control-label form-label">{{__('70MM')}}</label>
                    </div>
                </div>
                <div class="openable" id="openable" style="display:none;">
                    <div class="form-check form-check-inline">
                        <input type="radio" name="openabletype"  onclick="hingcheck()" class="form-check-input" id="tophing" value="tophing" >
                        <label class="custom-control-label form-label">{{__('Top Hing')}}</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input type="radio" name="openabletype"  onclick="casecheck()"  class="form-check-input" id="casement" value="casement">
                        <label class="custom-control-label form-label">{{__('Casement')}}</label>
                    </div>
                </div>
                <div class="frametype" id="frametype" style="display:none;">
                    <div class="form-check form-check-inline">
                        <input type="radio" name="openabledir" class="form-check-input" value="outward60MM" >
                        <label class="custom-control-label form-label">{{__('Outward 60MM')}}</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input type="radio" name="openabledir" class="form-check-input" value="utward70MM">
                        <label class="custom-control-label form-label">{{__('Outward 70MM')}}</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input type="radio" name="openabledir" class="form-check-input" value="inward60MM" >
                        <label class="custom-control-label form-label">{{__('Inward 60MM')}}</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input type="radio" name="openabledir" class="form-check-input" value="inward70MM">
                        <label class="custom-control-label form-label">{{__('Inward 70MM')}}</label>
                    </div>
                </div>
                <div class="type" id="type" style="display:none;">
                    <div class="form-check form-check-inline">
                        <input type="radio" name="designtyperatio" class="form-check-input" value="singleopener" >
                        <label class="custom-control-label form-label">{{__('Single Opener')}}</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input type="radio" name="designtyperatio" class="form-check-input" value="doubleopener">
                        <label class="custom-control-label form-label">{{__('Double Opener')}}</label>
                    </div>
                </div>
            </div>
        </div>
         <div class="row">
            <div class="col-sm-12 col-md-12">
                <div class="form-group" id="slideac" style="display:none;">
                    {{ Form::label('frame_id', __('Frames'), ['class' => 'form-label']) }}
                        <select name="frame_id"  class="form-control main-element select7" id="slideframe">
                            <option>Select Frames</option>
                            @foreach($slideaccess as $k => $v)
                                <option value="{{$k}}">{{__($v)}}</option>
                            @endforeach
                        </select>
                </div>

                <div class="form-group" id="openac" style="display:none;">
                    {{ Form::label('frame_id', __('Frames'), ['class' => 'form-label']) }}
                        <select name="frame_id"  class="form-control main-element select8" id="openframe">
                            <option>Select Frames</option>
                            @foreach($openaccess as $k => $v)
                                <option value="{{$k}}">{{__($v)}}</option>
                            @endforeach
                        </select>
                </div>
                <div class="form-group" id="fixac" style="display:none;">
                    {{ Form::label('frame_id', __('Frames'), ['class' => 'form-label']) }}
                        <select name="frame_id"  class="form-control main-element select9" id="fixframe">
                            <option>Select Frames</option>
                            @foreach($fixaccess as $k => $v)
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
      
        <div class="col-md-6" id="gear">
            <div class="form-check form-check-inline">
                <input type="radio" class="form-check-input" id="customRadio5" name="type" value="gear_handles" checked="checked" onclick="hide_show(this)">
                <label class="custom-control-label form-label" for="customRadio5">{{__('Gear Handles')}}</label>
            </div>
        </div>
        <div class="col-md-6" id ="slidelock">
            <div class="form-check form-check-inline">
                <input type="radio" class="form-check-input" id="customRadio6" name="type" value="latchlock" onclick="hide_show(this)">
                <label class="custom-control-label form-label" for="customRadio6">{{__('Latch Lock')}}</label>
            </div>
        </div>
        <div class="col-md-6" id ="openlock" style="display: none;">
            <div class="form-check form-check-inline">
                <input type="radio" class="form-check-input" id="customRadio8" name="type" value="cockspurhandle" onclick="hide_show(this)">
                <label class="custom-control-label form-label" for="customRadio6">{{__('Cockspur Handel')}}<label>
            </div>
        </div>
        <div class="col-12 form-group" id="qty">
            {{ Form::label('typequantity', __('Lock Quantity'), ['class' => 'form-label']) }}
            {{ Form::number('typequantity', null, ['class' => 'form-control']) }}
        </div>
        <div class="type" id="hindge" style="display:none;">
            <div class="form-check form-check-inline">
                <input type="radio" name="hindge" class="form-check-input" value="2Dhindge" >
                <label class="custom-control-label form-label">{{__('2D hindge')}}</label>
            </div>
            <div class="form-check form-check-inline">
                <input type="radio" name="hindge" class="form-check-input" value="3Dhindge">
                <label class="custom-control-label form-label">{{__('3D hindge')}}</label>
            </div>
        </div>
        
    </div>
</div>

<div class="modal-footer">
    <input type="button" value="{{__('Cancel')}}" class="btn  btn-light" data-bs-dismiss="modal">
    <input type="submit" value="{{__('Create')}}" class="btn  btn-primary">
</div>

{{Form::close()}}


<script>
    
$('#designsel').on('change',function(){
    var some = $(this).find('option:selected').val();
    if(some == "sliding"){
        $("#sliding").show();
           $("#slideac").show();
            document.getElementById("openframe").disabled = true;
            document.getElementById("fixframe").disabled = true;
            $("#fixac").hide();
            $("#openac").hide();
        $("#fix").hide();
        $("#openable").hide();
         $("#slidelock").show();
           $("#openlock").hide();
    }else if(some == "fix"){
        $("#fix").show();
         $("#fixac").show();
            document.getElementById("slideframe").disabled = true;
            document.getElementById("openframe").disabled = true;
            $("#slideac").hide();
            $("#openac").hide();
        $("#openable").hide();
        $("#sliding").hide();
           $("#slidelock").hide();
           $("#openlock").hide();
            $("#gear").hide();
             $("#qty").hide();
         
    }else if(some == "openable"){
        $("#openable").show();
         $("#openac").show();
            document.getElementById("slideframe").disabled = true;
            document.getElementById("fixframe").disabled = true;
            $("#slideac").hide();
            $("#fixac").hide();
        $("#sliding").hide();
        $("#fix").hide();
          $("#slidelock").hide();
             $("#gear").show();
              $("#openlock").show();
    }else{
        $("#sliding").hide();
        $("#fix").hide();
        $("#openable").hide();
    }
       
 
});

</script>
<script>
 function hingcheck(){
if( document.getElementById("tophing").checked = true){
    $("#frametype").show();
    $("#type").hide();
       $("#hindge").hide();
}else{
    $("#frametype").hide();
       $("#hindge").hide();
}
}
function casecheck(){
if( document.getElementById("casement").checked = true){
    $("#frametype").show();
    $("#type").show();
        $("#hindge").show();
}else{
    $("#frametype").hide();
       $("#hindge").hide();
}
}

</script>

