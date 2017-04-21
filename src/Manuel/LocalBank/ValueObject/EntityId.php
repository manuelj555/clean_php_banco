<?php
/**
 * User: manuel
 * Date: 20-04-2017
 */

namespace Manuel\LocalBank\ValueObject;

/**
 * @author maguirre <maguirre@developerplace.com>
 */
class EntityId
{
    /**
     * @var string
     */
    private $id;

    /**
     * EntityId constructor.
     *
     * @param string $id
     */
    public function __construct(string $id = null)
    {
        $this->id = $id ?? time();
    }

    /**
     * @return string
     */
    public function getId() :string
    {
        return $this->id;
    }

    public function __toString()
    {
        return (string)$this->getId();
    }

}