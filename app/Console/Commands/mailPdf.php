<?php

namespace App\Console\Commands;

use App\ContentPage;
use App\Message;
use App\Paper;
use App\User;
use Illuminate\Console\Command;
use gateweb\common\Mailer;
use gateweb\common\Presenter;

class mailPdf extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mail:pdf {alias} {--test}';

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

        $users = User::where('id','=','1')->get();


        $i = 1;
        /**
         * prepare message
         */
        $message = ContentPage::where('alias',$this->argument('alias'))->firstOrFail();
        
        /**
         * foreach
         */
        foreach ($users as $user) {

            $this->comment("## user $user->id. ".$i++."/".count($users).":");

            /**
             * prepare data
             * @param name
             * @param email
             * @param subject
             * @param body
             * 
             */
            $name = htmlspecialchars($user->name);
            if($this->option('test') || \App::environment() == 'local'){
                $email = "n-mail-$i@gateweb.gr";
            }else{
                $email = $user->email;
            }
            $subject = $message->title;
            $body = "<p>Προς: $name<br>Email: $email</p>";
            $body .= $message->page_text;

            /**
             * prepare pdf attachment
             */
            // initiate FPDI
            $pdf = new \setasign\Fpdi\Tfpdf\Fpdi();
            // add a page
            $pdf->AddPage();
            // set the source file
            $pdf->setSourceFile('storage/pdf/attendeeTemplate.pdf');
            // import page 1
            $template = $pdf->importPage(1);
            // use the imported
            $pdf->useTemplate($template);
            // custom font (tfpdf => utf-8)
            $pdf->AddFont('DejaVu','','DejaVuSansCondensed.ttf',true);
            $pdf->SetFont('DejaVu','',14);
            // now write some text above the imported page
            $pdf->SetTextColor(0,0,100);
            $pdf->SetXY(75, 115); //mm
            $str = "ο/η $name";
            $pdf->Write(0, $str); 

            /**
             * send message
             * 
             */
            $mailer = new Mailer();
            $mailer->set_subject($subject);
            $mailer->set_body($body,true);
            $mailer->set_to($email, $name);
            $mailer->addStringAttachment($pdf->Output(),'cert.pdf');

            if ($mailer->Send()){
                $this->info("sent message to $email");
                Message::create([
                    'name'=> $name,
                    'email' => $email,
                    'title'=>$subject,
                    'body' => $body,
                ]);
            }else{
                $this->error("ERROR: could not send message to user $user->id. ");
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