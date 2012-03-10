// Class (header-file) for getting the api-adress from settings

// Includes all the importen libs (in qt)
// that we need to use for this class to work
#include "settingsfuncs.h"
#include <QString>
#include <QSettings>
#include <QVariant>

// Get the api-adress from settings.
// If there isn't any adress in the
// settings. Use a default-adress of
// http://tmpn.se/api instead
QString SettingsFuncs::GetApiUrl()
{    
    QVariant apiUrl;
    QSettings settings("ProjectX", "Snippt");
    settings.beginGroup("SnipptSettings");
    apiUrl = settings.value("apiurl");
    QString apiUrlConv = apiUrl.toString();
    settings.endGroup();

    if (apiUrlConv == "")
    {
        apiUrlConv = "http://tmpn.se/api";
    }

    return apiUrlConv;
}
