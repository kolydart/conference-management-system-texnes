<?php

namespace App\Console\Commands;

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
    protected $description = 'Import users from google forms. Duplicates have been removed.';

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
         * test data
         */
        if($this->option('test')){
            $array = [[
               "name" => "Γιάννης Παπαδόπουλος",
               "email" => "n-test@gateweb.gr",
               "attribute" => "ΠΕ 78",
               "created_at" => "2018-09-19 5:51:14 am GMT+3",
             ]];
        }else{
        /**
         * csv2array
         */
            $array = Presenter::import_csv_to_array($this->argument('csv_path'));
        }

        foreach ($array as $row) {

            // if email does not exist
            if(User::where('email',$row['email'])->count() > 0){
                echo "email ".$row['email']." exists\n";
                continue;
            }
            /**
             * create user
             */
            $created_at = (new DateTime($row['created_at']))->set_timezone_utc()->sql();
            $password = str_random(8);
            $user = factory(User::class)->create([
                'name'=>htmlspecialchars($row['name']),
                'email'=>$row['email'], 
                'created_at'=>$created_at,
                'attribute' => htmlspecialchars($row['attribute']),
                'role_id' => 7,
                'password' => \Hash::make($password),
                ]);

            $message = "Προς: ".$row['name']."\nΙδιότητα: ".addslashes($row['attribute'])."\n\nΑγαπητοί συνάδελφοι,\n\nσας ενημερώνουμε ότι το πρόγραμμα του συνεδρίου \"Oι Τέχνες στο ελληνικό σχολείο: παρόν και μέλλον\" είναι πλέον διαθέσιμο στην ιστοσελίδα του συνεδρίου:\nhttps://texnes-ellinikosxoleio.uoa.gr/\n\nΛαμβάνετε αυτό το μήνυμα, διότι δηλώσατε ενδιαφέρον με την υποβολή της φόρμας προεγγραφής στο Συνέδριο. Η είσοδος στις εισηγήσεις είναι ελεύθερη. Στα εργαστήρια ο αριθμός των συμμετεχόντων είναι περιορισμένος. Για το λόγο αυτό, θα πρέπει να δηλώσετε σε ποια εργαστήρια επιθυμείτε να συμμετέχετε (μέχρι 7).\n\nΓια να συνδεθείτε στην ιστοσελίδα, χρησιμοποιήστε την ηλεκτρονική σας διεύθυνση και τον εξής κωδικό: $password\nΑν χάσετε τον κωδικό, ή για κάποιο λόγο ο κωδικός δεν λειτουργεί, μπορείτε να ζητήσετε από το σύστημα να σας στείλει νέο κωδικό: https://texnes-ellinikosxoleio.uoa.gr/password/reset Μετά από την πρώτη σύνδεση, προτείνουμε να αλλάξετε τον κωδικό σε άλλον, της αρεσκείας σας.\n\nΑκολούθως, θα πρέπει να δηλώσετε τα εργαστήρια που σας ενδιαφέρουν να παρακολουθήσετε. Περιηγηθείτε στα εργαστήρια (https://texnes-ellinikosxoleio.uoa.gr/papers/?type=Εργαστήριo%), επιλέξτε \"Εμφάνιση\" στο εργαστήριο που σας ενδιαφέρει να παρακολουθήσετε και πατήστε το κουμπί \"Δήλωση συμμετοχής\".\n\nΗ δήλωση εργαστηρίων για όσους έχουν κάνει προεγγραφή είναι διαθέσιμη από σήμερα. Για το κοινό θα ξεκινήσει να διατίθεται σε τρεις ημέρες. Συνεπώς, καλό θα είναι να δηλώσετε τα ενδιαφέροντά σας, σύντομα.\n\nΣας περιμένουμε να γνωριστούμε από κοντά, καθώς θεωρούμε ότι η επικοινωνία μεταξύ εκπαιδευτικών και επιστημόνων που θεραπεύουν τις τέχνες στο σχολείο, σήμερα και στο μέλλον, είναι ο κοινός μας σκοπός και αυτό που θα μας βοηθήσει στη δράση μας στο σχολικό περιβάλλον.\n\nΜε εκτίμηση\n\nΗ Οργανωτική Επιτροπή του Συνεδρίου\n";
            $mailer = new Mailer();
            $mailer->set_subject('Πρόγραμμα Συνεδρίου και οδηγίες δήλωσης συμμετοχής');
            $mailer->set_body($message);
            $mailer->set_to($row['email'], $row['name']);
            if (!$mailer->Send()){
               Presenter::mail("Error in mailer. kBSaSOfrFchbehAa.".$mailer->get_error());
            }           
            echo "created user ".$user->id."\n";
        }
    }
}
