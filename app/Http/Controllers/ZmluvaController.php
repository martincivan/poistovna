<?php

namespace App\Http\Controllers;

use App\ApiClient\client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ZmluvaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $client = new \SoapClient('http://labss2.fiit.stuba.sk/pis/ws/Students/Team095zmluva?WSDL');
        $email = Auth::user()->email;
        $user_client = new \SoapClient('http://labss2.fiit.stuba.sk/pis/ws/Students/Team095zakaznik?WSDL');
        $user_id = $user_client->getByAttributeValue(['attribute_name' => 'email', 'attribute_value' => $email, 'ids' => []])->zakazniks->zakaznik->id;

        $zmluvas = $client->getByAttributeValue(['attribute_name' => 'zakaznik_id', 'attribute_value' => $user_id, 'ids' => []])->zmluvas;
        if (!property_exists($zmluvas, 'zmluva')) {
            $zmluvy = [];
        } else {
            $zmluvy = $zmluvas->zmluva;
        }
        if (is_object($zmluvy)) {
            $zmluvy = array($zmluvy);
        }

        return view('home', ['zmluvy'=> $zmluvy]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $produkt_client = new \SoapClient('http://labss2.fiit.stuba.sk/pis/ws/Students/Team095produkt?WSDL');
        $produkt = $produkt_client->getByID(['id' => $request->produkt_id])->produkt;
        $email = Auth::user()->email;
        $user_client = new \SoapClient('http://labss2.fiit.stuba.sk/pis/ws/Students/Team095zakaznik?WSDL');
        $user = $user_client->getByAttributeValue(['attribute_name' => 'email', 'attribute_value' => $email, 'ids' => []])->zakazniks->zakaznik;

        $nova_zmluva = [
            "id" => null,
            "name" => $user->meno.' - '.$produkt->nazov,
            "stav" => 1,
            "zaciatok" => $request->zaciatok,
            "koniec" => $request->koniec,
            "produkt_id" => $request->produkt_id,
            "zakaznik_id" => $user->id,
            "zdovodnenie" => null,
            "predchadzajuca_zmluva" => $request->predchadzajuca_zmluva
        ];
        $zmluva_client = new \SoapClient('http://labss2.fiit.stuba.sk/pis/ws/Students/Team095zmluva?WSDL');

        $id = $zmluva_client->insert(["team_id" => client::TEAM_ID, "team_password" => client::TEAM_PWD, "zmluva" => $nova_zmluva]);
        return view('ok', ['akcia' => 'Vytvorenie žiadosti', 'sprava' => 'Žiadosť o zmenu zmluvy bola zaznamenaná. (#'.$id->id.')', 'redirect' => '/home']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $zmluva_client = new \SoapClient('http://labss2.fiit.stuba.sk/pis/ws/Students/Team095zmluva?WSDL');
        $zmluva = $zmluva_client->getByID(['id' => $id])->zmluva;
        $produkt_client = new \SoapClient('http://labss2.fiit.stuba.sk/pis/ws/Students/Team095produkt?WSDL');
        $produkts = $produkt_client->getAll()->produkts;
        if (!property_exists($produkts, 'produkt')) {
            $produkty = [];
        } else {
            $produkty = $produkts->produkt;
        }
        if (is_object($produkty)) {
            $produkty = array($produkty);
        }
        return view('upravazmluvy', ['produkty' => $produkty, 'zmluva' => $zmluva]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function potvrdenie_formular()
    {
        $zmluva_client = new \SoapClient('http://labss2.fiit.stuba.sk/pis/ws/Students/Team095zmluva?WSDL');
        $zmluvas = $zmluva_client->getByAttributeValue(['attribute_name' => 'stav', 'attribute_value' => 1, 'ids' => []])->zmluvas;
        //1 - podana ziadost, 2 - prijata, 3 - zamietnuta
        $zakaznik_client = new \SoapClient('http://labss2.fiit.stuba.sk/pis/ws/Students/Team095zakaznik?WSDL');
        $produkt_client = new \SoapClient('http://labss2.fiit.stuba.sk/pis/ws/Students/Team095produkt?WSDL');

        if (!property_exists($zmluvas, 'zmluva')) {
            $zmluvy = [];
        } else {
            $zmluvy = $zmluvas->zmluva;
        }
        if (is_object($zmluvy)) {
            $zmluvy = array($zmluvy);
        }
        foreach ($zmluvy as $zmluva) {
            $zmluva->zakaznik = $zakaznik_client->getByID(['id' => $zmluva->zakaznik_id])->zakaznik;
            $zmluva->produkt = $produkt_client->getByID(['id' => $zmluva->produkt_id])->produkt;
        }

        return view('biznis.potvrdenie', ['zmluvy' => $zmluvy]);
    }

    public function potvrd($id)
    {
        $zmluva_client = new \SoapClient('http://labss2.fiit.stuba.sk/pis/ws/Students/Team095zmluva?WSDL');
        $zmluva = $zmluva_client->getByID(['id' => $id])->zmluva;
        $zmluva->stav = 2;
        $zmluva_client->update(["team_id" => client::TEAM_ID, "team_password" => client::TEAM_PWD, "entity_id" => $id, "zmluva" => $zmluva]);

        return view('ok', ['akcia' => 'Potvrdenie žiadosti', 'sprava' => 'Žiadosť o zmluvu bola potvrdená', 'redirect' => '/potvrdenie']);
    }

    public function zamietni($id, Request $r)
    {
        $zmluva_client = new \SoapClient('http://labss2.fiit.stuba.sk/pis/ws/Students/Team095zmluva?WSDL');
        $zmluva = $zmluva_client->getByID(['id' => $id])->zmluva;
        $zmluva->stav = 3;
        $zmluva->zdovodnenie = $r->zdovodnenie;
        $zmluva_client->update(["team_id" => client::TEAM_ID, "team_password" => client::TEAM_PWD, "entity_id" => $id, "zmluva" => $zmluva]);

        $posta = new \SoapClient('http://labss2.fiit.stuba.sk/pis/ws/NotificationServices/Mail?WSDL');

        $str = <<<EOD
Dobrý deň,

s poľutovaním Vám musíme oznámiť, že vaša žiadosť bola zamietnutá z nasledovného dôvodu:
$zmluva->zdovodnenie

S pozdravom

Vasa poistovna domacich milacikov.
EOD;

        $user_client = new \SoapClient('http://labss2.fiit.stuba.sk/pis/ws/Students/Team095zakaznik?WSDL');
        $user = $user_client->getById(['id' => $zmluva->zakaznik_id])->zakaznik;

        $emaile = new \SoapClient('http://labss2.fiit.stuba.sk/pis/ws/NotificationServices/Email?WSDL');
        $posta = new \SoapClient('http://labss2.fiit.stuba.sk/pis/ws/NotificationServices/Mail?WSDL');

        $predmet = "Vasa poistovna - zamietnutie ziadosti";

        switch ($user->komunikacia) {
            case 1:
                $emaile->notify(["team_id" => client::TEAM_ID, "password" => client::TEAM_PWD, "subject" => $predmet,
                    "message" => $str, "email" => $user->email]);
                break;
            case 2:
                $posta->notify(["team_id" => client::TEAM_ID, "password" => client::TEAM_PWD, "subject" => $predmet,
                    "message" => $str, "address" => $user->adresa]);
                break;
        }


        return view('ok', ['akcia' => 'Zamietnutie žiadosti', 'sprava' => 'Žiadosť o zmluvu bola zamietnutá', 'redirect' => '/potvrdenie']);
    }

    public function zdovodnenie($id)
    {
        $zmluva_client = new \SoapClient('http://labss2.fiit.stuba.sk/pis/ws/Students/Team095zmluva?WSDL');
        $zmluva = $zmluva_client->getByID(['id' => $id])->zmluva;

        return view('biznis.zdovodnenie', ['zmluva' => $zmluva]);
    }
}
