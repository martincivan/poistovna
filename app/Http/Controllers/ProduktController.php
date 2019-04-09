<?php

namespace App\Http\Controllers;

use App\ApiClient\client;
use Illuminate\Http\Request;


include "/srv/http/pis/poistovna/app/ApiClient/Team095produktSoapClient.php";

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
        $obj = new \produktType();
        $obj->name = $request->get('nazov');
        $obj->nazov = $request->get('nazov');
        $obj->cena = $request->get('cena');
        $obj->zaciatok =$request->get('zaciatok');;
        $obj->koniec = $request->get('koniec');;
        $obj->popis = $request->get('popis');
        $id = $client->insert(["team_id" => client::TEAM_ID, "team_password" => client::TEAM_PWD, "produkt" => $obj]);
        return null;
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
