@extends('log-supervisor::layout')

@section('title', isset($utilisateur) ? "Logs de l'utilisateur : ".$utilisateur->name : "Logs")

@section('content')

<div class="custom-container">
    <div class="custom-row">
        <div class="custom-col-lg-6 mx-auto">
            <div class="bg-light p-4 mb-4 rounded shadow-sm custom-menu">
                <form action="" method="get">
                    <div class="custom-row g-2">
                        <div class="custom-col-sm">
                            <input type="date" name="created_at" id="created_at" class="form-control mb-1" placeholder="Date" value="{{ $input['created_at'] ?? ''}}">
                        </div>
                        <div class="custom-col-sm">
                            <input type="text" name="title" id="title" class="form-control mb-1" placeholder="Mot clé" value="{{ $input['title'] ?? ''}}">
                        </div>
                        <div class="custom-col-sm-auto">
                            <button type="submit" class="btn btn-primary mb-1"><i class="fa fa-search"></i> Rechercher</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
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
