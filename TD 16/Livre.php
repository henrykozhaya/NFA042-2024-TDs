<?php
class Livre {
    private $titre;
    private $auteur;
    private $prix;
    private $anneePublication;

    public function __construct($titre, $auteur, $prix, $anneePublication) {
        $this->titre = $titre;
        $this->auteur = $auteur;
        $this->prix = $prix;
        $this->anneePublication = $anneePublication;
    }

    public function setTitre($titre) {
        $this->titre = $titre;
    }

    public function getTitre() {
        return $this->titre;
    }

    public function setAuteur($auteur) {
        $this->auteur = $auteur;
    }

    public function getAuteur() {
        return $this->auteur;
    }

    public function setPrix($prix) {
        $this->prix = $prix;
    }

    public function getPrix() {
        return $this->prix;
    }

    public function setAnneePublication($anneePublication) {
        $this->anneePublication = $anneePublication;
    }

    public function getAnneePublication() {
        return $this->anneePublication;
    }
}