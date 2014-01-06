<?php
require_once('autorun.php');

class unit_acl extends UnitTestCase {
	
	function test_acl(){
		new Zend_Acl();
		$acl = new Zend_Acl();
		 
		$acl->addRole(new Zend_Acl_Role('guest'))
		    ->addRole(new Zend_Acl_Role('member'))
		    ->addRole(new Zend_Acl_Role('admin'));
		 
		$parents = array('guest', 'member', 'admin');
		$acl->addRole(new Zend_Acl_Role('someUser'), $parents);
		 
		$acl->add(new Zend_Acl_Resource('someResource'));
		 
		$acl->deny('guest', 'someResource');
		$acl->allow('member', 'someResource');
		 
		echo $acl->isAllowed('someUser', 'someResource') ? 'allowed' : 'denied';
		
		$acl = new Zend_Acl();
 
		// Add groups to the Role registry using Zend_Acl_Role
		// Guest does not inherit access controls
		$roleGuest = new Zend_Acl_Role('guest');
		$acl->addRole($roleGuest);
		 
		// Staff inherits from guest
		$acl->addRole(new Zend_Acl_Role('staff'), $roleGuest);
		 
		/*
		Alternatively, the above could be written:
		$acl->addRole(new Zend_Acl_Role('staff'), 'guest');
		*/
		 
		// Editor inherits from staff
		$acl->addRole(new Zend_Acl_Role('editor'), 'staff');
		 
		// Administrator does not inherit access controls
		$acl->addRole(new Zend_Acl_Role('administrator'));
	}
	
	function test_example(){
		$acl = new Zend_Acl();
		 
		$roleGuest = new Zend_Acl_Role('guest');
		$acl->addRole($roleGuest);
		$acl->addRole(new Zend_Acl_Role('staff'), $roleGuest);
		$acl->addRole(new Zend_Acl_Role('editor'), 'staff');
		$acl->addRole(new Zend_Acl_Role('administrator'));
		 
		// Guest may only view content
		$acl->allow($roleGuest, null, 'view');
		 
		/*
		Alternatively, the above could be written:
		$acl->allow('guest', null, 'view');
		//*/
		 
		// Staff inherits view privilege from guest, but also needs additional
		// privileges
		$acl->allow('staff', null, array('edit', 'submit', 'revise'));
		 
		// Editor inherits view, edit, submit, and revise privileges from
		// staff, but also needs additional privileges
		$acl->allow('editor', null, array('publish', 'archive', 'delete'));
		 
		// Administrator inherits nothing, but is allowed all privileges
		$acl->allow('administrator');
		
		echo $acl->isAllowed('guest', null, 'view') ?
		     "allowed" : "denied";
		// allowed
		 
		echo $acl->isAllowed('staff', null, 'publish') ?
		     "allowed" : "denied";
		// denied
		 
		echo $acl->isAllowed('staff', null, 'revise') ?
		     "allowed" : "denied";
		// allowed
		 
		echo $acl->isAllowed('editor', null, 'view') ?
		     "allowed" : "denied";
		// allowed because of inheritance from guest
		 
		echo $acl->isAllowed('editor', null, 'update') ?
		     "allowed" : "denied";
		// denied because no allow rule for 'update'
		 
		echo $acl->isAllowed('administrator', null, 'view') ?
		     "allowed" : "denied";
		// allowed because administrator is allowed all privileges
		 
		echo $acl->isAllowed('administrator') ?
		     "allowed" : "denied";
		// allowed because administrator is allowed all privileges
		 
		echo $acl->isAllowed('administrator', null, 'update') ?
		     "allowed" : "denied";
	}
	
	function test_advanced_acl(){
		
		$acl = new Zend_Acl();
		$acl->allow(null, null, null, new CleanIPAssertion());
		echo " "; var_dump( $acl->isAllowed( 'wer', 'tr', 'here' ) );
		
	}
	
}

class CleanIPAssertion implements Zend_Acl_Assert_Interface
{
    public function assert(Zend_Acl $acl,
                           Zend_Acl_Role_Interface $role = null,
                           Zend_Acl_Resource_Interface $resource = null,
                           $privilege = null)
    {
        return $this->_isCleanIP( '10.0.0.1' );
    }
 
    protected function _isCleanIP($ip)
    {
        return true;
    }
}

?>