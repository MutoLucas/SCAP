<?php

namespace App\Livewire\Components\Parada;

use Livewire\Component;
use Livewire\Attributes\Computed;

use Illuminate\Support\Facades\DB;

use Carbon\Carbon;

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


class EditLine extends Component
{

    public $lineId;

    public $observacao;
    public $tagGerador;
    public $grupCod;
    public $tipCod;
    public $falCod;
    public $causaAparente;
    public $componente;
    public $processo;
    public $sistema;
    public $equipamento;
    public $turno;
    public $operador;
    public $inicio;
    public $fim;

    public function rules()
    {
        return [
            'observacao'=>'max:1000',
            'tagGerador'=>'nullable|exists:tbl_Equipamento,id',
            'grupCod'=>'nullable|exists:tbl_GrupoDeCódigo,Grupo de Código',
            'tipCod'=>'nullable|exists:tbl_TipoDeCódigo,Tipo de Código',
            'falCod'=>'nullable|exists:tbl_CódigoDasFalhas,Código das Falhas',
            'causaAparente'=>'nullable|exists:tbl_CausaAparente,CausaAparente',
            'componente'=>'nullable|exists:tbl_Componente,Componente',
            'turno'=>'nullable|exists:tbl_turno,Turno',
            'operador'=>'nullable|exists:login,Login',
        ];
    }

    public function messages()
    {
        return [
            'observacao.max'=>'Maximo 1000 caracteres',

            'tagGerador.exists'=>'Erro ao procurar tagGerador',

            'grupCod.exists'=>'Erro ao procurar Grupo de Código',

            'tipCod.exists'=>'Erro ao procurar Tipo de Código',

            'falCod.exists'=>'Erro ao procurar Código da Falha',

            'causaAparente.exists'=>'Erro ao procurar Causa',

            'componente.exists'=>'Erro ao procurar Componente',

            'turno.exists'=>'Erro ao procurar Turno',

            'operador.exists'=>'Erro ao procurar Operador',
        ];
    }

    public function mount()
    {
        $parada = Parada::find($this->lineId);
        $this->observacao = $parada->Observacao;
        $this->tagGerador = $parada->tagGerador->id ?? null;
        $this->tipCod = $parada->TipoCodigo;
        $this->grupCod = $parada->GrupoCodigo;
        $this->falCod = $parada->CodigoFalha;
        $this->causaAparente = $parada->CausaAparente;
        $this->componente = $parada->Componente;
        $this->processo = $parada->Producao;
        $this->sistema = $parada->Sistema;
        $this->equipamento = $parada->Equipamento;
        $this->turno = $parada->Turno;
        $this->operador = $parada->Operador;
        $this->inicio = Carbon::parse($parada->DataInicio)->format('Y-m-d\TH:i');
        $this->fim = $parada->DataFim ? Carbon::parse($parada->DataFim)->format('Y-m-d\TH:i') : null;
        $this->apropriador = $parada->Apropriador;
    }

    public function render()
    {
        return view('livewire.components.parada.edit-line');
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

    #[Computed]
    public function equipamentos()
    {
        return Equipamento::orderBy('Equipamento','asc')->get();
    }

    #[Computed]
    public function tipoCodigos()
    {
        return TipoCodigo::orderBy('Tipo de Código','asc')->get();
    }

    #[Computed]
    public function grupoCodigos()
    {
        $query = GrupoCodigo::query();

        if($this->tipCod){
            $query->where('Tipo de Código',$this->tipCod);
        }

        return $query->orderBy('Tipo de Código','asc')->get();;
    }

    #[Computed]
    public function codigoFalhas()
    {
        $query = CodigoFalha::query();

        if($this->grupCod){
            $query->where('Grupo de Código',$this->grupCod);
        }

        return $query->orderBy('Código das Falhas','asc')->get();
    }

    #[Computed]
    public function causasAparentes()
    {
        $query = CausaAparente::query();

        if($this->falCod){
            $query->where('CodigoFalha',$this->falCod);
        }

        return $query->orderBy('CausaAparente','asc')->get();
    }

    #[Computed]
    public function componentes()
    {
        $query = Componente::query();

        if($this->tagGerador){
            $gerador = $this->getTagGerador($this->tagGerador);
            $query->where('Grupo de Equipamentos',$gerador['Grupo de Equipamentos']);
        }

        return $query->orderBy('Componente','asc')->get();
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
        $query = Sistema::query();

        if($this->processo){
            $query->where('Processo',$this->processo);
        }

        return $query->orderBy('Sistema','asc')->get();
    }

    #[Computed]
    public function turnos()
    {
        $query = Turno::query();

        return $query->orderBy('Turno','asc')->get();
    }

    #[Computed]
    public function operadores()
    {
        $query = Login::query();

        return $query->select('Nome','Login')->get()->all();
    }

    public function saveAlters()
    {
        $this->validate();

        $parada = $this->getParada($this->lineId);
        // dd($this->observacao,$this->tagGerador,$this->grupCod,$this->tipCod,$this->falCod,$this->causaAparente,$this->componente,$this->processo,$this->sistema,$this->equipamento,$this->turno,$this->operador,$this->inicio,$this->fim);


        $tagGerador = $this->getTagGerador($this->tagGerador) ?? null;
        $parada->EqpGerador = $tagGerador->Equipamento ?? null;
        $parada->TipoCodigo = $this->pull('tipCod');
        $parada->GrupoCodigo = $this->pull('grupCod');
        $parada->CodigoFalha = $this->pull('falCod');
        $parada->Turno = $this->pull('turno');
        $parada->CausaAparente = $this->pull('causaAparente');
        $parada->Operador = $this->pull('operador');
        $parada->Observacao = $this->pull('observacao');
        $parada->Componente = $this->pull('componente');
        $parada->NumeroParada = $parada->Id;
        $parada->save();

        return redirect()->route('lobby')->with('successEditLine','Linha: '.$parada->Id.' editada com sucesso');
    }

    public function getParada($lineId)
    {
        return Parada::find($lineId);
    }

    public function getTagGerador($tagGerador)
    {
        return Equipamento::where('id',$tagGerador)->first();
    }
}
