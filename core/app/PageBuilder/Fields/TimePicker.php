<?php


namespace App\PageBuilder\Fields;


use App\PageBuilder\Helpers\Traits\FieldInstanceHelper;
use App\PageBuilder\PageBuilderField;

class TimePicker extends PageBuilderField
{
    use FieldInstanceHelper;

    /**
     * render field markup
     * */
    public function render()
    {
        //  Implement render() method.
        $output = '';
        $output .= $this->field_before();
        $output .= $this->label();
        $output .= '<input type="datetime-local" value="'.$this->value().'" name="'.$this->name().'" placeholder="'.$this->placeholder().'"  class="flatpickr '.$this->field_class().'"/>';
        $output .= $this->field_after();

        return $output;
    }
}
