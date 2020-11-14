<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;

use App\Companies;
use Illuminate\Support\Facades\Storage;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$getCompanies = Companies::latest()->paginate(5);
		return view('home', ['getCompanies' => $getCompanies]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
		$validator = Validator::make(request()->all(), [
            'nama' => 'required|max:25',
			'email' => 'required|unique:users|max:255',
			'logo' => 'required|image|size:2048|mimes:png|dimensions:min_width=100,min_height=100',
			'website' => 'required|max:25'
        ]);

        if ($validator->fails()) {
            redirect()
                ->back()
                ->withErrors($validator->errors());
        }
		$submit = new Companies;
		$namefile = '';
		$file = $request->file('logo');
		$namefile = $file->getClientOriginalName();
		$move = $file->move(storage_path('app/public/companies'), $namefile);

		$submit -> create([
			'name' => $request['nama'],
			'email' => $request['email'],
			'website' => $request['website'],
			'logo' => $namefile
		]);
		return redirect('/home');
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
        //
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
		$validator = Validator::make(request()->all(), [
            'nama' => 'required|max:25',
			'email' => 'required|unique:users|max:255',
			'logo' => 'required|image|size:2048|mimes:png|dimensions:min_width=100,min_height=100',
			'website' => 'required|max:25'
        ]);

        if ($validator->fails()) {
            redirect()
                ->back()
                ->withErrors($validator->errors());
		}

		$namefile = '';
		$file = $request->file('logo');
		$namefile = $file->getClientOriginalName();
		$move = $file->move(storage_path('app/public/companies'), $namefile);

		$update_data = Companies::find($id);
		$update_data -> update ([
			'name' => $request['nama'],
			'email' => $request['email'],
			'website' => $request['website'],
			'logo' => $namefile
		]);
		return redirect('/home');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
		$hapus = Companies::where('id', $id)->delete();
		return redirect()->back();
    }
}
