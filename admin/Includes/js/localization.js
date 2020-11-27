function ReloadCardData()
{
    ReloadLocaleCard();
}

function ReloadLocaleCard()
{
    $("#localizationCard_locale").load("Localization/Ajax/CardData_Locale.php");
}


function AddLocale()
{
    console.log("AddLocale");
    var locale = $("#AddLocale_locale").val();
    var url = "Localization/PostScripts/AddLocale.php?locale="+locale;
    console.log(url);
    $("#ProcessDiv").load(url,()=>{
        console.log("HERE");
        var response = $("#ProcessDiv").text();
        var results = response.split(",");
        console.log("RESPONSE: " + response);
        if(results[0] == 0)
        {
            console.log("SUCCESS: " + results[1]);
            //Success
            ReloadCardData();
           // LoadPage('localization.php');
            AddToastNotification("Success", results[1], 1);
        }
        else if(results[0] == 1)
        {
            //Failure
            AddToastNotification("Error", results[1], 3);
        }
    });
}

function DeleteLocale()
{
    var locale = $("#DeleteLocale_locale").val();
    console.log("DeleteLocale: " + locale);
    if (confirm('Are you sure you want to Delete all keys associated with locale "'+locale+'"?\nThis action cannot be undone.')) {
        var url = "Localization/PostScripts/DeleteLocale.php?locale="+locale;
        $("#ProcessDiv").load(url,()=>{
            var response = $("#ProcessDiv").text();
            var results = response.split(",");
            if(results[0] == 0)
            {
                //Reload whole page, then load localization editor
                ReloadPage();
                AddToastNotification("Success", results[1], 1);
            }
            else if(results[0] == 1)
            {
                AddToastNotification("Error", results[1], 3);
            }
        });
    }
}

function ExportLocale(locale)
{
    console.log("ExportLocale(" + locale + ")");
    var url = "Localization/PostScripts/ExportLocale.php?locale="+locale;
    window.open(url,"_blank");
    AddToastNotification("Success", "Exported locale "+locale, 1);
}

function ExportAlllocales()
{
}