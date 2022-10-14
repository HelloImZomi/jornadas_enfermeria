<?php

namespace App\Http\Livewire;

use App\Mail\UserRegistered;
use App\Models\Convocation;
use App\Models\Inscription;
use App\Models\School;
use Carbon\Carbon;
use Filament\Notifications\Notification;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\In;
use Livewire\Component;
use Livewire\WithFileUploads;
use Ramsey\Collection\Collection;

class RegisterForm extends Component
{
    use WithFileUploads;

    public Inscription $inscription;

    protected array $rules = [
        'inscription.convocation_id' => ['required', 'exists:convocations,id'],
        'inscription.school_id' => ['required', 'exists:schools,id'],
        'inscription.name' => ['required', 'max:255', 'string'],
        'inscription.email' => ['required', 'email'],
        'inscription.phone' => ['nullable'],
        'inscription.education' => ['required', 'in:1,2,3'],
        'inscription.modality' => ['required', 'in:1,2'],
        'inscription.receipt_path' => ['required'],
    ];

    public $convocations;
    public $convocation = null;
    public $schools;
    public $receipt;

    public bool $hasInPersonSpaceAvailable = false;
    public bool $hasVirtualSpaceAvailable = false;

    public function mount()
    {
        $this->inscription = new Inscription();
        $this->convocations = Convocation::where('inscription_start_date', '<=', Carbon::now())
            ->where('inscription_end_date', '>=', Carbon::now())
            ->where('is_visible', true)
            ->get();
        $this->schools = School::where('visible', true)->get(['id', 'name']);
    }

    public function render(): Factory|View|Application
    {
        return view('livewire.register-form');
    }

    public function save()
    {
        $this->inscription->receipt_path = basename($this->receipt->store('/public'));

        $this->validate();

        $convocation = Convocation::find($this->inscription->convocation_id);

        // Reduce the available spaces
        if ($this->inscription->modality == 1) {
            $convocation->presencial_limit -= 1;
        } elseif ($this->inscription->modality == 2) {
            $convocation->virtual_limit -= 1;
        }
        $convocation->save();

        $code = Str::uuid();
        $this->inscription->code = $code;
        $this->inscription->save();

        Notification::make()
            ->title('Se ha registrado un nuevo alumno')
            ->success()
            ->send();

        $details = [
            'name' => $this->inscription->name,
            'convocation_title' => $convocation->name,
            'url' => 'https://jornadaenfermeria.unav.edu.mx/registro/' . $code
        ];

        Mail::to("aromero@unav.edu.mx")->send(new UserRegistered($details));

        //return redirect()->to('/registrarse');
    }

    public function onChangeConvocation()
    {
        $convocation = Convocation::find($this->inscription->convocation_id);
        $this->hasInPersonSpaceAvailable = $convocation->presencial_limit > 0;
        $this->hasVirtualSpaceAvailable = $convocation->virtual_limit > 0;
    }
}
