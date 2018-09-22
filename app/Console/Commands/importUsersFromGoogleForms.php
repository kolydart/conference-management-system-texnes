<?php

namespace App\Console\Commands;

use App\Message;
use App\User;
use Illuminate\Console\Command;
use gateweb\common\DateTime;
use gateweb\common\Mailer;
use gateweb\common\Presenter;

class importUsersFromGoogleForms extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:googleforms {csv_path} {--test}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import users from google forms.';

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
        /**
         * array from csv path given in terminal
         */
        $array = Presenter::import_csv_to_array($this->argument('csv_path'));

        /**
         * iterator
         * @var integer
         */
        $i=1;

        /**
         * foreach
         */
        foreach ($array as $row) {
            $this->info("## row ".$i++."/".count($array).":");
            /**
             * prepare data
             * @param name
             * @param email
             * @param attribute
             * @param created_at
             * 
             */
            $role_id = 7; // important!!
            $name = htmlspecialchars($row['name']);
            if($this->option('test') || \App::environment() == 'local'){
                $email = "n-imported-".$i++."@gateweb.gr";
            }else{
                $email = $row['email'];
            }
            $attribute = htmlspecialchars($row['attribute']);
            $password = str_random(8);
            $created_at = (new DateTime($row['created_at']))->set_timezone_utc()->sql();

            /**
             * skip if email exists
             */
            if(User::where('email',$email)->count() > 0){
                echo "email $email exists\n";
                continue;
            }

            /**
             * create user
             */
            $data = [
                'name'=> $name,
                'email'=>$email, 
                'created_at'=>$created_at,
                'attribute' => $attribute,
                'role_id' => $role_id,
                'password' => \Hash::make($password),
                ];
            /**
             * debug
             */
            // if($this->option('test'))
            //     $this->info(Presenter::dd($data));
            
            $user = User::create($data);
            $this->info("created user $user->id ($email)");

            /**
             * send message
             * 
             */
            $subject = 'Πρόγραμμα Συνεδρίου και οδηγίες δήλωσης συμμετοχής';
            $message = "Προς: $name\nEmail: $email\n\nΑγαπητοί συνάδελφοι,\n\nσας ενημερώνουμε ότι το πρόγραμμα του συνεδρίου \"Oι Τέχνες στο ελληνικό σχολείο: παρόν και μέλλον\" είναι πλέον διαθέσιμο στην ιστοσελίδα του συνεδρίου:\nhttps://texnes-ellinikosxoleio.uoa.gr/\n\nΛαμβάνετε αυτό το μήνυμα, διότι δηλώσατε ενδιαφέρον με την υποβολή της φόρμας προεγγραφής στο Συνέδριο. Η είσοδος στις εισηγήσεις είναι ελεύθερη. Στα εργαστήρια ο αριθμός των συμμετεχόντων είναι περιορισμένος. Για το λόγο αυτό, θα πρέπει να δηλώσετε σε ποια εργαστήρια επιθυμείτε να συμμετέχετε (μέχρι 7).\n\nΓια να συνδεθείτε στην ιστοσελίδα, πλοηγηθείτε στη διεύθυνση https://texnes-ellinikosxoleio.uoa.gr/login εισάγετε την ηλεκτρονική σας διεύθυνση και τον εξής κωδικό: $password\nΑν χάσετε τον κωδικό, ή για κάποιο λόγο ο κωδικός δεν λειτουργεί, μπορείτε να ζητήσετε από το σύστημα να σας στείλει νέο κωδικό (https://texnes-ellinikosxoleio.uoa.gr/password/reset). Μετά από την πρώτη σύνδεση, προτείνουμε να αλλάξετε τον κωδικό σε άλλον, της αρεσκείας σας (https://texnes-ellinikosxoleio.uoa.gr/change_password).\n\nΑκολούθως, θα πρέπει να δηλώσετε τα εργαστήρια που σας ενδιαφέρουν να παρακολουθήσετε. Περιηγηθείτε στα εργαστήρια (https://texnes-ellinikosxoleio.uoa.gr/papers/?type=Εργαστήριo%25), επιλέξτε \"Εμφάνιση\" στο εργαστήριο που σας ενδιαφέρει να παρακολουθήσετε και πατήστε το κουμπί \"Δήλωση συμμετοχής\".\n\nΗ δήλωση εργαστηρίων για όσους έχουν κάνει προεγγραφή είναι διαθέσιμη από σήμερα. Για το κοινό θα ξεκινήσει να διατίθεται σε μερικές ημέρες. Συνεπώς, καλό θα είναι να δηλώσετε τα ενδιαφέροντά σας σύντομα.\n\nΣας περιμένουμε να γνωριστούμε από κοντά, καθώς θεωρούμε ότι η επικοινωνία μεταξύ εκπαιδευτικών και επιστημόνων που θεραπεύουν τις τέχνες στο σχολείο, σήμερα και στο μέλλον, είναι ο κοινός μας σκοπός και αυτό που θα μας βοηθήσει στη δράση μας στο σχολικό περιβάλλον.\n\nΜε εκτίμηση\n\nΗ Οργανωτική Επιτροπή του Συνεδρίου\n";
            $mailer = new Mailer();
            $mailer->set_subject($subject);
            $mailer->set_body($message);
            $mailer->set_to($email, $name);
            if ($mailer->Send()){
                $this->info("sent message to user $user->id");
                Message::create([
                    'name'=> $name,
                    'email' => $email,
                    'title'=>$subject,
                    'body' => $message,
                ]);                
            }else{
                $this->info("ERROR: could not send message to user $user->id");
                Presenter::mail("Error in mailer. kBSaSOfrFchbehAa.".$mailer->get_error());
            }
        }
    }
}
