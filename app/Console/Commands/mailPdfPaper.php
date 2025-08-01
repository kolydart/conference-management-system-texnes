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
 * php artisan mail:pdfPaper {paper-cert} --id=330
 */
class mailPdfPaper extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mail:pdfPaper {--test} {--id=}';

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

        $i = 1;
        /**
         * prepare message
         */
        $message = ContentPage::where('alias','paper-cert')->firstOrFail();
        
        /**
         * foreach
         */
        foreach ($papers as $paper) {

            $this->comment("## paper $paper->id. ".$i++."/".count($papers).":");

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
            $body = "<p>Προς: $name<br>Email: $email</p>";
            $body .= $message->page_text;

            $type = explode(':', $paper->type)[0];

            /**
             * prepare pdf attachment
             */
            // initiate FPDI
            $pdf = new \setasign\Fpdi\Tfpdf\Fpdi();
            // add a page
            $pdf->AddPage();
            // set the source file
            if($type == 'Εισήγηση')
                $pdf->setSourceFile('storage/pdf/paperTemplate.pdf');
            else
                $pdf->setSourceFile('storage/pdf/labTemplate.pdf');
            // import page 1
            $template = $pdf->importPage(1);
            // use the imported
            $pdf->useTemplate($template);
            // custom font (tfpdf => utf-8)
            $pdf->AddFont('DejaVu','','DejaVuSansCondensed.ttf',true);
            $pdf->SetFont('DejaVu','',11);
            // now write some text above the imported page
            $pdf->SetTextColor(0,0,0);
            $pdf->SetXY(41, 125); //mm
            $str=(substr_count($paper->name,',')==0)?"Όνομα: ":"Ονόματα: ";
            $str.="$paper->name\nΤίτλος: $paper->title";
            $pdf->MultiCell(128,5,$str,0,'L');
            // $pdf->Write(0, $str);
            $attachment_path = "/tmp/paper-cert-".$paper->id.".pdf";
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
                Message::create([
                    'name'=> $name,
                    'email' => $email,
                    'title'=>$subject,
                    'body' => $body,
                    'paper_id' => $paper->id,
                    'page_id' => $message->id,                    
                ]);
            }else{
                $this->error("ERROR: could not send message to user $paper->id. ");
                // Presenter::mail("Error in mailer. kBSaSOfrFchbehAa.".$mailer->get_error());
                \App\Helpers\MailHelper::sendErrorNotification("Error in mailer. kBSaSOfrFchbehAa.", "PDF Paper Mailer");
            }
            
            \File::delete($attachment_path);

            // sleep (4);
        }


    }
}
