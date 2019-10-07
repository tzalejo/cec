<?php
namespace App\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;

trait ApiResponser{
  # para cuando fue satisfactorio
  private function successResponse($data,$code){
    return response()->json($data, $code);
  }
  # para los errores
  
  protected function errorResponse($msg, $code){
    return response()->json(['error'=> $msg, 'code'=>$code],$code);
  }
  # cuando devolvemos una colecciones de elementos json
  protected function showAll(Collection $data,$code=200 ){
    return $this->successResponse(['data'=>$data],$code);
  }
  
  protected function showOne(Model $instancia,$code=200){
    return $this->successResponse(['data'=>$instancia],$code);
  }

  private function showArray($array, $code=200){
  return $this->successResponse(['data'=>$array],$code);
  }
}


