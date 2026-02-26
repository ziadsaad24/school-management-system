<?php

namespace App\Livewire;

use App\Models\My_Parent;
use Livewire\Attributes\On;
use Livewire\Component;

class EditParent extends Component
{
     public $currentStep = 1;
    public $updateMode=false,

        // Father_INPUTS
        $Email, $Password,
        $Name_Father, $Name_Father_en,
        $National_ID_Father, $Passport_ID_Father,
        $Phone_Father, $Job_Father, $Job_Father_en,
        $Nationality_Father_id, $Blood_Type_Father_id,
        $Address_Father, $Religion_Father_id,

        // Mother_INPUTS
        $Name_Mother, $Name_Mother_en,
        $National_ID_Mother, $Passport_ID_Mother,
        $Phone_Mother, $Job_Mother, $Job_Mother_en,
        $Nationality_Mother_id, $Blood_Type_Mother_id,
        $Address_Mother, $Religion_Mother_id;

        public function mount($id)
{
    $this->updateMode = true;
    $Parent = My_Parent::findOrFail($id);

    // املأ بيانات الفورم
    $this->Email = $Parent->Email;
    $this->Password = ''; // متخزن هاش، مش نعرضه
    $this->Name_Father = $Parent->getTranslation('Name_Father', 'ar');
    $this->Name_Father_en = $Parent->getTranslation('Name_Father', 'en');
    $this->Job_Father = $Parent->getTranslation('Job_Father', 'ar');
    $this->Job_Father_en = $Parent->getTranslation('Job_Father', 'en');
    $this->National_ID_Father = $Parent->National_ID_Father;
    $this->Passport_ID_Father = $Parent->Passport_ID_Father;
    $this->Phone_Father = $Parent->Phone_Father;
    $this->Nationality_Father_id = $Parent->Nationality_Father_id;
    $this->Blood_Type_Father_id = $Parent->Blood_Type_Father_id;
    $this->Religion_Father_id = $Parent->Religion_Father_id;
    $this->Address_Father = $Parent->Address_Father;

    // نفس الكلام للأم
    $this->Name_Mother = $Parent->getTranslation('Name_Mother', 'ar');
    $this->Name_Mother_en = $Parent->getTranslation('Name_Mother', 'en');
    $this->Job_Mother = $Parent->getTranslation('Job_Mother', 'ar');
    $this->Job_Mother_en = $Parent->getTranslation('Job_Mother', 'en');
    $this->National_ID_Mother = $Parent->National_ID_Mother;
    $this->Passport_ID_Mother = $Parent->Passport_ID_Mother;
    $this->Phone_Mother = $Parent->Phone_Mother;
    $this->Nationality_Mother_id = $Parent->Nationality_Mother_id;
    $this->Blood_Type_Mother_id = $Parent->Blood_Type_Mother_id;
    $this->Religion_Mother_id = $Parent->Religion_Mother_id;
    $this->Address_Mother = $Parent->Address_Mother;

    $this->currentStep = 1;
}

    public function render()
    {
        return view('livewire.edit-parent');
    }
  

}
