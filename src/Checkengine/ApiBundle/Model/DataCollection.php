<?php

namespace Checkengine\DashboardBundle\Model;

class DataCollection
{
    /**
     * @var Note[]
     */
    public $notes;
    /**
     * @var integer
     */
    public $offset;
    /**
     * @var integer
     */
    public $limit;
    /**
     * @param Note[]  $notes
     * @param integer $offset
     * @param integer $limit
     */
    public function __construct($datos = array(), $offset = null, $limit = null)
    {
        $this->data = $datos;
        $this->offset = $offset;
        $this->limit = $limit;
    }
}