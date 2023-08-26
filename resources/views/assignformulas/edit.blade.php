{{ Form::model($form, array('route' => array('formasign.update', $form->id), 'method' => 'PUT')) }}<div class="modal-body">
<div class="row">
        <div class="col-6 form-group">
            
            {{ Form::hidden('image_id', null, array('class' => 'form-control','required'=>'required')) }}
            {{ Form::label('imagename', __('Name'),['class'=>'form-label']) }}<span class="text-danger">*</span>
            {{ Form::text('imagename',null, array('class' => 'form-control','required'=>'required')) }}
        </div>
        <div class="col-12 form-group">
            <label class="">Name</label>
            <img src="@if(!empty($image->image)) {{asset('/formulaimages/'.$image->image)}} @endif" alt="kal" class="img-user wid-30 width="500" height="200" ">
             
        </div>
    
        <div class="col-12 form-group">
        {{ Form::label('formula_id', __('Formulas'),['class'=>'form-label']) }}
            {{ Form::select('formula_id[]', $formulas,null, array('class' => 'form-control select2','id'=>'choices-multiple3','multiple'=>'')) }}
        </div>
           @if($image->type == "Sliding Sash")
                <div class="col-12 form-group">
            {{ Form::label('acess_id', __('Accessories'),['class'=>'form-label']) }}<span class="text-danger">*</span>
            {{ Form::select('acess_id[]',  $slidingaccess,null, array('class' => 'form-control select2','id'=>'choices-multiple2','multiple'=>'','required'=>'required')) }}
        </div>
         @elseif($image->type == "Openable door")
           <div class="col-12 form-group">
            {{ Form::label('acess_id', __('Accessories'),['class'=>'form-label']) }}<span class="text-danger">*</span>
            {{ Form::select('acess_id[]', $openabledooraccess,null, array('class' => 'form-control select2','id'=>'choices-multiple2','multiple'=>'','required'=>'required')) }}
        </div>
        @elseif($image->type == "Openable windows")
        <div class="col-12 form-group">
            {{ Form::label('acess_id', __('Accessories'),['class'=>'form-label']) }}<span class="text-danger">*</span>
            {{ Form::select('acess_id[]', $openablewindaccess,null, array('class' => 'form-control select2','id'=>'choices-multiple2','multiple'=>'','required'=>'required')) }}
        </div>
        @else
        <div class="col-12 form-group">
            {{ Form::label('acess_id', __('Accessories'),['class'=>'form-label']) }}<span class="text-danger">*</span>
            {{ Form::select('acess_id[]', $access,null, array('class' => 'form-control select2','id'=>'choices-multiple2','multiple'=>'','required'=>'required')) }}
        </div>
        @endif

    </div>
</div>

<div class="modal-footer">
    <input type="button" value="{{__('Cancel')}}" class="btn  btn-light" data-bs-dismiss="modal">
    <input type="submit" value="{{__('Update')}}" class="btn  btn-primary">
</div>
{{Form::close()}}
<script>
$('select').selectpicker();
</script>

