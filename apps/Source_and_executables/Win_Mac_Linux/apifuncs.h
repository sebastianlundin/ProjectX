#ifndef APIFUNCS_H
#define APIFUNCS_H

#include "filefuncs.h"
#include <QEvent>
#include <QObject>
#include <QString>
#include <QNetworkReply>
#include <QByteArray>

class ApiFuncs : public QObject
{
    Q_OBJECT

private:
    FileFuncs *fileFuncs;

public:
    explicit ApiFuncs(QObject *parent = 0);
    void ConnectToApi(QString a_filename, QString a_url, bool &a_errorTest);
    void LoadApiData(QString a_filename, QByteArray a_data);
};

#endif // APIFUNCS_H
