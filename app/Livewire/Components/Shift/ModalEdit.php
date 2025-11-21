<?php

namespace App\Livewire\Components\Shift;

use Livewire\Component;
use Livewire\Attributes\Computed;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

use App\Models\Login;
use App\Models\Turno;
use App\Models\Sistema;
use App\Models\Processo;
use App\Models\Equipamento;
use App\Models\OcorrenciaTurno;

class ModalEdit extends Component
{
    public $message = [];

    public $searchOperador;
    public $ocorrenciaId;

    public $data;
    public $turno;
    public $sistema;
    public $processo;
    public $operador;
    public $descricao;
    public $equipamento;


    public function rules()
    {
        return [
            'data'=>'required',
            'turno'=>'required|exists:tbl_turno,Turno',
            'sistema'=>'required|exists:tbl_Sistemas,Sistema',
            'processo'=>'required|exists:tbl_Processos,Processo',
            'operador'=>'required|exists:login,Login',
            'descricao'=>'nullable|max:400',
            'equipamento'=>'required|exists:tbl_Equipamento,Equipamento',
        ];
    }

    public function messages()
    {
        return [
            'data.required' => 'A data é obrigatória.',

            'turno.required' => 'O turno é obrigatório.',
            'turno.exists' => 'O turno selecionado é inválido.',

            'sistema.required' => 'O sistema é obrigatório.',
            'sistema.exists' => 'O sistema selecionado é inválido.',

            'processo.required' => 'O processo é obrigatório.',
            'processo.exists' => 'O processo selecionado é inválido.',

            'operador.required' => 'O operador é obrigatório.',
            'operador.exists' => 'O operador informado não foi encontrado.',

            'descricao.max' => 'A descrição deve ter no máximo 400 caracteres.',

            'equipamento.required' => 'O equipamento é obrigatório.',
            'equipamento.exists' => 'O equipamento selecionado é inválido.',
        ];
    }

    public function mount()
    {
        $ocorrencia = $this->ocorrencia;
        $this->turno = $ocorrencia->Turno;
        $this->data = $ocorrencia->data->format('Y-m-d\TH:i');
        $this->sistema = $ocorrencia->Sistema;
        $this->processo = $ocorrencia->Processo;
        $this->operador = $ocorrencia->Operador;
        $this->descricao = $ocorrencia->DescricaoOcorrencia;
        $this->equipamento = $ocorrencia->Equipamento;
    }

    public function render()
    {
        return view('livewire.components.shift.modal-edit');
    }

    public function updatedProcesso()
    {
        $this->sistema = null;
    }

    public function updatedSistema()
    {
        $this->equipamento = null;
    }

    #[Computed]
    public function processos()
    {
        $query = Processo::query();

        return $query->orderBy('Processo','asc')->get();
    }

    #[Computed]
    public function sistemas()
    {
        if($this->processo){
            $query = Sistema::query();

            $query->where('Processo',$this->processo);

            return $query->orderBy('Sistema','asc')->get();
        }

        return false;
    }

    #[Computed]
    public function equipamentos()
    {
        if($this->processo && $this->sistema){
            return Equipamento::where('Processo',$this->processo)
            ->where('Sistema',$this->sistema)
            ->orderBy('Equipamento','asc')
            ->get();
        }

        return false;
    }

    #[Computed]
    public function turnos()
    {
        return Turno::orderBy('Turno','asc')->get();
    }

    #[Computed]
    public function operadores()
    {
        $query = Login::query();

        if($this->searchOperador){
            $query->where('Nome','like','%'.$this->searchOperador.'%');
        }

        return $query->orderBy('Nome','asc')->get();
    }

    #[Computed]
    public function ocorrencia()
    {
        return OcorrenciaTurno::find($this->ocorrenciaId);
    }

    public function updateOcorrencia()
    {
        $this->validate();

        $this->ocorrencia->Processo = $this->processo;
        $this->ocorrencia->Sistema = $this->sistema;
        $this->ocorrencia->Equipamento = $this->equipamento;

        $data = Carbon::parse($this->data)->format('Y-m-d H:i:s');
        $this->ocorrencia->DataOcorrencia = DB::raw("CONVERT(datetime, '{$data}', 120)");

        $this->ocorrencia->Turno = $this->turno;
        $this->ocorrencia->Operador = $this->operador;
        $this->ocorrencia->DescricaoOcorrencia = $this->descricao ?? null;
        $this->ocorrencia->save();

        $this->message = [
            'message'=>'Ocorrencia Alterada com Sucesso',
            'severity'=>'success',
            'icon'=>'bi bi-check-circle',
        ];
    }
}
