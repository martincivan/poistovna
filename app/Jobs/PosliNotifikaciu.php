<?php

namespace App\Jobs;

use App\ApiClient\client;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class PosliNotifikaciu implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $nazov;
    private $popis;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($nazov, $popis)
    {
        $this->nazov = $nazov;
        $this->popis = $popis;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $hento = new \SoapClient('http://labss2.fiit.stuba.sk/pis/ws/Students/Team095zakaznik?WSDL');
        $emaile = new \SoapClient('http://labss2.fiit.stuba.sk/pis/ws/NotificationServices/Email?WSDL');
        $posta = new \SoapClient('http://labss2.fiit.stuba.sk/pis/ws/NotificationServices/Mail?WSDL');

        $str = <<<EOD
Dobrý deň,

radi by sme Vám týmto chceli oznámiť, že nový produkt
$this->nazov je už zaradený v našej ponuke.


$this->popis

S pozdravom

Vasa poistovna domacich milacikov.
EOD;
        $predmet = "Vasa poistovna - novy produkt v platnosti";

        $luda = $hento->getAll()->zakazniks->zakaznik;

        foreach ($luda as $lud) {
            switch ($lud->komunikacia) {
                case 1:
                    $emaile->notify(["team_id" => client::TEAM_ID, "password" => client::TEAM_PWD, "subject" => $predmet,
                        "message" => $str, "email" => $lud->email]);
                    break;
                case 2:
                    $posta->notify(["team_id" => client::TEAM_ID, "password" => client::TEAM_PWD, "subject" => $predmet,
                        "message" => $str, "address" => $lud->adresa]);
                    break;
            }
        }

    }
}
