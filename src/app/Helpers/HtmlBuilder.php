<?php

namespace app\Helpers;

use App\Field;
use App\FieldProfile;
use App\Helpers\Contracts\HtmlConvertContract;
use App\Manufacturer;
use App\Profile;
use DB;

class HtmlBuilder implements HtmlConvertContract
{

    /**
     * @param Field $field
     * @return mixed
     */
    public function detectFieldType(Field $field)
    {
        return $field->fieldtype->name;
    }

    /**
     * @param $string
     * @return array
     */
    public function stringToArray($string)
    {
        return array_filter(explode(",", $string));
    }

    /**
     * @param $value
     * @return string
     */
    public function arrayToString($value)
    {
        $stringToSave = "";
        foreach ($value as $_item) {
            $stringToSave .= trim($_item) . ",";
        }
        return $stringToSave;
    }

    /**
     * @param $field
     * @param $profile
     * @return null|string
     */
    public function htmlHelper(Field $field, Profile $profile)
    {

        $fieldTypeName = $this->detectFieldType($field);
        $selectedValue = $this->getSelectedValue($field, $profile);



        switch ($fieldTypeName) {
            case "Input": {
                return $this->buildInputTypeHtml($field, $selectedValue);
            }
                break;

            case "Textarea": {
                return $this->buildTextareaHtml($field, $selectedValue);
            }
                break;
            case "Select box": {
                return $this->buildSelectBoxHtml($field, $selectedValue);
            }
                break;
            case "Checkbox Group": {
                return $this->buildCheckboxGroupHtml($field, $profile);
            }
                break;
            case "Checkbox": {
                return $this->buildCheckboxHtml($field, $selectedValue);
            }
                break;
            case "from-to": {
                return $this->buildFromTo($field, $selectedValue);
            }
                break;

            case "Social Input": {
                return $this->buildSocialInput($field, $selectedValue);
            }
                break;

            case "Special Checkbox": {
                return $this->buildSpecialCheckbox($field, $selectedValue);
            }
                break;

            case "Special Select": {
                return $this->buildSpecialSelect($field, $selectedValue);
            }
                break;

            case "HTML": {
                return $this->buildHtmlBlock($field);
            }
                break;

            case "Checkbox Group Manufacturers": {
                return $this->buildCheckboxGroupManufacturers($field, $profile);
            }
                break;

            case "Selectbox Manufacturers": {
                return $this->buildSelectBoxManufacturers($field, $selectedValue);
            }
                break;

            case "List Architects": {
                return $this->buildListArchitects($field, $selectedValue);
            }
                break;

            default:
                return null;
                break;
        }
    }

    public function buildListArchitects($field, $selectedValue)
    {

        $valuesInList = explode(',', $selectedValue);
        array_pop($valuesInList);

        ?>

        <div class="row">
            <div class="col-md-6">
                <label class="label" for="description"><?php echo $field->name; ?></label>
                <input type="text" placeholder="<?php echo trans('messages.add_architect_to_list_desc'); ?>" id="architect_name"/>
                <input type="hidden" class="architect_name_receiver" name="<?php echo $field->key; ?>"
                       value="<?php echo $selectedValue; ?>">
            </div>
            <div class="col-md-6 text-left">
                <button type="button" class="add_architect_name"><?php echo trans('messages.add_architect_to_list_button'); ?></button>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-12">
                <label class="label" for="description"><?php echo trans('messages.add_architect_to_list_desc'); ?></label>
                <ul class="arch-list">
                    <?php
                    foreach ($valuesInList as $item) {
                        ?>
                        <li><?php echo $item; ?>  <i class="fa fa-times text-danger" aria-hidden="true"></i></li>
                        <?php
                    }
                    ?>
                </ul>
            </div>
        </div>
        <?php
    }

    public function buildSelectBoxManufacturers($field, $selectedValue)
    {
        $optionsArray = Manufacturer::all('name');

        $html = '
            <div class="work-time">
                <div class="name-founded pull-left">
                    <h6 class="description-name text-left">' . $field->name . '</h6>
                    <div class="ui dropdown">
                        <input type="hidden" name="' . $field->key . '" value="' . $selectedValue . '">
                        <div class="default text"><h5 class="text-left pull-left">Choose</h5></div>
                        <i class="dropdown icon"></i>
                        <div class="menu">';
        foreach ($optionsArray as $option) {
            $option = $option->name;
            $html .= "<div class=\"item\" data-value=\"" . $option . "\">" . $option . "</div>";
        }

        $html .= '</div></div></div></div>';
        return $html;
    }

