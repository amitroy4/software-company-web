<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class BlogFactory extends Factory
{
    public function definition()
    {
        $title = $this->faker->sentence(6, true);
        return [
            'title' => $title,
            'blog_url' => $this->faker->url(),
            'blog_category_id' => 1,
            'slug' => Str::slug($title) . '-' . $this->faker->unique()->numberBetween(1, 10000),
            'description' => $this->faker->paragraphs(3, true),
            'image' => 'frontend/assets/images/ui.jpg',
            'date' => $this->faker->date(),
            'author' => $this->faker->name(),
            'tags' => implode(',', $this->faker->words(5)),
            'status' =>1
        ];
    }
}
