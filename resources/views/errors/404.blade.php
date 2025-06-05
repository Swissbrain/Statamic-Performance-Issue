@extends('layouts.site')

@php(\Illuminate\Support\Facades\Redirect::to($configuration->error_404_entry->url())->send())