    public function buildCheckboxGroupManufacturers($field, $profile)
    {
        $selectedCheckboxes = [];
        foreach ($profile->store->manufacturers as $manufacturer) {
            $selectedCheckboxes []= $manufacturer->id;
        }
        // $selectedCheckboxes = $this->getSelectedCheckboxes($profile, $field);
        $optionsArray = Manufacturer::limit(8)->offset(0)->get();
        $html = "";
        $html .= "<h4>" . $field->name . "</h4>";
        $html .= "<div class='group-checkboxes brands-limited-boxes row'>";
        
        foreach ($optionsArray as $option) {
            $optionName = $option->name;
            (in_array(trim($option->id), $selectedCheckboxes)) ? $checked = " checked" : $checked = "";
            $html .= "<div class='form-group col-md-6 text-left'>";
            $html .= "<input class='checkbox-inline' value='" . $option->id . "' type='checkbox' id='" . $optionName . "' name='" . $field->key . "[]'" . $checked . "/>";
            $html .= "<label for='" . $optionName . "'>" . $optionName . "</label>";
            $html .= "</div>";
        }

        $html .= "</div>";

        $optionsArray = Manufacturer::limit(1500)->offset(8)->get();
        $html .= "<div>";
        $html .= "<a class='toggle-hidden-next' href='javascript:void(0)'>show all " . Manufacturer::all()->count() . " Brands</a>";
        $html .= "</div>";
        $html .= "<div class='group-checkboxes brands-limited-boxes row hidden-brands hidden'>";

        foreach ($optionsArray as $option) {
            $optionName = $option->name;
            (in_array(trim($option->id), $selectedCheckboxes)) ? $checked = " checked" : $checked = "";
            $html .= "<div class='form-group col-md-6 text-left'>";
            $html .= "<input class='checkbox-inline' value='" . $option->id . "' type='checkbox' id='" . $optionName . "' name='" . $field->key . "[]'" . $checked . "/>";
            $html .= "<label for='" . $optionName . "'>" . $optionName . "</label>";
            $html .= "</div>";
        }

        $html .= "</div>";

        return $html;
    }

    public function buildSpecialSelect($field, $selectedValue)
    {
        $optionsArray = explode(",", $field->values);

        $html = '
            <div class="work-time">
                <div class="name-founded pull-left">
                    <h6 class="description-name text-left">' . $field->name . '</h6>
                    <div class="ui dropdown">
                        <input type="hidden" name="' . $field->key . '" value="' . $selectedValue . '">
                        <div class="default text"><h5 class="text-left pull-left">Choose</h5></div>
                        <i class="dropdown icon"></i>
                        <div class="menu">';
        foreach ($optionsArray as $option) {
            $html .= "<div class=\"item\" data-value=\"" . $option . "\">" . $option . "</div>";
        }

        $html .= '</div></div></div></div>';
        return $html;
    }

    public function buildHtmlBlock($field)
    {
        $html = "<div class='" . $field->key . "'>" . $field->values . "</div>";
        return $html;
    }

    public function buildSocialInput($field, $selectedValue)
    {
        $html = '<div class="fb-tw-fan">
                    <div class="fb-top">
                        <div class="pull-left" style="width: 80%;">
                        <h6 style="color: rgb(58, 90, 149)" class=" text-left description-name">
                            ' . $field->name . ':
                            </h6>
                            <p class="text-left fb-tw-links">';
        $html .= "<input 
        value='" . $selectedValue . "' 
        class='form-control fieldtype-socialinput' 
        type='text' 
        id='" . $field->key . "' 
        name='" . $field->key . "' 
        placeholder='" . $field->name . "'/>";
        $html .= '</p>
                        </div>
                        <a class="fb-icon pull-right" href="' . $selectedValue . '"></a></div>
                </div>';
        return $html;
    }

    public function buildFromTo($field, $selectedValue)
    {
        if (!empty($selectedValue)) {
            $values = explode(",", $selectedValue);
            $working_hours_from = $values[0];
            $working_hours_to = $values[1];
        } else {
            $working_hours_from = 0;
            $working_hours_to = 0;
        }
        $html = '<div class="row">
            <div class="work-time col-sm-12">
                <h5 class="text-left">' . $field->name . '</h5>
                <div class="name-founded pull-left">
                    <h6 class="description-name text-left">Von:</h6>
                    <div class="ui dropdown">
                        <input type="hidden" name="working_hours_from" value="' . $working_hours_from . '">
                        <div class="default text"><h5 class="text-left pull-left">Uhr</h5></div>
                        <i class="dropdown icon"></i>
                        <div class="menu">
                            <div class="item" data-value="08:00">08:00</div>
                            <div class="item" data-value="09:00">09:00</div>
                            <div class="item" data-value="10:00">10:00</div>
                            <div class="item" data-value="11:00">11:00</div>
                            <div class="item" data-value="12:00">12:00</div>
                        </div>
                    </div>
                </div>
    
                <div class="name-founded pull-left">
                    <h6 class="description-name text-left">Bis:</h6>
                    <div class="ui dropdown">
                        <input type="hidden" name="working_hours_to" value="' . $working_hours_to . '">
                        <div class="default text"><h5 class="text-left pull-left">Uhr</h5></div>
                        <i class="dropdown icon"></i>
                        <div class="menu">
                            <div class="item" data-value="16:00">16:00</div>
                            <div class="item" data-value="17:00">17:00</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>';
        return $html;
    }

