<?php

namespace Otto;

class Challenge
{
    protected $pdoBuilder;

    public function __construct()
    {
        $config = require __DIR__ . '/../config/database.config.php';
        $this->setPdoBuilder(new PdoBuilder($config));
    }

    /**
     * Use the PDOBuilder to retrieve all the director records
     *
     * @return array
     */
    public function getDirectorRecords()
    {
        //..
    }

    /**
     * Use the PDOBuilder to retrieve a single director record with a given id
     *
     * @param int $id
     * @return array
     */
    public function getSingleDirectorRecord($id)
    {
        //..
    }

    /**
     * Use the PDOBuilder to retrieve all the business records
     *
     * @return array
     */
    public function getBusinessRecords()
    {
        //..
    }

    /**
     * Use the PDOBuilder to retrieve a single business record with a given id
     *
     * @param int $id
     * @return array
     */
    public function getSingleBusinessRecord($id)
    {
        //..
    }

    /**
     * Use the PDOBuilder to retrieve a list of all businesses registered on a particular year
     *
     * @param int $year
     * @return array
     */
    public function getBusinessesRegisteredInYear($year)
    {
        //..
    }

    /**
     * Use the PDOBuilder to retrieve the last 100 records in the directors table
     *
     * @return array
     */
    public function getLast100Records()
    {
        //..
    }

    /**
     * Use the PDOBuilder to retrieve a list of all business names with the director's name in a separate column.
     * The links between directors and businesses are located inside the director_businesses table.
     *
     * Your result schema should look like this;
     *
     * | business_name | director_name |
     * ---------------------------------
     * | some_company  | some_director |
     *
     * @return array
     */
    public function getBusinessNameWithDirectorFullName()
    {
        //..
    }

    /**
     * @param PdoBuilder $pdoBuilder
     * @return $this
     */
    public function setPdoBuilder(PdoBuilder $pdoBuilder)
    {
        $this->pdoBuilder = $pdoBuilder;
        return $this;
    }

    /**
     * @return PdoBuilder
     */
    public function getPdoBuilder()
    {
        return $this->pdoBuilder;
    }
}