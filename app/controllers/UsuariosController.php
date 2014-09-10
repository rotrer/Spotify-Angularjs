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
		return $this->reponseApi(400);
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
			'id' => 'required',
			'first_name' => 'required|min:3',
			'last_name' => 'required|min:3',
			'email' => 'required|email',
			'access_token' => 'required',
			'expire_token' => 'required',
			'gender' => 'required',
		]);

		if ($validator->fails())
		{
			return $this->reponseApi(200, 'true', $validator->errors()->all());
		}

		$arrUserAdd =
			array(
					"fbuid" => Input::get('id'),
					"firstname" => Input::get('first_name'),
					"lastname" => Input::get('last_name'),
					"email" => Input::get('email'),
					"genero" => Input::get('gender'),
					"ip" => Request::getClientIp(),
					"complete" => 0,
					"meta" => json_encode(array("link" => Input::get('link'), "locale" => Input::get('locale'), "name" => Input::get('name'), "timezone" => Input::get('timezone'), "updated_time" => Input::get('updated_time'), "username" => Input::get('username'))),
					"access_token" => Input::get('access_token'),
					"expire_token" => Input::get('expire_token')
			);
		$response = array();
		#Crear instancia modelo usuario
		$usuario = new Usuario;
		
		#Si registra desde otro metodo
		$exists = $usuario->existsByFuid(Input::get('id'));

		if($exists === null){
				$usuario_id = $usuario->saveUsuario( $arrUserAdd );
				if ( $usuario_id ) {
						return $this->reponseApi(201, 'false', '', array('id' => $usuario_id, 'token' => Input::get('access_token')));
				} else {
						return $this->reponseApi(200, 'true', 'Error al guardar', array('code' => 100));
				}
		}  else {
				$exists->updated_at = date('Y-m-d H:i:s');
				$exists->access_token = Input::get('access_token');
				$exists->save();
				
				return $this->reponseApi(200, 'false', '', array('id' => $exists->id, 'token' => Input::get('access_token')));
		}
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
		$validator = Validator::make(Input::all(), [
			'access_token' => 'required',
		]);

		if ($validator->fails())
		{
			return $this->reponseApi(422, 'true', $validator->errors()->all());
		}

		try {
			$this->checkAuth($id, Input::get('access_token'));
			
			$answer = Usuario::findOrFail($id);
		 	return $this->reponseApi(200, 'false', '', $answer); 
		} catch (Exception $e) {
			return $this->reponseApi(200, 'true', $e->getMessage(), array('code' => 101));
		}
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
		return $this->reponseApi(400);
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
		$validator = Validator::make(Input::all(), [
			'access_token' => 'required',
		]);

		if ($validator->fails())
		{
			return $this->reponseApi(422, 'true', $validator->errors()->all());
		}

		try {
			$this->checkAuth($id, Input::get('access_token'));
			
			Usuario::destroy($id);
		 	return $this->reponseApi(200, 'false', 'Usuario eliminado.'); 
		} catch (Exception $e) {
			return $this->reponseApi(200, 'true', $e->getMessage(), array('code' => 101));
		}
	}

	public function checkAuth($id, $token)
	{
		$answer = DB::table('usuarios')
                  ->where('id', $id)
                  ->where('access_token', $token)
                  ->get();
    if (count($answer) === 0) throw new Exception('Request inválido');

    $expired_date = strtotime($answer[0]->updated_at) + $answer[0]->expire_token;
		if (time() > $expired_date) {
			throw new Exception('Token expirado');
		}
	}
}