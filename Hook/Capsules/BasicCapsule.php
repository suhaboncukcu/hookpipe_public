<?php
namespace App\HookPipe\Hook\Capsules;

use Cake\Datasource\ModelAwareTrait; 

/**
 * Basic capsule fits to pipes.
 */
abstract class BasicCapsule implements CapsuleInterface {

	use ModelAwareTrait;

	public $_models = [];

	// capsules are objects encapsulating 
	// different types of tasks. 
	// 
	// tasks of capsules are smoked according to
	// tasks array. If you need to smoke just one task,
	// you may pipe it directly or create a capsule with
	// just one task. If you need to change smoking order
	// in time; you should encapsulate your each task. 
	// 
	// do not forget all the tasks must be  tasks objects 
	// defined with their smoke function
	public  $tasks = [];

	public function __construct()
	{
		if (count($this->_models)) {
            foreach ($this->getModels() as $model) {
                $this->loadModel($model);
            }
        }
	}

    /**
     * Gets the models.
     *
     * @return     <type>  The models.
     */
    public function getModels(){
        return $this->_models;
    }

}