<?php
class Member
{
    //Declare instance variables
    private $_fname;
    private $_lname;
    private $_age;
    private $_gender;
    private $_phone;
    private $_email;
    private $_state;
    private $_seeking;
    private $_bio;

    /**
     * Default constructor
     */

    public function __construct($_fname,$_lname,$_age,$_gender,$_phone)
    {
        $this->_fname = $_fname;
        $this->_lname = $_lname;
        $this->_age = $_age;
        $this->_gender = $_gender;
        $this->_gender = $_phone;
    }

    /** Set the first name
     * @param $_fname the first name
     */
    public function setFirstName($_fname)
    {
        $this->_fname = $_fname;
    }

    /** Get the first name
     * @return the first name
     */
    public function getFirstName()
    {
        return $this->_fname;
    }


    /**
     * @return last name
     */
    public function getLastName()
    {
        return $this->_lname;
    }

    /**
     * @param  $_lname last name
     */
    public function setLastName($_lname)
    {
        $this->_lname = $_lname;
    }

    /**
     * @return age
     */
    public function getAge()
    {
        return $this->_age;
    }

    /**
     * @param  $_age is the age
     */
    public function setAge($_age)
    {
        $this->_age = $_age;
    }

    /**
     * @return gender
     */
    public function getGender()
    {
        return $this->_gender;
    }

    /**
     * @param $_gender is the gender
     */
    public function setGender($_gender)
    {
        $this->_gender = $_gender;
    }

    /**
     * @return phone number
     */
    public function getPhone()
    {
        return $this->_phone;
    }

    /**
     * @param $_phone is the phone number
     */
    public function setPhone($_phone)
    {
        $this->_phone = $_phone;
    }

    /**
     * @return email
     */
    public function getEmail()
    {
        return $this->_email;
    }

    /**
     * @param  $_email is the email
     */
    public function setEmail($_email)
    {
        $this->_email = $_email;
    }

    /**
     * @return state the member coming from
     */
    public function getState()
    {
        return $this->_state;
    }

    /**
     * @param $_state
     */
    public function setState($_state)
    {
        $this->_state = $_state;
    }

    /**
     * @return the gender the member is looking for
     */
    public function getSeeking()
    {
        return $this->_seeking;
    }

    /**
     * @param $_seeking the gender
     */
    public function setSeeking($_seeking)
    {
        $this->_seeking = $_seeking;
    }

    /**
     * @return bio
     */
    public function getBio()
    {
        return $this->_bio;
    }

    /**
     * @param $_bio member's bio
     */
    public function setBio($_bio)
    {
        $this->_bio = $_bio;
    }






    /**
     * toString() returns a String representation
     * of a member object
     * @return string
     */
    public function toString()
    {

        return $this->_fname . $this->_lname;


    }


}

$member = new Member();
echo $member->toString();
