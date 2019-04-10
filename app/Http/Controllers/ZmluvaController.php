<?php

namespace App\Http\Controllers;

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

        $zmluvy = $client->getByAttributeValue(['attribute_name' => 'zakaznik_id', 'attribute_value' => $user_id, 'ids' => []])->zmluvas->zmluva;

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
        //
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
        $produkty = $produkt_client->getAll()->produkts->produkt;

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

    public function potvrdenie()
    {
        $zmluva_client = new \SoapClient('http://labss2.fiit.stuba.sk/pis/ws/Students/Team095zmluva?WSDL');
        $zmluvy = $zmluva_client->getByAttributeValue(['attribute_name' => 'stav', 'attribute_value' => 1, 'ids' => []])->zmluvas->zmluva;
        //1 - podana ziadost, 2 - prijata, 3 - zamietnuta
        $zakaznik_client = new \SoapClient('http://labss2.fiit.stuba.sk/pis/ws/Students/Team095zakaznik?WSDL');
        $produkt_client = new \SoapClient('http://labss2.fiit.stuba.sk/pis/ws/Students/Team095produkt?WSDL');

        foreach ($zmluvy as $zmluva) {
            $zmluva->zakaznik = $zakaznik_client->getByID(['id' => $zmluva->zakaznik_id])->zakaznik;
            $zmluva->produkt = $produkt_client->getByID(['id' => $zmluva->produkt_id])->produkt;
        }

        return view('biznis.potvrdenie', ['zmluvy' => $zmluvy]);
    }
}
