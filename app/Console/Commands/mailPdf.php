<?php

namespace App\Console\Commands;

use App\ContentPage;
use App\Message;
use App\Paper;
use App\User;
use Illuminate\Console\Command;
use gateweb\common\Mailer;
use gateweb\common\Presenter;

/**
 * @example 
 * php artisan mail:pdf {attendee-cert} --id=997 --test
 * php artisan mail:pdf {attendee-cert} --id=997 
 */
class mailPdf extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mail:pdf {--test} {--id=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send pdf using email';

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
        $this->error('PDF functionality has been disabled. The setasign/fpdi-tfpdf package was abandoned and removed.');
        $this->error('Please implement an alternative PDF generation solution if needed.');
        return 1;
    }
}
