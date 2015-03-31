<?php

class AdminModule extends CWebModule 
{
    static private $_admins;
    
    public function init() {
        // this method is called when the module is being created
        // you may place code here to customize the module or the application
        // import the module-level models and components
        $this->setImport(array(
            'admin.models.*',
            'admin.components.*',
            'news.models.*',
            'news.components.*',
        ));
    }

    public function beforeControllerAction($controller, $action) {
        if (parent::beforeControllerAction($controller, $action)) {
            // this method is called before any module controller action is performed
            // you may place customized code here
            return true;
        }
        else
            return false;
    }

    /**
     * Return admins.
     * @return array syperusers names
     */
    public static function getAdmins() {
        if (!self::$_admins) {
            $admins = User::model()->active()->superuser()->findAll();
            $return_name = array();
            foreach ($admins as $admin) {
                array_push($return_name, $admin->username);
            }

            self::$_admins = ($return_name) ? $return_name : array('');
        }
        return self::$_admins;
    }
}
