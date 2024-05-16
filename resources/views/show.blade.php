@extends('log-supervisor::layout')

@section('title'," Consulter un log "  )

@section('content')
    
<table class=" table table-striped table-responsive-sm text-wrap ">
        <thead>
            <tr>
                <th style="width: 50%;">Attributs</th>
                <th style="width: 50%;">Valeurs</th>
            </tr>
        </thead>
        <tbody>            
            <tr>
                <th>Utilisateur</th>
                <td>  {{$activity->user? $activity->user->name : "Anonyme" }}</td>
            </tr>
            <tr>
                <th>Action</th>
                <td>{{ $activity->action }}</td>
            </tr>
            <tr>
                <th>Description</th>
                <td class="col-md-2">{{ $activity->description }}</td>
            </tr>
            <tr>
                <th>Rôle</th>
                <td>{{ $activity->role }}</td>
            </tr>
            <tr>
                <th>Groupe</th>
                <td>{{ $activity->group }}</td>
            </tr>
            <tr>
                <th>Navigateur</th>
                <td  class="col-md-2">{{ $activity->user_agent }}</td>
            </tr> 
            <tr>  
                <th>Route</th>
                <td>{{ $activity->route }}</td>
            </tr> 
            
            <tr>
                <th>Action précedente</th>
                <td>{{ $activity->referrer }}</td>
            </tr>
            <tr>
                 <th>Méthode</th>
                <td>{{ $activity->method }}</td>
            </tr>
           <tr>
                <th>Langue</th>
                <td>{{ $activity->locale }}</td>
            </tr>
         
                <th>Adresse Ip</th>
                <td>{{ $activity->ip_address }}</td>

            </tr>
              <tr>
                 <th>Date de création </th>
                <td>{{ $activity->created_at}} </td>
            </tr>
            <tr>
                <th>Date de modification </th>
                <td>{{ $activity->updated_at }}</td>
            </tr>
           <tr>
        </tbody>
    </table>

       

          
    
@endsection
    
