<?php
namespace App\Helpers;
class Exchange
{

    /**
     * @var string
     */
    protected $url = '';

    /**
     * @var false|string
     */
    protected $xmlDocument = "";


    /**
     * @var string
     */
    public $date = "";


    /**
     * @var array
     */
    protected $currency = array();


    /**
     * cursBnrXML class constructor
     *
     * @access		public
     * @param 		$url		string
     * @return		void
     */
    public function __construct($url = 'https://www.bnr.ro/nbrfxrates.xml')
    {
        $this->xmlDocument = file_get_contents($url);
        $this->parseXMLDocument();
    }

    /**
     * parseXMLDocument method
     *
     * @access		public
     * @return 		void
     */
    protected function parseXMLDocument()
    {
        $xml = new \SimpleXMLElement($this->xmlDocument);

        $this->date=$xml->Header->PublishingDate;

        foreach($xml->Body->Cube->Rate as $line)
        {
            $this->currency[]=array("name"=>$line["currency"], "value"=>$line, "multiplier"=>$line["multiplier"]);
        }
    }

    /**
     * @param $currency
     * @return mixed|string
     */
    public function getExchangeRate($currency)
    {
        foreach($this->currency as $line)
        {
            $line = json_decode(json_encode($line),true);

            if($line["name"][0]==$currency)
            {
                return $line["value"][0];
            }
        }

        return "Incorrect currency!";
    }
}
