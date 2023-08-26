{{ Form::model($milestone, array('route' => array('door.assign.access.store', $milestone->id),'enctype' => 'multipart/form-data', 'method' => 'POST'))}}
<div class="modal-body">
<div class="row">
        
        <div class="col-6 form-group">
            <input type="checkbox" value="silicon" name="silicon">Silicon<br/> 
            <input class="form-control" type="number" name="siliconqty" placeholder="qty"  style="width: 5em;  display: inline-block;">
            <input class="form-control" type="number" name="siliconrate" placeholder="price" style="width: 6em;  display: inline-block;">
        </div>
    
        <div class="col-6 form-group">
            <input type="checkbox" value="twoDhindges" name="twoDhindges">2D hindges<br/> 
            <input class="form-control" type="number" name="twoDhindgesqty" placeholder="qty"  style="width: 5em;  display: inline-block;">
            <input class="form-control" type="number" name="twoDhindgesrate" placeholder="price" style="width: 6em;  display: inline-block;">
        </div>

        <div class="col-6 form-group">
            <input type="checkbox" value="thDhindges" name="thDhindges">3D hindges<br/> 
            <input class="form-control" type="number" name="thDhindgesqty" placeholder="qty"  style="width: 5em;  display: inline-block;">
            <input class="form-control" type="number" name="thDhindgesrate" placeholder="price" style="width: 6em;  display: inline-block;">
        </div>

        <div class="col-6 form-group">
            <input type="checkbox" value="Tlock" name="Tlock">Tlock<br/> 
            <input class="form-control" type="number" name="Tlockqty" placeholder="qty"  style="width: 5em;  display: inline-block;">
            <input class="form-control" type="number" name="Tlockrate" placeholder="price" style="width: 6em;  display: inline-block;">
        </div>

        <div class="col-6 form-group">
            <input type="checkbox" value="cockspur" name="cockspur">Cockspur Handle<br/> 
            <input class="form-control" type="number" name="cockspurqty" placeholder="qty"  style="width: 5em;  display: inline-block;">
            <input class="form-control" type="number" name="cockspurrate" placeholder="price" style="width: 6em;  display: inline-block;">
        </div>
        <div class="col-6 form-group">
            <input type="checkbox" value="imphandlesp" name="imphandlesp">Imported Handle Espanglet<br/> 
            <input class="form-control" type="number" name="imphandlespqty" placeholder="qty"  style="width: 5em;  display: inline-block;">
            <input class="form-control" type="number" name="imphandlesprate" placeholder="price" style="width: 6em;  display: inline-block;">
        </div>
        <div class="col-6 form-group">
            <input type="checkbox" value="imphandle" name="imphandle">Imported Handle<br/> 
            <input class="form-control" type="number" name="imphandleqty" placeholder="qty"  style="width: 5em;  display: inline-block;">
            <input class="form-control" type="number" name="imphandlerate" placeholder="price" style="width: 6em;  display: inline-block;">
        </div>
        <div class="col-6 form-group">
            <input type="checkbox" value="imphandlecyl" name="imphandlecyl">Imported Handle Cylinder<br/> 
            <input class="form-control" type="number" name="imphandlecylqty" placeholder="qty"  style="width: 5em;  display: inline-block;">
            <input class="form-control" type="number" name="imphandlecylrate" placeholder="price" style="width: 6em;  display: inline-block;">
        </div>
      
</div>
</div>
<div class="modal-footer">
    <input type="button" value="{{__('Cancel')}}" class="btn  btn-light" data-bs-dismiss="modal">
    <input class="btn btn-sm btn-primary btn-icon rounded-pill" type="submit" value="Add">
</div>
{{ Form::close() }}