<?php
    require_once('LocalizationDatabase.inc.php');
    
    $supportedLocales = GetSupportedLocales();
    $localeOptionBox = "";
    foreach($supportedLocales->locale_codes as $locale)
    {
        $localeOptionBox .="<option value='$locale'>$locale</option>";
    }
?>

<div id="LocalizationEditor">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm">
                <!-- Add Locale Card -->
                <div class = "card">
                    <div class = "card-header">
                        <h5 class="card-title">Add Locale</h5>
                    </div>
                    <div class = "card-body">
                        <form>
                            <div class="form-group">
                                <label for="AddLocale_locale">Locale Code</label>
                                <input type="text" class="form-control" id="AddLocale_locale" aria-describedby="localeHelp" placeholder="Enter Locale">
                                <small id="localeHelp" class="form-text text-muted">Current Locales: 
                                <?php
                                    for($i=0;$i<count($supportedLocales->locale_codes);$i++)
                                    {
                                        if($i>0)
                                            echo ", ";
                                            
                                        echo $supportedLocales->locale_codes[$i];
                                    }
                                ?>
                                </small>
                            </div>
                            <button type="submit" class="btn btn-primary" onclick=AddLocale();>Submit</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-sm">
                <!--Delete Locale Card-->
                <div class = "card">
                    <div class = "card-header">
                        <h5 class="card-title">Delete Locale</h5>
                    </div>
                    <div class = "card-body">
                        <form>
                            <div class="form-group">
                                <label for="DeleteLocale_locale">Locale Code</label>
                                <select id='DeleteLocale_locale'>
                                <?php
                                    echo $localeOptionBox; 
                                ?>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary" onclick=DeleteLocale();>Submit</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-sm">
                <!--Delete Locale Card-->
                <!--<div class = "card">
                    <div class = "card-header">
                        <h5 class="card-title">Delete Locale</h5>
                    </div>
                    <div class = "card-body">
                        <form>
                            <div class="form-group">
                                <label for="DeleteLocale_locale">Locale Code</label>
                                <select id='DeleteLocale_locale'>
                                <?php
                                    echo $localeOptionBox; 
                                ?>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary" onclick=DeleteLocale();>Submit</button>
                        </form>
                    </div>
                </div>-->
            </div>
        </div>
        <div class="row">
            <div class="col-sm">
                <!-- Add Key Card -->
                <div class = "card">
                    <div class = "card-header">
                        <h5 class="card-title">Add Key</h5>
                    </div>
                    <div class = "card-body">
                        <form>
                            <div class="form-group">
                                <label for="AddKey_key">Key</label>
                                <input type="text" id = "AddKey_key"/><br />
                                <label for="AddKey_locale">Locale</label>
                                <select id='AddKey_locale'>
                                <?php
                                    echo $localeOptionBox; 
                                ?>
                                </select>
                                <br />
                                <label for="">Value</label><br />
                                <textarea id="AddKey_value"rows="5" cols="50">
                                </textarea>
                            
                            </div>
                            <button type="submit" class="btn btn-primary" onclick=AddLocalizationKey();>Submit</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-sm">
                <!--Delete Key Card-->
                <div class = "card">
                    <div class = "card-header">
                        <h5 class="card-title">Delete Key</h5>
                    </div>
                    <div class = "card-body">
                        <form>
                            <div class="form-group">
                                <label for="DeleteLocale_locale">Locale Code</label>
                                <select id='DeleteLocale_locale'>
                                <?php
                                    echo $localeOptionBox; 
                                ?>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary" onclick=DeleteLocale();>Submit</button>
                        </form>
                    </div>
                </div>
                <!--Check Key Card-->
                <div class = "card">
                    <div class = "card-header">
                        <h5 class="card-title">Check Key</h5>
                    </div>
                    <div class = "card-body">
                        <form>
                            <div class="form-group">
                            <label for="CheckKey_key">Key</label>
                            <input type="text" id = "CheckKey_key"/>
                            </div>
                            <button type="submit" class="btn btn-primary" onclick=CheckKey();>Submit</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-sm">
                
            </div>
        </div>
    </div>
    
    <hr />
    <h4>Check Key</h4>
    <div id="CheckKey">
        <form>
            <label for="CheckKey_key">Key:</label>
            <input type="text" id = "CheckKey_key"/>
            <input type="submit" id="CheckKey_submit"/>
        </form>
    </div>
    <hr />

    <h4>Export</h4>
    <div id="Export">
        <label for="Export_Lang">Locale: </label>
        <select id='Export_Lang'>
        <?php
            echo $localeOptionBox; 
        ?>
        </select>
        &nbsp;&nbsp;
        <input type="submit" id="Export_submit" value="Export Locale"/>
        <br />
        <input type="submit" id="ExportAll_submit" value="Export All"/>
    </div>
    <hr />
</div>