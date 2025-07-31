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
 * send mail to authors of proceedings
 * proceedings are published 
 */
class mailProcPublished extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mail:procPublished {--id=}';

    protected $description = 'Send email for proceedings; Proceedings are published.';

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
            /**
             * prepare data
             * @param name
             * @param email
             * @param subject
             * @param body
             * 
             */
            $name = htmlspecialchars($paper->name);
            $email = $paper->email;
            $subject = "Κυκλοφορία Πρακτικών “Οι τέχνες στο ελληνικό σχολείο: παρόν και μέλλον”";
            $body = "<p style=\"margin-bottom:40px; \">Με πολλή χαρά σας ενημερώνουμε ότι αναρτήθηκαν στον ιστότοπο του συνεδρίου “Οι τέχνες στο ελληνικό σχολείο: παρόν και μέλλον” τα πρακτικά των εισηγήσεων (α΄τόμος) και τα πρακτικά των εργαστηρίων/καλών πρακτικών (β΄τόμος).<br><br>Σας ευχαριστούμε θερμά που με το έργο σας συμβάλατε στη συγκρότηση μίας πολύτιμης έκδοσης που θα συνιστά οδηγό για ολόκληρη την εκπαιδευτική κοινότητα για την αξιοποίηση, ενσωμάτωση και ανάδειξη όλων των τεχνών εντός του ελληνικού σχολείου.<br><br>Καλή σας συνέχεια!<br>Η επιμελητική ομάδα των πρακτικών του συνεδρίου<br>“Οι τέχνες στο ελληνικό σχολείο: παρόν και μέλλον”<br><br><a href=\"https://texnes-ellinikosxoleio.uoa.gr/\">https://texnes-ellinikosxoleio.uoa.gr/</a></p>";

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
                ]);
            }else{
                $this->error("ERROR: could not send message to $email");
                \App\Helpers\MailHelper::sendErrorNotification("Error in mailer. bMOYvCehIn7zQNgp.".$mailer->get_error(), "Published Proceedings Mailer");
            }

            sleep(3);
        }


    }
}
