<?php

namespace App\Console\Commands;

use App\ContentPage;
use App\Message;
use App\Paper;
use App\User;
use Illuminate\Console\Command;
use gateweb\common\Mailer;
use gateweb\common\Presenter;

class mailPdfVolunteers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mail:pdfVolunteers {alias} {--test} {--id=}';

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
        
        /**
         * foreach
         */
        foreach ($users as $user) {
            $user = (object)$user;

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
                $email = "n-mail-$i@example.com";
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
            $pdf->setSourceFile('storage/pdf/volunteerTemplate.pdf');
            // import page 1
            $template = $pdf->importPage(1);
            // use the imported
            $pdf->useTemplate($template);
            // custom font (tfpdf => utf-8)
            $pdf->AddFont('DejaVu','','DejaVuSansCondensed.ttf',true);
            $pdf->SetFont('DejaVu','',13);
            // now write some text above the imported page
            $pdf->SetTextColor(0,0,0);
            $pdf->SetXY(85, 115); //mm
            $str = "$name";
            $pdf->Write(0, $str);
            $attachment_path = "/tmp/".$this->argument('alias')."-".$user->id.".pdf";
            $pdf->Output($attachment_path,'F');            

            /**
             * send message
             * 
             */
            $mailer = new Mailer();
            $mailer->set_subject($subject);
            $mailer->set_body($body,true);
            $mailer->set_to($email, $name);
            $mailer->addAttachment($attachment_path);

            if ($mailer->Send()){
                $this->info("sent message to $email");
            }else{
                $this->error("ERROR: could not send message to user $user->id. ");
                // Presenter::mail("Error in mailer. kBSaSOfrFchbehAa.".$mailer->get_error());
                \App\Helpers\MailHelper::sendErrorNotification("Error in mailer. kBSaSOfrFchbehAa.", "PDF Volunteers Mailer");
            }
            
            \File::delete($attachment_path);

            // sleep (4);
        }


    }
}
