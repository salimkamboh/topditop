<?php

namespace App\Helpers;

class ImportRow
{
    /**
     * @var string
     *
     * Fa.
     */
    public $company;

    /**
     * @var string
     *
     * AP
     */
    public $title;

    /**
     * @var string
     *
     * Vorname
     */
    public $firstName;

    /**
     * @var string
     *
     * Nachname
     */
    public $lastName;

    /**
     * @var string
     *
     * Straße
     */
    public $street;

    /**
     * @var string
     *
     * Hausnr.
     */
    public $houseNumber;

    /**
     * @var string
     *
     * Adresszusatz
     */
    public $additionalAddressInfo;

    /**
     * @var string
     *
     * PLZ
     */
    public $postalCode;

    /**
     * @var string
     *
     * Ort
     */
    public $city;


    /**
     * @var integer
     */
    public $location_id;

    /**
     * @var string
     *
     * Telefon
     */
    public $phone;

    /**
     * @var string
     *
     * Email
     */
    public $email;

    /**
     * @var string
     *
     * Fax
     */
    public $fax;

    /**
     * @var string
     *
     * Website
     */
    public $website;

    /**
     * @var string
     *
     * Mail
     */
    public $mail;

    /**
     * @var boolean
     */
    public $valid;

    /**
     * @var string
     */
    public $note = "";

    /**
     * latitude determined by geocode lookup
     *
     * @var double
     */
    public $latitude;

    /**
     * longitude determined by geocode lookup
     *
     * @var double
     */
    public $longitude;

    /**
     * Brand (manufacurer) ids in raw format
     *
     * @var string
     */
    public $brandIdsRaw;

    public function getBrandIds()
    {
        preg_match_all('!\d+!', $this->brandIdsRaw, $matches);

        return collect($matches)->flatten()->map(function ($member) { return (int) $member; })->toArray();
    }


    public function addNote(string $note)
    {
        if ($this->note) {
            $this->note .= ", $note";
            return;
        }
        $this->note = $note;
    }


}