<?php

namespace App\Http\Controllers;

use App\ApiClient\client;
use App\Jobs\PosliNotifikaciu;
use Illuminate\Http\Request;


//include "app\ApiClient\Team095produktSoapClient.php";

class ProduktController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        echo("OK");
        $obj = [
            'id' => 100,
            'name' => $request->get('nazov'),
            'nazov' => $request->get('nazov'),
            'cena' => 5.99,
            'zaciatok' => "2010-01-01",
            'schvalene' => "2010-01-01",
            'koniec' => "2010-01-01",
            'popis' => "popis" ];
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $client = new \SoapClient('http://labss2.fiit.stuba.sk/pis/ws/Students/Team095produkt?WSDL');
        $obj = [
            "name" => $request->get('nazov'),
            "nazov" => $request->get('nazov'),
            "cena" => $request->get('cena'),
            "zaciatok" => $request->get('zaciatok'),
            "koniec" => $request->get('koniec'),
            "popis" => $request->get('popis'),
            "id" => null,
            "schvalene" => null,
        ];
        $id = $client->insert(["team_id" => client::TEAM_ID, "team_password" => client::TEAM_PWD, "produkt" => $obj]);


        $date = new \DateTime($request->get('zaciatok'));

        $delay = $date->getTimestamp() - now()->getTimestamp();
        if ($delay <= 0) {
            $delay = 5;
        }

        $job = (new PosliNotifikaciu($request->get('nazov'), $request->get('popis')))->delay($delay);

        $this->dispatch($job);

        return view('ok', ['akcia' => 'Pridanie nového produktu', 'sprava' => 'Produkt: '.$obj['name'].' bol pridaný a začne platiť '.$obj['zaciatok'], 'redirect' => '/novyprodukt']);
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
        //
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
}
