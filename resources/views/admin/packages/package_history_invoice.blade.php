<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Invoice</title>

    <style type="text/css">
        * {
            font-family: Verdana, Arial, sans-serif;
        }
        table{
            font-size: x-small;
        }
        tfoot tr td{
            font-weight: bold;
            font-size: x-small;
        }
        .gray {
            background-color: lightgray
        }
        .font{
        font-size: 15px;
        }
        .authority {
            /*text-align: center;*/
            float: right
        }
        .authority h5 {
            margin-top: -10px;
            color: green;
            /*text-align: center;*/
            margin-left: 35px;
        }
        .thanks p {
            color: green;;
            font-size: 16px;
            font-weight: normal;
            font-family: serif;
            margin-top: 20px;
        }
    </style>

</head>
<body>

    <table width="100%" style="background: #F7F7F7; padding:0 20px 0 20px;">
        <tr>
            <td valign="top">
                <!-- {{-- <img src="" alt="" width="150"/> --}} -->
                <h2 style="color: darkblue; font-size: 26px;">
                    <strong>
                        MalickRoi
                    </strong>
                </h2>
            </td>
            <td align="right">
                <pre class="font">
                    Contactez-nous:
                    Email : worldpython3@gmail.com <br>
                    Téléphone : +224 628 00 00 00 <br>
                    Conakry 872, Rép. de Guinée:#4 <br>
                </pre>
            </td>
        </tr>
    </table>

    <table width="100%" style="background:white; padding:2px;"></table>

    <table width="100%" style="background: #F7F7F7; padding:0 5 0 5px;" class="font">
        <tr>
            <td>
                <p class="font" style="margin-left: 20px;">
                    <strong>Agent : </strong> {{ $packageData['Users']['name'] }} <br>
                    <strong>Email : </strong> {{ $packageData['Users']['name'] }} <br>
                    <strong>Téléphone : </strong> {{ $packageData['Users']['phone'] }} <br>
                    <strong>Adresse : </strong>{{ $packageData['Users']['address'] }}
                </p>
            </td>
            <td>
                <p class="font">
                    <h3>
                        <span style="color: darkblue;">Facture N° : </span>
                        #{{ $packageData->invoice }}
                    </h3>
                    Date facturation : {{ $packageData->created_at }} <br>
                    Mode de paiement : COD </span>
                </p>
            </td>
        </tr>
    </table>
    <br/>

    <h3>Forfait Propriété </h3>

    <table width="100%">
        <thead style="background-color: darkblue; color:#FFFFFF;">
            <tr class="font">
                <th>Nom du forfait </th>
                <th class="text-end">Nombre de propriétés</th>
                <th class="text-end">Prix unitaire</th>
                <th class="text-end">Total</th>
            </tr>
        </thead>
        <tbody>

            <tr class="font">
                <td align="center">{{ $packageData->package_name }}</td>
                <td align="center">{{ $packageData->package_credits }}</td>
                <td align="center">$ {{ $packageData->package_amount }}</td>
                <td align="center">$ {{ $packageData->package_amount }}</td>
            </tr>

        </tbody>
    </table>

    <div class="thanks mt-3">
        <p>Merci d'avoir effectué cet achat..!!</p>
    </div>
    <div class="authority float-right mt-5">
        <p>-----------------------------------</p>
        <h5 style="color: darkblue;">Signature des autorités:</h5>
    </div>
</body>
</html>
