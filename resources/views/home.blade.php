@extends('layouts.master')

@section('title')
Trending Quotes
@endsection
@section('content')
<section class="quotes row">
    <h1>Latest Quotes </h1>
    
<!--
// to display error message if inputs
-->
@if(count($errors)>0)
<div class="text-center bg-danger box">
    <ul class="list-unstyled">
    @foreach($errors->all() as $error)
    <li> {{ $error }}</li>
    @endforeach
    </ul>
</div>
@endif
<!--
// to display success if insert
-->
@if(Session::has('success'))
<div class="bg-success text-center box">
    {{ Session::get('success') }}
</div>
@endif

<!--
// to display filter
-->

@if(Request::segment(1))
<section class="box text-center bg-info"> Filter apply <a href="{{ route('index') }}">Show all Quotes</a> </section>
@endif 

    @for($i=0;$i<count($quotes);$i++)

        <div class="quote col-md-3">
            <div class="delete"><a href="{{ route('delete',['quote_id'=>$quotes[$i]->id]) }}">X</a></div>
            <p>{{ $quotes[$i]->text }}</p>
            <div class="info">Created by : <a href="{{ route('index',['author'=>$quotes[$i]->author->name]) }}">{{ $quotes[$i]->author->name }}</a> On {{ $quotes[$i]->created_at }}</div>

        </div>
        @endfor
        
<div class='col-md-12 text-center'>
    @if($quotes->currentPage()!=1)
    <a href="{{ $quotes->previousPageUrl() }}" class="btn btn-primary">Prev</a>
    @endif
    @if($quotes->currentPage()!=$quotes->lastPage() && $quotes->hasPages())
    <a href="{{ $quotes->nextPageUrl() }}" class="btn btn-primary">Next</a>
    @endif<br><br>
        </div>
</section>
<section class="edit-quote row">
    <div class="col-md-12 text-center">
        <h2>Add Quote</h2>
        <form class="center-block" action="{{ route('create') }}" method="post">
            <div class="inputgroup">
                <label for="author">Author</label>
                <input type="text" name="author" id="author">
            </div>

            <div class="inputgroup">
                <label for="quote">Quote</label>
                <textarea name="quote" rows="5" placeholder="quote..." id="quote"></textarea>
            </div>
            
            <input type="hidden" name="_token" value="{{ Session::token() }}">
            <button type="submit" class="btn btn-primary">submit</button>

        </form>
    </div>
</section>

@endsection