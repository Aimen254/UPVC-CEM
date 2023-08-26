{{ Form::open(array('url' => 'leads')) }}
<div class="modal-body">
    <div class="row">
        <div class="col-6 form-group">
            {{ Form::label('subject', __('Subject'),['class'=>'form-label']) }}
            {{ Form::text('subject', null, array('class' => 'form-control','required'=>'required')) }}
        </div>
        <div class="col-6 form-group">
            {{ Form::label('user_id', __('User'),['class'=>'form-label']) }}
            {{ Form::select('user_id', $users,null, array('class' => 'form-control select','required'=>'required')) }}
            @if(count($users) == 1)
                <div class="text-muted text-xs">
                    {{__('Please create new users')}} <a href="{{route('users.index')}}">{{__('here')}}</a>.
                </div>
            @endif
        </div>
        <div class="col-6 form-group">
            {{ Form::label('name', __('Name'),['class'=>'form-label']) }}
            {{ Form::text('name', null, array('class' => 'form-control','required'=>'required')) }}
        </div>
        <!--<div class="col-6 form-group">-->
        <!--    {{ Form::label('email', __('Email'),['class'=>'form-label']) }}-->
        <!--    {{ Form::text('email', null, array('class' => 'form-control','required'=>'required')) }}-->
        <!--</div>-->
        <div class="col-6 form-group">
            {{ Form::label('phone', __('Phone'),['class'=>'form-label']) }}
            {{ Form::text('phone', null, array('class' => 'form-control','required'=>'required')) }}
        </div>
          <div class="col-6 form-group">
            {{ Form::label('houseno', __('House#'),['class'=>'form-label']) }}
            {{ Form::number('houseno', null, array('class' => 'form-control')) }}
        </div>
        <div class="col-6 form-group">
            {{ Form::label('streetno', __('Street#'),['class'=>'form-label']) }}
            {{ Form::text('streetno', null, array('class' => 'form-control')) }}
        </div>
         <div class="col-6 form-group">
            {{ Form::label('sector', __('Sector'),['class'=>'form-label']) }}
            {{ Form::text('sector', null, array('class' => 'form-control')) }}
        </div>
        <div class="col-6 form-group">
            {{ Form::label('area', __('Area'),['class'=>'form-label']) }}
            {{ Form::text('area', null, array('class' => 'form-control')) }}
        </div>
        <div class="col-6 form-group">
            {{ Form::label('housesize', __('HouseSize'),['class'=>'form-label']) }}
            {{ Form::text('housesize', null, array('class' => 'form-control')) }}
        </div>
        <div class="col-6 form-group">
            {{ Form::label('whoishe', __('Who is he'),['class'=>'form-label']) }}
            {{ Form::text('whoishe', null, array('class' => 'form-control','required'=>'required')) }}
        </div>
          <div class="col-sm-6 col-md-6">
            <div class="form-group">
                {{ Form::label('created_at', __('Created_at'), ['class' => 'form-label']) }}
                {{ Form::date('created_at', null, ['class' => 'form-control']) }}
            </div>
        </div>
    </div>
</div>

<div class="modal-footer">
    <input type="button" value="{{__('Cancel')}}" class="btn  btn-light" data-bs-dismiss="modal">
    <input type="submit" value="{{__('Create')}}" class="btn  btn-primary">
</div>

{{Form::close()}}

