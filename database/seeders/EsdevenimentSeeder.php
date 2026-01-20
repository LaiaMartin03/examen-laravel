<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Esdeveniment;
use Illuminate\Support\Carbon;

class EsdevenimentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();

        $examples = [
            [
                'nom' => 'Fira de la Tecnologia',
                'descripcio' => 'Una fira per mostrar les novetats en tecnologia i startups locals.',
                'data' => $now->copy()->addWeeks(2)->toDateString(),
            ],
            [
                'nom' => 'Concert a la plaça',
                'descripcio' => 'Concert gratuït amb bandes emergents del territori.',
                'data' => $now->copy()->addWeeks(4)->toDateString(),
            ],
            [
                'nom' => 'Taller de cuina mediterrània',
                'descripcio' => 'Aprèn receptes típiques amb un xef local.',
                'data' => $now->copy()->addMonths(1)->toDateString(),
            ],
            [
                'nom' => 'Marató de lectura',
                'descripcio' => 'Lectures i trobades amb escriptors.',
                'data' => $now->copy()->addMonths(2)->toDateString(),
            ],
            [
                'nom' => 'Exposició d\'art contemporani',
                'descripcio' => 'Obres d\'artistes locals i internacionals.',
                'data' => $now->copy()->addWeeks(6)->toDateString(),
            ],
        ];

        foreach ($examples as $e) {
            Esdeveniment::create($e);
        }
    }
}
