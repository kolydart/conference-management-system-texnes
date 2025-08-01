<?php

namespace App\Console\Commands;

use App\ContentPage;
use App\Message;
use App\Paper;
use App\User;
use Illuminate\Console\Command;
use gateweb\common\Mailer;
use gateweb\common\Presenter;

class mailPageFromPaper extends Command
{
    /**
     * Send message from CMS to all accepted Paper authors
     *
     * @var string
     */
    protected $signature = 'mail:pageFromPaper {alias} {--test}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send page using email';

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
        $papers = Paper::accepted()->get();
        // $papers = Paper::accepted()->labNot()->doesntHave('fullpapers')->get(); // ->lab() (only for lab)

        $i = 1;
        /**
         * prepare message
         */
        $message = ContentPage::where('alias',$this->argument('alias'))->firstOrFail();
        
        /**
         * foreach
         */
        foreach ($papers as $paper) {

            $this->info("## paper $paper->id. ".$i++."/".count($papers).":");

            /**
             * prepare data
             * @param name
             * @param email
             * @param subject
             * @param body
             * 
             */
            $name = htmlspecialchars($paper->name);
            if($this->option('test') || \App::environment() == 'local'){
                $email = "n-mail-$i@example.com";
            }else{
                $email = $paper->email;
            }
            $subject = $message->title;
            $body = "<p>Προς: $name<br>Email: $email<br>$paper->type: <i>$paper->title</i><br></p>";
            $body .= $message->page_text;

            /**
             * send message
             * 
             */
            $mailer = new Mailer();
            $mailer->set_subject($subject);
            $mailer->set_body($body,true);
            $mailer->set_to($email, $name);
            if ($mailer->Send()){
                $this->info("sent message to $email");
                Message::create([
                    'name'=> $name,
                    'email' => $email,
                    'title'=>$subject,
                    'body' => $body,
                    'paper_id' => $paper->id,
                    'page_id' => $message->id,
                ]);
            }else{
                $this->error("ERROR: could not send message to user $user->id");
                \App\Helpers\MailHelper::sendErrorNotification("Error in mailer. kBSaSOfrFchbehAa.".$mailer->get_error(), "Page From Paper Mailer");
            }
        }


    }
}
