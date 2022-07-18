<?php

namespace App\Http\Controllers;

use App\Models\Template;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TemplateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('Templates/Index', [
            'Template' => Template::orderBy('template_title','DESC')->paginate(10)
                ->through(fn ($Template) => [
                    'id' => $Template->id,
                    'template_title' => $Template->template_title,
                ]),
        ]);
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Templates/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'template_title' => ['required']
        ]);

        $input = $request->all();
        
        $templateCreated = Template::create([
            'template_title'        => $input['template_title'],
            'template_text'        => $input['template_text'],
        ]);


        return Redirect::route('template')->with('success', 'Template created!.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $Template = Template::where('id', $id)->first();
        return Inertia::render('Templates/Edit', [
            'Template' => [
                'id' => $Template->id,
                'template_title' => $Template->template_title,
                'template_text' => $Template->template_text,
            ],
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'template_title' => ['required'],
        ]);

        $input = $request->all();
        $templates = Template::where('id', $id)->first();
        $templates->template_title = $input['template_title'];
        $templates->template_text = $input['template_text']; 
        $templates->save();

        return Redirect::route('template')->with('success', 'Template updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Template $template)
    {
        $template->delete();
        return Redirect::route('template')->with('success', 'Template Deleted.');        
        
    }
}
