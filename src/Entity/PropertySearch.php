<?php

namespace App\Entity;

class PropertySearch
{
    /**
     * Recherche par kilomètrage
     *
     * @var int|null
     */
    private $kilometerMin;

    /**
     * Recherche par kilomètrage
     *
     * @var int|null
     */
    private $kilometerMax;

    /**
     * Recherche par prix
     *
     * @var int|null
     */
    private $priceMin;

     /**
     * Recherche par prix
     *
     * @var int|null
     */
    private $priceMax;

    /**
     * Recherche par année
     *
     * @var int|null
     */
    private $yearMin;

    /**
     * Recherche par année
     *
     * @var int|null
     */
    private $yearMax;

    /**
     * Recherche par année
     *
     * @var int|null
     */
    private $sortBy;

    /**
     * Undocumented variable
     *
     * @var integer
     */
        public $page = 1;

   

    

    /**
     * Get recherche par kilomètrage
     *
     * @return  int|null
     */ 
    public function getKilometerMin()
    {
        return $this->kilometerMin;
    }

    /**
     * Set recherche par kilomètrage
     *
     * @param  int|null  $kilometerMin  Recherche par kilomètrage
     *
     * @return  self
     */ 
    public function setKilometerMin($kilometerMin)
    {
        $this->kilometerMin = $kilometerMin;

        return $this;
    }

    /**
     * Get recherche par kilomètrage
     *
     * @return  int|null
     */ 
    public function getKilometerMax()
    {
        return $this->kilometerMax;
    }

    /**
     * Set recherche par kilomètrage
     *
     * @param  int|null  $kilometerMax  Recherche par kilomètrage
     *
     * @return  self
     */ 
    public function setKilometerMax($kilometerMax)
    {
        $this->kilometerMax = $kilometerMax;

        return $this;
    }

    /**
     * Get recherche par prix
     *
     * @return  int|null
     */ 
    public function getPriceMin()
    {
        return $this->priceMin;
    }

    /**
     * Set recherche par prix
     *
     * @param  int|null  $price  Recherche par prix
     *
     * @return  self
     */ 
    public function setPriceMin($priceMin)
    {
        $this->priceMin = $priceMin;

        return $this;
    }

    /**
     * Get recherche par prix
     *
     * @return  int|null
     */ 
    public function getPriceMax()
    {
        return $this->priceMax;
    }

    /**
     * Set recherche par prix
     *
     * @param  int|null  $priceMax  Recherche par prix
     *
     * @return  self
     */ 
    public function setPriceMax($priceMax)
    {
        $this->priceMax = $priceMax;

        return $this;
    }

    /**
     * Get recherche par année
     *
     * @return  int|null
     */ 
    public function getYearMin()
    {
        return $this->yearMin;
    }

    /**
     * Set recherche par année
     *
     * @param  int|null  $yearMin  Recherche par année
     *
     * @return  self
     */ 
    public function setYearMin($yearMin)
    {
        $this->yearMin = $yearMin;

        return $this;
    }

    /**
     * Get recherche par année
     *
     * @return  int|null
     */ 
    public function getYearMax()
    {
        return $this->yearMax;
    }

    /**
     * Set recherche par année
     *
     * @param  int|null  $yearMax  Recherche par année
     *
     * @return  self
     */ 
    public function setYearMax($yearMax)
    {
        $this->yearMax = $yearMax;

        return $this;
    }

    /**
     * Get recherche par année
     *
     * @return  int|null
     */ 
    public function getSortBy()
    {
        return $this->sortBy;
    }

    /**
     * Set recherche par année
     *
     * @param  int|null  $sortBy  Recherche par année
     *
     * @return  self
     */ 
    public function setSortBy($sortBy)
    {
        $this->sortBy = $sortBy;

        return $this;
    }
}