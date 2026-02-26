<?php

namespace App\Livewire;

use App\Models\My_Parent;
use Livewire\Component;

class Parents extends Component
{
    public $Parent_id, $Email, $Password,
        $Name_Father, $Name_Father_en, $Job_Father, $Job_Father_en,
        $National_ID_Father, $Passport_ID_Father, $Phone_Father,
        $Nationality_Father_id, $Blood_Type_Father_id, $Address_Father, $Religion_Father_id,
        $Name_Mother, $Name_Mother_en, $Job_Mother, $Job_Mother_en,
        $National_ID_Mother, $Passport_ID_Mother, $Phone_Mother,
        $Nationality_Mother_id, $Blood_Type_Mother_id, $Address_Mother, $Religion_Mother_id,
        $currentStep = 1, $updateMode = false;

    // Add these properties
    public $showDeleteModal = false;
    public $parentToDelete = null;

    public function render()
    {
        return view('livewire.parents', [
            'my_parents' => My_Parent::all(),
            'Nationalities' => \App\Models\Nationalitie::all(),
            'Type_Bloods' => \App\Models\Type_Blood::all(),
            'Religions' => \App\Models\Religion::all(),
        ]);
    }

    public function secondStepSubmit()
    {
        $this->validate([
            'Name_Mother' => 'required',
            'Name_Mother_en' => 'required',
            'Job_Mother' => 'required',
            'Job_Mother_en' => 'required',
            'National_ID_Mother' => 'required|unique:my__parents,National_ID_Mother,' . $this->Parent_id,
            'Passport_ID_Mother' => 'required|unique:my__parents,Passport_ID_Mother,' . $this->Parent_id,
            'Phone_Mother' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'Nationality_Mother_id' => 'required',
            'Blood_Type_Mother_id' => 'required',
            'Religion_Mother_id' => 'required',
            'Address_Mother' => 'required',
        ]);

        $this->currentStep = 3;
    }

    public function edit($id)
    {
        $this->updateMode = true;
        $parent = My_Parent::findOrFail($id);
        
        // Load parent data into component properties
    $this->Parent_id = $parent->id;
    $this->Email = $parent->Email;
    $this->Name_Father = $parent->getTranslation('Name_Father', 'ar');
    $this->Name_Father_en = $parent->getTranslation('Name_Father', 'en');
    $this->Job_Father = $parent->getTranslation('Job_Father', 'ar');
    $this->Job_Father_en = $parent->getTranslation('Job_Father', 'en');
    $this->National_ID_Father = $parent->National_ID_Father;
    $this->Passport_ID_Father = $parent->Passport_ID_Father;
    $this->Phone_Father = $parent->Phone_Father;
    $this->Nationality_Father_id = $parent->Nationality_Father_id;
    $this->Blood_Type_Father_id = $parent->Blood_Type_Father_id;
    $this->Address_Father = $parent->Address_Father;
    $this->Religion_Father_id = $parent->Religion_Father_id;

    $this->Name_Mother = $parent->getTranslation('Name_Mother', 'ar');
    $this->Name_Mother_en = $parent->getTranslation('Name_Mother', 'en');
    $this->Job_Mother = $parent->getTranslation('Job_Mother', 'ar');
    $this->Job_Mother_en = $parent->getTranslation('Job_Mother', 'en');
    $this->National_ID_Mother = $parent->National_ID_Mother;
    $this->Passport_ID_Mother = $parent->Passport_ID_Mother;
    $this->Phone_Mother = $parent->Phone_Mother;
    $this->Nationality_Mother_id = $parent->Nationality_Mother_id;
    $this->Blood_Type_Mother_id = $parent->Blood_Type_Mother_id;
    $this->Address_Mother = $parent->Address_Mother;
    $this->Religion_Mother_id = $parent->Religion_Mother_id;
        
        // If you have a form modal, show it
        $this->dispatch('showEditModal');
    }

    public function confirmDelete($id)
    {
        $this->parentToDelete = $id;
        $this->showDeleteModal = true;
    }

    public function delete()
    {
        if ($this->parentToDelete) {
            try {
                $parent = My_Parent::findOrFail($this->parentToDelete);
                $parent->delete();
                
                $this->showDeleteModal = false;
                $this->parentToDelete = null;
                
                session()->flash('success', 'تم حذف ولي الأمر بنجاح');
            } catch (\Exception $e) {
                session()->flash('error', 'حدث خطأ أثناء الحذف');
            }
        }
    }

    public function cancelDelete()
    {
        $this->showDeleteModal = false;
        $this->parentToDelete = null;
    }
    public function firstStepSubmit_edit()
    {
        $this->validate([
            'Email' => 'required|email|unique:my__parents,Email,' . $this->Parent_id,
            'Name_Father' => 'required',
            'Name_Father_en' => 'required',
            'Job_Father' => 'required',
            'Job_Father_en' => 'required',
            'National_ID_Father' => 'required|unique:my__parents,National_ID_Father,' . $this->Parent_id,
            'Passport_ID_Father' => 'required|unique:my__parents,Passport_ID_Father,' . $this->Parent_id,
            'Phone_Father' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'Nationality_Father_id' => 'required',
            'Blood_Type_Father_id' => 'required',
            'Religion_Father_id' => 'required',
            'Address_Father' => 'required',
        ]);

        $this->currentStep = 2;
    }

    public function submitForm_edit()
    {
        $parent = My_Parent::findOrFail($this->Parent_id);
        // Update father's info
        $parent->Email = $this->Email;
        if ($this->Password) {
            $parent->Password = bcrypt($this->Password);
        }
        $parent->setTranslation('Name_Father', 'ar', $this->Name_Father);
        $parent->setTranslation('Name_Father', 'en', $this->Name_Father_en);
        $parent->setTranslation('Job_Father', 'ar', $this->Job_Father);
        $parent->setTranslation('Job_Father', 'en', $this->Job_Father_en);
        $parent->National_ID_Father = $this->National_ID_Father;
        $parent->Passport_ID_Father = $this->Passport_ID_Father;
        $parent->Phone_Father = $this->Phone_Father;
        $parent->Nationality_Father_id = $this->Nationality_Father_id;
        $parent->Blood_Type_Father_id = $this->Blood_Type_Father_id;
        $parent->Address_Father = $this->Address_Father;
        $parent->Religion_Father_id = $this->Religion_Father_id;

        // Update mother's info
        $parent->setTranslation('Name_Mother', 'ar', $this->Name_Mother);
        $parent->setTranslation('Name_Mother', 'en', $this->Name_Mother_en);
        $parent->setTranslation('Job_Mother', 'ar', $this->Job_Mother);
        $parent->setTranslation('Job_Mother', 'en', $this->Job_Mother_en);
        $parent->National_ID_Mother = $this->National_ID_Mother;
        $parent->Passport_ID_Mother = $this->Passport_ID_Mother;
        $parent->Phone_Mother = $this->Phone_Mother;
        $parent->Nationality_Mother_id = $this->Nationality_Mother_id;
        $parent->Blood_Type_Mother_id = $this->Blood_Type_Mother_id;
        $parent->Address_Mother = $this->Address_Mother;
        $parent->Religion_Mother_id = $this->Religion_Mother_id;

        $parent->save();

        // Reset form and state
        $this->reset();
        $this->updateMode = false;
        $this->currentStep = 1;
        session()->flash('success', 'تم تحديث بيانات ولي الأمر بنجاح');
    }
}