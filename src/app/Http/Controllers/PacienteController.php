<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\DB;

class PacienteController extends Controller
{
    public function index()
    {
        return view('paciente.index');
    }

    /**
    * @param \Illuminate\Http\Request  $request
    */
    public function listPacientes(Request $request){
        $filNome = $request->get('filNome');
        $filCpf = $request->get('filCpf');

        $data = DB::table('paciente')->selectRaw(
            'paciente.id, paciente.nome, paciente.mae, paciente.nascimento, paciente.cpf, paciente.cns'
        );

        if($filNome){
            $data->where('paciente.nome','=',$filNome);
        }
        if($filCpf){
            $data->where('paciente.cpf','=',$filCpf);
        }
        
        return Datatables::of($data)
        ->addIndexColumn()
        ->addColumn('action', function($row){
            $actionBtn = '<button onclick="editar(\''.$row->id.'\');" class="btn btn-outline-dark btn-sm">Edit</button> <button onclick="deletar(\''.$row->id.'\');" class="btn btn-outline-dark btn-sm">Delete</button>';
            return $actionBtn;
        })->rawColumns(['action'])->make(true);
    }

    public function showPaciente($id){
        
    }

    public function createPaciente(){
        
    }

    public function updatePaciente($id){
        
    }

    public function deletePaciente($id){
        
    }
}
