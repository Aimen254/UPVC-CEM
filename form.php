<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <style>
    label:before {
  content: url("https://cdn1.iconfinder.com/data/icons/windows8_icons_iconpharm/26/unchecked_checkbox.png");
  position: absolute;
  z-index: 100;
}
:checked+label:before {
  content: url("https://cdn1.iconfinder.com/data/icons/windows8_icons_iconpharm/26/checked_checkbox.png");
}
input[type=checkbox] {
  display: none;
}
/*pure cosmetics:*/
img {
  width: 150px;
  height: 150px;
}
label {
  margin: 10px;
}
.container{
    height:100%;
    width:100%;
}
.frm{
    display: inline-block;
}

    </style>
</head>
<body>
<div class="container">
    <div class="row" >
      <!-- Trigger the modal with a button -->
        <div class = "col-md-3">
            <h2>Outer frame 80MM 88MM 98MM</h2>
            <button type="button" id="btn1" class="btn  btn-lg " data-toggle="modal" data-id="picone"><img src="images/formula1.png" height ="80" width="100" /></button>  
        </div>
        <div class= col-md-3 style="margin-top:70px;">
            <p><h4>Formula 1:</h4> Width = W + 6 <br> Height = H + 6
            </p>
        </div>
        <div class="col-md-6" >
             <h2>Enter your values</h2>
                <div class="row" >
                    <div class="col-sm-3" form-group>
                        <label for="">Width</label>
                        <input class="form-control " type="number" name="width" id="wid" >
                    </div>
                    <div class="col-sm-3  form-group">
                        <label for="">Height</label>
                        <input class="form-control " type="number" name="hit" id="hit" >
                    </div>
                    <div class="col-sm-3  form-group">
                     <button type="submit" class="btn btn-info  btn-block" onClick="get()" id="picone" name="submit"  style="margin-top:30px;">save</button>
                     <!-- <a href="#" class="btn btn-info  btn-block" id="link_a" style="margin-top:30px;">Home link</a>              -->
                    </div>
                </div> 
                <div id="b" style="display:none">
                <p class="frm">Width : 
                <span id = "widthres"></span>
                </p>&nbsp;
                <p class="frm">Height : 
                    <span id = "heightres"></span>
                </p>
                </div>
        </div>
    </div>

    <div class="row" >
      <!-- Trigger the modal with a button -->
        <div class = "col-md-2">
            <h2>Sliding SAsh</h2>
            <button type="button" id="btn2" class="btn  btn-lg " data-toggle="modal" data-id="pictwo"><img src="images/Fromula2.png" height ="80" width="100" /></button>  
        </div>
        <div class= col-md-4 style="margin-top:70px;">
            <p> <h4 class="frm">Formula 1: </h4>Width = W + 6 , Height = H + 6 <br>
                <h4 class="frm">sliding sash 55:</h4><span class="frm">Width= W/2+2 , Height= H-78</span>
                <h4 class="frm">sliding sash 66:</h4>Width= W/2+5 , Height= H-80
                <h4 class="frm">sliding sash 73:</h4>Width= W/2+5 , Height= H-80
            </p>
        </div>
        <div class="col-md-6" >
             <h2>Enter your values</h2>
                <div class="row" >
                    <div class="col-sm-3" form-group>
                        <label for="">Width</label>
                        <input class="form-control " type="number" name="width2" id="wid2" >
                    </div>
                    <div class="col-sm-3  form-group">
                        <label for="">Height</label>
                        <input class="form-control " type="number" name="hit2" id="hit2" >
                    </div>
                    <div class="col-sm-3  form-group">
                      <label for="cars">Choose a size:</label>

                        <select id="sizes" name="size">
                        <option value="55">55</option>
                        <option value="66">66</option>
                        <option value="73">73</option>
                        </select>
                    </div>
                    <div class="col-sm-3  form-group">
                     <button type="submit" class="btn btn-info  btn-block" onClick="get2()" id="pictwo" name="submit"  style="margin-top:30px;">save</button>
                    
                    </div>
                </div> 
                <div id="Div2" style="display:none">
                <h4>Formula1</h4>
                <p class="frm">Width : 
                <span id = "form2widthres2"></span>
                </p>&nbsp;
                <p class="frm">Height : 
                    <span id = "form2heightres2"></span>
                </p>
                <h4>Sliding Sash</h4>
                <p class="frm">Width : 
                <span id = "widthres2"></span>
                </p>&nbsp;
                <p class="frm">Height : 
                    <span id = "heightres2"></span>
                </p>&nbsp;
                <p class="frm">Size : 
                    <span id = "size"></span>
                </p>
                </div>
        </div>
    </div>

    <div class="row" >
      <!-- Trigger the modal with a button -->
        <div class = "col-md-2">
            <h2>Sliding SAsh Fix</h2>
            <button type="button" id="btn2" class="btn  btn-lg " data-toggle="modal" data-id="picthree"><img src="images/formula3.png" height ="80" width="100" /></button>  
        </div>
        <div class= col-md-4 style="margin-top:70px;">
            <p> <h4 class="frm">Formula 1: </h4>Width = W + 6 , Height = H + 6 <br>
                <h4 class="frm">sliding sash55:</h4><span class="frm">Width= W/2+2 , Height= H-78 &nbsp; Fix W/2+39 , H-78</span>
                <h4 class="frm">sliding sash66:</h4><span class="frm">Width= W/2+5 , Height= H-80 &nbsp; Fix W/2+40 , H-70</span>
                <h4 class="frm">sliding sash73:</h4><span class="frm">Width= W/2+5 , Height= H-80 &nbsp; Fix W/2+40 , H-70</span>
            </p>
        </div>
        <div class="col-md-6" >
             <h2>Enter your values</h2>
                <div class="row" >
                    <div class="col-sm-3" form-group>
                        <label for="">Width</label>
                        <input class="form-control " type="number" name="width3" id="wid3" >
                    </div>
                    <div class="col-sm-3  form-group">
                        <label for="">Height</label>
                        <input class="form-control " type="number" name="hit3" id="hit3" >
                    </div>
                    <div class="col-sm-3  form-group">
                      <label for="cars">Choose a size:</label>

                        <select id="sizes3" name="size">
                        <option value="55">55</option>
                        <option value="66">66</option>
                        <option value="73">73</option>
                        </select>
                    </div>
                    <div class="col-sm-3  form-group">
                     <button type="submit" class="btn btn-info  btn-block" onClick="get3()" id="picthree" name="submit"  style="margin-top:30px;">save</button>
                    
                    </div>
                </div> 
                <div id="Div3" style="display:none">
                <h4>Formula1</h4>
                <p class="frm">Width : 
                <span id = "form3widthres3"></span>
                </p>&nbsp;
                <p class="frm">Height : 
                    <span id = "form3heightres3"></span>
                </p>
                <h4>Sliding Sash Fix</h4>
                <p class="frm">Width : 
                <span id = "widthres3"></span>
                </p>&nbsp;
                <p class="frm">Height : 
                    <span id = "heightres3"></span>
                </p>&nbsp;
                <p class="frm">Size : 
                    <span id = "size3"></span>
                </p>&nbsp;
                <h4 class="frm">With Fixed</h4>
                <p class="frm">Width : 
                <span id = "fixwidthres3"></span>
                </p>&nbsp;
                <p class="frm">Height : 
                    <span id = "fixheightres3"></span>
                </p>&nbsp;
                </div>
        </div>
    </div>

    <div class="row" >
      <!-- Trigger the modal with a button -->
        <div class = "col-md-2">
            <h2>Sliding SAsh</h2>
            <button type="button" id="btn2" class="btn  btn-lg " data-toggle="modal" data-id="picfour"><img src="images/formula4.png" height ="80" width="100" /></button>  
        </div>
        <div class= col-md-4 style="margin-top:70px;">
            <p> <h4 class="frm">Formula 1: </h4>Width = W + 6 , Height = H + 6 <br>
                <h4 class="frm">sliding sash 55 , 66, 73:</h4><span class="frm">Width= W + 85/4 </span>
            </p>
        </div>
        <div class="col-md-6" >
             <h2>Enter your values</h2>
                <div class="row" >
                    <div class="col-sm-3" form-group>
                        <label for="">Width</label>
                        <input class="form-control " type="number" name="width4" id="wid4" >
                    </div>
                    <div class="col-sm-3  form-group">
                        <label for="">Height</label>
                        <input class="form-control " type="number" name="hit4" id="hit4" >
                    </div>
                    <div class="col-sm-3  form-group">
                      <label for="cars">Choose a size:</label>

                        <select id="sizes4" name="size">
                        <option value="55">55</option>
                        <option value="66">66</option>
                        <option value="73">73</option>
                        </select>
                    </div>
                    <div class="col-sm-3  form-group">
                     <button type="submit" class="btn btn-info  btn-block" onClick="get4()" id="picfour" name="submit"  style="margin-top:30px;">save</button>
                    
                    </div>
                </div> 
                <div id="Div4" style="display:none">
                <h4>Formula1</h4>
                <p class="frm">Width : 
                <span id = "form4widthres4"></span>
                </p>&nbsp;
                <p class="frm">Height : 
                    <span id = "form4heightres4"></span>
                </p>
                <h4>Slidinf Sash</h4>
                <p class="frm">Width : 
                <span id = "widthres4"></span>
                </p>&nbsp;
                <p class="frm">Size : 
                    <span id = "size4"></span>
                </p>
                </div>
        </div>
    </div>

    <div class="row" >
      <!-- Trigger the modal with a button -->
        <div class = "col-md-2">
            <h2>Latch Lock</h2>
            <button type="button" id="btn2" class="btn  btn-lg " data-toggle="modal" data-id="picfive"><img src="images/formula5.png" height ="80" width="100" /></button>  
        </div>
        <div class= col-md-4 style="margin-top:70px;">
            <p> <h4 class="frm">Formula 1: </h4>Width = W + 6 , Height = H + 6 <br>
                <h4 class="frm">sliding sash 55:</h4><span class="frm">Width= W/4 , Height= H-78</span>
                <h4 class="frm">sliding sash 66:</h4><span class="frm">Width= W/4 , Height= H-70</span>
                <h4 class="frm">sliding sash 73:</h4><span class="frm">Width= W/4 , Height= H-80</span>
            </p>
        </div>
        <div class="col-md-6" >
             <h2>Enter your values</h2>
                <div class="row" >
                    <div class="col-sm-3" form-group>
                        <label for="">Width</label>
                        <input class="form-control " type="number" name="width5" id="wid5" >
                    </div>
                    <div class="col-sm-3  form-group">
                        <label for="">Height</label>
                        <input class="form-control " type="number" name="hit5" id="hit5" >
                    </div>
                    <div class="col-sm-3  form-group">
                      <label for="cars">Choose a size:</label>

                        <select id="sizes5" name="size">
                        <option value="55">55</option>
                        <option value="66">66</option>
                        <option value="73">73</option>
                        </select>
                    </div>
                    <div class="col-sm-3  form-group">
                     <button type="submit" class="btn btn-info  btn-block" onClick="get5()" id="picfive" name="submit"  style="margin-top:30px;">save</button>
                    
                    </div>
                </div> 
                <div id="Div5" style="display:none">
                <h4>Formula1</h4>
                <p class="frm">Width : 
                <span id = "form5widthres5"></span>
                </p>&nbsp;
                <p class="frm">Height : 
                    <span id = "form5heightres5"></span>
                </p>
                <h4>Sliding Sash</h4>
                <p class="frm">Width : 
                <span id = "widthres5"></span>
                </p>&nbsp;
                <p class="frm">Height : 
                    <span id = "heightres5"></span>
                </p>&nbsp;
                <p class="frm">Size : 
                    <span id = "size5"></span>
                </p>
                </div>
        </div>
    </div>

    <div class="row" >
      <!-- Trigger the modal with a button -->
        <div class = "col-md-2">
            <h2>Formula 6</h2>
            <button type="button" id="btn2" class="btn  btn-lg " data-toggle="modal" data-id="picsix"><img src="images/formula6.png" height ="80" width="100" /></button>  
        </div>
        <div class= col-md-4 style="margin-top:70px;">
            <p> <h4 class="frm">Formula 1: </h4>Width = W + 6 , Height = H + 6 <br>
                <h4 class="frm">60MM :</h4><span class="frm">Width= W - 56 , Height= H-56</span><br>
                <h4 class="frm">70MM :</h4><span class="frm">Width= W - 70 Height= H-70</span>
            </p>
        </div>
        <div class="col-md-6" >
             <h2>Enter your values</h2>
                <div class="row" >
                    <div class="col-sm-3" form-group>
                        <label for="">Width</label>
                        <input class="form-control " type="number" name="width6" id="wid6" >
                    </div>
                    <div class="col-sm-3  form-group">
                        <label for="">Height</label>
                        <input class="form-control " type="number" name="hit6" id="hit6" >
                    </div>
                    <div class="col-sm-3  form-group">
                      <label for="cars">Choose a size:</label>

                        <select id="sizes6" name="size">
                        <option value="60MM">60MM</option>
                        <option value="70MM">70MM</option>
                   
                        </select>
                    </div>
                    <div class="col-sm-3  form-group">
                     <button type="submit" class="btn btn-info  btn-block" onClick="get6()" id="picsix" name="submit"  style="margin-top:30px;">save</button>
                    
                    </div>
                </div> 
                <div id="Div6" style="display:none">
                <h4>Formula1</h4>
                <p class="frm">Width : 
                <span id = "form6widthres6"></span>
                </p>&nbsp;
                <p class="frm">Height : 
                    <span id = "form6heightres6"></span>
                </p>
                <h4>Formula 6</h4>
                <p class="frm">Width : 
                <span id = "widthres6"></span>
                </p>&nbsp;
                <p class="frm">Height : 
                    <span id = "heightres6"></span>
                </p>&nbsp;
                <p class="frm">Size : 
                    <span id = "size6"></span>
                </p>
                </div>
        </div>
    </div>

    <div class="row" >
      <!-- Trigger the modal with a button -->
        <div class = "col-md-2">
            <h2>Mullion</h2>
            <button type="button" id="btn2" class="btn  btn-lg " data-toggle="modal" data-id="picseven"><img src="images/formula7.png" height ="80" width="100" /></button>  
        </div>
        <div class= col-md-4 style="margin-top:70px;">
            <p> <h4 class="frm">Formula 1: </h4>Width = W + 6 , Height = H + 6 <br>
                <h4 class="frm">Mullion 60MM :</h4><span class="frm">Width= W - 80 </span><br>
                <h4 class="frm">Mullion 70MM :</h4><span class="frm">Width= W - 80</span>
            </p>
        </div>
        <div class="col-md-6" >
             <h2>Enter your values</h2>
                <div class="row" >
                    <div class="col-sm-3" form-group>
                        <label for="">Width</label>
                        <input class="form-control " type="number" name="width7" id="wid7" >
                    </div>
                    <div class="col-sm-3  form-group">
                        <label for="">Height</label>
                        <input class="form-control " type="number" name="hit7" id="hit7" >
                    </div>
                    <div class="col-sm-3  form-group">
                      <label for="cars">Choose a size:</label>

                        <select id="sizes7" name="size">
                        <option value="60MM">Mullion 60MM</option>
                        <option value="70MM">Mullion 70MM</option>
                   
                        </select>
                    </div>
                    <div class="col-sm-3  form-group">
                     <button type="submit" class="btn btn-info  btn-block" onClick="get7()" id="picseven" name="submit"  style="margin-top:30px;">save</button>
                    
                    </div>
                </div> 
                <div id="Div7" style="display:none">
                <h4>Formula1</h4>
                <p class="frm">Width : 
                <span id = "form7widthres7"></span>
                </p>&nbsp;
                <p class="frm">Height : 
                    <span id = "form7heightres7"></span>
                </p>
                <h4>Mullion Formula</h4>
                <p class="frm">Width : 
                <span id = "widthres7"></span>
                </p>&nbsp;
                <p class="frm">Size : 
                    <span id = "size7"></span>
                </p>
                </div>
        </div>
    </div>
  
    <div class="row" >
      <!-- Trigger the modal with a button -->
        <div class = "col-md-2">
            <h2>Openable Door SAsh</h2>
            <button type="button" id="btn2" class="btn  btn-lg " data-toggle="modal" data-id="piceight"><img src="images/formula8.png" height ="80" width="100" /></button>  
        </div>
        <div class= col-md-4 style="margin-top:70px;">
            <p> <h4 class="frm">60MM Frame: </h4>Width = W + 6 , Height = H + 3 <br>
                <h4 class="frm">70MM Frame: </h4>Width = W + 6 , Height = H + 3 <br>
                <h4 class="frm">Openable Door SAsh 60MM :</h4><span class="frm">Width= W - 56 , Height= H + 35 </span><br>
                <h4 class="frm">Openable Door SAsh 70MM :</h4><span class="frm">Width= W - 70 , Height= H - 40</span>
            </p>
        </div>
        <div class="col-md-6" >
             <h2>Enter your values</h2>
                <div class="row" >
                    <div class="col-sm-3" form-group>
                        <label for="">Width</label>
                        <input class="form-control " type="number" name="width7" id="wid8" >
                    </div>
                    <div class="col-sm-3  form-group">
                        <label for="">Height</label>
                        <input class="form-control " type="number" name="hit7" id="hit8" >
                    </div>
                    <div class="col-sm-3  form-group">
                      <label for="cars">Choose a size:</label>

                        <select id="sizes8" name="size">
                        <option value="60MM Frame">60MM Frame</option>
                        <option value="70MM Frame">70MM Frame</option>
                   
                        </select>
                    </div>
                    <div class="col-sm-3  form-group">
                     <button type="submit" class="btn btn-info  btn-block" onClick="get8()" id="piceight" name="submit"  style="margin-top:30px;">save</button>
                    
                    </div>
                </div> 
                <div id="Div8" style="display:none">
                <h4 id="framesize"></h4>
                <p class="frm">Width : 
                <span id = "form8widthres8"></span>
                </p>&nbsp;
                <p class="frm">Height : 
                    <span id = "form8heightres8"></span>
                </p>
                <h4 id="sizeres">Mullion Formula</h4>
                <p class="frm">Width : 
                <span id = "widthres8"></span>
                </p>&nbsp;
                <p class="frm">Height : 
                <span id = "heightres8"></span>
                </p>&nbsp;
                <p class="frm">Size : 
                    <span id = "size8"></span>
                </p>
                </div>
        </div>
    </div>

    <div class="row" >
      <!-- Trigger the modal with a button -->
        <div class = "col-md-2">
            <h2>Openable Door SAsh 2</h2>
            <button type="button" id="btn2" class="btn  btn-lg " data-toggle="modal" data-id="picnine"><img src="images/formula9.png" height ="80" width="100" /></button>  
        </div>
        <div class= col-md-4 style="margin-top:70px;">
            <p> <h4 class="frm">60MM Frame: </h4>Width = W + 6 , Height = H + 6 <br>
                <h4 class="frm">70MM Frame: </h4>Width = W + 6 , Height = H + 6 <br>
                <h4 class="frm">Openable Door SAsh 60MM :</h4><span class="frm">Width= W - 80/2 , Height= H - 56 </span><br>
                <h4 class="frm">Openable Door SAsh 70MM :</h4><span class="frm">Width= W - 100/2 , Height= H - 70</span>
            </p>
        </div>
        <div class="col-md-6" >
             <h2>Enter your values</h2>
                <div class="row" >
                    <div class="col-sm-3" form-group>
                        <label for="">Width</label>
                        <input class="form-control " type="number" name="width7" id="wid9" >
                    </div>
                    <div class="col-sm-3  form-group">
                        <label for="">Height</label>
                        <input class="form-control " type="number" name="hit7" id="hit9" >
                    </div>
                    <div class="col-sm-3  form-group">
                      <label for="cars">Choose a size:</label>

                        <select id="sizes9" name="size">
                        <option value="60MM Frame">60MM Frame</option>
                        <option value="70MM Frame">70MM Frame</option>
                   
                        </select>
                    </div>
                    <div class="col-sm-3  form-group">
                     <button type="submit" class="btn btn-info  btn-block" onClick="get9()" id="picnine" name="submit"  style="margin-top:30px;">save</button>
                    
                    </div>
                </div> 
                <div id="Div9" style="display:none">
                <h4 id="framesize2"></h4>
                <p class="frm">Width : 
                <span id = "form9widthres9"></span>
                </p>&nbsp;
                <p class="frm">Height : 
                    <span id = "form9heightres9">
                </p>
                <h4 id="sizeres2">Mullion Formula</h4>
                <p class="frm">Width : 
                <span id = "widthres9"></span>
                </p>&nbsp;
                <p class="frm">Height : 
                <span id = "heightres9"></span>
                </p>&nbsp;
                <p class="frm">Size : 
                    <span id = "size9"></span>
                </p>
                </div>
        </div>
    </div>

