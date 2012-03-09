#ifndef FILEFUNCS_H
#define FILEFUNCS_H

#include <QString>
#include <QByteArray>

class FileFuncs
{
public:
    QString GetUserDir();
    bool CheckIfFileExists(QString a_filename);
    bool CheckIfCacheDirExists();
    QString GetUnixTime(int a_time);
    bool SaveFile(QString a_filename, QByteArray a_data, QString a_search);
    bool CheckIfFileIsTheLatest(QString a_filename);
    QByteArray LoadFile(QString a_filename);
    QString GetSearchString(QString a_filename);
    bool DeleteFile(QString a_filename);
};

#endif // FILEFUNCS_H
