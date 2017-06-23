<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Mail;
use App\Mail\NewsletterEmail;
use App\Newsletter;

class SendNewsletters extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:newsletter';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'send newsletter to susbcribed users';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $newsletters = Newsletter::all();
        foreach ($newsletters as $newsletter) {
            $user = $newsletter->user;
            Mail::to($user)->send(new NewsletterEmail($user));
        }
        $this->info('newsletters sended successfully');
    }
}
