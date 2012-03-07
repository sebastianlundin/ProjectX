#include "settingsfuncs.h"
#include <QString>
#include <QSettings>
#include <QVariant>

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
