<?php
namespace Dsc\Traits\Models;

trait ForSelection
{

    public $__select2_fields = array(
        'id' => '_id',
        'text' => 'title',
        'slug' => 'slug'
    );

    protected function forSelectionBeforeValidate($field)
    {
        if (!empty($this->$field) && !is_array($this->$field))
        {
            $this->$field = trim($this->$field);
            if (!empty($this->$field))
            {
                $this->$field = \Base::instance()->split((string) $this->$field);
            }
        }
        elseif (empty($this->$field) && !is_array($this->$field))
        {
            $this->$field = array();
        }
    }

    /**
     * Helper method for creating select list options
     *
     * @param array $query            
     * @return multitype:multitype:string NULL
     */
    public static function forSelection(array $query = array())
    {
        $model = new static();
        
        $cursor = $model->collection()->find($query, array(
            $model->__select2_fields['text'] => 1
        ));
        $cursor->sort(array(
            $model->__select2_fields['text'] => 1
        ));
        
        $result = array();
        foreach ($cursor as $doc)
        {
            $array = array(
                'id' => (string) $doc[$model->__select2_fields['id']],
                'text' => htmlspecialchars($doc[$model->__select2_fields['text']], ENT_QUOTES)
            );
            $result[] = $array;
        }
        
        return $result;
    }
}