</div>


<script>

function get()
{
       
        num1 = document.getElementById("wid").value;
        num2 = document.getElementById("hit").value;
        width =num1 * 304.8;
        height =num2 * 304.8;
        document.getElementById("widthres").innerHTML = Math.round(Number(width) + Number(6)) + "MM";
        document.getElementById("heightres").innerHTML =Math.round( Number(height) + Number(6)) + "MM";
        $("#b").show();
        
}

function get2(){
        num1 = document.getElementById("wid2").value;
        num2 = document.getElementById("hit2").value;
        width = num1 * 304.8;
        height = num2 * 304.8;
        var e = document.getElementById("sizes");
        var value = e.value;
        if( value == 55){
          document.getElementById("form2widthres2").innerHTML = Math.round(Number(width) + Number(6)) + "MM";
          document.getElementById("form2heightres2").innerHTML = Math.round(Number(height) + Number(6)) + "MM";
          document.getElementById("widthres2").innerHTML = Math.round(width / 2 + Number(2)) + "MM";
          document.getElementById("heightres2").innerHTML =Math.round( Number(height) - Number(78)) + "MM";
          document.getElementById("size").innerHTML = value;
          $("#Div2").show();
        }
        else if(value == 66){
            document.getElementById("form2widthres2").innerHTML = Math.round(Number(width) + Number(6)) + "MM";
          document.getElementById("form2heightres2").innerHTML = Math.round(Number(height) + Number(6)) + "MM";
          document.getElementById("widthres2").innerHTML =  Math.round(width / 2 + Number(5)) + "MM";
          document.getElementById("heightres2").innerHTML =  Math.round(Number(height) - Number(80)) + "MM";
          document.getElementById("size").innerHTML = value;
          $("#Div2").show();
        }
       else{
        document.getElementById("form2widthres2").innerHTML = Math.round(Number(width) + Number(6)) + "MM";
          document.getElementById("form2heightres2").innerHTML = Math.round(Number(height) + Number(6)) + "MM";
        document.getElementById("widthres2").innerHTML =  Math.round(width / 2 + Number(5)) + "MM";
          document.getElementById("heightres2").innerHTML =  Math.round(Number(height) - Number(80)) + "MM";
          document.getElementById("size").innerHTML = value;
          $("#Div2").show();
       }
}

