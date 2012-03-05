// Header-file for the class with the responsibility
// of parsing JSON-data and returning an object

#include "jsonfuncs.h"
#include <QVariantList>
#include <QVariant>
#include <QString>
#include <libs/code/qjson/parser.h>

// The method that make the magic happen
QVariantList JsonFuncs::GetJsonObject(QByteArray a_jsonData)
{
    QJson::Parser parser;
    QVariantList jsonObjectResult = parser.parse(a_jsonData).toList();
    return jsonObjectResult;
}

QString JsonFuncs::GetSnippetCode(QVariantList a_jsonObject)
{
    QString codeData;
    foreach(QVariant record, a_jsonObject)
    {
        QVariantMap map = record.toMap();
        codeData = map.value("code").toString();
    }
    return codeData;
}
