<?php
    include_once("../LocalizationDatabase.inc.php");
    
    $supportedLocales = GetSupportedLocales();
    $localeOptionBox = "";
    foreach($supportedLocales->locale_codes as $locale)
    {
        $localeOptionBox .="<option value='$locale'>$locale</option>";
    }
?>
<?php

$out = '
<div class="tab-content">
    <div class="tab-pane active" id="locale_info">
        <table class="table">
        <thead>
            <tr>
            <th>Existing Locales</th>
        </thead>
        <tbody>';
            foreach($supportedLocales->locale_codes as $locale)
            {
                $out.= "<tr>";
                $out.= "<td>$locale</td>";
                $keyCount = GetKeyCountForLocale($locale);
                $out.= "<td>$keyCount Keys</td>";
                $out.= "</tr>";
            }
$out .='
        </tbody>
        </table>
    </div>
    <div class="tab-pane" id="locale_add">
        <form>
        <div class="row">
            <div class="col-md-5">
            <div class="form-group">
                <label class="bmd-label-floating">Locale Code</label>
                <input type="text" class="form-control" id="AddLocale_locale">
                <small id="localeHelp" class="form-text text-muted">Current Locales:';

                    for($i=0;$i<count($supportedLocales->locale_codes);$i++)
                    {
                        if($i>0)
                            $out .= ", ";
                            
                        $out.= $supportedLocales->locale_codes[$i];
                    }
$out .='
            </small>
            </div>
            </div>
        </div>
        </form>
        <button class="btn btn-primary" onclick=AddLocale();>Submit</button>
    </div>
    <div class="tab-pane" id="locale_delete">
        <form>
        <div class="row">
            <div class="col-md-5">
                <div class="form-group">
                <label for="DeleteLocale_locale" class="bmd-label-floating">Locale Code</label>
                <select id="DeleteLocale_locale" class="form-control">';
                    $out .= $localeOptionBox; 
$out .= '
                    </select>
                </div>
                <button type="submit" class="btn btn-primary" onclick=DeleteLocale();>Submit</button>
            </div>
            </div>
        </form>
    </div>
</div>';

echo $out;
?>