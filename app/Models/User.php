<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'phone',
        'email',
        'password',
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

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    public function recipients()
    {
        return $this->hasMany(Recipient::class);
    }

    public function updateUser($request)
    {

        $user = $this->where('id', auth()->user()->id)->first();

        $image = $request->file('picture');

        if ($image !== null) {
            if ($user->picture !== null) {
                $url = substr($user->picture, 62, 32);
                Cloudinary::destroy($url);
            }
            $url = Cloudinary::upload($image->getRealPath(), array("folder" => "posts-users", "overwrite" => TRUE, "resource_type" => "image"))->getSecurePath();
            $this->where('id', auth()->user()->id)->update([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'phone' => $request->phone,
                'picture' => $url
            ]);
            // $image_name = Cloudinary::getPublicId();
        } else {
            $this->where('id', auth()->user()->id)->update([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'phone' => $request->phone,
            ]);
        }

        // if ($user->picture !== null) {
        //     $oldFile = substr($user->picture, 18);
        //     unlink(public_path('/storage/img-user/' . $oldFile));
        // }

        // $image = $request->file('picture');
        // $filename = '';

        // if ($image !== null) {
        //     $filename = $image->hashName();
        //     $image->store('img-user');
        //     $this->where('id', auth()->user()->id)->update([
        //         'first_name' => $request->first_name,
        //         'last_name' => $request->last_name,
        //         'phone' => $request->phone,
        //         'picture' => "/storage/img-user/$filename"
        //     ]);
        // } else {
        //     $this->where('id', auth()->user()->id)->update([
        //         'first_name' => $request->first_name,
        //         'last_name' => $request->last_name,
        //         'phone' => $request->phone,
        //     ]);
        // }
    }
}
