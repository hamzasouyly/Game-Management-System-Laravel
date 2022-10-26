<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class SexFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //
            'title' => 'female',
            'image' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT2QkP63E3HY8nUUlEOAXO6MhQvdbK3Do_JOCjMf3CHGg&s',
        ];
    }
}
