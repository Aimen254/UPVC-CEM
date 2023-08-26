<?php

namespace App\Http\Controllers;

use App\Models\ImageFormula;
use App\Models\Image;
use App\Models\Formula;
use App\Models\User;
use Illuminate\Http\Request;

class ImageFormulaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $images = Image::all();
        $formulas = Formula::all();

        return view('assignformulas.allimages' ,compact('images','formulas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Image $image)
    {
        
        $formulas = Formula::get()->pluck('type', 'id');
      
        if(\Auth::user()->can('create lead'))
        {
            $users = User::where('created_by', '=', \Auth::user()->creatorId())->where('type', '!=', 'client')->where('type', '!=', 'company')->where('id', '!=', \Auth::user()->id)->get()->pluck('name', 'id');
            $users->prepend(__('Select User'), '');

            return view('assignformulas.create', compact('users', 'image','formulas'));
        }
        else
        {
            return response()->json(['error' => __('Permission Denied.')], 401);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
           try {
            $imageid = $request->id;
            // $formulaid = $request->cat;
            $formula = $request->get('formulas');
    
            $bins = Formula::whereIn('id', $formula)->get();
           
          
            foreach( $bins as $bin)
                    {
                        // imageformula::create(
                        //     [
                        //         'image_id' => $imageid,
                        //         'formula_id' => $bin->id,
                        //     ])->save();
                        $dataanswer[] = [                
                            'image_id'   => $imageid,
                            'formula_id'        => $bin->id,
                            'formula_type'       => $bin->type,
                            'date'               => date('Y-m-d H:i:s')
                        ]; 
                     
                    }
                    $imageformul = new ImageFormula(); 
                    // $imageformul->date = date('Y-m-d H:i:s');
                    $insert = $imageformul->insert($dataanswer);
                    if ($insert){
                       return redirect()->back()->with('success', __('Formula Assign successfully created!'));
                        
                    }
        
                    // Test
                } catch (\Exception $e) {
                    return $e->getMessage();
                }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ImageFormula  $imageFormula
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
         $imgs = ImageFormula::where('image_id' , $id)->get();
        return view('assignformulas.show', compact('imgs'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ImageFormula  $imageFormula
     * @return \Illuminate\Http\Response
     */
    public function edit(ImageFormula $imageFormula)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ImageFormula  $imageFormula
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ImageFormula $imageFormula)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ImageFormula  $imageFormula
     * @return \Illuminate\Http\Response
     */
    public function destroy(ImageFormula $imageFormula)
    {
        //
    }
}
