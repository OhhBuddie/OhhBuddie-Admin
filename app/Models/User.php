<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Foundation\Auth\User as Authenticatable;

use Illuminate\Notifications\Notifiable;

use Laravel\Sanctum\HasApiTokens;

use Exception;

use Mail;

use App\Mail\SendCodeMail;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'google_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
     public function generateCode()

    {

        $code = rand(1000, 9999);

  

        UserCode::updateOrCreate(

            [ 'user_id' => auth()->user()->id ],

            [ 'code' => $code ]

        );

    

        try {

  

            $details = [

                'title' => 'Mail from ItSolutionStuff.com',

                'code' => $code

            ];

             

            Mail::to(auth()->user()->email)->send(new SendCodeMail($details));

    

        } catch (Exception $e) {

            info("Error: ". $e->getMessage());

        }

    }
}
