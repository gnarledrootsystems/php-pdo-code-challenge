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
        $query = $this->getPdoBuilder()->createPdoInstance()->query("SELECT * FROM directors");

        return $query->fetchAll();
    }

    /**
     * Use the PDOBuilder to retrieve a single director record with a given id
     *
     * @param int $id
     * @return array
     */
    public function getSingleDirectorRecord($id)
    {
        $query = $this->getPdoBuilder()->createPdoInstance()->prepare("SELECT * FROM directors WHERE id=:id");
        $query->execute(['id' => $id]);
        
        return $query->fetch();
    }

    /**
     * Use the PDOBuilder to retrieve all the business records
     *
     * @return array
     */
    public function getBusinessRecords()
    {
        $query = $this->getPdoBuilder()->createPdoInstance()->query("SELECT * FROM businesses");

        return $query->fetchAll();
    }

    /**
     * Use the PDOBuilder to retrieve a single business record with a given id
     *
     * @param int $id
     * @return array
     */
    public function getSingleBusinessRecord($id)
    {
        $query = $this->getPdoBuilder()->createPdoInstance()->prepare("SELECT * FROM businesses WHERE id=:id");
        $query->execute(['id' => $id]);
        
        return $query->fetch();
    }

    /**
     * Use the PDOBuilder to retrieve a list of all businesses registered on a particular year
     *
     * @param int $year
     * @return array
     */
    public function getBusinessesRegisteredInYear($year)
    {
        $query = $this->getPdoBuilder()->createPdoInstance()->prepare("SELECT * FROM businesses WHERE YEAR(registration_date)=:year");
        $query->execute(['year' => $year]);
        
        return $query->fetchAll();
    }

    /**
     * Use the PDOBuilder to retrieve the last 100 records in the directors table
     *
     * @return array
     */
    public function getLast100Records()
    {
        $query = $this->getPdoBuilder()->createPdoInstance()->query("SELECT * FROM directors ORDER BY id DESC LIMIT 100");
        
        return $query->fetchAll();
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
        $query = $this->getPdoBuilder()->createPdoInstance()->prepare("SELECT b.name AS business_name, CONCAT_WS('', d.first_name, d.last_name) AS director_name 
                                        FROM director_businesses AS db
                                        JOIN businesses AS b ON b.id = db.business_id
                                        JOIN directors AS d ON d.id = db.director_id");
        $query->execute();
        
        return $query->fetchAll();
    }

    /**
     * Use the PDOBuilder to retrieve a list of the business id, name, address and registration number as well as the linked
     * director name.
     * 
     * @return array
     */
    public function getRecords()
    {
        $query = $this->getPdoBuilder()->createPdoInstance()->prepare("SELECT b.id, d.first_name, d.last_name, b.name, b.registered_address, b.registration_number 
                                        FROM director_businesses AS db
                                        JOIN businesses AS b ON b.id = db.business_id
                                        JOIN directors AS d ON d.id = db.director_id");
        $query->execute();
        
        return $query->fetchAll();
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