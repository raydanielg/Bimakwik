<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NewsController extends Controller
{
    //
    public function index()
    {
        // Sample blog data
        $posts = [
            [
                'id' => 1,
                'title' => 'Digital Insurance Transformation in Tanzania',
                'excerpt' => 'How BimaKwik is leading the charge in making insurance accessible to everyone through digital innovation.',
                'image' => 'https://images.unsplash.com/photo-1450101499163-c8848c66ca85?auto=format&fit=crop&w=800&q=80',
                'category' => 'Technology',
                'date' => 'May 10, 2026',
                'author' => 'BimaKwik Team'
            ],
            [
                'id' => 2,
                'title' => 'Understanding Motor Insurance Coverage',
                'excerpt' => 'A comprehensive guide to different types of motor insurance and what fits your needs best.',
                'image' => 'https://images.unsplash.com/photo-1533558701576-23c65e0272fb?auto=format&fit=crop&w=800&q=80',
                'category' => 'Guides',
                'date' => 'May 08, 2026',
                'author' => 'Insurance Experts'
            ],
            [
                'id' => 3,
                'title' => 'The Future of Health Insurance with AI',
                'excerpt' => 'Exploring how Artificial Intelligence is simplifying claims and underwriting in the health sector.',
                'image' => 'https://images.unsplash.com/photo-1576091160550-2173bdd99625?auto=format&fit=crop&w=800&q=80',
                'category' => 'AI Insights',
                'date' => 'May 05, 2026',
                'author' => 'Tech Desk'
            ]
        ];

        return view('resources.news', compact('posts'));
    }

    public function show($id)
    {
        // Sample single post data
        $post = [
            'id' => $id,
            'title' => 'Digital Insurance Transformation in Tanzania',
            'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.',
            'image' => 'https://images.unsplash.com/photo-1450101499163-c8848c66ca85?auto=format&fit=crop&w=1200&q=80',
            'category' => 'Technology',
            'date' => 'May 10, 2026',
            'author' => 'BimaKwik Team'
        ];

        return view('resources.news_detail', compact('post'));
    }
}
