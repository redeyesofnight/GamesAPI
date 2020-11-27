var currentToastID = 0;
$(document).ready(function(){
    var url = window.location.href;
    if(url.endsWith("#LocalizationEditor"))
    {
        LoadPage("Localization/LocalizationEditor.php");
    }
  });

function LoadPage(url)
{
    $("#ContentDiv").load(url,()=>{
        console.log("Load " + url);
    });
}

function ReloadPage()
{
    window.location = window.location.href;
    window.location.reload();
}

function AddToastNotification(titleText, bodyText, toastLevel)
{
    //ToastLevel 0=info, 1=success, 2=warning, 3=error
    var toastID = "toast_"+currentToastID;
    currentToastID++;
    var color = "grey";
    var svg = '<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-exclamation-circle-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">';  
    svg += '<path fill-rule="evenodd" d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8 4a.905.905 0 0 0-.9.995l.35 3.507a.552.552 0 0 0 1.1 0l.35-3.507A.905.905 0 0 0 8 4zm.002 6a1 1 0 1 0 0 2 1 1 0 0 0 0-2z"/>';
    svg += '</svg>';
    if(toastLevel == 1)
    {
        color = "green";
        svg = '<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-emoji-sunglasses" fill="currentColor" xmlns="http://www.w3.org/2000/svg">';  
        svg += '<path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>';
        svg += '<path fill-rule="evenodd" d="M4.285 9.567a.5.5 0 0 1 .683.183A3.498 3.498 0 0 0 8 11.5a3.498 3.498 0 0 0 3.032-1.75.5.5 0 1 1 .866.5A4.498 4.498 0 0 1 8 12.5a4.498 4.498 0 0 1-3.898-2.25.5.5 0 0 1 .183-.683zM6.5 6.497V6.5h-1c0-.568.447-.947.862-1.154C6.807 5.123 7.387 5 8 5s1.193.123 1.638.346c.415.207.862.586.862 1.154h-1v-.003l-.003-.01a.213.213 0 0 0-.036-.053.86.86 0 0 0-.27-.194C8.91 6.1 8.49 6 8 6c-.491 0-.912.1-1.19.24a.86.86 0 0 0-.271.194.213.213 0 0 0-.036.054l-.003.01z"/>';
        svg += '<path d="M2.31 5.243A1 1 0 0 1 3.28 4H6a1 1 0 0 1 1 1v1a2 2 0 0 1-2 2h-.438a2 2 0 0 1-1.94-1.515L2.31 5.243zM9 5a1 1 0 0 1 1-1h2.72a1 1 0 0 1 .97 1.243l-.311 1.242A2 2 0 0 1 11.439 8H11a2 2 0 0 1-2-2V5z"/>';
        svg += '</svg>';
    }
    else if(toastLevel == 2)
    {
        color = "orange";
        svg = '<svg width="1.0625em" height="1em" viewBox="0 0 17 16" class="bi bi-exclamation-triangle" fill="currentColor" xmlns="http://www.w3.org/2000/svg">';  
        svg += '<path fill-rule="evenodd" d="M7.938 2.016a.146.146 0 0 0-.054.057L1.027 13.74a.176.176 0 0 0-.002.183c.016.03.037.05.054.06.015.01.034.017.066.017h13.713a.12.12 0 0 0 .066-.017.163.163 0 0 0 .055-.06.176.176 0 0 0-.003-.183L8.12 2.073a.146.146 0 0 0-.054-.057A.13.13 0 0 0 8.002 2a.13.13 0 0 0-.064.016zm1.044-.45a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566z"/>';
        svg += '<path d="M7.002 12a1 1 0 1 1 2 0 1 1 0 0 1-2 0zM7.1 5.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995z"/>';
        svg += '</svg>';
    }
    else if(toastLevel ==3)
    {
        color = "red";
        svg = '<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-exclamation-circle" fill="currentColor" xmlns="http://www.w3.org/2000/svg">';  
        svg += '<path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>';
        svg += '<path d="M7.002 11a1 1 0 1 1 2 0 1 1 0 0 1-2 0zM7.1 4.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 4.995z"/>';
        svg += '</svg>';
    }

    var toast = '<div class="toast md-warn" id="'+toastID+'"role="alert" aria-live="assertive" aria-atomic="true" data-delay="10000">';
        toast +='<div class="toast-header">';
        
        toast += svg;
        //toast +='<img src="..." class="rounded mr-2" alt="...">';
        toast +='<strong class="mr-auto" style="color:'+color+'">'+titleText+'</strong>';
        toast +='<small class="text-muted">just now</small>';
        toast +='<button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">';
        toast +='<span aria-hidden="true">&times;</span>';
        toast +='</button>';
        toast +='</div>';
        toast +='<div class="toast-body">';
        toast += '<rect width="100%" height="100%" fill="red" />';
        toast += bodyText;
        toast +='</div>';
        toast +='</div>';

    $("#toastNotificationArea").append(toast);
    $('#'+toastID).toast('show');
}