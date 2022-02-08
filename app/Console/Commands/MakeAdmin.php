<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class MakeAdmin extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:admin';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create application user with admin access';

    /**
     * Create a new command instance.
     *
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
    public function handle(): mixed
    {
        $mainBar = $this->output->createProgressBar(4);

        $name = $this->getUserName();
        $mainBar->advance(1);

        $email = $this->getEmail();
        $mainBar->advance(1);

        $password = $this->getPassword();
        $mainBar->advance(1);


        User::create([
            'name'=>$name,
            'email'=>$email,
            'password'=>Hash::make($password),
            'is_admin'=>true
        ]);

        $mainBar->advance(1);
        $mainBar->finish();
        $this->info(PHP_EOL.'Admin created successfully.');
        return 0;
    }

    /**
     * Gets admin email from console input
     * @return string
     */
    public function getEmail(): string
    {
        $email = $this->ask(PHP_EOL.'What is your admin email?');
        $validator = Validator::make(
            [
                'email'=>$email
            ],
            [
                'email'=>'required|email|unique:users,email'
            ]
        );

        if($validator->fails()){
            foreach ($validator->errors()->all() as $error){
                $this->error($error);
            }
            return $this->getEmail();
        }

        return $email;
    }

    /**
     * Gets admin password from console input
     * @return string
     */
    public function getPassword(): string
    {
        $password = $this->secret(PHP_EOL.'What is your admin password?');
        if(strlen($password) < 6 ){
            $this->error(PHP_EOL.'Password must be at least 6 characters long.');
            return $this->getPassword();
        }
        return $password;
    }

    /**
     * Gets admin name from console input
     * @return string
     */
    public function getUserName(): string
    {
        $name = $this->ask(PHP_EOL.'What is your admin name?');
        if(strlen($name) < 5){
            $this->error(PHP_EOL.'Name too short,min:5');
            return $this->getUserName();
        }
        return $name;
    }
}