function get3(){
        num1 = document.getElementById("wid3").value;
        num2 = document.getElementById("hit3").value;
        width = num1 * 304.8;
        height = num2 * 304.8;
        var e = document.getElementById("sizes3");
        var value = e.value;
        if( value == 55){
          document.getElementById("form3widthres3").innerHTML = Math.round(Number(width) + Number(6)) + "MM";
          document.getElementById("form3heightres3").innerHTML =Math.round( Number(height) + Number(6)) + "MM";
          document.getElementById("widthres3").innerHTML = Math.round(width / 4 + Number(20)) + "MM";
          document.getElementById("heightres3").innerHTML = Math.round(Number(height) - Number(78)) + "MM";
          document.getElementById("fixwidthres3").innerHTML = Math.round(width / 2 + Number(38)) + "MM";
          document.getElementById("fixheightres3").innerHTML = Math.round(Number(height) - Number(78)) + "MM";
          document.getElementById("size3").innerHTML = value;
          $("#Div3").show();
        }
        else if(value == 66){
            document.getElementById("form3widthres3").innerHTML = Math.round(Number(width) + Number(6)) + "MM";
          document.getElementById("form3heightres3").innerHTML =Math.round( Number(height) + Number(6)) + "MM";
          document.getElementById("widthres3").innerHTML = width / 4 + Number(20);
          document.getElementById("heightres3").innerHTML = Number(height) - Number(78);
          document.getElementById("fixwidthres3").innerHTML = width / 2 + Number(40);
          document.getElementById("fixheightres3").innerHTML = Number(height) - Number(70);
          document.getElementById("size3").innerHTML = value;
          $("#Div3").show();
        }
       else{
        document.getElementById("form3widthres3").innerHTML = Math.round(Number(width) + Number(6)) + "MM";
          document.getElementById("form3heightres3").innerHTML =Math.round( Number(height) + Number(6)) + "MM";
        document.getElementById("widthres3").innerHTML = Math.round(width / 4 + Number(20)) + "MM";;
          document.getElementById("heightres3").innerHTML = Math.round(Number(height) - Number(70)) + "MM";;
          document.getElementById("fixwidthres3").innerHTML =Math.round( width / 2 + Number(40)) + "MM";;
          document.getElementById("fixheightres3").innerHTML = Math.round(Number(height) - Number(70)) + "MM";;
          document.getElementById("size3").innerHTML = value;
          $("#Div3").show();
       }
}

