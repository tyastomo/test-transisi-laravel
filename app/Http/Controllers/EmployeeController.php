<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;

use App\Employees;
use App\Companies;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$companyList = Companies::all();
		$getEmployees = Employees::with('companies')->latest()->paginate(5);

		//return $getEmployees;
		return view('employee', ['getEmployees' => $getEmployees,
								'companyList' => $companyList]);
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
			'company_id' => 'required'
        ]);

        if ($validator->fails()) {
            redirect()
                ->back()
                ->withErrors($validator->errors());
		}

		$submit = new Employees;
		$submit -> create([
			'name' => $request['nama'],
			'company_id' => $request['company'],
			'email' => $request['email']
		]);

		flash('Success add your data')->success();
		return redirect('/employees');
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
			'company_id' => 'required'
        ]);

        if ($validator->fails()) {
            redirect()
                ->back()
                ->withErrors($validator->errors());
		}

        $update_data = Employees::find($id);
		$update_data -> update ([
			'name' => $request['nama'],
			'email' => $request['email'],
			'company_id' => $request['company'],
		]);
		return redirect('/employees');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $hapus = Employees::where('id', $id)->delete();
		return redirect()->back();
	}

}
