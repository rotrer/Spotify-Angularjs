<?php

class UsuariosController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /usuarios
	 *
	 * @return Response
	 */
	public function index()
	{
		return $this->reponseApi(200, '', '', array("info" => "Lista de usuarios"));
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /usuarios/create
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /usuarios
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make(Input::all(), [
			'fbuid' => 'required',
			'firstname' => 'required|min:3',
			'lastname' => 'required|min:3',
			'email' => 'required|email',
			'access_token' => 'required'
		]);

		if ($validator->fails())
		{
			return $this->reponseApi(422, 'true', $validator->errors()->all());
		}

		return $this->reponseApi(200, 'false', "OK Data");
	}

	/**
	 * Display the specified resource.
	 * GET /usuarios/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /usuarios/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /usuarios/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /usuarios/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}