function get4(){
        num1 = document.getElementById("wid4").value;
        num2 = document.getElementById("hit4").value;
        width = num1 * 304.8;
        height = num2 * 304.8;
        var e = document.getElementById("sizes4");
        var value = e.value;
        if( value == 55){
          document.getElementById("form4widthres4").innerHTML = Math.round(Number(width) + Number(6)) + "MM";
          document.getElementById("form4heightres4").innerHTML =Math.round( Number(height) + Number(6)) + "MM";
          document.getElementById("widthres4").innerHTML = Math.round(width + Number(85) / 4) + "MM";
          document.getElementById("size4").innerHTML = value;
          $("#Div4").show();
        }
        else if(value == 66){
            document.getElementById("form4widthres4").innerHTML = Math.round(Number(width) + Number(6)) + "MM";
          document.getElementById("form4heightres4").innerHTML = Math.round(Number(height) + Number(6)) + "MM";
            document.getElementById("widthres4").innerHTML = Math.round(width + Number(85) / 4) + "MM";
          document.getElementById("size4").innerHTML = value;
          $("#Div4").show();
        }
       else{
        document.getElementById("form4widthres4").innerHTML = Math.round(Number(width) + Number(6)) + "MM";
          document.getElementById("form4heightres4").innerHTML = Math.round(Number(height) + Number(6)) + "MM";
         document.getElementById("widthres4").innerHTML = Math.round(width + Number(85) / 4) + "MM";
          
          document.getElementById("size4").innerHTML = value;
          $("#Div4").show();
       }
}


