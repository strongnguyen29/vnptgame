@extends('errors::minimal')

@section('title', __('Từ chối truy cập'))
@section('code', '403')
@section('message', __($exception->getMessage() ?: 'Từ chối truy cập'))
