<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SdsData
 *
 * @ORM\Table(name="sds_data")
 * @ORM\Entity
 */
class SdsData
{
    /**
     * @var string
     *
     * @ORM\Column(name="title_sds", type="string", length=200, nullable=false)
     */
    public $titleSds;

    /**
     * @var string
     *
     * @ORM\Column(name="manufac_sds", type="string", length=150, nullable=false)
     */
    public $manufacSds;

    /**
     * @var string
     *
     * @ORM\Column(name="item_sds", type="string", length=5, nullable=false)
     */
    public $itemSds;

    /**
     * @var string
     *
     * @ORM\Column(name="dir_file_sds", type="string", length=100, nullable=false)
     */
    public $dirFileSds;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_sds", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    public $idSds;


    public function getIdsds() {
        return $this->idSds;
    }

    public function setIdsds($idSds) {
      $this->idSds= $idSds;
    }

    public function getTitlesds() {
        return $this->titleSds;
    }

    public function setTitlesds($titleSds) {
      $this->titleSds= $titleSds;
    }

    public function getManufacsds() {
        return $this->manufacSds;
    }

    public function setManufacsds($manufacSds) {
      $this->manufacSds= $manufacSds;
    }

    public function getDirfilesds() {
        return $this->dirFileSds;
    }

    public function setDirfilesds($dirFileSds) {
      $this->dirFileSds = $dirFileSds;
    }

    public function getItemsds() {
        return $this->itemSds;
    }

    public function setItemsds($itemSds) {
      $this->itemSds= $itemSds;
    }


}
