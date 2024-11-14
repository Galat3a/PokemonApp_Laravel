@extends('pokeball.base')

@section('title', 'Pokemon catch:')

@section('basecontent')

    <table class="table table-striped table-hover" id="tablaPokemon">
        <thead>
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Weight (kg)</th>
                <th>Height (m)</th>
                <th>Type</th>
                <th>Evolution</th>
                @if(session('user'))
                    <th>Delete</th>
                    <th>Edit</th>
                @endif
                <th>View</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pokemons as $pokemon)
                <tr>
                    <td>{{$pokemon->id}}</td>
                    <td>{{$pokemon->name}}</td>
                    <td>{{$pokemon->weight}}</td>
                    <td>{{$pokemon->height}}</td>
                    <td>{{$pokemon->type}}</td>
                    <td>{{$pokemon->evolution}}</td>
                    @if(session('user'))
                    <td><a href="#" data-href="{{ url('pokemon/' . $pokemon->id )}}" class="borrar">delete</a></td>
                    <!-- Para hacerlo con botón, sin script.js y sin confirmación de borrado. No recomendable
                    <form id="formDelete" action="{{ url('pokemon/' . $pokemon->id) }}" method="post">
                        @csrf
                        @method('delete')
                        <td><button type="submit" class="btn btn-danger">Delete</button></td>
                    </form>
                    -->
                        <td><a href="{{url('pokemon/' . $pokemon->id . '/edit')}}">edit</a></td>
                    @endif
                    <td><a href="{{url('pokemon/' . $pokemon->id)}}">view</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="row">
        @if(session('user'))
            <a href="{{url('pokemon/create')}}" class="btn btn-success">add pokèmon</a>
            <form id="formDelete" action="{{ url('') }}" method="post">
                @csrf
                @method('delete')
            </form>
        @endif
    </div>

@endsection

@section('scripts')
    <script src="{{url('assets/scripts/script.js')}}"></script>
@endsection