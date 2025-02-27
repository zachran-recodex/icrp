<?php

namespace Database\Seeders;

use App\Models\CallToAction;
use Illuminate\Database\Seeder;

class CallToActionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CallToAction::create([
            'title' => 'Mari Bergabung Menjadi Mitra Kami',
            'subtitle' => 'ICRP terus berkomitmen mewujudkan masyarakat yang damai, berkeadilan, dan menghormati keberagaman agama dan keyakinan di Indonesia. Dukungan anda membantu kami mengembangkan dialog antar-iman, advokasi HAM, dan studi perdamaian untuk Indonesia yang lebih baik.',
            'image' => 'public/images/hero.jpeg',
            'button_text' => 'Dukung Misi Kami',
        ]);
    }
}