function get5(){
        num1 = document.getElementById("wid5").value;
        num2 = document.getElementById("hit5").value;
        width = num1 * 304.8;
        height = num2 * 304.8;
        var e = document.getElementById("sizes5");
        var value = e.value;
        if( value == 55){
          document.getElementById("form5widthres5").innerHTML =Math.round( Number(width) + Number(6)) + "MM";
          document.getElementById("form5heightres5").innerHTML = Math.round(Number(height) + Number(6)) + "MM";
          document.getElementById("widthres5").innerHTML = Math.round(width / 4) + "MM";
          document.getElementById("heightres5").innerHTML = Math.round(Number(height) - Number(78)) + "MM";
          document.getElementById("size5").innerHTML = value;
          $("#Div5").show();
        }
        else if(value == 66){
            document.getElementById("form5widthres5").innerHTML =Math.round( Number(width) + Number(6)) + "MM";
          document.getElementById("form5heightres5").innerHTML = Math.round(Number(height) + Number(6)) + "MM";
          document.getElementById("widthres5").innerHTML =  Math.round(width / 4) + "MM";
          document.getElementById("heightres5").innerHTML = Math.round(Number(height) - Number(70)) + "MM";
          document.getElementById("size5").innerHTML = value;
          $("#Div5").show();
        }
       else{
        document.getElementById("form5widthres5").innerHTML =Math.round( Number(width) + Number(6)) + "MM";
          document.getElementById("form5heightres5").innerHTML = Math.round(Number(height) + Number(6)) + "MM";
          document.getElementById("widthres5").innerHTML = Math.round(width / 4) + "MM";
          document.getElementById("heightres5").innerHTML = Math.round(Number(height) - Number(80)) + "MM";
          document.getElementById("size5").innerHTML = value;
          $("#Div5").show();
       }
}


