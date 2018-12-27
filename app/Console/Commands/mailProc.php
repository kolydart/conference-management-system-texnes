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
 * send mail for proceedings 
 * lab is provided with a signed url, in order to edit wihout login
 */
class mailProc extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mail:proc {--id=} {--test}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send email for proceedings';

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
        if($this->option('id'))
            $papers = Paper::accepted()->where('id',$this->option('id'))->get();
        else
            $papers = Paper::accepted()->get();


        $i = 1;
        
        /**
         * foreach
         */
        foreach ($papers as $paper) {

            $this->info("## paper $paper->id. ".$i++."/".count($papers).":");
            
            /** @var is_lab flag */
            $is_lab=Paper::lab()->accepted()->where('id',$paper->id)->count();

            /**
             * prepare message
             */
            if ($is_lab) {
                $message = ContentPage::where('alias','proc-lab')->firstOrFail();
            }else{
                $message = ContentPage::where('alias','proc-paper')->firstOrFail();
            }

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
                $email = "n-mail-$i@gateweb.gr";
            }else{
                $email = $paper->email;
            }
            $subject = $message->title;
            $body = "<p style=\"margin-bottom:40px; \">Προς: $name<br>Email: $email<br>$paper->type: <i>$paper->title</i><br></p>";
            $body .= $message->page_text;

            if ($is_lab) {
                $body .= "<p style=\"text-align:center; font-weight: bold; margin-bottom:40px;\"><a href=\"".\URL::temporarySignedRoute('frontend.papers.edit',now()->addDays(40), ['paper'=>$paper->id])."\">Φόρμα επεξεργασίας</a></p>";
            }else{
                $body .= "";
            }            

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
                Presenter::mail("Error in mailer. bMOYvCehIn7zQNgp.".$mailer->get_error());
            }
        }


    }
}
