<?php

class UloginUserIdentity implements IUserIdentity
{

    private $id;
    private $name;
    private $isAuthenticated = false;
    private $states = array();

    public function __construct()
    {
    }

    public function authenticate($uloginModel = null)
    {

        $criteria = new CDbCriteria;
        $criteria->condition = 'identity=:identity AND network=:network';
        $criteria->params = array(
            ':identity' => $uloginModel->identity
        , ':network' => $uloginModel->network
        );
        $user = User::model()->find($criteria);
        
        
        //die ("fffffffffff");

        if (null !== $user) {
            $this->id = $user->id;
            $this->name = $user->full_name;
        }
        else {
            $user = new User();
            $user->identity = $uloginModel->identity;
            $user->network = $uloginModel->network;
            $user->email = $uloginModel->email;
            $user->full_name = $uloginModel->full_name;
            $user->username = $uloginModel->full_name;
            $user->password = md5($uloginModel->identity);
            $user->create_at = date("Y-m-d H:i:s");
            
            $user->save();
            
            /*
            if(sizeof($user->erros)>0){
                return false;
            }
             * 
             */
            
            $this->id = $user->id;
            $this->name = $user->full_name;
        }
        $this->isAuthenticated = true;
        return true;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getIsAuthenticated()
    {
        return $this->isAuthenticated;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getPersistentStates()
    {
        return $this->states;
    }
}