function get6(){
        num1 = document.getElementById("wid6").value;
        num2 = document.getElementById("hit6").value;
        width = num1 * 304.8;
        height = num2 * 304.8;
        var e = document.getElementById("sizes6");
        var value = e.value;
        if( value == "60MM"){
          document.getElementById("form6widthres6").innerHTML =Math.round( Number(width) + Number(6)) + "MM";
          document.getElementById("form6heightres6").innerHTML = Math.round(Number(height) + Number(6)) + "MM";
          document.getElementById("widthres6").innerHTML = Math.round(width - 56) + "MM";
          document.getElementById("heightres6").innerHTML = Math.round(Number(height) - Number(56)) + "MM";
          document.getElementById("size6").innerHTML = value;
          $("#Div6").show();
        }
        else {
            document.getElementById("form6widthres6").innerHTML =Math.round( Number(width) + Number(6)) + "MM";
          document.getElementById("form6heightres6").innerHTML =Math.round( Number(height) + Number(6)) + "MM";
          document.getElementById("widthres6").innerHTML =Math.round( width - 70) + "MM";
          document.getElementById("heightres6").innerHTML =Math.round( Number(height) - Number(70)) + "MM";
          document.getElementById("size6").innerHTML = value;
          $("#Div6").show();
        }
     
}

