<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use App\Models\Paciente;

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
            $data->where("paciente.nome",'ilike','%'.$filNome.'%');
        }
        if($filCpf){
            $data->where('paciente.cpf','=',$filCpf);
        }
        
        return Datatables::of($data)
        ->addIndexColumn()
        ->addColumn('action', function($row){
            $actionBtn = '
            <button onclick="visualizar(\''.$row->id.'\');" class="btn btn-outline-dark btn-sm">View</button> 
            <button onclick="editar(\''.$row->id.'\');" class="btn btn-outline-dark btn-sm">Edit</button>
            <button onclick="deletar(\''.$row->id.'\');" class="btn btn-outline-dark btn-sm">Delete</button>';
            return $actionBtn;
        })->rawColumns(['action'])->make(true);
    }

    public function showModal(Request $request){
        $dados = null;
        $destino = null;
        $id = $request->get('paciente_id') ?? null;
        $modal = $request->get('modal') ?? null;
        
        if(!is_null($modal)){
            if($modal == 'paciente'){
                $destino = 'modal.modalpaciente';
            }
            if(!is_null($id)){
                $paciente = Paciente::find($id);
                $dados['paciente'] = $paciente;
                $dados['endereco'] = $paciente->endereco;
            }
            
            return View::make($destino,[
                'dados' => $dados
            ])->render();
        }

        return response('Não foi encontrada a modal requerida.');
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
