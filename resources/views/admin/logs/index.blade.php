@extends('log-supervisor::layout')

{{-- @section('title' , 'Logs') --}}
@section('title' , ('Logs')   )


@section('content')

    
    <table class=" table table-striped">
        <thead>
            <tr>
                <th>User</th>
                <th>Rôle</th>
                <th>Action</th>
                <th>Méthode</th>
                <th class="text-end"> Actions</th>
            </tr>
        </thead>
        <tbody>
                      
                            
            @forelse ($logs as $activity)
                <tr>
                    <td> 
                        {{$activity->user? $activity->user->name : "Anonyme" }}
                    </td>
                    <td>{{ $activity->role }}</td>
                    <td>{{ $activity->action}} </td>
                    
                    <td>{{ $activity->method }}</td>
        
                    <td>
                        <div class="d-flex gap-2 m-100 justify-content-end">
                            <a href="{{ route('admin.logs.show', $activity)}}" class="btn btn-primary">Voir</a>
                         
                        </div>
                    </td>
                </tr>
                @empty

                    <div class="col text-danger text-center text-blod">
                    Aucun log pour ce(s) utilisateur(s)!! 

                    </div>
                
            @endforelse
        </tbody>
    </table>

    {{$logs->links()}}
    
@endsection