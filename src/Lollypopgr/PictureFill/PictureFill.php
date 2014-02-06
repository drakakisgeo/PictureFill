<?php namespace Lollypopgr\PictureFill;

use Config;

class PictureFill {

    private $ruleSet;
    private $imageFolder;
    protected static $instance;

    public function __construct(array $ruleSetName=null,$imageFolder=null){

        $this->ruleSet = !is_null($ruleSetName) ?: Config::get('picture-fill::default') ;
        $this->imageFolder = $imageFolder;
    }


    /**
     * Create the boilerplate markup for
     * scottjehl/picturefill
     *
     * @param  string $image
     * @param  string $altText
     * @param  array $ruleSet
     * @return string
     */
    public function responsiveImage($image,$altText,array $ruleSet=null){

        $image = is_null($this->imageFolder) ? $image : $this->imageFolder.$image;

        $ruleSet = is_null($ruleSet) ? $this->ruleSet : $ruleSet;

        $output = '<span data-picture data-alt="'.$altText.'">';
        $output .= '<span data-src="'.$image.'"></span>';



        foreach($ruleSet as $rule){

          $output .= '<span data-src="'.$this->buildSuffix($image,$rule[0]).'"     data-media="'.$rule[1].'"></span>';
        }

        $output .= '<noscript>
                    <img src="'.$image.'" alt="'.$altText.'">
                    </noscript>
                    </span>';

        return $output;

    }


    /**
     * Build name by adding the suffix
     * @param  string $image     [original name]
     * @param  string $extraname [extra name]
     * @return string            [generated original+extra+extension]
     */
    private function buildSuffix($image,$extraname){
        $extension_pos = strrpos($image, '.');
        return substr($image, 0, $extension_pos) . $extraname . substr($image, $extension_pos);
    }

    /**
     * Set Rules
     * @param array $rules
     */
    public function set_ruleSet(array $rules){
        $this->ruleSet = $rules;
    }

    /**
     * Get Rules
     * @return [type]
     */
    public function get_ruleSet(){
        return $this->ruleSet;
    }



    /**
    * Handle dynamic method calls
    *
    * @param string $name
    * @param array $args
    */
    public static function __callStatic($name,$args)
    {
        $instance = static::$instance;
        if ( ! $instance) $instance = static::$instance = new static;
        if($name=="make"){
            if(sizeof($args)>2){

            $sizes = is_array($args[2]) ? $args[2] :null;

            }else{
                $sizes = null;
            }

            return $instance->responsiveImage($args[0],$args[1],$sizes);
        }
    }
}


