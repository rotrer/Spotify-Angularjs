<?php

class BaseController extends Controller {

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
	}

	public function reponseApi($code = 400, $error = '', $msg = '', $data = array())
	{
		/*
		* Codes HTTP Response
		* 
		*	200	OK
		*	201	Creado
		*	304	No modificado
		*	400	Petición incorrecta
		*	401	No autorizado
		*	403	Prohibido
		*	404	No encontrado
		*	422	Entidad imposible de procesar
		*	500	Error interno del servidor
	 	*/
	 	// Validación parametros
	 	$response['status'] = $code;
	 	
	 	if (!empty($error))
	 		$response['error'] = $error;

	 	if (!empty($msg))
	 		$response['msg'] = $msg;

	 	if (!empty($data))
	 		$response['data'] = $data;

	 	return Response::json($response, $code);
	}

}
