@extends('log-supervisor::layout')

@section('title'," Consulter un log "  )

@section('content')
    
<table class=" table table-striped table-responsive-sm text-wrap">
        <thead>
            <tr>
                <th>User</th>
                <th>Description</th>
                <th>Action</th>
                <th>Rôle</th>
                <th>Groupe</th>
                <th>Navigateur</th>
                <th>route</th>
                <th>Cause</th>
                <th>Méthode</th>
                <th>Langue</th>
                <th>SE</th>
                <th>Moteur</th>
                <th>Adresse Ip</th>
                <th class="text-end"> Actions</th>
            </tr>
        </thead>
        <tbody>
                      
                            
                <tr>
                    <td> 
                        {{$activity->user? $activity->user->name : "Anonyme" }}
                    </td>
                    <td>{{ $activity->action }}</td>
                    <td class="col-md-2">{{ $activity->description }}</td>
                    <td>{{ $activity->role }}</td>
                    <td>{{ $activity->group }}</td>
                    <td  class="col-md-2">{{ $activity->user_agent }}</td>
                    <td>{{ $activity->route }}</td>
                    <td>{{ $activity->referrer }}</td>
                    <td>{{ $activity->method }}</td>
                    <td>{{ $activity->locale }}</td>
                    <td>{{ $activity->platform}} </td>
                    <td>{{ $activity->method }}</td>
                    <td>{{ $activity->device }}</td>
                    <td>{{ $activity->ip_address }}</td>
        
                </tr>
        </tbody>
    </table>

       

          
    
@endsection
    
