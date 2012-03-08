#ifndef APIFUNCS_H
#define APIFUNCS_H

#include "filefuncs.h"
#include <QEvent>
#include <QObject>
#include <QString>
#include <QNetworkReply>
#include <QByteArray>
#include "jsonfuncs.h"

class ApiFuncs : public QObject
{
    Q_OBJECT

private:
    FileFuncs *fileFuncs;
    JsonFuncs *jsonFuncs;

public:
    explicit ApiFuncs(QObject *parent = 0);
    void ConnectToApi(QString a_filename, QString a_url, bool &a_errorTest, QString a_search);
    void LoadApiData(QString a_filename, QByteArray a_data, QString a_search);
};

#endif // APIFUNCS_H
