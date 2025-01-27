@extends ('layout/app')

@section ('style')
	<link rel="stylesheet" href="{{ URL::asset('style/style.css') }}">
@endsection

@section ('script')
	<script src="{{ URL::asset('scripts/script.js') }}" charset="utf-8"></script>
@endsection

@section ('content')


<div class="app-wrapper">

    <div class="logo">
        <img src="https://i.pinimg.com/736x/9f/23/b2/9f23b24a7698b1515d6c2584249c7f74.jpg" alt="Dog Logo" />
    </div>

    <h1>Dog Breed</h1>

    <div class="input-container">
        <select id="breed-select">
            <option value="">Select Breed</option>
        </select>
        <button class="generate-dog">Generate Dog</button>
    </div>

    <div id="spinner" style="display: none;">
        <img src="https://loading.io/assets/mod/spinner/spinner/lg.gif" alt="Loading..." />
    </div>

    <div id="image-container"></div>

    <footer>
        <p>Created by Stephanie Joy Revano</p>
    </footer>

</div>

@endsection