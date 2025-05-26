<?php

namespace App\Console\Commands;

use App\Models\post\Post;
use Carbon\Carbon;
use Illuminate\Console\Command;

class ArchiveOldPendingPosts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'posts:archive-old-pending-posts';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Archive (soft delete) posts that are pending for more than 3 days';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $threeDaysAgo = Carbon::now()->subDays(3);

        $posts = Post::where('status', 'pending')
            ->where('created_at', '<=', $threeDaysAgo)
            ->whereNull('deleted_at')
            ->get();

        foreach ($posts as $post) {
            $post->delete();
        }

        $this->info("Archived {$posts->count()} old pending posts.");
    }
}
