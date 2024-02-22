<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Facture</title>
    <link rel="stylesheet" href="{{public_path('style.css')}}" media="all" />
  </head>
  <body>
    <header class="clearfix">
      <div id="logo">
        <img src="logo.png">
      </div>
      <div id="company">
        <h2 class="name">AmbulancePro</h2>
        <div>Bâtiment Bréguet, 3 Rue Joliot Curie <br> 2e ét, 91190 Gif-sur-Yvette</div>
        <div>(+33) 07 567 890 01</div>
        <div><a href="mailto:ambulancepro@gmail.com">ambulancepro@gmail.com</a></div>
      </div>
      </div>
    </header>
    <main>
      <div id="details" class="clearfix">
        <div id="client">
          <div class="to">FACTURE à:</div>
          <h2 class="name">{{$etbs->nom}}</h2>
          <div class="address">{{$etbs->adresse}}</div>
          <div class="email"><a href="mailto:{{$etbs->email}}">{{$etbs->email}}</a></div>
        </div>
        <div id="invoice">
          <h3>Facture N°{{$fac}} {{$da}}</h3>
          <div class="date">Date de facturation: {{$date}}</div>
        </div>
      </div>
      <table border="0" cellspacing="0" cellpadding="0" >
        <thead>
          <tr>
            <th class="noh">#</th>
            <th class="desc">Malade</th>
            <th class="unit">Lieu Dep</th>
            <th class="qty">Lieu Arriv</th>
            <th class="unit">Condition transp</th>
            <th class="totalh">Prix</th>
          </tr>
        </thead>
        <tbody>
          @foreach($missions as $mission)
          <tr>
            <td class="no">{{$i}}</td>
            <td class="desc">
                <span>{{$mission->nom}} {{$mission->prenom}}</span><br>
                <span>{{$mission->adresse}} </span><br>
                <span>{{$mission->tel}} </span><br>
                <span>{{$mission->email}} </span>
            </td>
            <td class="unit">{{$mission->adresseDep}}</td>
            <td class="qty">{{$mission->adresseArriv}}</td>
            <td class="unit">{{$mission->conditionTransp}}</td>
            <td class="total">{{$mission->prix}}€</td>
          </tr>
          {{$i=$i+1}}
          {{$prixht = $prixht + $mission->prix}}
          @endforeach
        
        </tbody>
        <tfoot>
          <tr>
            <td colspan="2"></td>
            <td colspan="2">TOTAL HT</td>
            <td>{{$prixht}}€</td>
          </tr>
          <tr>
            <td colspan="2"></td>
            <td colspan="2">TAX 25%</td>
            <td>{{($prixht*25)/100}}€</td>
          </tr>
          <tr>
            <td colspan="2"></td>
            <td colspan="2">TOTAL TTC</td>
            <td>{{$prixht-($prixht*25)/100}}€</td>
          </tr>
        </tfoot>
      </table>
      <div id="notices">
        <div>NOTICE:</div>
        <div class="notice">Des frais financiers de 1,5% seront imputés sur les soldes impayés après 30 jours.</div>
      </div>
    </main>
    <footer>
    La facture a été créée sur un ordinateur et est valide sans la signature et le sceau.
    </footer>
  </body>
</html>