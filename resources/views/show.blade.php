@extends('log-supervisor::layout')

@section('title', "Consulter un log")

@section('content')

<div class="bg-light p-4 rounded shadow-sm mb-4">
    <h2 class="text-center">Détails du Log</h2>
</div>

<div class="table-responsive">
    <table class="table table-striped table-hover">
        <thead class="table-dark">
            <tr>
                <th scope="col">Attributs</th>
                <th scope="col">Valeurs</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th scope="row">Utilisateur</th>
                <td>{{ $activity->user ? $activity->user->name : "Anonyme" }}</td>
            </tr>
            <tr>
                <th scope="row">Action</th>
                <td>{{ $activity->action }}</td>
            </tr>
            <tr>
                <th scope="row">Description</th>
                <td>{{ $activity->description }}</td>
            </tr>
            <tr>
                <th scope="row">Rôle</th>
                <td>{{ $activity->role }}</td>
            </tr>
            <tr>
                <th scope="row">Groupe</th>
                <td>{{ $activity->group }}</td>
            </tr>
            <tr>
                <th scope="row">Navigateur</th>
                <td>{{ $activity->user_agent }}</td>
            </tr>
            <tr>
                <th scope="row">Route</th>
                <td>{{ $activity->route }}</td>
            </tr>
            <tr>
                <th scope="row">Action précédente</th>
                <td>{{ $activity->referrer }}</td>
            </tr>
            <tr>
                <th scope="row">Méthode</th>
                <td>{{ $activity->method }}</td>
            </tr>
            <tr>
                <th scope="row">Langue</th>
                <td>{{ $activity->locale }}</td>
            </tr>
            <tr>
                <th scope="row">Adresse IP</th>
                <td>{{ $activity->ip_address }}</td>
            </tr>
            <tr>
                <th scope="row">Date de création</th>
                <td>{{ $activity->created_at->format('d/m/Y H:i') }}</td>
            </tr>
            <tr>
                <th scope="row">Date de modification</th>
                <td>{{ $activity->updated_at->format('d/m/Y H:i') }}</td>
            </tr>
        </tbody>
    </table>
</div>

@endsection
