@extends('log-supervisor::layout')

@section('title', "Consulter un log")

@section('content')

<div class="bg-light p-5 mb-4 rounded shadow-sm">
    <h2 class="text-center">Détails du Log</h2>
</div>

<div class="table-responsive">
    <table class="table table-striped table-hover">
        <thead class="table-dark">
            <tr>
                <th style="width: 50%;">Attributs</th>
                <th style="width: 50%;">Valeurs</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th>Utilisateur</th>
                <td>{{ $activity->user ? $activity->user->name : "Anonyme" }}</td>
            </tr>
            <tr>
                <th>Action</th>
                <td>{{ $activity->action }}</td>
            </tr>
            <tr>
                <th>Description</th>
                <td>{{ $activity->description }}</td>
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
                <td>{{ $activity->user_agent }}</td>
            </tr>
            <tr>
                <th>Route</th>
                <td>{{ $activity->route }}</td>
            </tr>
            <tr>
                <th>Action précédente</th>
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
            <tr>
                <th>Adresse IP</th>
                <td>{{ $activity->ip_address }}</td>
            </tr>
            <tr>
                <th>Date de création</th>
                <td>{{ $activity->created_at->format('d/m/Y H:i') }}</td>
            </tr>
            <tr>
                <th>Date de modification</th>
                <td>{{ $activity->updated_at->format('d/m/Y H:i') }}</td>
            </tr>
        </tbody>
    </table>
</div>

@endsection
