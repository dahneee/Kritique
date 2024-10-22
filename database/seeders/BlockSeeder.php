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
                'block_id' => 'Block 1',
                'name' => 'Block 1',
            ],
            [
                'block_id' => 'Block 2',
                'name' => 'Block 2',
            ],
            [
                'block_id' => 'Block 3',
                'name' => 'Block 3',
            ],
            [
                'block_id' => 'Block 4',
                'name' => 'Block 4',
            ],
            [
                'block_id' => 'Block 5',
                'name' => 'Block 5',
            ],
            [
                'block_id' => 'Block 6',
                'name' => 'Block 6',
            ],
            [
                'block_id' => 'Block 7',
                'name' => 'Block 7',
            ],
            [
                'block_id' => 'Block 8',
                'name' => 'Block 8',
            ],
            [
                'block_id' => 'Block 9',
                'name' => 'Block 9',
            ],
            [
                'block_id' => 'Block 10',
                'name' => 'Block 10',
            ],
        ];

        foreach ($blocks as $block) {
            Block::create($block);
        }
    }
}
