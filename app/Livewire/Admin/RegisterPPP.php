<?php

namespace App\Livewire\Admin;

use App\Models\Company;
use App\Models\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;
use Usernotnull\Toast\Concerns\WireToast;

class RegisterPPP extends Component
{
    use WithPagination;
    use WireToast;

    public $search;
    public $isOpen = false,
        $showUser = false,
        $isOpenDelete = false;
    public $itemId, $userState;
    public $isCreating = false;

    public $currentStep = 1; // Paso actual (1, 2 o 3)
    public $codigoEstudiante;
    public $studentData = [];
    public $companyData = [];

    public function render()
    {
        $solicitudes = Request::query()
            ->join('users', 'requests.user_id', '=', 'users.id') // Realizamos el JOIN con la tabla users
            ->select('requests.*', 'users.code', 'users.name') // Seleccionamos todas las columnas de requests y code, name de users
            ->where(function ($query) {
                $query
                    ->where('linea', 'like', '%' . $this->search . '%')
                    ->orWhere('users.code', 'like', '%' . $this->search . '%') // Filtrar por la columna code de la tabla users
                    ->orWhere('users.name', 'like', '%' . $this->search . '%'); // Filtrar también por el nombre de los usuarios
            })
            ->latest('requests.id') // Ordenar por el ID de la tabla requests
            ->paginate(10); // Paginación
        // $categories = Category::all();
        return view('livewire.admin.registerPPP', compact('solicitudes'));
    }

    // Método para mostrar el formulario de nuevo registro
    public function create()
    {
        $this->isCreating = true;
    }

    // Método para cancelar la creación y volver a la lista
    public function cancelCreate()
    {
        $this->isCreating = false;
    }

    // Método para avanzar al siguiente paso
    public function nextStep()
    {
        $this->currentStep++;
    }

    // Método para retroceder al paso anterior
    public function previousStep()
    {
        $this->currentStep--;
    }

    // Método para buscar el estudiante
    public function buscarEstudiante()
    {
        // Lógica para obtener los datos del estudiante a partir del código
        $user = User::where('code', $this->codigoEstudiante)->first();
        $this->studentData['code'] = $user->code;
        $this->studentData['names'] = $user->name . '' . $user->surnames;
        $this->studentData['dni'] = $user->dni;
        $this->studentData['ciclo'] = $user->ciclo;

        $companyUser = DB::table('company_users')
            ->where('user_id', $user->id)
            ->first();

        $company = Company::where('id', $companyUser->company_id)->first();

        $this->companyData['razon_social'] = $company->razon_social;
        $this->companyData['ruc'] = $company->ruc;
        $this->companyData['direccion'] = $company->direccion_fiscal;
        $this->companyData['responsable'] = $company->responsable;

        $this->nextStep();
    }

    public function guardarSolicitud()
    {
        // Buscar el usuario con el código proporcionado
        $user = User::where('code', $this->codigoEstudiante)->first();

        // Crear la nueva solicitud
        Request::create([
            'user_id' => $user->id,
            'paso' => 'Solicitud de PPP',
            'linea' => 'Ingeniería de Software',
            'estado' => true,
            'descripcion' => 'Se realizó la solicitud correctamente',
        ]);

        // Reiniciar cualquier propiedad que necesite para refrescar la vista o re-filtrar
        $this->search = ''; // Restablecer la búsqueda si es necesario
        $this->isCreating = false; // Si tienes un formulario de creación, puedes cerrarlo o resetearlo

        // Mostrar un mensaje de éxito o realizar alguna acción post-creación
        toast()->success('Solicitud guardada correctamente', 'Mensaje de éxito')->push();
    }

    public function refreshRegistrarPPP()
    {
        $this->render();
    }

    public function deleteItem($id)
    {
        $this->itemId = $id;
        $this->isOpenDelete = true;
    }

    public function closeModals()
    {
        $this->isOpen = false;
        $this->showUser = false;
        $this->isOpenDelete = false;
    }

    public function delete()
    {
        Request::find($this->itemId)->delete();
        toast()->success('Solicitud eliminado correctamente', 'Mensaje de éxito')->push();
        $this->reset('isOpenDelete', 'itemId');
    }
}
