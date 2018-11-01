<?php

namespace App\Console\Commands;

use App\ContentPage;
use App\Lunch;
use App\Message;
use App\Paper;
use App\User;
use Illuminate\Console\Command;
use gateweb\common\Mailer;
use gateweb\common\Presenter;

class mailPageFromLunch extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mail:lunch {alias} {--test}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send message for lunch using email';

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

        $lunches = Lunch::all();


        $i = 1;
        /**
         * prepare message
         */
        $message = ContentPage::where('alias',$this->argument('alias'))->firstOrFail();
        
        /**
         * foreach
         */
        foreach ($lunches as $lunch) {

            $this->comment("## lunch $lunch->id. ".$i++."/".count($lunches).":");

            /**
             * prepare data
             * @param name
             * @param email
             * @param subject
             * @param body
             * 
             */
            $name = User::where('email',$lunch->email)->first()?User::where('email',$lunch->email)->first()->name:'';
            if($this->option('test') || \App::environment() == 'local'){
                $email = "n-mail-$i@gateweb.gr";
            }else{
                $email = $lunch->email;
            }
            $subject = $message->title;
            // $body = "<p>Προς: $name<br>Email: $email</p>";
            $body = $message->page_text;
            $body .= "<p>Η προτίμηση που έχετε δηλώσει είναι η εξής:<b> $lunch->menu </b></p>";
            $body .= "<p><b>Για να επιβεβαιώσετε τη δήλωσή σας κάνετε κλικ στον παρακάτω σύνδεσμο.</b></p>";
            $body .= "<h3><a href=\"".\URL::temporarySignedRoute('frontend.lunch.confirm', now()->addHours(26), ['lunch_id' => $lunch->id])."\">Επιβεβαίωση</a></h3>";
            $body .= "<p>Οι επιβεβαιώσεις θα γίνονται δεκτές μέχρι την Τετάρτη, στις 12 το μεσημέρι.</p>";
            $body .= "<p>Η Οργανωτική Επιτροπή του Συνεδρίου<br>https://texnes-ellinikosxoleio.uoa.gr/</p>";

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
                    'page_id' => $message->id
                ]);
            }else{
                $this->error("ERROR: could not send message to lunch $lunch->id. ");
                // Presenter::mail("Error in mailer. kBSaSOfrFchbehAa.".$mailer->get_error());
                Presenter::mail("Error in mailer. kBSaSOfrFchbehAa.");
            }
        // sleep(30);

            // if( $i % 10 == 0 ){
                // $this->info('pausing');
                // sleep(10);
            // }

        }


    }
}
