<?php

namespace App\Http\Controllers\Specialties;

use App\Http\Controllers\Controller;

use App\Models\Specialty\Specialty;

class QualificationTypesController extends Controller
{
    public function update(Specialty $qualification)
    {
        $qualification->update(['type' => 'specialty']);

        return redirect()
            ->route('specialties.edit', [$institution, $qualification])
            //^changed "college" to $institution
            ->with([
                'message' => 'Задайте направление специальности',
                'notification' => 'warning',
                'timeOut' => 90000
            ]);
    }
}
