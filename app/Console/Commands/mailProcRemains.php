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
class mailProcRemains extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mail:procRemains {--id=} {--test}';

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
            $papers = Paper::lab()->accepted()->where('description','<>','')->get();


        $i = 1;

        $date = new \Illuminate\Support\Carbon('February 18, 2019');
        
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
            $body .= "<p>Σας υπενθυμίζουμε ότι η καταληκτική ημερομηνία για την συμπλήρωση των πεδίων είναι η εξής: ".$date->subDay()->toFormattedDateString()."</p>";
            $body .= $message->page_text;

            /** lab edit form */
            if ($is_lab) {
                $body .= "<p style=\"text-align:center; font-weight: bold; margin-top:20px; margin-bottom:20px;\"><a href=\"".\URL::temporarySignedRoute('frontend.papers.edit',$date, ['paper'=>$paper->id])."\">Συμπλήρωση φόρμας</a></p>";
            }

            /** instructions & signature */
            if ($is_lab) {
                $body .= "<p>Δείτε τις <a href=\"".route('frontend.fullpapers.download',["0a91348d-56d8-465e-8a3c-ad95502a55b9",$paper->id])."\">αναλυτικές οδηγίες</a> για τη συμπλήρωση της φόρμας.</p>
                <p><span style=\"font-family:trebuchet ms,helvetica,sans-serif;\">Σας ευχόμαστε να έχετε καλή Πρωτοχρονιά και ευτυχισμένο το νέο έτος.</span></p>
                <p><span style=\"font-family:trebuchet ms,helvetica,sans-serif; margin-bottom:40px;\">Η επιτροπή επιμέλειας των πρακτικών του συνεδρίου</span></p>";               
            }else{
                $body .= "<p>Δείτε τις <a href=\"".route('frontend.fullpapers.download',["82382136-33ab-43f2-b7b5-4f167fee0aea",$paper->id])."\">αναλυτικές οδηγίες</a> για τη συμπλήρωση της φόρμας.</p>
                <p><span style=\"font-family:trebuchet ms,helvetica,sans-serif; margin-bottom:40px;\">Η επιτροπή επιμέλειας των πρακτικών του συνεδρίου</span></p>";
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
