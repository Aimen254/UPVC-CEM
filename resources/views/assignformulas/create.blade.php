{{ Form::open(['route' => ['formasign.store'],'enctype' => 'multipart/form-data']) }}
<div class="modal-body">
    <div class="row">
        <div class="col-6 form-group">
            <label class="">Name</label>
            <input class="form-control" type="hidden" name="id" id="imageid" value="{{$image->id}}">
            <input class="form-control" value="{{$image->name}}" type="text" name="name" id="name">
        </div>
        <div class="col-12 form-group">
           
           <img src="{{(!empty($image->image))? asset(Storage::url("uploads/windows/".$image->image)): asset(Storage::url("uploads/avatar/avatar.png"))}}" alt="kal" class="img-user wid-140">
             
        </div>
    
      
        <div class="col-12 form-group">
            {{ Form::label('formula_id', __('Formulas'),['class'=>'form-label']) }}<span class="text-danger">*</span>
            {{ Form::select('formula_id[]', $formulas,null, array('class' => 'form-control select2','id'=>'choices-multiple1','multiple'=>'','required'=>'required')) }}
        </div>
        @if($image->type == "Sliding Sash")
                <div class="col-12 form-group">
            {{ Form::label('acess_id', __('Accessories'),['class'=>'form-label']) }}<span class="text-danger">*</span>
            {{ Form::select('acess_id[]',  $slidingaccess,null, array('class' => 'form-control select2','id'=>'choices-multiple2','multiple'=>'')) }}
        </div>
         @elseif($image->type == "Openable door")
           <div class="col-12 form-group">
            {{ Form::label('acess_id', __('Accessories'),['class'=>'form-label']) }}<span class="text-danger">*</span>
          
            {{ Form::select('acess_id[]', $openabledooraccess,null, array('class' => 'form-control select2','id'=>'choices-multiple2','multiple'=>'')) }}
        </div>
        @elseif($image->type == "Openable windows")
        <div class="col-12 form-group">
            {{ Form::label('acess_id', __('Accessories'),['class'=>'form-label']) }}<span class="text-danger">*</span>
            {{ Form::select('acess_id[]', $openablewindaccess,null, array('class' => 'form-control select2','id'=>'choices-multiple2','multiple'=>'')) }}
        </div>
        @else
        <div class="col-12 form-group">
            {{ Form::label('acess_id', __('Accessories'),['class'=>'form-label']) }}<span class="text-danger">*</span>
            {{ Form::select('acess_id[]', $access,null, array('class' => 'form-control select2','id'=>'choices-multiple2','multiple'=>'')) }}
        </div>
        @endif
    </div>
</div>


<div class="modal-footer">
    <input type="button" value="{{__('Cancel')}}" class="btn  btn-light" data-bs-dismiss="modal">
    <input type="submit" value="{{__('Create')}}" class="btn  btn-primary">
</div>

{{Form::close()}}
<script>
$('select').selectpicker();
</script>

