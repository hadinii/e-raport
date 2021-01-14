<?php
$title = 'Dashboard';
$showNav = true;
$user = Auth::user();
?>
@extends('layouts.adminty')

@section('title', $title)

@if ($user->role == 'Admin')
    @include('dashboard.admin')
@else
    @include('dashboard.guru')
@endif
