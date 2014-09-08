<?php

class ComunasController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /comunas
	 *
	 * @return Response
	 */
	public function index()
	{
		//checkAuthToken
		try {
			$this->checkAuthToken(Input::get('access_token'));
			
			$comunas = Comuna::all();
		 	return $this->reponseApi(200, '', '', $comunas); 
		} catch (Exception $e) {
			return $this->reponseApi(200, 'true', $e->getMessage(), array('code' => 101));
		}
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /comunas/create
	 *
	 * @return Response
	 */
	public function create()
	{
		return $this->reponseApi(400);
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /comunas
	 *
	 * @return Response
	 */
	public function store()
	{
		return $this->reponseApi(400);
	}

	/**
	 * Display the specified resource.
	 * GET /comunas/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//checkAuthToken
		try {
			$this->checkAuthToken(Input::get('access_token'));
			
			$comunas = Comuna::findOrFail($id);
		 	return $this->reponseApi(200, '', '', $comunas); 
		} catch (Exception $e) {
			return $this->reponseApi(200, 'true', $e->getMessage(), array('code' => 101));
		}
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /comunas/{id}/edit
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
	 * PUT /comunas/{id}
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
	 * DELETE /comunas/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		return $this->reponseApi(400);
	}

	public function regiones($id)
	{
		//checkAuthToken
		try {
			$this->checkAuthToken(Input::get('access_token'));
			
			$comuna = new Comuna;
		 	return $this->reponseApi(200, '', '', $comuna->byRegion($id)); 
		} catch (Exception $e) {
			return $this->reponseApi(200, 'true', $e->getMessage(), array('code' => 101));
		}
	}

}