function get7(){
        num1 = document.getElementById("wid7").value;
        num2 = document.getElementById("hit7").value;
        width = num1 * 304.8;
        height = num2 * 304.8;
        var e = document.getElementById("sizes7");
        var value = e.value;
        if( value == "60MM"){
            document.getElementById("form7widthres7").innerHTML = Math.round(Number(width) + Number(6)) + "MM";
          document.getElementById("form7heightres7").innerHTML = Math.round(Number(height) + Number(6))+"MM";
          document.getElementById("widthres7").innerHTML = Math.round(width - 80) + "MM";
         
          document.getElementById("size7").innerHTML = value;
          $("#Div7").show();
        }
        else {
            document.getElementById("form7widthres7").innerHTML = Math.round(Number(width) + Number(6)) + "MM";
          document.getElementById("form7heightres7").innerHTML = Math.round(Number(height) + Number(6))+"MM";
          document.getElementById("widthres7").innerHTML = Math.round(width - 80) + "MM";
         
          document.getElementById("size7").innerHTML = value;
          $("#Div7").show();
        }
     
}


function get8(){
        num1 = document.getElementById("wid8").value;
        num2 = document.getElementById("hit8").value;
        width = num1 * 304.8;
        height = num2 * 304.8;
        var e = document.getElementById("sizes8");
        var innerdoor = "Openable Door SAsh 60MM";
        var value = e.value;
        if( value == "60MM Frame"){
            document.getElementById("form8widthres8").innerHTML = Math.round(Number(width) + Number(6)) + "MM";
          document.getElementById("form8heightres8").innerHTML =Math.round( Number(height) + Number(3)) + "MM";
          document.getElementById("widthres8").innerHTML = Math.round(width - 56) + "MM";
          document.getElementById("heightres8").innerHTML = Math.round(height - 35) + "MM";
          document.getElementById("size8").innerHTML = value;
          document.getElementById("framesize").innerHTML = value;
          document.getElementById("sizeres").innerHTML = innerdoor;
          $("#Div8").show();
        }
        else {
            var innerdoor2 = "Openable Door SAsh 70MM";
            document.getElementById("form8widthres8").innerHTML = Math.round(Number(width) + Number(6)) + "MM";
          document.getElementById("form8heightres8").innerHTML =Math.round( Number(height) + Number(3)) + "MM";
          document.getElementById("widthres8").innerHTML =Math.round( width - 70) + "MM";
          document.getElementById("heightres8").innerHTML =Math.round( height - 40) + "MM";
          document.getElementById("size8").innerHTML = value;
          document.getElementById("framesize").innerHTML = value;
          document.getElementById("sizeres").innerHTML = innerdoor2;
          $("#Div8").show();
        }
     
}

