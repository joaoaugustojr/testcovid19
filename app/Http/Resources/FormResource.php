<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class FormResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'fever' => $this->getNameOption($this->fever),  
            'coryza' => $this->getNameOption($this->coryza), 
            'stuffy_nose' => $this->getNameOption($this->stuffy_nose),  
            'tiredness' => $this->getNameOption($this->tiredness),  
            'cough' => $this->getNameOption($this->cough), 
            'headache' => $this->getNameOption($this->headache), 
            'body_aches' => $this->getNameOption($this->body_aches), 
            'general_discomfort' => $this->getNameOption($this->general_discomfort), 
            'sore_throat' => $this->getNameOption($this->sore_throat), 
            'dyspnea' => $this->getNameOption($this->dyspnea), 
            'lack_of_taste' => $this->getNameOption($this->lack_of_taste), 
            'loss_of_smell' => $this->getNameOption($this->loss_of_smell), 
            'locomotion_difficulty' => $this->getNameOption($this->locomotion_difficulty), 
            'diarrhea' => $this->getNameOption($this->diarrhea), 
            'result' => $this->result,
            'result_text' => $this->getTextResult($this->result),
            'created_at' => $this->created_at,
            'user' => [
                'name' => $this->user->name,
                'whatsapp_number' => $this->user->whatsapp_number
            ]
        ];
    }

    private function getNameOption($value)
    {
        return ($value == '0' ? 'Sim' : 'Não');
    }

    private function getTextResult($value)
    {
        if ($value >= 60) {
            return 'Possível Infectado!';
        } else if ($value >= 40 && $value < 60){
            return 'Potencial Infectado!';
        } else if ($value < 40){
            return 'Sintomas Insuficientes!';
        }

        return '';
    }
}
