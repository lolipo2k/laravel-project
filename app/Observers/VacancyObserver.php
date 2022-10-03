<?php

namespace App\Observers;

use App\Jobs\SendVacancies;
use App\Models\Vacancies;

class VacancyObserver
{
    public function created(Vacancies $vacancy)
    {
        SendVacancies::dispatch($vacancy);
    }
}
