<!DOCTYPE html>

<head>

  <!-- Prise en charge des accents et autres caractères spéciaux -->
  <meta charset="utf-8" />
  <!-- (meta) Pour être responsive et éviter une mise à l'échelle automatique -->
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!-- CDN de font awesome pour l'utilisation des fa-fa et des icones -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
  <!-- CDN de Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">  <!-- Lien avec la page CSS (toujours après Bootstrap pour éviter les bug) -->
  <!-- Lien éventuel pour l'utilisation d'une police -->
  <link href="{{ asset('website') }}/css/nouvelles.css" rel="stylesheet">
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet"> 
  <!-- Lien pour placer une icone dans l'onglet, avant le titre de la page -->
  <link rel="icon" href=".png">
  <!-- Titre de la page affiché dans l'onglet -->
  <title>Daniel Hortofer</title>

</head>

<body>

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

    <div class="site-cover site-cover-sm same-height overlay single-page">
      <div class="container">
        <div class="row same-height justify-content-center">
          <div class="col-md-12 col-lg-10">
            <div class="post-entry text-center">
              <h1 class="">Contactez Moi</h1>
              <p class="lead mb-4 text-white"><br></p>
            </div>
          </div>
        </div>
      </div>
    </div>
    
    <div class="site-section">
      <div class="container">
        <div class="row">
          <div class="col-md-7 mb-5">
            <form action="{{ route('website.contact') }}" method="post" class="p-5 bg-white" id="blocContact">
              @csrf 
              @include('includes.errors')
              @if(Session::has('message-send'))
                <div class="alert alert-success">{{ Session::get('message-send') }}</div>
              @endif
              <div class="row form-group">
                <div class="col-md-12">
                  <label class="text-black" for="fname">Nom</label>
                  <input type="text" id="name" name="name" class="form-control" placeholder="Name">
                </div>
              </div>

              <div class="row form-group">
                <div class="col-md-12">
                  <label class="text-black" for="email">Mail</label> 
                  <input type="email" id="email" name="email" class="form-control" placeholder="Email">
                </div>
              </div>

              <div class="row form-group">
                <div class="col-md-12">
                  <label class="text-black" for="subject">Sujet</label> 
                  <input type="subject" id="subject" name="subject" class="form-control" placeholder="Subject">
                </div>
              </div>

              <div class="row form-group">
                <div class="col-md-12">
                  <label class="text-black" for="message">Message</label> 
                  <textarea name="message" id="message" cols="30" rows="7" class="form-control" placeholder="Write your notes or questions here..."></textarea>
                </div>
              </div>

              <div class="row form-group">
                <div class="col-md-12">
                  <input type="submit" value="Send Message" class="btn btn-primary py-2 px-4 text-white" id="btnContact">
                </div>
              </div>

  
            </form>
          </div>
          <div class="col-md-5">
            
            <div class="p-4 mb-3 bg-white" id="blocContact">
              <p class="mb-0 font-weight-bold">Adresse</p>
              <p class="mb-4">{{ $setting->address }}</p>

              <p class="mb-0 font-weight-bold">Restons connectés</p>
              <p class="mb-4">
                @if($setting->facebook)<a target="_blank" href="{{ $setting->facebook }}"><span class="icon-facebook pt-2 pr-2 pb-2 pl-0"></span></a> @endif
                @if($setting->twitter)<a target="_blank" href="{{ $setting->twitter }}"><span class="icon-twitter p-2"></span></a> @endif
                @if($setting->instagram)<a target="_blank" href="{{ $setting->instagram }}"><span class="icon-instagram p-2"></span></a> @endif
                @if($setting->reddit)<a target="_blank" href="{{ $setting->reddit }}"><span class="icon-rss p-2"></span></a> @endif
              </p>

              <p class="mb-0 font-weight-bold">Mail</p>
              <p class="mb-0">{{ $setting->email }}</p>

            </div>

          </div>
        </div>
      </div>
    </div>
    <footer>
    
    <!-- Copyright -->
    <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.4);">
    <a href="{{ route('website.contact') }}" id="footerLink">Contactez-moi</a> <br><br>
      <p>
          {{ $setting->copyright }} |
          <a class="text" href="https://livre.fnac.com/a14646323/Daniel-Hortofer-Athena-et-la-guerre-des-genes#int=:NonApplicable|NonApplicable|NonApplicable|14646323|NonApplicable|NonApplicable" id="footerLink">DanielHortofer.com</a>
      </p>
      
    </div>
    <!-- Copyright -->
  </footer>

  <!-- CDN JavaScript toujours à la fin du body pour éviter les bug -->
  <!-- D'abord le CDN de JQuery -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
  <!-- Puis le CDN du Popper.js -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <!-- Et enfin le CDN de Bootstrap.js -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
  <!-- Sweet alert 2 -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
  <!-- Lien avec la page JS (toujours après les CDN de JQuery/AngularJs) -->
  <script src=".js"></script>
  
</body>

</html>