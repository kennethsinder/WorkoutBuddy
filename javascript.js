/**
 * Created by Kenneth on 2015-10-04.
 */

function ajaxRequest()
{
    try
    {
        var request = new XMLHttpRequest();
    }
    catch (e1)
    {
        try
        {
            request = new ActiveXObject("Msxml2.XMLHTTP");
        }
        catch (e2)
        {
            try
            {
                request = new ActiveXObject("Microsoft.XMLHTTP");
            }
            catch (e3)
            {
                request = false;
            }
        }
    }
    return request;
}

function sendAjaxRequest(id, filename, paramname, param)
{
    if (!param.value)
    {
        O(id).innerHTML = '';
        return;
    }

    params = paramname + "=" + param.value;
    request = new ajaxRequest();
    request.open("POST", filename, true);
    request.setRequestHeader("Content-type",
        "application/x-www-form-urlencoded");
    request.setRequestHeader("Content-length", params.length);
    request.setRequestHeader("Connection", "close");

    request.onreadystatechange = function()
    {
        if (this.readyState == 4)
            if (this.status == 200)
                if (this.responseText != null)
                    O(id).innerHTML = this.responseText;
    }
    request.send(params);
}

function O(i)
{
    return typeof i == 'object' ? i : document.getElementById(i);
}
function S(i)
{
    return O(i).style;
}
function C(i)
{
    return document.getElementsByClassName(i);
}