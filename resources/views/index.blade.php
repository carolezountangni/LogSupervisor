@extends('log-supervisor::layout')

{{-- @section('title' , ('Logs') --}}
@section('title' , isset($utilisateur )? "Logs de l'utilisateur : ".$utilisateur->name : "Logs"  )


@section('content')


    <div class="bg-ligh p-5 mb-1 text-center">
        <form action="" method="get" class="container d-flex gap-2">

                <input type="text" name="created_at" id="created_at" class="form-control" placeholder="JJ/MM/AAAA" value="{{ $input['created_at'] ?? ''}}">
            
                <input type="text" name="title" id="title" class="form-control" placeholder="Mot clé" value="{{ $input['title'] ?? ''}}">
        
            <button type="submit" class="btn btn-primary btn-sm flex-grow-0"><i class=" fa fa-search-minus"></i>Rechercher</button>

        </form>
    </div>

    
    <table class=" table table-striped table-responsive text-wrap">
        <thead>
            <tr>
                <th class="col-md-2">User</th>
                <th class="col-md-2">Rôle</th>
                <th class="col-md-2">Action</th>
                <th class="col-md-2">Méthode</th>
                <th class=""> Actions</th>
            </tr>
        </thead>
        <tbody>
                      
                            
            @forelse ($logs as $activity)
                <tr>
                    <td class="col-md-2"> 
                        {{$activity->user? $activity->user->name : "Anonyme" }}
                    </td>
                    <td class="col-md-2">{{ $activity->role }}</td>
                    <td class="col-md-2">{{ $activity->action}} </td>
                    
                    <td class="col-md-2">{{ $activity->method }}</td>
        
                    <td>
                        <div class="d-flex gap-2 m-100 justify-content-end">
                            <a href="{{ route('lg.logs.show', $activity->id)}}" class="btn btn-primary">Voir</a>
                         
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