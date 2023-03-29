<?php

namespace App;

use App\Http\Requests\ImageUploadRequest;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens,Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'last_name', 'email', 'password','phone','file','role_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];


    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function permissions()
    {
        return $this->role->permissions->pluck('name');
    }

    public function hasAccess($access)
    {

        return $this->permissions()->contains($access);
    }

    public static function upload($request)
    {

        if (is_file($request['image'])){
            $file = $request['image'];
            $name = \Illuminate\Support\Str::random(10);
            $localUrl = Storage::putFileAs('image',$file,$name.'.'.$file->extension());
            return env('APP_URL').'/'.$localUrl;
        }

    }
}
