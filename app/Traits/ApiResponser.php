<?php


namespace ApiResponser;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

trait ApiResponser
{
    private function succesResponse($data,$code){
        return response()->json($data,$code);
    }
    protected  function  errorResponse($message,$code){
        return response()->json(['error'=>$message ,'code'=>$code],$code);
    }

    protected function  showAll(Collection $collection, $code = 200){
        return $this->succesResponse(['data'=>$collection],$code);
    }
    protected function  showOne(Model $model, $code = 200){
        return $this->succesResponse(['data'=>$model],$code);
    }
}
