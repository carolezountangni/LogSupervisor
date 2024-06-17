@extends('log-supervisor::layout')

@section('title', isset($utilisateur) ? "Logs de l'utilisateur : ".$utilisateur->name : "Logs")

@section('content')



<div class="bg-light p-5 mb-1 text-center">
    <form action="" method="get" class="container d-flex gap-2">

        <input type="date" name="created_at" id="created_at" class="form-control" placeholder="Date" value="{{ $input['created_at'] ?? '' }}">
            <input type="text" name="title" id="title" class="form-control" placeholder="Mot clé" value="{{ $input['title'] ?? '' }}">


        <button class="btn btn-primary btn-sm flex-grow-0">

                <i class="fa fa-search">Rechercher</i>
            
        </button> 


    </form>

 </div>

<div class="custom-container">
    <div class="custom-row">
        <div class="custom-col-lg-10 mx-auto">
            <div class="table-responsive custom-table">
                <table class="table table-striped table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col">Utilisateur</th>
                            <th scope="col">Rôle</th>
                            <th scope="col">Action</th>
                            <th scope="col">Méthode</th>
                            <th scope="col">Date</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($logs as $activity)
                            <tr>
                                <td>{{ $activity->user ? $activity->user->name : "Anonyme" }}</td>
                                <td>{{ $activity->role }}</td>
                                <td>{{ $activity->action }}</td>
                                <td>{{ $activity->method }}</td>
                                <td>{{ $activity->created_at->format('d/m/Y H:i') }}</td>
                                <td>
                                    <div class="d-flex gap-2 justify-content-end">
                                        <a href="{{ route('lg.logs.show', $activity->id) }}" class="btn btn-outline-primary btn-sm">Consulter</a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-danger fw-bold">Aucun log pour ce(s) utilisateur(s)!!</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="custom-container">
    <div class="custom-row">
        <div class="custom-col-lg-6 mx-auto">
            <div class="d-flex justify-content-center">
                {{ $logs->links() }}
            </div>
        </div>
    </div>
</div>

@endsection