    public function buildSpecialCheckbox($field, $selectedValue)
    {
        if ($selectedValue == "on")
            $checked = " checked";
        else
            $checked = "";

        $checkbox = "<input type='checkbox' class='js-switch' id='" . $field->key . "' name='" . $field->key . "'" . $checked . "/>";
        $checkbox .= "<label class='special-label' for='" . $field->key . "'> " . $field->name . "</label>";
        return $checkbox;
    }

    public function buildCheckboxHtml($field, $selectedValue)
    {
        if ($selectedValue == "on")
            $checked = " checked";
        else
            $checked = "";
        $checkbox = "<label for='" . $field->key . "'>" . $field->name . "</label>";
        $checkbox .= "<input type='checkbox' id='" . $field->key . "' name='" . $field->key . "'" . $checked . "/>";
        return $checkbox;
    }

    public function buildCheckboxGroupHtml($field, $profile)
    {
        $selectedCheckboxes = $this->getSelectedCheckboxes($profile, $field);
        $optionsArray = explode(",", $field->values);
        $html = "";
        $html .= "<h4>" . $field->name . "</h4>";
        $html .= "<div class='group-checkboxes row'>";
        foreach ($optionsArray as $option) {
            (in_array(trim($option), $selectedCheckboxes)) ? $checked = " checked" : $checked = "";
            $html .= "<div class='form-group col-md-6 text-left'>";
            $html .= "<input class='checkbox-inline' value='" . $option . "' type='checkbox' id='" . $option . "' name='" . $field->key . "[]'" . $checked . "/>";
            $html .= "<label for='" . $option . "'>" . $option . "</label>";
            $html .= "</div>";
        }
        $html .= "</div>";

        return $html;
    }

    /**
     * @param $field
     * @param $selectedValue
     * @return string
     */
    public function buildSelectBoxHtml($field, $selectedValue)
    {
        $optionsArray = explode(",", $field->values);

        $select = "<select class='form-control' name='" . $field->key . "'>";
        $select .= "<option>Select " . $field->name . "</option>";
        foreach ($optionsArray as $option) {
            ($selectedValue == $option) ? $selectedCheck = " selected" : $selectedCheck = "";
            $select .= "<option value='" . $option . "'" . $selectedCheck . ">" . $option . "</option>";
        }
        $select .= "</select>";
        return $select;
    }

    public function buildTextareaHtml($field, $selectedValue)
    {
        $html = "<label class='label' for='" . $field->key . "'>" . $field->name . "</label>";
        $html .= "<textarea class='form-control fieldtype-textarea' id='" . $field->key . "' name='" . $field->key . "' placeholder='" . $field->name . "'>" . $selectedValue . "</textarea>";
        return $html;
    }

    public function buildInputTypeHtml(Field $field, $selectedValue)
    {

        $html = "<label class='label' for='" . $field->key . "'>" . $field->name . "</label>";
        $html .= "<input 
        value='" . $selectedValue . "' 
        class='form-control fieldtype-input' 
        type='text' 
        id='" . $field->key . "' 
        name='" . $field->key . "' 
        placeholder='" . $field->name . "'/>";
        return $html;
    }

    /**
     * @param $profile
     * @param $field
     * @return FieldProfile
     */
    public function selectedRow($profile, $field)
    {
        return FieldProfile::where(['field_id' => $field->id, 'profile_id' => $profile->id])->get()->first();
    }

    public function getSelectedCheckboxes($profile, $field)
    {
        /** @var FieldProfile $selectedRow */
        $selectedRow = $this->selectedRow($profile, $field);

        if (is_object($selectedRow) && is_object($selectedRow->translate())) {
            $selectedRow_value = $selectedRow->translate()->selected;
            $selectedCheckboxes = $this->stringToArray($selectedRow_value);
        } else {
            $selectedCheckboxes = array();
        }
        return $selectedCheckboxes;
    }

    /**
     * @param $field
     * @param $profile
     * @return string
     */
    public function getSelectedValue(Field $field, Profile $profile)
    {
        /** @var FieldProfile $fieldProfilePIVOT */
        $fieldProfilePIVOT = FieldProfile::where(['field_id' => $field->id, 'profile_id' => $profile->id])->get()->first();
        if (is_object($fieldProfilePIVOT)) {
            if (is_object($fieldProfilePIVOT->translate()))
                $selectedValue = $fieldProfilePIVOT->translate()->selected;
            else
                $selectedValue = '';
        } else {
            $selectedValue = '';
        }
        return $selectedValue;
    }

}