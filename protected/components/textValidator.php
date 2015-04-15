<?
/* валидация разных текстов */
class textValidator extends CValidator
{
 
    private $patterns = array(
        'iden' => '-_a-z\.0-9',
        'string' => '- _\w\W\.0-9 ,!\?',
        'text' => '- _\w\W\.0-9 ,!\?',
        'message' => '-_a-z\.0-9 ,!\?',
        'html' => '-_a-z\.0-9 ,!\?',
    );
    
    public $format="iden";
 
    protected function validateAttribute($object,$attribute)
    {
        
        if( $object->$attribute!='' and $object->$attribute!=null)  {
                        
            if(isset($this->patterns[$this->format])) {
                $object->$attribute=trim($object->$attribute);
                if(!preg_match("~^[".$this->patterns[$this->format]."]+$~",$object->$attribute)) {
                    $attrLabels = $object->attributeLabels();
                    $object->addError($attribute, 
                            t('Неподходящий формат текстовых данных. '
                            . 'Список допустимых символов: '
                            .$this->patterns[$this->format] ));
                }
            }

        
        }

    }
}