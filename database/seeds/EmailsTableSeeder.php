<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class EmailsTableSeeder extends Seeder
{
     /**
     * Run the database seeds.
     *
     * @return void
     */
    private $table, $faker;

    public function __construct()
    {
      $this->table  = 'emails';
      $this->faker  = Faker\Factory::create();
    }

    public function run()
    {

      DB::table($this->table)->truncate();

      $staticEmails = [
        "Verify Your Email Address" => "Thanks for creating an account with MonsterCall. Please follow the link below to verify your email address",

        "Thank you for verifying your account, You can login now." => "Thanks for verifying your account with MonsterCall. You can now use your email and password to start using MonsterCall.",

        "Your Password Reset Link" => "Click here to reset your password:",

        "Apply to be an expert" => "There is a new application to become expert.<br> Click here to approve: ",

        "Expert application approved" => "Your account is approved as an expert with MonsterCall.
Please follow the link below to your profile.",

        "New appointment requested" => "This is a static mail body.",

        "Reply for your appointment" => "This is a static mail body.",

        "New question notification" => "<p>There is a new question and you are an expert in related fields.</p>
<p>Click here to answer this question: </p>",

        "New answer notification" => "<p>There is a new answer on your question.</p>
<p>Click here to check it: </p>"
       ];

      foreach ($staticEmails as $subject=>$body ) {
        DB::table($this->table)->insert([
            'subject'     => $subject,
            'slug'        => str_slug($subject),
            'content'     => $body,//$this->faker->realText(151, 2),
            'created_at'  => Carbon::now(),
            'updated_at'  => Carbon::now()
        ]);
      }
    }
}
