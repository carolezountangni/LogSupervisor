<?php

namespace carolezountangni\LogSupervisor\Models;

// namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User;
use Illuminate\Notifications\Notifiable;

class Activity extends Model
{
    use HasFactory;

    protected $fillable = [
        'action', // le type ,la méthode du controlleur
        'description',  // la description inserer un champ description dans chaque requête
        'role',
        'group',
        'user_agent', // le navigateur(browser)
        'route',
        'referrer', //la requête précédente ayant entrainé l'action
        'method', // les méthodes GET PUT...
        'locale', // les informations sur la langue
        // 'params', 
        'user_id',
        // Ajout de champs
        // 'platform', // le système d'exploitation
        // 'device', //moteur de rendu de pages Web 
        'ip_address', // l'adresse ip de l'utilisateur 
        'attributes' => 'json'


    ];
    protected $casts = [
        'attributes' => 'json', //les attributs de la requête
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