function get9(){
        num1 = document.getElementById("wid9").value;
        num2 = document.getElementById("hit9").value;
        width = num1 * 304.8;
        height = num2 * 304.8;
        var e = document.getElementById("sizes9");
     
        var innerdoor = "Openable Door SAsh 60MM";
        var value = e.value;
        if( value == "60MM Frame"){
            document.getElementById("form9widthres9").innerHTML = Math.round( Number(width) + Number(6)) +"MM";
          document.getElementById("form9heightres9").innerHTML = Math.round( Number(height) + Number(6)) +"MM";
          document.getElementById("widthres9").innerHTML = Math.round(width - 80/2) +"MM";
          document.getElementById("heightres9").innerHTML = Math.round(height - 56) +"MM";
          document.getElementById("size9").innerHTML = value;
          document.getElementById("framesize2").innerHTML = value;
      
          document.getElementById("sizeres2").innerHTML = innerdoor;
          $("#Div9").show();
        }
        else {
            var innerdoor2 = "Openable Door SAsh 70MM";
            document.getElementById("form9widthres9").innerHTML = Math.round( Number(width) + Number(6)) +"MM";
          document.getElementById("form9heightres9").innerHTML = Math.round( Number(height) + Number(6)) +"MM";
          document.getElementById("widthres9").innerHTML = Math.round(width - 100/2) +"MM";
          document.getElementById("heightres9").innerHTML = Math.round(height - 70 ) +"MM";
          document.getElementById("size9").innerHTML = value;
          document.getElementById("framesize2").innerHTML = value;
          document.getElementById("sizeres2").innerHTML = innerdoor2;
          $("#Div9").show()
        }
     
}


</script>


</body>
</html>