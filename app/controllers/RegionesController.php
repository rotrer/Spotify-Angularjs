<?php

class RegionesController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /regiones
	 *
	 * @return Response
	 */
	public function index()
	{
		//checkAuthToken
		try {
			$this->checkAuthToken(Input::get('access_token'));
			
			$regiones = Regione::all();
		 	return $this->reponseApi(200, '', '', $regiones); 
		} catch (Exception $e) {
			return $this->reponseApi(200, 'true', $e->getMessage(), array('code' => 101));
		}
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /regiones/create
	 *
	 * @return Response
	 */
	public function create()
	{
		return $this->reponseApi(400);
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /regiones
	 *
	 * @return Response
	 */
	public function store()
	{
		return $this->reponseApi(400);
	}

	/**
	 * Display the specified resource.
	 * GET /regiones/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//checkAuthToken
		try {
			$this->checkAuthToken(Input::get('access_token'));
			
			$regiones = Regione::findOrFail($id);
		 	return $this->reponseApi(200, '', '', $regiones); 
		} catch (Exception $e) {
			return $this->reponseApi(200, 'true', $e->getMessage(), array('code' => 101));
		}
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /regiones/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		return $this->reponseApi(400);
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /regiones/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		return $this->reponseApi(400);
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /regiones/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		return $this->reponseApi(400);
	}

}