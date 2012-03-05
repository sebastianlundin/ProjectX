// Header-file for the class with the responsibility
// of parsing JSON-data and returning an object

#ifndef JSONFUNCS_H
#define JSONFUNCS_H

#include <QVariantList>
#include <QByteArray>

// The class for the above description
class JsonFuncs
{
public:
    // The method that make the magic happen
    QVariantList GetJsonObject(QByteArray a_jsonData);
    QString GetSnippetCode(QVariantList a_jsonObject);
};

#endif // JSONFUNCS_H
