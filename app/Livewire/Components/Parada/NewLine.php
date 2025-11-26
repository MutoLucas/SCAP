<?php

namespace App\Livewire\Components\Parada;

use Livewire\Component;
use Livewire\Attributes\Computed;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

use App\Models\Login;
use App\Models\Turno;
use App\Models\Parada;
use App\Models\Sistema;
use App\Models\Processo;
use App\Models\Componente;
use App\Models\TipoCodigo;
use App\Models\GrupoCodigo;
use App\Models\CodigoFalha;
use App\Models\Equipamento;
use App\Models\CausaAparente;

class NewLine extends Component
{
    public $tagGerador;
    public $tipCod;
    public $grupCod;
    public $falCod;
    public $causaAparente;
    public $componente;
    public $processo;
    public $sistema;
    public $equipamento;
    public $inicio;
    public $fim;
    public $turno;
    public $operador;
    public $observacao;

    public function rules()
    {
        return [
            'observacao'=>'max:1000',
            'tagGerador'=>'required|exists:tbl_Equipamento,Equipamento',
            'grupCod'=>'required|exists:tbl_GrupoDeCódigo,Grupo de Código',
            'tipCod'=>'required|exists:tbl_TipoDeCódigo,Tipo de Código',
            'falCod'=>'required|exists:tbl_CódigoDasFalhas,Código das Falhas',
            'causaAparente'=>'nullable|exists:tbl_CausaAparente,CausaAparente',
            'componente'=>'required|exists:tbl_Componente,Componente',
            'processo'=>'required|exists:tbl_Processos,Processo',
            'sistema'=>'required|exists:tbl_Sistemas,Sistema',
            'equipamento'=>'required|exists:tbl_Equipamento,Equipamento',
            'turno'=>'required|exists:tbl_turno,Turno',
            'operador'=>'required|exists:login,Login',
            'inicio'=>'required',
            'fim'=>'required',
        ];
    }

    public function messages()
    {
        return [
            'observacao.max'=>'Maximo 1000 caracteres',
            'tagGerador.required'=>'Necessario selecionar',
            'tagGerador.exists'=>'Erro ao procurar tagGerador',
            'grupCod.required'=>'Necessario selecionar',
            'grupCod.exists'=>'Erro ao procurar Grupo de Código',
            'tipCod.required'=>'Necessario selecionar',
            'tipCod.exists'=>'Erro ao procurar Tipo de Código',
            'falCod.required'=>'Necessario selecionar',
            'falCod.exists'=>'Erro ao procurar Código da Falha',
            'causaAparente.exists'=>'Erro ao procurar Causa',
            'componente.required'=>'Necessario selecionar',
            'componente.exists'=>'Erro ao procurar Componente',
            'processo.required'=>'Necessario selecionar',
            'processo.exists'=>'Erro ao procurar Processo',
            'sistema.required'=>'Necessario selecionar',
            'sistema.exists'=>'Erro ao procurar Sistema',
            'equipamento.required'=>'Necessario selecionar',
            'equipamento.exists'=>'Erro ao procurar Equipamento',
            'turno.required'=>'Necessario selecionar',
            'turno.exists'=>'Erro ao procurar Turno',
            'operador.required'=>'Necessario selecionar',
            'operador.exists'=>'Erro ao procurar Operador',
            'inicio.required'=>'Necessario informar o Inicio',
            'fim.required'=>'Necessario informar o Fim',
        ];
    }

    public function render()
    {
        return view('livewire.components.parada.new-line');
    }

    public function updatedProcesso()
    {
        $this->sistema = null;
    }

    public function updatedTipCod()
    {
        $this->grupCod = null;
    }

    public function updatedGrupCod()
    {
        $this->falCod = null;
    }

    public function updatedFalCod()
    {
        $this->causaAparente = null;
    }

    public function updatedSistema()
    {
        $this->equipamento = null;
    }

    #[Computed]
    public function equipamentos()
    {
        return Equipamento::orderBy('Equipamento','asc')->get();
    }

    #[Computed]
    public function tipoCodigos()
    {
        return TipoCodigo::get()->all();
    }

    #[Computed]
    public function grupoCodigos()
    {
        $query = GrupoCodigo::query();

        if($this->tipCod){
            $query->where('Tipo de Código',$this->tipCod);
        }

        return $query->get()->all();
    }

    #[Computed]
    public function codigoFalhas()
    {
        $query = CodigoFalha::query();

        if($this->grupCod){
            $query->where('Grupo de Código',$this->grupCod);
        }

        return $query->get()->all();
    }

    #[Computed]
    public function causasAparentes()
    {
        $query = CausaAparente::query();

        if($this->falCod){
            $query->where('CodigoFalha',$this->falCod);
        }

        return $query->get()->all();
    }

    #[Computed]
    public function componentes()
    {
        return Componente::get()->all();
    }

    #[Computed]
    public function processos()
    {
        $query = Processo::query();

        return $query->get()->all();
    }

    #[Computed]
    public function sistemas()
    {
        $query = Sistema::query();

        if($this->processo){
            $query->where('Processo',$this->processo);
        }

        return $query->get()->all();
    }

    #[Computed]
    public function turnos()
    {
        $query = Turno::query();

        return $query->get()->all();
    }

    #[Computed]
    public function operadores()
    {
        $query = Login::query();

        return $query->select('Nome','Login')->get()->all();
    }

    public function storeNewLine()
    {
        $this->validate();
        // dd($this->observacao,$this->tagGerador,$this->grupCod,$this->tipCod,$this->falCod,$this->causaAparente,$this->componente,$this->processo,$this->sistema,$this->equipamento,$this->turno,$this->operador,$this->inicio,$this->fim);

        $newInicio = Carbon::parse($this->inicio)->format('Y-m-d H:i:s');
        $newFim = Carbon::parse($this->fim)->format('Y-m-d H:i:s');

        $newParada = Parada::create([
            'Producao'=>$this->processo,
            'Sistema'=>$this->sistema,
            'Equipamento'=>$this->equipamento,

            'DataInicio'=>DB::raw("CONVERT(datetime, '{$newInicio}', 120)"),
            'DataFim'=>DB::raw("CONVERT(datetime, '{$newFim}', 120)"),

            'EqpGerador'=>$this->tagGerador,
            'TipoCodigo'=>$this->tipCod,
            'GrupoCodigo'=>$this->grupCod,
            'CodigoFalha'=>$this->falCod,
            'Turno'=>$this->turno,
            'CausaAparente'=>$this->causaAparente,
            'Operador'=>$this->operador,
            'Observacao'=>$this->observacao,
            'Componente'=>$this->componente,
        ]);

        $newParada->NumeroParada = $newParada->Id;
        $newParada->save();

        return redirect()->route('lobby')->with('successCreateLine','Linha: '.$newParada->Id.' criada com sucesso');
    }
}
