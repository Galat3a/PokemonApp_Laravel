@extends('pokeball.base')

@section('basecontent')

    <form action="{{url('pokemon')}}" method="post">
        @csrf
        <div class="form-group">
            <label for="name">Name</label>
            <input value="{{old('name')}}" required type="text" class="form-control" id="name" name="name" placeholder="name">
        </div>
        <div class="form-group">
            <label for="weight">Weight (kg)</label>
            <input value="{{old('weight')}}" required type="number" step="0.01" class="form-control" id="weight" name="weight" placeholder="weight">
        </div>
        <div class="form-group">
            <label for="height">Height (m)</label>
            <input value="{{old('height')}}" required type="number" step="0.01" class="form-control" id="height" name="height" placeholder="height">
        </div>
        <div class="form-group">
            <label for="type">Type</label>
            <!-- <input value="{{old('type')}}" required type="number" class="form-control" id="type" name="type" placeholder="type"> -->
            <select required type="text" class="form-control" id="type" name="type">
                <option value="bug" {{ old('type') == 'bug' ? 'selected' : '' }}>Bug</option>
                <option value="dark" {{ old('type') == 'dark' ? 'selected' : '' }}>Dark</option>
                <option value="dragon" {{ old('type') == 'dragon' ? 'selected' : '' }}>Dragon</option>
                <option value="electric" {{ old('type') == 'electric' ? 'selected' : '' }}>Electric</option>
                <option value="fairy" {{ old('type') == 'fairy' ? 'selected' : '' }}>Fairy</option>
                <option value="fighting" {{ old('type') == 'fighting' ? 'selected' : '' }}>Fighting</option>
                <option value="fire" {{ old('type') == 'fire' ? 'selected' : '' }}>Fire</option>
                <option value="flying" {{ old('type') == 'flying' ? 'selected' : '' }}>Flying</option>
                <option value="ghost" {{ old('type') == 'ghost' ? 'selected' : '' }}>Ghost</option>
                <option value="grass" {{ old('type') == 'grass' ? 'selected' : '' }}>Grass</option>
                <option value="ground" {{ old('type') == 'ground' ? 'selected' : '' }}>Ground</option>
                <option value="ice" {{ old('type') == 'ice' ? 'selected' : '' }}>Ice</option>
                <option value="normal" {{ old('type') == 'normal' ? 'selected' : '' }}>Normal</option>
                <option value="poison" {{ old('type') == 'poison' ? 'selected' : '' }}>Poison</option>
                <option value="psychic" {{ old('type') == 'psychic' ? 'selected' : '' }}>Psychic</option>
                <option value="rock" {{ old('type') == 'rock' ? 'selected' : '' }}>Rock</option>
                <option value="steel" {{ old('type') == 'steel' ? 'selected' : '' }}>Steel</option>
                <option value="water" {{ old('type') == 'water' ? 'selected' : '' }}>Water</option>
            </select>
        </div>
        <div class="form-group">
            <label for="evolution">Evolutions</label>
            <input value="{{old('evolution')}}" required type="number" step="1" class="form-control" id="evolution" name="evolution" placeholder="number of evolutions">
        </div>
        <button type="submit" class="btn btn-primary">add</button>
    </form>
    <br>
    <div class="form-group">
        <a href="{{url()->previous()}}">Pokeball</a>
    </div>

@endsection