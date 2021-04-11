<div class="row" id="header">
    <div class="col-md-3">
        <h1 id="btnAccueil"><a href="{{ route('website') }}" id="accueilLink">DANIEL HORTOFER</a></h1>
    </div>
        <div class="col-md-9">
            <div class="btn-group" role="group">
            <a href="{{ route('website.about') }}"><button type="button" class="btn btn-primary" id="btnMenu" >L'AUTEUR</button></a>
            <a href="{{ route('website.roman') }}"><button type="button" class="btn btn-primary" id="btnMenu" >ROMAN</button></a>
            @foreach($categories as $category)
            <a href="{{ route('website.category', ['slug' => $category->slug]) }}"><button type="button" class="btn btn-primary" id="btnMenu" >{{ $category->name }}</button></a>
            @endforeach
            </div>
         </div>
</div>