<?php

namespace Database\Seeders;

use App\Models\PageView;
use App\Models\Solution;
use App\Models\Post;
use App\Models\Page;
use App\Models\Lead;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class PageViewSeeder extends Seeder
{
    public function run(): void
    {
        PageView::truncate();
        Lead::truncate();

        $solutions = Solution::all();
        $posts = Post::all();
        $pages = Page::all();

        if ($solutions->isEmpty() || $posts->isEmpty() || $pages->isEmpty()) {
            $this->command->error('❌ Solutions, Posts, and Pages must be seeded first!');
            return;
        }

        $referers = [
            null, // Direct
            'https://www.google.com/',
            'https://www.google.com/search?q=innovation+project',
            'https://www.bing.com/',
            'https://lnkd.in/sharing', // LinkedIn
            'https://t.co/xyz', // Twitter
            'https://www.facebook.com/',
            'https://github.com/',
        ];

        $userAgents = [
            'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36',
            'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/17.0 Safari/605.1.15',
            'Mozilla/5.0 (iPhone; CPU iPhone OS 17_1_1 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/17.0 Mobile/15E148 Safari/604.1',
            'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Mobile Safari/537.36',
        ];

        $sessionIds = collect(range(1, 40))->map(fn () => 'sess_' . bin2hex(random_bytes(8)))->toArray();

        // 1. Seed 150 page views spread over 30 days
        for ($i = 0; $i < 150; $i++) {
            $daysAgo = rand(0, 29);
            $createdAt = Carbon::now()->subDays($daysAgo)->subHours(rand(0, 23))->subMinutes(rand(0, 59));

            $typeRoll = rand(1, 3); // 1 = page, 2 = solution, 3 = post
            $referrable = null;
            $url = '/';

            if ($typeRoll === 1) {
                $page = $pages->random();
                $referrable = $page;
                $url = $page->slug === 'home' ? '/' : '/' . $page->slug;
                $pageType = 'page';
            } elseif ($typeRoll === 2) {
                $solution = $solutions->random();
                $referrable = $solution;
                $url = '/solutions/' . $solution->slug;
                $pageType = 'solution';
            } else {
                $post = $posts->random();
                $referrable = $post;
                $url = '/blog/' . $post->slug;
                $pageType = 'post';
            }

            $ipVal = '192.168.1.' . rand(1, 150);

            $pv = new PageView();
            $pv->page_url = $url;
            $pv->page_type = $pageType;
            $pv->visitor_ip = hash('sha256', $ipVal);
            $pv->user_agent = $userAgents[array_rand($userAgents)];
            $pv->referer = $referers[array_rand($referers)];
            $pv->session_id = $sessionIds[array_rand($sessionIds)];
            $pv->created_at = $createdAt;

            if ($referrable) {
                $pv->referrable()->associate($referrable);
            }

            $pv->save();
        }

        // 2. Seed 12 mock Leads for pipeline analytics
        $leadNames = ['Budi Prasetyo', 'Siti Rahma', 'John Doe', 'Jessica Alva', 'Adi Wijaya', 'Linda Kartika', 'Roni Yusuf', 'Mega Utami', 'Daniel Lee', 'Erick Thohir', 'Gibran Rakabuming', 'Kaerul Anam'];
        $companies = ['PT Maju Jaya', 'CV Sumber Makmur', 'Global Corp', 'Acme Ltd', 'PT Trans Logistics', 'Sinar Mas', 'PT Agro Mandiri', 'Lestari Indah', 'Tech Nusantara', 'Initech', 'PT Karya Bangsa', 'Anugerah Abadi'];
        $solutionsList = ['ERP System', 'Transportation Management System', 'Warehouse Management System', 'Material Resource Planning', 'IoT Solution'];
        $statuses = ['new', 'contacted', 'qualified', 'proposal_sent', 'closed', 'archived'];

        for ($i = 0; $i < 12; $i++) {
            $daysAgo = rand(1, 28);
            $createdAt = Carbon::now()->subDays($daysAgo)->subHours(rand(0, 23));

            Lead::create([
                'name'                => $leadNames[$i],
                'company'             => $companies[$i],
                'email'               => strtolower(str_replace(' ', '.', $leadNames[$i])) . '@example.com',
                'phone'               => '+62 812 ' . rand(1000, 9999) . ' ' . rand(100, 999),
                'interested_solution' => $solutionsList[array_rand($solutionsList)],
                'message'             => "Hello, we are interested in your enterprise software solutions. We would like to schedule a meeting to discuss our requirements for " . $companies[$i] . ".",
                'source_page'         => '/contact',
                'status'              => $statuses[array_rand($statuses)],
                'follow_up_notes'     => rand(0, 1) ? 'Spoke with client, scheduled follow-up meeting next week.' : null,
                'created_at'          => $createdAt,
                'updated_at'          => $createdAt,
            ]);
        }

        $this->command->info('✅ PageViewSeeder & LeadSeeder completed successfully.');
    }
}
