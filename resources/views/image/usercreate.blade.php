{{ Form::open(['route' => ['usrimg.store'],'enctype' => 'multipart/form-data']) }}
<div class="modal-body">
    <div class="row">
        <div class="col-6 form-group">
            <label class="">Name</label>
            <input class="form-control" type="hidden" name="id" id="imageid" value="{{$image->id}}">
            <input class="form-control" value="{{$image->name}}" type="text" name="name" id="name">
        </div>
        <div class="col-12 form-group">
            <!--<label class="">Name</label>-->
           <img src="{{(!empty($image->image))? asset(Storage::url("uploads/windows/".$image->image)): asset(Storage::url("uploads/avatar/avatar.png"))}}" alt="kal" class="img-user wid-140 ">
             
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
            {{ Form::label('products', __('Projects'),['class'=>'form-label']) }}<span class="text-danger">*</span>
            {{ Form::select('products[]', $products,null, array('class' => 'form-control select2','id'=>'choices-multiple2','multiple'=>'','required'=>'required')) }}
        </div>
    </div>
</div>

<div class="modal-footer">
    <input type="button" value="{{__('Cancel')}}" class="btn  btn-light" data-bs-dismiss="modal">
    <input type="submit" value="{{__('Create')}}" class="btn  btn-primary">
</div>

{{Form::close()}}

