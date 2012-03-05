#include "apifuncs.h"
#include <QNetworkRequest>
#include <QNetworkAccessManager>
#include <QNetworkReply>
#include <QSignalMapper>
#include <QString>
#include <QByteArray>
#include <QEventLoop>

ApiFuncs::ApiFuncs(QObject *parent) : QObject(parent)
{
    this->fileFuncs = new FileFuncs();
}

void ApiFuncs::ConnectToApi(QString a_filename, QString a_url, bool &a_errorTest)
{
    if (this->fileFuncs->CheckIfFileExists(a_filename) == false || this->fileFuncs->CheckIfFileIsTheLatest(a_filename) == false)
    {
        QNetworkRequest networkRequest;
        networkRequest.setUrl(QUrl(a_url));
        QNetworkAccessManager *networkManager = new QNetworkAccessManager();
        QNetworkReply *networkReply = networkManager->get(networkRequest);

        QEventLoop loop;
        connect(networkReply, SIGNAL(finished()), &loop, SLOT(quit()));
        connect(networkReply, SIGNAL(error(QNetworkReply::NetworkError)), &loop, SLOT(quit()));
        loop.exec();

        if (networkReply->error())
        {
            a_errorTest = false;
        }
        else if (networkReply->isFinished())
        {
            this->LoadApiData(a_filename, networkReply->readAll());
            disconnect(networkReply, SIGNAL(finished()), &loop, SLOT(quit()));
            loop.quit();
        }
    }
}

void ApiFuncs::LoadApiData(QString a_filename, QByteArray a_data)
{
    this->fileFuncs->SaveFile(a_filename, a_data);
}
