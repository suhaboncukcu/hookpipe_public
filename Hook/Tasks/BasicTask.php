<?php
namespace App\HookPipe\Hook\Tasks;

use Cake\Datasource\ModelAwareTrait;

abstract class BasicTask implements TaskInterface {

	use ModelAwareTrait;

	public $_models = [];

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