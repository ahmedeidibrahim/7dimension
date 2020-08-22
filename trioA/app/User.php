<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Twilio\Rest\Client;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'phone', 'password'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'phone_verified_at' => 'datetime',
    ];

    public function hasVerifiedPhone()
    {
        return ! is_null($this->phone_verified_at);
    }

    public function markPhoneAsVerified()
    {
        return $this->forceFill([
            'phone_verified_at' => $this->freshTimestamp(),
        ])->save();
    }

    public function callToVerify()
    {
        $code = random_int(100000, 999999);
        
        $this->forceFill([
            'verification_code' => $code
        ])->save();

        $client = new Client(env('TWILIO_SID'), env('TWILIO_AUTH_TOKEN'));
        $twilio_number = "+13342491301";//"+12058720171"; // REPLACE WITH YOUR TWILIO NUMBER
/*
        $client->messages->create(
            $this->phone ,
            array(
                'from' => $twilio_number,
                'body' => 'your regestration code is '.$code,
            )
        );

        $client->calls->create(
            $this->phone,
            $twilio_number, 
            ["url" => "http://your-ngrok-url>/build-twiml/{$code}"]
        );
*/
    }

    //relation
    public function permissions()
    {
        return $this->hasMany('App\Permission','user_id');
    }
}
