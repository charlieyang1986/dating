<?php

/**
 * Class Controller
 */
class Controller
{
    private $_f3; // router
    private $_validator; //validation object

    /**
     * Controller constructor.
     * @param $f3
     * @param $validator
     */
    public function __construct($f3, $validator)
    {
        $this->_f3 = $f3;
        $this->_validator = $validator;
    }

    // represent default route

    /**
     * display the default route
     */
    public function home()
    {
        $view = new Template();
        echo $view->render('views/datingHome.html');
    }

    /**
     * process the personal info includes name, age, gender, phone number
     */
    public function personalInfo()
    {
        $gender = getGender();
        //If the form has been submitted
        if($_SERVER['REQUEST_METHOD'] == 'POST') {


            //Data is valid

            //alternative way is to used   !$GLOBALS['validator']->validName($_POST['fName'],$_POST['lName'])
            if(!$this->_validator->validName($_POST['fName'],$_POST['lName'])){

                // set an error variable in the F3 hive
                $this->_f3->set('errors["name"]', "Enter a valid name");
            }

            if(!$this->_validator->validAge($_POST['age'])){
                //set an error variable in the F3 hive
                $this->_f3->set('errors["age"]', "Please enter number between 18 and 118");
            }

            if(!$this->_validator->validPhone($_POST['phoneNumber'])){
                //set an error variable in the F3 hive
                $this->_f3->set('errors["phoneNumber"]', "Please enter a valid phone number");
            }



            if(empty( $this->_f3->get('errors'))){

                //Create a member object
                $member = new Member();
                $member->setFirstName($_POST['fName']);
                $member->setLastName($_POST['lName']);
                $member->setAge($_POST['age']);
                $member->setGender($_POST['gender']);
                $member->setPhone($_POST['phoneNumber']);




                //Store the object in the session array
                $_SESSION['member'] = $member;

//            $_SESSION['fName'] = $_POST['fName'];
//            $_SESSION['lName'] = $_POST['lName'];
//            $_SESSION['age'] = $_POST['age'];
//            $_SESSION['genders'] = $_POST['gender'];
//            $_SESSION['phoneNumber'] = $_POST['phoneNumber'];

                //Direct to profile page
                $this->_f3->reroute('profile');

            }
        }


        $this->_f3->set('fName', $_POST['fName']);
        $this->_f3->set('lName', $_POST['lName']);
        $this->_f3->set('age', $_POST['age']);
        $this->_f3->set('genders', $gender);
        $this->_f3->set('phoneNumber', $_POST['phoneNumber']);
        $this->_f3->set('selectedGender', $_POST['gender']);


        $view = new Template();
        echo $view->render('views/personalInfo.html');

    }

    /**
     *
     */
    public function profile()
    {
        // $state = getState();
        $seeking = getSeeking();

        //If the form has been submitted
        if($_SERVER['REQUEST_METHOD'] == 'POST') {



            if(!$this->_validator->validEmail($_POST['email'])){
                $this->_f3->set('errors["email"]', "Please enter a valid email");
            }

            if(empty( $this->_f3->get('errors'))) {

                //Add the data to the object in the session array
                $_SESSION['member']->setEmail($_POST['email']);
                $_SESSION['member']->setState($_POST['state']);
                $_SESSION['member']->setSeeking($_POST['seeking']);


//            $_SESSION['email'] = $_POST['email'];
//            $_SESSION['state'] = $_POST['state'];
//            $_SESSION['seeking'] = $_POST['seeking'];

                //Redirect to summary page
                $this->_f3->reroute('interests');
            }

        }

        $this->_f3->set('email', $_POST['email']);
        $this->_f3->set('state', $_POST['state']);
        $this->_f3->set('seekings', $seeking);
        $this->_f3->set('selectedSeeking', $_POST['seeking']);


        $view = new Template();
        echo $view->render('views/profile.html');
    }

    /**
     *
     */
    public function interest()
    {
        $indoors = getIndoor();
        $outdoors = getOutdoor();




        //If the form has been submitted
        if($_SERVER['REQUEST_METHOD'] == 'POST') {

            if(isset($_POST['outdoors']) && !$this->_validator->validOutdoor($_POST['outdoors'])){
                $this->_f3->set('errors["outdoors"]', "Invalid option");
            }

            if(isset($_POST['indoors']) && !$this->_validator->validIndoor($_POST['indoors'])){
                $this->_f3->set('errors["indoors"]', "Invalid option");
            }


            if(empty($this->_f3->get('errors'))) {

                //Store the data in the session array
                $_SESSION['outdoors'] = $_POST['outdoors'];
                $_SESSION['indoors'] = $_POST['indoors'];
                //Redirect to summary page
                $this->_f3->reroute('summary');

            }

        }
        $this->_f3->set('outdoors', $outdoors);
        $this->_f3->set('indoors', $indoors);


        $view = new Template();
        echo $view->render('views/interests.html');
    }

    /**
     *
     */
    public function summary()
    {
        $view = new Template();
        echo $view->render('views/summary.html');

        session_destroy();
    }
}