<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Block;

class BlockSeeder extends Seeder
{
    public function run()
    {
        $blocks = [
            [
                'block_id' => 'BSIT3-01',
                'name' => 'BSIT3-01',
            ],
            [
                'block_id' => 'BSIT3-02',
                'name' => 'BSIT3-02',
            ],
            [
                'block_id' => 'BSIT3-03',
                'name' => 'BSIT3-03',
            ],
            [
                'block_id' => 'BSIT3-04',
                'name' => 'BSIT3-04',
            ],
            [
                'block_id' => 'BSIT3-05',
                'name' => 'BSIT3-05',
            ],
            [
                'block_id' => 'BSIT3-06',
                'name' => 'BSIT3-06',
            ],
            [
                'block_id' => 'BSIT3-07',
                'name' => 'BSIT3-07',
            ],
            [
                'block_id' => 'BSIT3-08',
                'name' => 'BSIT3-08',
            ],
            [
                'block_id' => 'BSIT3-09',
                'name' => 'BSIT3-09',
            ],
            [
                'block_id' => 'BSIT3-10',
                'name' => 'BSIT3-10',
            ],
        ];

        foreach ($blocks as $block) {
            Block::create($block);
        }
    }
}
