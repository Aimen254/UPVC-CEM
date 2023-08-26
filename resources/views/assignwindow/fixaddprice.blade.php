{{ Form::model($milestone, array('route' => array('assign.window.update', $milestone->id),'enctype' => 'multipart/form-data', 'method' => 'POST'))}}
<div class="modal-body">
<div class="row">
<div class="col-6 form-group">
            <label><strong>Outer Frame Price</strong></label><br/>
            <input class="form-control" type="number" name="outerprice" id="outerprice">
        </div>
        <div class="col-6 form-group">
            <label><strong>Outer Steel Frame 60MM </strong></label><br/>
            <input class="form-control" type="number" name="outersteelprice" id="outersteelprice">
        </div>
        <div class="col-6 form-group">
                <label><strong>Casement beeding 5mm</strong></label><br/>
                <input class="form-control" type="number" name="slidebeedprice" id="slidebeedprice">
        </div>
        <div class="col-6 form-group">
                <label><strong>Gaskit EPDM</strong></label><br/>
                <input class="form-control" type="number" name="gaskitprice" id="gaskitprice">
        </div>
            <div class="col-6 form-group">
            <label><strong>Outer Frame Weight</strong></label><br/>
            <input class="form-control" type="number" name="outerw" id="outerw"  step="any">
        </div>
        <div class="col-6 form-group">
                <label><strong>Casement beeding weight</strong></label><br/>
                <input class="form-control" type="number" name="slidew" id="slidew"  step="any">
        </div>
        
</div>
</div>
<div class="modal-footer">
    <input type="button" value="{{__('Cancel')}}" class="btn  btn-light" data-bs-dismiss="modal">
    <input class="btn btn-sm btn-primary btn-icon rounded-pill" type="submit" value="Add">
</div>
{{ Form::close() }}