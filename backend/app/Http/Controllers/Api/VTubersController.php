<?php


namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Http\Resources\VTuberResource;
use App\VTuber;

class VTubersController extends Controller
{
    public function index()
    {
        return VTuberResource::collection(VTuber::all());
    }
}
