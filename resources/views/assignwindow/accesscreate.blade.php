{{ Form::model($milestone, array('route' => array('assign.access.store', $milestone->id),'enctype' => 'multipart/form-data', 'method' => 'POST'))}}
<div class="modal-body">
<div class="row">
        <div class="col-6 form-group">
            <!-- <label><strong>Sash Roller</strong></label><br/> -->
            <input type="checkbox" value="sashroll" name="sashroll">Sash Roller <br/> 
            <input class="form-control" type="number"  placeholder="qty" name="sashrollqty"  style="width: 5em;  display: inline-block;">
            <input class="form-control" type="number" placeholder="price"  name="sashrollrate"  style="width: 6em;  display: inline-block;">
        </div>
        <div class="col-6 form-group">
            <input type="checkbox" value="flathandle" name="flathandle">Flat Handle<br/> 
            <input class="form-control" type="number" placeholder="qty" name="flathandleqty"  style="width: 5em;  display: inline-block;">
            <input class="form-control" type="number" placeholder="price" name="flathandlerate"  style="width: 6em;  display: inline-block;">
        </div>
        <div class="col-6 form-group">
            <input type="checkbox" value="slidekeep" name="slidekeep">sliding keep<br/> 
            <input class="form-control" type="number" name="slidekeepqty" placeholder="qty"  style="width: 5em;  display: inline-block;">
            <input class="form-control" type="number" name="slidekeeprate" placeholder="price"  style="width: 6em;  display: inline-block;">
        </div>
        <div class="col-6 form-group">
            <input type="checkbox" value="dummywheel" name="dummywheel">Dummy Wheel<br/> 
            <input class="form-control" type="number"  placeholder="qty" name="dummywheelqty"  style="width: 5em;  display: inline-block;">
            <input class="form-control" type="number"  placeholder="price" name="dummywheelrate"  style="width: 6em;  display: inline-block;">
        </div>
        <div class="col-6 form-group">
            <input type="checkbox" value="netwheel" name="netwheel">Netting Wheel<br/> 
            <input class="form-control" type="number" name="netwheelqty" placeholder="qty" style="width: 5em;  display: inline-block;">
            <input class="form-control" type="number" name="netwheelrate" placeholder="price"  style="width: 6em;  display: inline-block;">
        </div>
        <div class="col-6 form-group">
            <input type="checkbox" value="silicon" name="silicon">Silicon<br/> 
            <input class="form-control" type="number" name="siliconqty" placeholder="qty"  style="width: 5em;  display: inline-block;">
            <input class="form-control" type="number" name="siliconrate" placeholder="price" style="width: 6em;  display: inline-block;">
        </div>
        <div class="col-6 form-group">
            <input type="checkbox" value="fixer" name="fixer">Fixer<br/> 
            <input class="form-control" type="number" name="fixerqty" placeholder="qty" style="width: 5em;  display: inline-block;">
            <input class="form-control" type="number" name="fixerrate" placeholder="price" style="width: 6em;  display: inline-block;">
        </div>
        <div class="col-6 form-group">
            <input type="checkbox" value="windbreak" name="windbreak">WindBreak<br/> 
            <input class="form-control" type="number" name="windbreakqty"  placeholder="qty" style="width: 5em;  display: inline-block;">
            <input class="form-control" type="number" name="windbreakrate"  placeholder="price"  style="width: 6em;  display: inline-block;">
        </div>
        <div class="col-6 form-group">
            <input type="checkbox" value="stopper" name="stopper">Stopper<br/> 
            <input class="form-control" type="number" name="stopperqty"   placeholder="qty" style="width: 5em;  display: inline-block;">
            <input class="form-control" type="number" name="stopperrate"  placeholder="price"  style="width: 6em;  display: inline-block;">
        </div>
        <div class="col-6 form-group">
            <input type="checkbox" value="bumperblock" name="bumperblock">Bumper Block<br/> 
            <input class="form-control" type="number" name="bumperblockqty"  placeholder="qty"  style="width: 5em;  display: inline-block;">
            <input class="form-control" type="number" name="bumperblockrate"  placeholder="price"  style="width: 6em;  display: inline-block;">
        </div>
        <div class="col-6 form-group">
            <input type="checkbox" value="steeltap" name="steeltap">SteelTapingScrew<br/> 
            <input class="form-control" type="number" name="steeltapqty"  placeholder="qty"  style="width: 5em;  display: inline-block;">
            <input class="form-control" type="number" name="steeltaprate"  placeholder="price"  style="width: 6em;  display: inline-block;">
        </div>
        <div class="col-6 form-group">
            <input type="checkbox" value="conscrew" name="conscrew">Concrete Screw<br/> 
            <input class="form-control" type="number" name="conscrewqty"  placeholder="qty"  style="width: 5em;  display: inline-block;">
            <input class="form-control" type="number" name="conscrewrate"  placeholder="price"  style="width: 6em;  display: inline-block;">
        </div>
        
        
        
</div>
</div>
<div class="modal-footer">
    <input type="button" value="{{__('Cancel')}}" class="btn  btn-light" data-bs-dismiss="modal">
    <input class="btn btn-sm btn-primary btn-icon rounded-pill" type="submit" value="Add">
</div>
{{ Form::close() }}