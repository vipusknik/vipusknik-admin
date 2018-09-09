<?php

namespace App\Http\Controllers\Institution;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Institution\Institution;
use App\Support\Traits\File\ComposesFileName;

class InstitutionProfilePhotosController extends Controller
{
    use ComposesFileName;

    public function store(Institution $institution, Request $request)
    {
        $photo = $request->file('photo');

        $institution
            ->addMedia($photo)
            ->usingFileName(
                $this->composeFileName($photo)
            )
            ->toMediaCollection('profile-photo');

        return back()->withMessage('Фото загружено');
    }

    public function destroy(Institution $institution)
    {
        $institution->profilePhoto()->delete();

        return back()->withMessage('Фото удалено');
    }
}
